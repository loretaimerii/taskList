{{-- hello, my name is {{$name}}!!!!!!!!!!!!!!!!!!!! --}}

{{-- if psh nuk e ban pass qat variabel qe o te prit ather duhet me use isset --}}
{{-- @isset($name)
  <div>  hello, my name is {{$name}}!!!!!!!!!!!!!!!!!!!!</div>
@endisset --}}

{{-- <div> --}}
  {{-- @if(count($tasks))
    @foreach ($tasks as $task)
      <div>{{$task->title}}</div>
    @endforeach
  @else
    <div>There are no tasks!</div>
  @endif --}}
  {{-- @forelse($tasks as $task)
    <div>
        <a href=" {{ route('tasks.show',['id' => $task->id])}}">{{$task->title}}</a>
    </div>
  @empty
    <div>There are no tasks!</div>
  @endforelse
</div> --}}
@extends('layouts.app')

@section('title','The list of tasks')

@section('content')
  <nav class="mb-4">
    <a href="{{route('tasks.create')}}" class="link">Add task!</a>
  </nav>

  @forelse($tasks as $task)
    <div>
      <a href=" {{ route('tasks.show',['task' => $task->id])}}"
        @class(['line-through' => $task->completed])>{{$task->title}}</a>
    </div>
  @empty
    <div>There are no tasks!</div>
  @endforelse

  @if($tasks->count())
   <nav class="mt-4">
     {{$tasks->links()}}
   </nav>
  @endif
@endsection
