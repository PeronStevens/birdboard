@extends('layouts.app')

@section('content')    
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end" >            
            <p class="text-grey text-sm font-normal" >
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>
            <a class="button" href="/projects/create">New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-8">
                    <h2 class="text-grey font-normal text-lg mb-3" >Tasks</h2>
                    
                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf

                                <div class="flex" >
                                    <input type="text" value="{{ $task->body }}" name="body" class="w-full {{ $task->completed ? 'text-grey' : '' }} " >
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }} >
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input class="w-full"  type="text" name="body" placeholder="Add a new task..." >
                        </form>
                    </div>                    
                </div>
                <div>
                    <h2 class="text-grey font-normal text-lg mb-3" >General Notes</h2>

                    <textarea class="card w-full" style="min-height: 200px;" >Irure et nostrud Lorem ullamco.</textarea>                    
                </div>
            </div>
            <div class="lg:w-1/4 px-3" >
                @include('projects.card')
            </div>
        </div>
    </main>
@endsection