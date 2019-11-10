<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        if($request->content == "" && !$request->hasFile("photo")){
            return back()->withInput()->with("error","The comment content can not be null");
        }
        $user = Auth::user();
    
        // in order to store the correct account_id column in the commments table we need to know the current account_id the is stroed in the id column of the current loged in user account table
        $account_id  = $user->id;
        // to find the post to which the comment is added by hellping the post_id which is comming from a hidden input in the comment section
        $post = Post::findOrFail($request->post_id);
        //add column account_id to array request
        $request->merge(["account_id"=>$account_id]);
        // create the comment for the post we found above and add content owner_id and owner_type column aswell
        $comment = $post->comments()->create($request->all());

        // if the request has photo then add it by the help of comment and photos relationship (photos)
        if($request->hasFile("photo")){
            $photo = $request->file("photo");
            $fullName  = $photo->getClientOriginalName();
            $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $photo->getClientOriginalExtension();
            $nameToBeStored = $onlyName.time(). "." .$extension;
            $folder = "public/images/comments/";
            $photo->storeAs($folder,$nameToBeStored);
            $comment->photos()->create(["path"=>$nameToBeStored,"status"=>"1"]);
        }


        if($comment){
            return back()->with(["commentSuccess"=>"Your Comment has been Added.","post_id"=>$request->post_id]);
        }else{
            return back()->with(["error"=>"Comment Not"]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
