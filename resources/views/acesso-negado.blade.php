@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acesso Negado</div>

                <div class="card-body">
                    Desculpe... Você não tem acesso a esse recurso.
                </div>
                <a href="{{route('tarefa.index')}}" class='btn btn-button bg-success text-white'>Tarefas</a>
            </div>
        </div>
    </div>
</div>
@endsection
