<?php

namespace App\Http\Controllers;

use App\Models\JobApplicationAnswer;
use App\Http\Requests\StoreJobApplicationAnswerRequest;
use App\Http\Requests\UpdateJobApplicationAnswerRequest;

class JobApplicationAnswerController extends Controller
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
     * @param  \App\Http\Requests\StoreJobApplicationAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobApplicationAnswerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobApplicationAnswer  $jobApplicationAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(JobApplicationAnswer $jobApplicationAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobApplicationAnswer  $jobApplicationAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(JobApplicationAnswer $jobApplicationAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobApplicationAnswerRequest  $request
     * @param  \App\Models\JobApplicationAnswer  $jobApplicationAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobApplicationAnswerRequest $request, JobApplicationAnswer $jobApplicationAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobApplicationAnswer  $jobApplicationAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobApplicationAnswer $jobApplicationAnswer)
    {
        //
    }
}
