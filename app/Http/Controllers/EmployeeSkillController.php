<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSkill;
use App\Http\Requests\StoreEmployeeSkillRequest;
use App\Http\Requests\UpdateEmployeeSkillRequest;

class EmployeeSkillController extends Controller
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
     * @param  \App\Http\Requests\StoreEmployeeSkillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeSkillRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeSkill  $employeeSkill
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSkill $employeeSkill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeSkill  $employeeSkill
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeSkill $employeeSkill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeSkillRequest  $request
     * @param  \App\Models\EmployeeSkill  $employeeSkill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeSkillRequest $request, EmployeeSkill $employeeSkill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeSkill  $employeeSkill
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeSkill $employeeSkill)
    {
        //
    }
}
