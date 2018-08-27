            @extends('admin')
            @section('title', 'Lone Wolf')
            @section('content')
          <div class="row">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-edit"></i></div>
                  <div class="count">{{ $posts }}</div>
                  <h3>Posts</h3>
                  <p>Total number of published posts.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">{{ $comments }}</div>
                  <h3>Comments</h3>
                  <p>Total number of published comments.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-clone"></i></div>
                  <div class="count">{{ $pages }}</div>
                  <h3>Pages</h3>
                  <p>Total number of published pages.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">{{ $categories }}</div>
                  <h3>Categories</h3>
                  <p>Total number of categories.</p>
                </div>
              </div>
            </div>
        
            <div class="row">
              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Recent Posts </h2>
                  <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @foreach ($rposts as $rpost)
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">{{ date('M', strtotime($rpost->created_at)) }}</p>
                        <p class="day">{{ date('d', strtotime($rpost->created_at)) }}</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{ $rpost->title }}</a>
                        <p>{{ substr(strip_tags($rpost->body), 0, 20) }}{{ strlen(strip_tags($rpost->body)) > 20 ? '...' : "" }}</p>
                      </div>
                    </article>
                     @endforeach
                  </div>
                </div>
              </div>

             <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Recent Comments </h2>
                  <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @foreach ($rcomments as $rcomment)
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">{{ date('M', strtotime($rcomment->created_at)) }}</p>
                        <p class="day">{{ date('d', strtotime($rcomment->created_at)) }}</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{ $rcomment->name }}</a>
                        <p>{{ substr(strip_tags($rcomment->comment), 0, 20) }}{{ strlen(strip_tags($rcomment->body)) > 20 ? '...' : "" }}</p>
                      </div>
                    </article>
                     @endforeach
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Recent Pages </h2>
                  <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @foreach ($rpages as $rpage)
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">{{ date('M', strtotime($rpage->created_at)) }}</p>
                        <p class="day">{{ date('d', strtotime($rpage->created_at)) }}</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{ $rpage->title }}</a>
                        <p>{{ substr(strip_tags($rpage->content), 0, 20) }}{{ strlen(strip_tags($rpage->content)) > 20 ? '...' : "" }}</p>
                      </div>
                    </article>
                     @endforeach
                  </div>
                </div>
              </div>

            </div>

            @endsection