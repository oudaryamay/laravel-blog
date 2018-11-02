            @extends('admin')

            @section('title', 'All Posts')

            @section('content')

       <!-- page content -->
            <div class="page-title">
              <div class="title_left">
                <h3>Posts {{ Html::linkRoute('ob-admin.posts.create' ,'Create new', array(), ['class' => 'btn btn-success'])}}</h3>
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
                    <h2>All Posts </h2>
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
                            <th class="column-title">Category </th>
                            <th class="column-title">Tags </th>
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
                          @foreach ($posts as $post)
                          <tr class="<?php echo ++$count%2 ? "odd" : "even" ?> pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                          </td>
                            <td class="post-id">{{$post->id}}</td>
                            <td class="post-title">{{$post->title}}</td>
                            <?php if (( $post->category->name) != null) { ?>
                            <td class="cat-name">{{ $post->category->name }}</td>
                            <?php } else { ?>
                            <td class="cat-name">--</td>
                            <?php } ?>
                            <?php if (($post->tags) != null) { ?>
                            <td class="tag-name">@foreach ($post->tags as $tag)
                              <span class="label label-success">{{ $tag->name }}</span>
                              @endforeach
                            </td>
                            <?php } else { ?>
                            <td class="tag-name"> -- </td>
                            <?php } ?>
                            <td class="post-slug">{{$post->slug}}</td>
                            <td class="post-date">{{date('M j, Y', strtotime($post->created_at))}}</td>
                            <td class="post-edit">
                            {!! Html::linkRoute('ob-admin.posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
                            </td>
                            <td class="post-delete last">
                            {!! Form::open(['route' => ['ob-admin.posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return postDelete();']) !!}
                            {!! Form::close() !!}
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {!! $posts->links(); !!}
                    </div>    
                  </div>
                </div>
              </div>
            </div>

        <!-- /page content -->
  <script>
  function postDelete() {
      return confirm('Are you sure to delete?');
      event.preventDefault();
  }
 </script>

     @endsection