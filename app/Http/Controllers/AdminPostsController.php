<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostsCreateRequest;
use App\Post;
use Auth;
use App\Photo;
use App\Category;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $posts = Post::paginate(2);
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id')->all();
        
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        
        $input = $request->all();
        
        $user = Auth::user();
        
        if($file = $request->file('photo_id')){
            
            $name = time() . $file->getClientOriginalName();
            
            $file->move('images', $name);
            
            $photo = Photo::create(['file'=>$name]);
            
            $input['photo_id'] = $photo->id;
            
        }
        
        $user->posts()->create($input);
        
        $message = 'Post "'.$input['title'].'" has been created.';
        
        Session::flash('created_post', $message);
        
        return redirect('/admin/posts');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        
        $categories = Category::pluck('name','id')->all();
        
        return view('admin.posts.edit', compact('post', 'categories'));
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
        //
        $input = $request->all();
        
        if($file = $request->file('photo_id')){
            
            $name = time() . $file->getClientOriginalName();
            
            $file->move('images', $name);
            
            $photo = Photo::create(['file'=>$name]);
            
            $input['photo_id'] = $photo->id;
            
        }
        
        $message = 'Post "'. Post::findOrFail($id)->title.'" has been updated.';
        
        Session::flash('updated_post', $message);
        
        Post::findOrFail($id)->update($input);
        
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        
        if($post->photo_id != '') {unlink(public_path().$post->photo->file);}
        
        $message = 'Post "'.$post->title.'" has been deleted.';
        
        Session::flash('deleted_post', $message);
        
        $post->delete();
        
        return redirect('/admin/posts');
    }
    
    public function post($slug){
        
        $post = Post::findBySlugOrFail($slug);
        
        $comments = $post->comments()->whereisActive(1)->get();
        
        return view('post', compact('post', 'comments'));
        
    }
}
