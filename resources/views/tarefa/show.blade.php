@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$tarefa->tarefa}}</div>
                <div class="card-body">
                    <fieldset disable>
                        <div class="mb-3">
                            <label class="form-label">Data Limite conclusão</label>
                            <input type="date" class="form-control" value={{$tarefa->data_limite_conclusao}}>
                        </div>
                    </fieldset>
                     <a href="{{url()->previous() /*retornar a pagina anterior acessada pelo client */}}" class="btn btn-primary">Voltar</a>
                     <a href="{{route('tarefa.index') }}" class="btn btn-primary">Listar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
