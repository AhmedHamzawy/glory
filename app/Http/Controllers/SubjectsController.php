<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Subject;
use App\Http\Resources\Subject as SubjectResource;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::paginate(15);
        return SubjectResource::collection($subject);
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
    public function store(Request $request)
    {
        $subject = $request->isMethod('put') ? Subject::findOrFail($request->subject_id)
        : new Subject;

        $subject->name = $request->input('name');
        $subject->room = $request->input('room');
        $subject->professor = $request->input('professor');
        $subject->assistant = $request->input('assistant');
        $subject->description = $request->input('description');
        $subject->min_mark = $request->input('min_mark');
        $subject->max_mark = $request->input('max_mark');
        $subject->pass_mark = $request->input('pass_mark');
        $subject->type = $request->input('type');


        if($subject->save()){ return new SubjectResource($subject); }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::findOrFail($id);

        return new Subjectresource($subject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);

        if($subject->delete()){
            return new Subjectresource($subject);
        }
    }
}
