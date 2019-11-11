<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Http\Request;
use App\Http\Requests\CommentReplyRequest;
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

        return $request->all();
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
