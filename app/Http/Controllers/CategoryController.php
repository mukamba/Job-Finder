<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Category;

class CategoryController extends Controller {

    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct() {
        $this->middleware('auth');
    }

    public function index() {


        // display a view of all of our categories

        // it will also have a form to create a new category 

       $categories = Category::all();
       return view('categories.index')->withCategories($categories);

    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //save  a new category and redirect back to index 

        $this->validate($request, array(
             'name'=>'required|max:255' 

                ));
       $category = new Category;
       $category ->name = $request->name;
       
       $category ->save();
       Session::flash('success','New Category has been created');
       return redirect()->route('categories.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $post = Post::find($id);

        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //find a post in the database and save it as variable 
        $post = Post::find($id);

        return view('posts.edit')->withPost($post);

        //return the view and pass in the variable previously created
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //validate the data before we use it 

        $post = Post::find($id);
        if ($request->input('slug') == $post->slug) {


            $this->validate($request, array(
                'title' => 'required|max:255',
                'body' => 'required'
            ));
        } else {

            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|min:5|max:255|unique:posts,slug',
                'body' => 'required'
            ));
        }

        //save the data to the database 

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->save();
        //set a flash  data with success
        Session::flash('success', 'This post was successfully saved .');
        //rediect to the posts.show

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        // find the item 

        $post = Post::find($id);

        $post->delete();
        Session::flash('success', 'The post was successfully deleted');
        return redirect()->route('posts.index');
    }

}
