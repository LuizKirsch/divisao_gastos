@extends('components.layout.app')

@section('title', 'Eventos')

@section('content')
    <div class="container">
        {{-- Toast para sucesso --}}
        @if(session('success'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        {{-- Toast para erro --}}
        @if($errors->any())
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <h1>Eventos que você está participando</h1>

        <div class="mb-4">
            <a href="{{ route('user.event.create') }}" class="btn btn-primary">Criar Novo Evento</a>
        </div>

        @if($events->isEmpty())
            <p>Você não está participando de nenhum evento.</p>
        @else
            <ul class="list-group">
                @foreach ($events as $event)
                    <li class="list-group-item">
                        {{ $event->name }} || Criado por: {{ $event->user->name }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl)
            });
            
            toastList.forEach(toast => toast.show());
        });
    </script>    
@endsection
