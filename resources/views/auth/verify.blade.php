@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Falta pouco para terminarmos, por favor verifique seu email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Reenviamos um novo email com link para verificação.
                        </div>
                    @endif

                    Para poder ter acesso ao sistema por favor verifique seu email e clique no link.
                    Caso não tenha recebido clique no link,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Reenviar link</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
