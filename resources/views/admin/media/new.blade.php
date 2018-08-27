            @extends('admin')
            @section('title', 'Add Media')
            @section('content')
            <div class="page-title">
              <div class="title_left">
                <h3>Add Media {{ Html::linkRoute('media.index' ,'All Media', array(), ['class' => 'btn btn-default'])}}</h3>
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

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Media</h2>

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

                      {!! Form::open(array('route' => 'upload', 'files' => true)) !!}

                         {{ Form::label('featured_img', 'Upload a image') }}
                         {{ Form::file('featured_img') }}
                          
                           <div class="clearfix"></div>
                      
                   
                         <ul class="legend list-unstyled" style="float: right;" >
                              <li>
                                <p>
                                {{ Form::submit('Upload', array('class' => 'btn btn-success btn-block')) }}
                                </p>
                              </li>
                            </ul>

        

                      {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>

            @endsection