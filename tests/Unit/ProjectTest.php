<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $project = factory('App\Project')->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    public function test_it_belongs_to_an_owner()
    {
        $project = factory('App\Project')->create();

        $this->assertinstanceof('App\User', $project->owner);
    }

    public function test_it_can_add_a_task()
    {
        $project = factory('App\Project')->create();

        $task = $project->addTask('Test task');

        $this->assertCount(1, $project->tasks);

        $this->assertTrue($project->tasks->contains($task));
    }
}
