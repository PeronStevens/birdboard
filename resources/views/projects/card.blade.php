
<div class="card" style="height: 200px;"> 
    <h2 class="mb-6 py-4 -ml-5 border-l-4 border-blue-300 pl-4 mb-3" > 
        <a href="{{ $project->path() }}">
            {{ $project->title }}
        </a>
    </h2>
    <div class="text-grey" >
        {{ Str::limit($project->description, 50) }}
    </div>
</div>