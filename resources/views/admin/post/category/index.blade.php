            @extends('admin')

            @section('title', 'Category')

            @section('stylesheets')

            {{ Html::style('css/parsley.css') }}
            {!! Html::script('admin/js/slugger.min.js') !!}

            @endsection


            @section('content')

       <!-- page content -->
            <div class="page-title">
              <div class="title_left">
                <h3>Categories</h3>
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
                 </div>
            </div>
           
            <div class="row">
                        
             <div class="col-md-4 col-sm-4 col-xs-12">
               {!! Form::open(['route' => 'ob-admin.categories.store', 'method' => 'POST', 'data-parsely-validate' =>'' ]) !!}
              <div class="x_panel">
                <div class="x_title">
                  <h2>Create new category</h2>
                        <div class="clearfix"></div>
                </div>
                <div class="x_content">
       
                  
                  {{ Form::label('name', 'Name *') }}
                  {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'categoryName', 'required' => '', 'maxlength' => '255')) }}
                  <div class="divider-dashed"></div>

                  {{ Form::label('slug', 'Slug *') }}
                  {{ Form::text('slug', null, array('class' => 'form-control', 'id' => 'categorySlug', 'required' => '', 'maxlength' => '255')) }}
                  
                  <br />
                    {{ Form::submit('Create new category', array('class' => 'btn btn-success btn-block')) }}
                   </div>
              </div>
              {!! Form::close() !!}
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>All categories</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($categories as $category)
                        <tr>
                          <th scope="row">{{ $category->id }}</th>
                          <td>{{ $category->name }}  <span class="badge badge-info">{{ $category->posts()->count() }}</span></td>
                          <td>{{ $category->slug }}</td>
                          <td>{!! Html::linkRoute('ob-admin.categories.edit', 'Edit', array($category->id), array('class' => 'btn btn-default btn-xs')) !!}</td>
                          @if($category->id != 1)
                          <td>{!! Form::open(['route' => ['ob-admin.categories.destroy', $category->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs', 'onclick' => 'return categoryDelete();']) !!}
                            {!! Form::close() !!}</td>
                            @endif
                        </tr>
                      @endforeach
                       </tbody>
                    </table>
                    {!! $categories->links(); !!}
                  </div>
                </div>
            </div>
            </div>
            <!-- /page content -->

            <script>
            function categoryDelete() {
                if(!confirm("Are You Sure to delete this!"))
                event.preventDefault();
            }
            $('#categorySlug').slugger({
            source: '#categoryName',
            readonly: true,
            });
            $('#categorySlug').click(function(){
              $("#categorySlug").attr("readonly", false); 
            });
           </script>
     @endsection

     @section('scripts')

    {{ Html::script('js/parsley.min.js') }}

    @endsection