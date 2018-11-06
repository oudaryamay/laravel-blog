            @extends('admin')

            @section('title', 'Update Settings')

            @section('content')

           <div class="page-title">
              <div class="title_left">
                <h3>Settings Page</h3>
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
                    <h2>Update Settings</h2>
                    <?php 
                    $site_title = DB::table('options')->where('option_key', 'site_title')->get();
                    $site_description = DB::table('options')->where('option_key', 'site_description')->get();
                    $site_url = DB::table('options')->where('option_key', 'site_url')->get();
                    $home_url = DB::table('options')->where('option_key', 'home_url')->get();
                    $admin_url = DB::table('options')->where('option_key', 'admin_url')->get();
                    /*
                    echo '<pre>';
                    print_r($site_title); 
                    echo '</pre>';
                    */
                    ?>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 @if (Session::has('success'))

                  <div class="alert alert-success" role="alert">
                    <strong>Success : </strong> {{ Session::get('success') }}
                  </div>

                  @endif
                    <br />
                   {!! Form::open(array('route' => 'ob-admin.settings.option.update', 'method' => 'post', 'class' => 'form-horizontal form-label-left')) !!}

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="site-title">Site Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="site-title" name="site_title" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo ($site_title  != null) ? $site_title[0]->option_value : 'Lone Wolf' ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="site-description">Site Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="site-description" name="site_description" class="form-control col-md-7 col-xs-12" value="<?php echo ($site_description  != null) ? $site_description[0]->option_value : 'Proudly developed by lone wolf' ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="site-url">Site URL <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="site_url" name="site_url" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo ($site_url  != null) ? $site_url[0]->option_value : url('/') ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="home-url">Home URL <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="home-url" name="home_url" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo ($home_url  != null) ? $home_url[0]->option_value : url('/') ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admin-url">Admin URL <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="admin-url" name="admin_url" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo ($admin_url  != null) ? $admin_url[0]->option_value : url('/').'/ob-admin' ?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          {{ Html::linkRoute('admin.index', 'Cancel', array(), ['class' => 'btn btn-primary']) }}
				                  {{ Form::submit('Update settings', array('class' => 'btn btn-success')) }}
                        </div>
                      </div>

                     {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
        @endsection
