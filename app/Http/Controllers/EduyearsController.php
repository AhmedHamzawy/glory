<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Eduyear;
use App\Http\Resources\Eduyear as EduyearResource;

class EduyearsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eduyears = Eduyear::paginate(15);
        return EduyearResource::collection($eduyears);
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
        $eduyear = $request->isMethod('put') ? Eduyear::findOrFail($request->eduyear_id)
        : new Eduyear;



        $eduyear->start = $request->input('start');
        $eduyear->end = $request->input('end');
        $eduyear->year = $request->input('year');
        $eduyear->semester = $request->input('semester');

        if($eduyear->save()){ return new EduyearResource($eduyear); }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $eduyear = Eduyear::findOrFail($id);

        if($eduyear->delete()){
            return new EduyearResource($eduyear);
        }
    }
}
