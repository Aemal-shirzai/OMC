<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Http\Request;
use App\Http\Requests\CommentReplyRequest;
use Illuminate\Support\Facades\Auth;
use App\Comment;
class CommentReplyController extends Controller
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
    public function store(CommentReplyRequest $request)
    {
        if($request->content == "" && !$request->hasFile('replyPhoto')){
            return back()->withInput()->with("error","The reply content can not be null");
        }

        $user = Auth::user();
    
        // in order to store the correct account_id column in the  replies table we need to know the current account_id the is stroed in the id column of the current loged in user account table
        $account_id  = $user->id;
        // to find the comment to which the reply is added by helping the comment_id which is comming from a hidden input in the reply section
        $comment = Comment::findOrFail($request->comment_id);
        //add column account_id to array request
        $request->merge(["account_id"=>$account_id]);
        // create the reply for the comment 
        $reply = $comment->replies()->create($request->all());

        // if the request has photo then add it by the help of reply and photos relationship (photos)
        if($request->hasFile("replyPhoto")){
            $photo = $request->file("replyPhoto");
            $fullName  = $photo->getClientOriginalName();
            $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $photo->getClientOriginalExtension();
            $nameToBeStored = $onlyName.time(). "." .$extension;
            $folder = "public/images/comment_replies/";
            $photo->storeAs($folder,$nameToBeStored);
            $reply->photos()->create(["path"=>$nameToBeStored,"status"=>"1"]);
        }


        if($reply){
            return back()->with(["replySuccess"=>"Your reply has been Added.","comment_id"=>$request->comment_id]);
        }else{
            return back()->with(["error"=>"Reply Not added"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CommentReply  $commentReply
     * @return \Illuminate\Http\Response
     */
    public function show(CommentReply $commentReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CommentReply  $commentReply
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentReply $commentReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CommentReply  $commentReply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentReply $commentReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommentReply  $commentReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentReply $commentReply)
    {
        //
    }
}
