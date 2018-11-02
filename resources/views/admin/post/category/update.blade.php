            @extends('admin')

            @section('title', 'Update Category')

            @section('stylesheets')

            {{ Html::style('css/parsley.css') }}

            @endsection


            @section('content')

       <!-- page content -->
            <div class="page-title">
              <div class="title_left">
                <h3>Categories <small>{{ Html::linkRoute('ob-admin.categories.store' ,'Create new', array(), ['class' => 'btn btn-default btn-xs'])}}</small></h3>
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
               {!! Form::model($category, ['route' => ['ob-admin.categories.update', $category->id], 'method' => 'PUT', 'data-parsely-validate' =>'' ]) !!}
              <div class="x_panel">
                <div class="x_title">
                  <h2>Update category {{ Html::linkRoute('ob-admin.categories.index' ,'View all categories', array(), ['class' => 'btn btn-default btn-xs']) }}</h2>
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
                  
                  {{ Form::label('name', 'Name *') }}
                  {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                  <div class="divider-dashed"></div>

                  {{ Form::label('slug', 'Slug *') }}
                  {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                  
                  <br />
                    {{ Form::submit('Update category', array('class' => 'btn btn-success btn-block')) }}
                   </div>
              </div>
              {!! Form::close() !!}
            </div>
            </div>
            <!-- /page content -->


     @endsection

     @section('scripts')

    {{ Html::script('js/parsley.min.js') }}

    @endsection