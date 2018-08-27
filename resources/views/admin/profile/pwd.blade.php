@extends('admin')
@section('title', 'Reset Password')
@section('content')
<div class="page-title">
   <div class="title_left">
      <h3>Reset Password</h3>
   </div>
</div>
<div class="clearfix"></div>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Change Password</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <?php //echo '<pre>'; print_r($user); echo '</pre>';?>
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
               <strong>Success : </strong> {{ Session::get('success') }}
            </div>
            @endif
            @if (count($errors) > 0 )
            <div class="alert alert-danger" role="alert">
               <ul>
                  <strong>Errors:</strong>
                  @foreach ($errors->all() as $error )
                  <li>{{$error}}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            {!! Form::open(['route' => ['password.update'], 'method' => 'PUT']) !!}

            {{ Form::label('new_password', "New Password:") }}
            {{ Form::password('new_password', ['class' => 'form-control', 'id' => 'shwpwd']) }}
            <div class="divider-dashed"></div>
            {{ Form::label('password_confirmation', 'Confirm New Password:') }}
            {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'shwpwd']) }}
            <div class="divider-dashed"></div>
            {{ Form::label('old_password', 'Old Password:') }}
            {{ Form::password('old_password', ['class' => 'form-control', 'id' => 'shwpwd']) }}
            <div class="divider-dashed"></div>
            {{ Form::submit('Reset Password', ['class' => 'btn btn-success btn-block']) }}
            
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
@endsection