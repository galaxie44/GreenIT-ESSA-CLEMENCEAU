@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <p>Login :</p>
            <input type="text" name="login" size="20" maxlength="50">
            <p>Mot de passe :</p>
            <input type="password" name="password" size="20" maxlength="50">
            <br><br>
            <input type="submit" value="Valider">
        </form>
        @if($errors->has('credentials'))
            <div class="text-danger mt-2">{{ $errors->first('credentials') }}</div>
        @endif
    </div>
@endsection

