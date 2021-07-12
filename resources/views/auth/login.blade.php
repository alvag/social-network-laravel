@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card border-0 bg-light px-4 py-2">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control border-0" id="email" type="email" name="email"
                                       placeholder="Tu correo...">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input class="form-control border-0" id="password" type="password" name="password"
                                       placeholder="Tu contraseña...">
                            </div>
                            <button id="login-btn" class="btn btn-block btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
