<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Project;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_project_can_have_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->raw();

        $project = auth()->user()->projects()->create($project);
 
        $this->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
             ->assertSee('Test task');
    }

    public function test_a_task_requires_a_body()
    {
        $this->signIn();

        $project = factory(Project::class)->raw();

        $project = auth()->user()->projects()->create($project);

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');

    }

    public function test_only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
             ->assertStatus(403);
         
    }

    public function test_only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $task = $project->addTask('test task');

        $this->patch($task->path(), ['body' => 'Test task'])
             ->assertStatus(403);
         
        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    public function test_a_task_can_be_updated()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()  
        );

        $task = $project->addTask('Test task');

        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }
}
