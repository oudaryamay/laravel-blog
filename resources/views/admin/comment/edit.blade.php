            @extends('admin')

            @section('title', 'Edit Comment')

            @section('stylesheets')

           {{ Html::style('admin/css/parsley.css') }}
         
            <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
            <script>
              tinymce.init({
                selector: 'textarea',
                height: 250,
                  menubar: false,
                  plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                  ],
                  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify bullist numlist outdent indent',
                  content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css']
                   });
            </script>
            @endsection


            @section('content')

       <!-- page content -->
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Comment <small>{{ Html::linkRoute('ob-admin.comment.index' ,'All Comments', array(), ['class' => 'btn btn-success'])}}</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <?php //echo '<pre>'; print_r($post); echo'</pre>';?>
            <div class="clearfix"></div>
           {!! Form::model($comment, ['route' => ['ob-admin.comment.update',  $comment->id], 'method' => 'PUT', 'files' => 'true']) !!}
            <div class="row">
             <div class="col-md-9 col-sm-9 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Update comment </h2>
                 <div class="clearfix"></div>
                </div>
                <div class="x_content">
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
                  
                  {{ Form::label('Author', 'Author *') }}
                  {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                   <div class="divider-dashed"></div>

                  {{ Form::label('email', 'Email *') }}
                  {{ Form::email('email', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                  <div class="divider-dashed"></div>

                  {{ Form::label('comment', 'Comment *') }}
                  {{ Form::textarea('comment', null, array('class' => 'resizable_textarea form-control')) }}
                  
                  <br />

                   </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="x_panel">
                          <div class="x_title">
                            <h2>Action</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                         <ul class="legend list-unstyled">
                                <li>
                               <p>
                                In response to : {!! Html::linkRoute('ob-admin.posts.edit', $comment->post->title, array($comment->post_id), array('class' => 'btn btn-primary btn-block')) !!}
                                </p>
                                </li>
                                <div class="divider-dashed"></div>
                              <li>
                               <p>
                                Approved :  {{ Form::select('approved', ['0' => 'No', '1' => 'Yes'], null, ['class' => 'form-control']) }}
                                </p>
                                </li>
                                <div class="divider-dashed"></div>
                                <li>
                                <p>
                                Created at : {{date('M j, Y', strtotime($comment->created_at))}}
                                </p>
                              </li>
                              <div class="divider-dashed"></div>
                               <li>
                                <p>
                                Updated at : {{date('M j, Y', strtotime($comment->updated_at))}}
                                </p>
                              </li>
                              <li>
                                <p>
                                {{ Form::submit('Update', array('class' => 'btn btn-success btn-block')) }}
                                </p>
                              </li>
                            </ul>

                          </div>
                        </div>
            </div>


              </div>
            {!! Form::close() !!}
        <!-- /page content -->


     @endsection

     @section('scripts')

    {{ Html::script('admin/js/parsley.min.js') }}

    @endsection