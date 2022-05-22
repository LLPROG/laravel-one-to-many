<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Post;
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
            'title'         => 'required|min:3|max:100',
            'content'       => 'required',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($model->id),
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $posts = Post::paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPostData = $request->all();
        //validazione
        $request->validate($this->validator(null));

        // $newPostData['slug'] = Post::slugGenerator($newPostData['title']);

        $post = Post::create($request->all());

        return redirect()->route('admin.posts.show', $post->slug);

        // $formData = [
        //     'user_id' => Auth::user()->id
        // ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', [
            'post' => $post,
            'pageTitle' => $post->title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validator($post->id));

        // prendiamo i nuovi valori
        $newPostData = $request->all();

        // dd($newPostData);
        $newPostData['slug'] = Post::slugGenerator($newPostData['title']);
        $post->update($newPostData);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
