@extends('components.layout.app')

@section('title', 'Eventos')

@section('content')
    <div class="container">
        <h1>Eventos que você está participando</h1>

        <div class="mb-4">
            <a href="{{route('user.event.create')}}" class="btn btn-primary">Criar Novo Evento</a>
        </div>

        @if($events->isEmpty())
            <p>Você não está participando de nenhum evento.</p>
        @else
            <ul class="list-group">
                @foreach ($events as $event)
                    <li class="list-group-item">
                        {{ $event->name }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
