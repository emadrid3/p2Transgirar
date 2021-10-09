@extends('layouts.app')

@section('login')

<div class="login-view" style="heigth: 100%;">
    <div class="login-view__img"></div>
    <div class="login-view__form">
    
    <div class="transgirar-icon">
      <img
        src="/img/logo.jpeg"
        width="100px"
        height="auto"
      />
    </div>
    
    <h1 class="form-title">Transgirar</h1>

    <p class="form-paragraph">Ingrese las credenciales del sistema.</p>
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="username-input">
                <label class="username-input__label" for="username">Correo electrónico</label>
                <input id="email" type="email" class="username-input__tag @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>Las credenciales no coinciden, Por favor intentelo otra vez</strong>
                    </span>
                @enderror
            </div>
            <div class="password-input">
                <label class="password-input__label" for="password">Contraseña</label>
                <input id="password" type="password" class="password-input__tag @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="submit">
            <button type="submit" class="btn btn-success btn-block submit__button">Ingresar <i class="fas fa-sign-in-alt"></i></b-button>
            </div>
        </form>
    </div>
</div>

@endsection
