@extends('layouts.app')

@section('content')
<h1>Login</h1>
<hr>

<form action="{{ route('login') }}" method="post">
	@csrf
  	<div class="form-group">
    	<label>E-mail</label>
    	<input type="email" name="email" class="form-control">
  	</div>
  	<div class="form-group">
    	<label>Senha</label>
    	<input type="password" name="password" class="form-control">
  	</div>
  	<button type="submit" class="btn btn-default">Entrar</button>
</form>
@endsection