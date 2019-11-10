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
        // in order to store the correct owner_type column in the commments table we need to know the current accout owner_type
        if($user->owner_type == "App\Doctor"){
            // if it is doctor then store the user owner type in the owner_type column
            $owner_type = $user->owner_type;
        }else{
            // if it is normal user then store the user owner type in the owner_type column
            $owner_type = $user->owner_type;
        }
        // in order to store the correct owner_id column in the commments table we need to know the current account owner id the we store it in owner_id
        $owner_id  = $user->owner->id;
        // content comming from request
        $content = $request->content;
        // to find the post to which the comment is added by hellping the post_id which is comming from a hidden input in the comment section
        $post = Post::findOrFail($request->post_id);
        // create the comment for the post we found above and add content owner_id and owner_type column aswell
        $comment = $post->comments()->create(["owner_type"=>$owner_type,"owner_id"=>$owner_id,"content"=>$content]);

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
