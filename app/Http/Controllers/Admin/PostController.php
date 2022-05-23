<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PostController extends Controller
{
    // validation with array variable
    public $validationRules = [
        'title'         => 'required|min:3|max:100',
        'content'       => 'required',
        'slug'          => 'unique'
    ];

    // validation with function
    private function validator($model) {
        return [

            'category_id'   => 'required|exists:App\Category,id',
            'title'         => 'required|min:3|max:100',
            'content'       => 'required',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($model),
            ]
        ];
    }

    // function to shwo just personal id post
    public function myindex() {
        $posts = Post::where('user_id', Auth::user()->id)->paginate(50);

        return view('admin.posts.index', compact('posts'));
    }

    public function index() {
        $posts = Post::paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create() {
        $categories = Category::all();
        // dd($categories);
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request) {

        $newPostData = $request->all();

        //validazione
        $request->validate($this->validator(null));

        $formData = $request->all() + [
            'user_id' => Auth::user()->id
        ];

        $post = Post::create($formData);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function show(Post $post) {


        return view('admin.posts.show', [
            'post' => $post,
            'pageTitle' => $post->title,
        ]);
    }

    public function edit(Post $post) {

        if (Auth::user()->id !== $post->user_id) abort(403);

        return view('admin.posts.edit', compact('post'));

    }

    public function update(Request $request, Post $post) {

        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->validator($post->id));

        // prendiamo i nuovi valori
        $newPostData = $request->all();

        $post->update($newPostData);

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post) {

        if (Auth::user()->id !== $post->user_id) abort(403);


        $post->delete();

        // condition for button delete in edit
        // if (previos() === route('admin.posts.edit', $post->slug)) {
        //     return redirect()->rout('admin.home');
        // }

        return redirect()->back();
    }
}
