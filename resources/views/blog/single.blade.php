@extends('main')
@section('title','| Show Post')
@section('content')

               <div class="post-title-section">
                  <h1>{{ $post->title }} </h1>
                  <div class="post-info-wrapper">
                     <div class="post-info">{{date('M j, Y', strtotime($post->created_at))}}</div>
                     <div class="post-info">|</div>
                     <a class="post-info when-link" href="/categories/music">{{ $post->category->name }}</a>
                  </div>
               </div>
               <!-- Post Content Column -->
               <div class="col-lg-12 body-copy w-richtext">
                  <!-- Preview Image -->
                   @if(!empty($post->image))
                  <div class="post-img">
                  <img class="img-fluid imgBorder" src="{{url('/uploads/' . $post->image)}}" alt="">
                  </div>
                  @endif
               <div class="blog-content">
                {!! $post-> body !!}
               </div>
           
                  <!-- Comments Form -->

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
                  <div class="card my-4">

                     <h5 class="card-header">Leave Your Comment</h5>
                     <div class="card-body">
                        {{ Form::open(['route' => ['comment.store', $post->id], 'method' => 'POST' ]) }}
                           <div class="row">
                              <div class="col-md-6">
                               {{ Form::label('name', 'Name') }}
                               {{ Form::text('name', null, ['class' => 'form-control']) }}
                              </div>
                              <div class="col-md-6">
                               {{ Form::label('email', 'Email') }}
                               {{ Form::email('email', null, ['class' => 'form-control']) }}
                              </div>
                           </div>
                           <div class="form-group">
                               {{ Form::label('comment', 'Message') }}
                               {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3]) }}
                           </div>
                           {{ Form::submit('Add comment', ['class' => 'btn btn-primary']) }}
                    
                           {{ Form::close() }}
                      </div>
                  </div>
                   <h3 class="comments-title"><i class="fa fa-comments"></i>  {{ $post->comment()->count() }} Comments</h3>
                  <!-- Single Comment -->
                @foreach($post->comment as $com)
                  <div class="media mb-4">
                     <img class="d-flex mr-3 rounded-circle" src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($com->email))) . "?s=50&d=monsterid" }}" alt="">
                     <div class="media-body">
                        <h5 class="mt-0">{{ $com->name }} | {{ date('F dS, Y - g:iA' ,strtotime($com->created_at)) }}</h5>
                        <p> {!! $com->comment !!}</p>
                     </div>
                  </div>
                   @endforeach

               </div>
               <div class="button-wrapper"><a class="button w-button" href="/all-posts">←&nbsp;View all posts</a></div>
              @endsection