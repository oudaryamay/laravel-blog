@extends('admin')
@section('title', 'All Media')
@section('stylesheets')
{{ Html::style('admin/css/media.css') }}
{{ Html::style('admin/css/prettyPhoto.css') }}
@endsection
@section('content')
<div class="page-title">
   <div class="title_left">
      <h3>Media Library {{ Html::linkRoute('media.new' ,'Add new', array(), ['class' => 'btn btn-success'])}}</h3>
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
            <h2>All Images</h2>
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

            <?php
               //echo public_path();
               //echo base_path();
               //echo URL::to('/');
               $dir = public_path().'/uploads/';
               
               // Run the recursive function 
               
               $response = scan($dir);
               
               
               // This function scans the files folder recursively, and builds a large array
               
               function scan($dir){
               
               $files = array();
               
               // Is there actually such a folder/file?
               
               if(file_exists($dir)){
               
                 foreach(scandir($dir) as $f) {
                 
                   if(!$f || $f[0] == '.') {
                     continue; // Ignore hidden files
                   }
               
                   if(is_dir($dir . '/' . $f)) {
               
                     // The path is a folder
               
                     $files[] = array(
                       "name" => $f,
                       "type" => "folder",
                       "path" => $dir . '/' . $f,
                       "items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
                     );
                   }
                   
                   else {
               
                     // It is a file
               
                     $files[] = array(
                       "name" => $f,
                       "type" => pathinfo($f, PATHINFO_EXTENSION),
                       "loc" => $dir . '/' . $f,
                       "path" => URL::to('/') . '/uploads/' . $f,
                       "size" => filesize($dir . '/' . $f) // Gets the size of this file
                     );
                   }
                 }
               
               }
               
               return $files;
               }
               
               
               
               // Output the directory listing as JSON
               /*
               header('Content-type: application/json');
               
               echo json_encode(array(
               "name" => "files",
               "type" => "folder",
               "path" => $dir,
               "items" => $response
               ));
               */
               /*
               echo '<pre>';
               print_r($response);
               echo '</pre>';
               */
               foreach ($response as $res) {
               ?>
            <div class="col-md-3 col-sm-3 col-xs-12">
               <div class="responsive">
                  <div class="gallery">
                     <a href="<?php echo $res['path']; ?>" rel="prettyPhoto" title="Name : <?php echo $res['name']; ?> | Type : <?php echo $res['type']; ?> | Size : <?php echo $res['size']; ?> Bytes | Url : <?php echo $res['path']; ?>">
                     <img src="<?php echo $res['path']; ?>">
                      </a>
                     <div class="desc-hover">
                        <div class="desc">
                           <p class="img-url"><span>URL <br></span><span id="link-sel"><?php echo $res['path']; ?></span></p>
                        </div>
                        <div class="overlay">
                           <div class="text">
                            {!! Form::open(['route' => ['destroy'], 'method' => 'DELETE']) !!}
                            <input type="hidden" name="file_name" value="<?php echo $res['name']; ?>">
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return mediaDelete();']) !!}
                            {!! Form::close() !!}
                         </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php
               }
               ?>
         </div>
      </div>
   </div>
</div>
<script>
  function mediaDelete() {
      if(!confirm("Are You Sure to delete this!"))
      event.preventDefault();
  }
 </script>

@endsection
@section('scripts')
{{ Html::script('admin/js/media.js') }}
{{ Html::script('admin/js/prettyPhoto.js') }}
@endsection