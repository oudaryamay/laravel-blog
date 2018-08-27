@extends('admin')
@section('title', 'Edit Profile')
@section('stylesheets')
{{ Html::style('admin/css/custom.css') }}
@section('content')
<div class="page-title">
   <div class="title_left">
      <h3>Edit Profile</h3>
   </div>
</div>
<div class="clearfix"></div>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>My Profile</h2>
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
            {!! Form::model($user, ['route' => ['profile.update',  $user->id], 'method' => 'PUT', 'files' => 'true']) !!}
            <div class="img-container">
               <?php if ($user->profile_image != null)  { ?>
               <img id="instant-img" src="{{url('/uploads/' . $user->profile_image)}}" alt="your image" class="profile-img-center" />
               <?php } else { ?>
               <img id="instant-img" src="{{url('/admin/images/default_avatar.png')}}" alt="your image" class="profile-img-center" />
               <?php } ?>
               <div class="middle">
                  <div class="overlay-text">
                     {{ Form::file('profile_img', ['id' => 'imgInp']) }}
                  </div>
               </div>
            </div>
            <div class="divider-dashed"></div>
            {{ Form::label('name', "Name:") }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            <div class="divider-dashed"></div>
            {{ Form::label('email', 'Email:') }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}
            <div class="divider-dashed"></div>
            {{ Form::submit('Update profile', ['class' => 'btn btn-success btn-block']) }}
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
<script>
   function readURL(input) {
   
   if (input.files && input.files[0]) {
   var reader = new FileReader();
   
   reader.onload = function(e) {
   $('#instant-img').attr('src', e.target.result);
   }
   
   reader.readAsDataURL(input.files[0]);
   }
   }
   
   $("#imgInp").change(function() {
   readURL(this);
   });
</script>
@endsection