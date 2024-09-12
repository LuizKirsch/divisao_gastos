@extends('components.layout.app')

@section('title', 'Criar Evento')

@section('content')
    <div class="container mt-5">
        <h1>Criar Novo Evento</h1>
        <p class="text-center text-danger">
            @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
            @endif
        </p>
        <form action="{{ route('user.event.store') }}" method="post">
            @csrf

            <div class="form-group mb-3">
                <label for="name" class="form-label">Nome do Evento</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Descrição do Evento</label>
                <input type="text" name="description" id="description" class="form-control">
            </div>

            <div class="form-group mb-3">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Selecionar Usuários
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($users as $user)
                            <li>
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" id="user_{{ $user->id }}" class="form-check-input">
                                <label for="user_{{ $user->id }}" class="form-check-label">{{ $user->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                  </div>
            </div>

            <button type="submit" class="btn btn-primary">Criar Evento</button>
        </form>
    </div>
@endsection
