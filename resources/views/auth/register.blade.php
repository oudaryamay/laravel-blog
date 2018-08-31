@extends('main')

@section('title', '| Register')

@section('content')

<section class="jumbotron text-center">
<div class="container">
  <h1 class="jumbotron-heading">Register</h1>
</div>
</section>


	<div class="row">
		<div class="col-md-3 col-md-offset-3">
		</div>

		<div class="col-md-6 col-md-offset-3">
			<h2>Welcome! to Lone Wolf World!</h2>
			{!! Form::open() !!}

				{{ Form::label('name', "Name:") }}
				{{ Form::text('name', null, ['class' => 'form-control']) }}
				<br>
				{{ Form::label('email', 'Email:') }}
				{{ Form::email('email', null, ['class' => 'form-control']) }}
				<br>
				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password', ['class' => 'form-control']) }}
				<br>
				{{ Form::label('password_confirmation', 'Confirm Password:') }}
				{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
				<br>
				{{ Form::submit('Register', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

			{!! Form::close() !!}
		</div>

		<div class="col-md-3 col-md-offset-3">
		</div>
	</div>

@endsection