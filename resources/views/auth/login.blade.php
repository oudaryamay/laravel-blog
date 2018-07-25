<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lone Wolf | Login</title>

    <!-- title and css -->
    @include('adminTemplate._head')
    <!-- /title and css -->
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            {!! Form::open() !!}
              <h1>Login</h1>
              <div>
               {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
              </div>
              <div>
              {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
              </div>
              <div>
                {{ Form::submit('Log in', ['class' => 'btn btn-default submit']) }}
                {{ Form::checkbox('remember') }}{{ Form::label('remember', "Remember Me") }}
                <a class="reset_pass" href="{{ url('password/reset') }}">Lost your password?</a>
              </div>

              <div class="clearfix"></div>
            {!! Form::close() !!}
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
