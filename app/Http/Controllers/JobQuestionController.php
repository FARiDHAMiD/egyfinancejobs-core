<?php

namespace App\Http\Controllers;

use App\Models\JobQuestion;
use App\Http\Requests\StoreJobQuestionRequest;
use App\Http\Requests\UpdateJobQuestionRequest;

class JobQuestionController extends Controller
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
     * @param  \App\Http\Requests\StoreJobQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobQuestion  $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(JobQuestion $jobQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobQuestion  $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(JobQuestion $jobQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobQuestionRequest  $request
     * @param  \App\Models\JobQuestion  $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobQuestionRequest $request, JobQuestion $jobQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobQuestion  $jobQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobQuestion $jobQuestion)
    {
        //
    }
}
