@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tarefas
                    <a href="{{route('tarefa.exportacao', ['extensao' => 'xlsx'])}}" class="col-1" style="float:right; text-decoration: none;">XLSX</a>
                    <a href="{{route('tarefa.exportacao', ['extensao' => 'csv'])}}" class="col-1" style="float:right; text-decoration: none;">CSV</a>
                    <a href="{{route('tarefa.exportacao', ['extensao' => 'pdf'])}}" class="col-1" style="float:right; text-decoration: none;">PDF</a>
                    </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data Limite para conclusão</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tarefas as $tarefa)
                            <tr>
                                <th scope="row">{{ $tarefa->id }}</th>
                                <td>{{ $tarefa->tarefa }}</td>
                                <td>{{ date('d/m/Y', strtotime($tarefa->data_limite_conclusao)) }}</td>
                                <td><a href="{{route('tarefa.show', ['tarefa'=>$tarefa->id])}}" style="text-decoration: none">Acessar</a></td>
                                <td><a href="{{route('tarefa.edit', ['tarefa'=>$tarefa->id])}}" style="text-decoration: none">Editar</a></td>
                                <td>
                                    <form id="form_{{$tarefa->id}}" method="POST" action="{{route('tarefa.destroy', ['tarefa'=>$tarefa->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" onclick="document.getElementById('form_{{$tarefa->id}}').submit()" style="text-decoration: none">Excluir</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{route('tarefa.create')}}" class='btn btn-button bg-success text-white'>Adicionar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
