<?php

namespace App\Http\Controllers;

use App\Question;
use App\DiseaseCategory;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except("index");
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
        if($this->authorize("normalUser_related",Auth::user())){
            $d_categories = DiseaseCategory::orderBy("category","asc")->get(); 
            return view("questions.create",compact("d_categories"));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
         if($this->authorize("normalUser_related",Auth::user())){
            $user = Auth::user()->owner;
            $question = $user->questions()->create($request->all());

            if($request->tags){
                foreach($request->tags as $tagId){
                    $tag = DiseaseCategory::findOrFail($tagId);
                     $question->tags()->save($tag);
                 }
            } // end of adding tags part

            if($request->hasFile("photo")){
                $photo = $request->file("photo");
                $fullName = $photo->getClientOriginalName();
                $onlyExtentsion = $photo->getClientOriginalExtension();
                $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
                $nameToBeStored = $onlyName . time() . $onlyExtentsion;

                $photo->storeAs("public/images/questions/",$nameToBeStored);
                $question->photos()->create(["path"=>$nameToBeStored,"status"=>1]);

            } // End of adding photo
            if($question){
                return back()->with("postAddSuccess","Your question was added!");
            }
        } // end of authorization if statement
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
