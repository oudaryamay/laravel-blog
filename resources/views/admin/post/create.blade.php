            @extends('admin')

            @section('title', 'Create Posts')

            @section('stylesheets')

            {!! Html::style('admin/css/parsley.css') !!}
            {!! Html::style('admin/css/select2.min.css') !!}
            {!! Html::script('admin/js/slugger.min.js') !!}
            <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
            <script>
              tinymce.init({
                selector: 'textarea',
                branding: false,
                height: 350,
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
                <h3>Posts</h3>
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

            <div class="clearfix"></div>
            {!! Form::open(array('route' => 'posts.store', 'data-parsely-validate' => '', 'files' => true)) !!}
            <div class="row">
             <div class="col-md-9 col-sm-9 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Create new post</h2>
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
                    <strong>Error :</strong>
                    
                    @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                    @endforeach

                    </ul>
                  </div>

                  @endif
                  
                  {{ Form::label('title', 'Title *') }}
                  {{ Form::text('title', null, array('class' => 'form-control title', 'id' => 'postTitle', 'required' => '', 'maxlength' => '255')) }}
                  <div class="divider-dashed"></div>

                  {{ Form::label('slug', 'Slug *') }}
                  {{ Form::text('slug', null, array('class' => 'form-control slug', 'id' => 'postSlug', 'required' => '', 'maxlength' => '255')) }}
                  <div class="divider-dashed"></div>

                  {{ Form::label('body', 'Content *') }}
                  {{ Form::textarea('body', null, array('class' => 'resizable_textarea form-control')) }}
                  
                  <br />

                   </div>
              </div>
            </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="x_panel">
                      {{ Html::linkRoute('posts.index' ,'View all posts', array(), ['class' => 'btn btn-success btn-block'])}}
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
                                {{ Form::submit('Publish', array('class' => 'btn btn-success btn-block')) }}
                                </p>
                              </li>
                            </ul>

                          </div>
                        </div>
            </div>

             <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Select category</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" name="category_id">
                                 @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Select tags</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control selecttag2-multi select2_multiple" name="tags[]" multiple="multiple">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                        <h2>Featured image</h2>
                        <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                             {{ Form::label('featured_img', 'Upload a image') }}
                              {{ Form::file('featured_img') }}
                            </div>
                          </div>
                      </div>
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        <!-- /page content -->
          <script>
          $('#postSlug').slugger({
            source: '#postTitle',
            readonly: true,
          });
          $('#postSlug').click(function(){
            $("#postSlug").attr("readonly", false); 
           });
          </script>

     @endsection

     @section('scripts')

    {!! Html::script('admin/js/parsley.min.js') !!}
    {!! Html::script('admin/js/select2.min.js') !!}
     <script type="text/javascript">
      $('.selecttag2-multi').select2();
    </script>

    @endsection