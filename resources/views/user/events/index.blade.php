@extends('components.layout.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        @foreach ($events as $event)
            <p>
                {{$event->name}}
            </p>
        @endforeach
    </div>
@endsection
