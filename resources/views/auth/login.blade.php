<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Meta, title, CSS, favicons, etc. -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Lone wolf | Login</title>
      @include('adminTemplate._head')
      {!! Html::style('admin/css/login.css') !!}
   </head>
   <body>
      <style>
      </style>
      <div class="container">
         <div class="row" id="pwd-container">
            <div class="col-md-4"></div>
            <div class="col-md-4">
               <section class="login-form">
                  {!! Form::open(['role' => 'login']) !!}
                  <p class="login-title"><a target="_blank" href="{{ url('/') }}" class=""><i class="fa fa-paw"></i> <span>Lone Wolf</span></a></p>
                  {{ Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => '@ Address']) }}
                  {{ Form::password('password', ['class' => 'form-control input-lg', 'placeholder' => 'Password']) }}
                  {{ Form::submit('Sign in', ['class' => 'btn btn-lg btn-primary btn-block']) }}
                  <div>
                     {{ Form::checkbox('remember') }}&nbsp;{{ Form::label('remember', "Remember Me") }}
                     or <a href="{{ url('password/reset') }}">reset password</a>
                  </div>
                  {!! Form::close() !!}
                  <div class="form-links">
                     <a href="{{ url('/') }}"> © <?php echo date('Y'); ?> Oudaryamay Burai</a>
                  </div>
               </section>
            </div>
            <div class="col-md-4"></div>
         </div>
      </div>
   </body>
</html>