@extends('layouts.app')

@section('content')    
    <h2> {{ $project->title }} </h2>
    <div>
        {{ $project->description }}
    </div>
   <a href="/projects">Go Back</a> 
@endsection