<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Http\Request;
use App\Http\Requests\CommentReplyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Comment;
class CommentReplyController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
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
        if($request->replyContent == "" && !$request->hasFile('replyPhoto')){
            return back()->withInput()->with("replyError","The reply content can not be null");
        }

        $user = Auth::user();
    
        // in order to store the correct account_id column in the  replies table we need to know the current account_id the is stroed in the id column of the current loged in user account table
        $account_id  = $user->id;
        // to find the comment to which the reply is added by helping the comment_id which is comming from a hidden input in the reply section
        $comment = Comment::findOrFail($request->comment_id);
        //add column account_id to array request
        $request->merge(["account_id"=>$account_id,"content"=>$request->replyContent]);
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
            return back()->with(["replySuccess"=>"Your reply has been Added.","comment_id"=>$request->comment_id,"post_id"=>$request->post_id_for_replies]);
        }else{
            return back()->with(["replyError"=>"Reply Not added"]);
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

// Beggining of: function which is responsible for deleteing replies using ajax request
    public function delete(Request $request)
    {
        $user = Auth::user();
        
        $reply = CommentReply::findOrFail($request->reply_id);

        if($user->replies()->where("comment_replies.id",$request->reply_id)->first()){
            if($reply->photos()->count() > 0){
                foreach($reply->photos as $reply_photo){
                    Storage::delete("public/images/comment_replies/".$reply_photo->path);
                    $reply_photo->delete();
                }
            }
            $user->replies()->where("comment_replies.id",$request->reply_id)->first()->delete();
        }
    }
// End of : function which is responsible for deleteing replies using ajax request



// The funcion which add and update votes to replies using ajax request
    public function Vote(Request $request){
        $type = $request->voteType; // the type of vote whether user click up vote or down vote
        $reply_id = $request->reply_id; // get the id of reply 
        $reply = CommentReply::find($reply_id); // To Find the the reply to which the vote is added or deleted 
        if(!$reply){     
            return null;
        }
        $user = Auth::user(); // to find the current authenticated user who click the upvote and downvote buttons
        $userLikedReplies = $user->repliesVotes->where("id",$reply_id)->first(); // the variable which stores the recoreds of the current user in pivot table , note: only the recoreds which belongs to the reply id  which the we found above


        if($userLikedReplies){ // if the user already voted that reply
            if($type === "upVote"){ // if the use is clicking the upvote button
                if($userLikedReplies->pivot->type == 0){ // if the user already voted and the vote is downvote
                    $userLikedReplies->pivot->update(["type"=>"1"]); //then come and just update that to upvote by changin 0 to 1
                 }else{  //if the user already voted and the vote is upvote
                    $user->repliesVotes()->detach($userLikedReplies); // then come and remove the vote from the user
                }
            }else{ // if the user is clicking the downVote Button
                if($userLikedReplies->pivot->type == 0){ // the user is clickin downvote and the user already vote is downvote
                    $user->repliesVotes()->detach($userLikedReplies); // then remove the already vote
                }else{ // the user is clicking downvote and the user already vote is upvote
                    $userLikedReplies->pivot->update(["type"=>"0"]); // then just update the vote type by changing 1 to 0
                }
            }
        }else{ // if the user has not aleardy voted that comment
            if($type === "upVote"){ // if the user has not aleardy voted that post and clicking the upVote button
                $user->repliesVotes()->save($reply,["type"=>"1"]); // Then add a new record into the database with up vote type
            }else{ // if the user has not aleardy voted that comment and clicking the downVote button
                $user->repliesVotes()->save($reply,["type"=>"0"]); // Then add a new record into the database with down vote type
            }
        }


    }// end of vote fuction

} // End of controller 
