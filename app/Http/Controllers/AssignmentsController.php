<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Assignment as AssignmentResource;
use Assignment;
use Auth;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignments = Assignment::paginate(15);
        return AssignmentResource::collection($assignments);
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
        $assignment = $request->isMethod('put') ? Article::findOrFail($request->assignment_id)
        : new Article;

        $assignment->user_id = Auth::user()->id;
        $assignment->name = $request->input('name');
        $assignment->content = $request->input('content');
        $assignment->mark = $request->input('mark');

        if($assignment->save()){ return new AssignmentResource($assignment); }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);

        return new Assignmentresource($assignment);
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
        $assignment = Assignment::findOrFail($id);

        if($assignment->delete()){
            return new Assignmentresource($assignment);
        }
    }
}
