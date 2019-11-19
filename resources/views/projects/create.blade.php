@extends('layouts.app')

@section('content')
    <form method="POST" action="/projects">
        @csrf
        <h2>Create A Project</h2>
        <div>
            <label for="title">Title</label>
            <div>
                <input name="title" type="text">
            </div>
        </div>

        <div>
            <label for="description">Description</label>
            <div>
                <input name="description" type="text">
            </div>
        </div>
        
        <div>
            <button type="submit">Create Project</button>
            <a href="/projects">Cancel</a>
        </div>        
    </form>
@endsection