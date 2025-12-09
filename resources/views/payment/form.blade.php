@extends('layouts.app')

@section('content')
    <main class="container mt-4">
        <form action="{{ route('payment.process') }}" method="post">
            @csrf
            <div class="form-group mt-2">
                <label for="numcatre"> quelle est votre numro de catre</label>
                <input type="text" class="form-control" name="numcatre" id="numcatre">
            </div>
            <div class="form-group mt-2">
                <label for="dateexpeiration"> quelle est la date d'expiration </label>
                <input type="date" class="form-control" name="dateexpeiration" id="dateexpeiration">
            </div>
            <div class="form-group mt-2">
                <label for="numCrypto"> quelle est le cryptogramme </label>
                <input type="text" class="form-control" name="numCrypto" id="numCrypto">
            </div>
            <input type="submit" class="btn btn-primary mt-2" value="envoyer">
        </form>

        @if(session('success'))
            <div class="text-success mt-2">{{ session('success') }}</div>
        @endif
        @if($errors->has('payment'))
            <div class="text-danger mt-2">{{ $errors->first('payment') }}</div>
        @endif
    </main>
@endsection

