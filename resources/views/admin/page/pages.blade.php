            @extends('admin')

            @section('title', 'All Pages')

            @section('content')

       <!-- page content -->
            <div class="page-title">
              <div class="title_left">
                <h3>Pages {{ Html::linkRoute('ob-admin.pages.create' ,'Create new', array(), ['class' => 'btn btn-success'])}}</h3>
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
                    <h2>All Pages </h2>
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

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">#</th>
                            <th class="column-title">Title </th>
                            <th class="column-title">Slug </th>
                            <th class="column-title">Date </th>
                            <th class="column-title">Edit</th>
                            <th class="column-title no-link last"><span class="nobr">Delete</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <?php //echo '<pre>'; print_r($posts); echo'</pre>';?>
                        <tbody>
                          <?php $count=0; ?>
                          @foreach ($pages as $page)
                          <tr class="<?php echo ++$count%2 ? "odd" : "even" ?> pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class="page-id">{{$page->id}}</td>
                            <td class="post-title">{{$page->title}}</td>
                            <td class="page-slug">{{$page->slug}}</td>
                            <td class="page-date">{{date('M j, Y', strtotime($page->created_at))}}</td>
                            <td class="post-edit">
                            {!! Html::linkRoute('ob-admin.pages.edit', 'Edit', array($page->id), array('class' => 'btn btn-primary btn-block')) !!}
                            </td>
                            <td class="post-delete last">
                            {!! Form::open(['route' => ['ob-admin.pages.destroy', $page->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return pageDelete();']) !!}
                            {!! Form::close() !!}
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {!! $pages->links(); !!}
                    </div>    
                  </div>
                </div>
              </div>
            </div>

        <!-- /page content -->
  <script>
  function pageDelete() {
      return confirm('Are you sure to delete?');
      event.preventDefault();
  }
 </script>

     @endsection