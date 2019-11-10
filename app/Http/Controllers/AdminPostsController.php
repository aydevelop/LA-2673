<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->all();
        $file = $request->file('file');
        if(!empty($file)){
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move('img/posts', $name);
			
            $image = Photo::create(['filename'=>$name]);
            $input['photo_id'] = $image->id;
        }

         $input['views'] = 1;
         $input['user_id'] = Auth::user()->id;
         Post::create($input);
         Session::flash('flash_admin','The post has been created');
         return redirect('admin/posts');
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
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories'));
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
        $post = Post::findOrFail($id);
        $input = $request->all();

        $file = $request->file('file');
        if(!empty($file)){
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move('img/posts', $name);
            $image = Photo::create(['filename'=>$name]);
            $input['photo_id'] = $image->id;
        }

        $post->update($input);
        Session::flash('flash_admin','The post has been edited');
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        Session::flash('flash_admin','The post has been deleted');
        return redirect('admin/posts');
    }

    public function filter(Request $request)
    {
        $name = $request->input('name');
        $posts = Post::where('name','like', '%'.$name.'%')
        ->orWhere('review','like', '%'.$name.'%')->get();
        return view('admin.posts.filter', compact('posts','name'));
    }
}
