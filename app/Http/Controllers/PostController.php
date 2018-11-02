<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use App\Category;

use App\Tag;

use Purifier;

use Session;

use Image;

class PostController extends Controller
{

     public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::orderBy('id', 'desc')->paginate(10);
        $categories = Category::all();
    
        $cats = array();
        foreach ($categories as $category) {
        $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = array();
        foreach($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        return view ('admin.post.posts')->withPosts($posts)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags = Tag::all();
        return view('admin.post.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, array(

            'title'       => 'required|max:255',
            'slug'        => 'required|alpha-dash|min:5|max:255|unique:posts,slug',
            'body'        => 'required',
            //'category_id' => 'required|integer'     

        ));

        //Store
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = Purifier::clean($request->body);

        if(($request->category_id) != null) :
        $post->category_id = $request->category_id;
        endif;

        if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/' . $filename);
          Image::make($image)->resize(800, 400)->save($location);

          $post->image = $filename;
        }

        $post->save(); 

        if(($request->tags) != null) :
        $post->tags()->sync($request->tags, false);
        endif;

        //Success message

        Session::flash('success', 'The blog post was successfully saved.');

        //redirect
        return redirect()->route('ob-admin.posts.show', $post->id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
        $cats[$category->id] = $category->name;
        }
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag){
            $tags2[$tag->id] = $tag->name;
        }

        return view('admin.post.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
        $cats[$category->id] = $category->name;
        }
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag){
            $tags2[$tag->id] = $tag->name;
        }
        return view('admin.post.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Get the id
        $post = Post::find($id);

        //Validate value
         if ($request->input('slug') == $post->slug) {

            $this->validate($request, array(

            'title'         => 'required|max:255',
            'body'          => 'required',
            'category_id'   => 'required|integer'

        ));
        } else {

             $this->validate($request, array(

            'title'         => 'required|max:255',
            'slug'          => 'required|alpha-dash|min:5|max:255|unique:posts,slug',
            'body'          => 'required',
            'category_id'   => 'required|integer'

            ));

        }

        //store in variable

        $post= Post::find($id);

        $post->title=$request->input('title');
        $post->slug = $request->input ('slug');
        $post->body= Purifier::clean($request->input('body'));
        $post->category_id=$request->input('category_id');

        if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/' . $filename);
          Image::make($image)->resize(800, 400)->save($location);

          $post->image = $filename;
        }

        $post->save();

        if (isset($request->tags)){

            $post->tags()->sync($request->tags);
        } else {

            $post->tags()->sync(array());
        }

        //Session message

        Session::flash('success','The post was successfully updated.');

        //redirect

        return redirect()->route('ob-admin.posts.show', $post->id); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);

        $post->tags()->detach();

        $post->delete();

        Session::flash('success','The post was successfully deleted.');

        return redirect()->route('ob-admin.posts.index');
    }
}
