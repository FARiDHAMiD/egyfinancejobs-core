@extends('website.app')
@section('website.content')
<div class="main">
    <div class="container user-settings">
        <div class="row">
            <div class="mb-4 col-md-4">
                @include('website.employee.profile.user-settings-sidebar')
            </div>
            <div class="mb-4 col-md-8">
                <div class="form-content-box w-100 my-0">
                    <div class="details text-left">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <p class="section-subtitle mb-0">What technical skill do you have?
                                </p>
                            </div>
                            <div class="col-12 mb-3">
                                @foreach ($employee->employee_skills('technical') as $employee_skill)
                                    <div class="work-experience-box">
                                        <div class="description">
                                            <h5 class="title">{{$employee_skill->skill->name}}</h5>
                                            <p>
                                                Proficiency:

                                                <span class="stars" data-stars-number="{{$employee_skill->skill_level}}">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </p>
                                            
                                        </div>
                                        <form method="post" action="{{route('employee.profile.skills.destroy', $employee_skill->id)}}" class="d-inline">
                                            @csrf
                                            <button onclick="return confirm('Are you sure you want to delete?')"  class="delete-btn"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <button data-toggle="modal" data-target="#edit-skill-{{$employee_skill->id}}" type="button" class="edit-btn"><i class="fa fa-pencil-square-o"></i></button>
                                        <div class="modal fade" id="edit-skill-{{$employee_skill->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="modal-body text-left py-5">
                                                        <form method="post" action="{{route('employee.profile.skills.update', $employee_skill->id)}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>skill: <span class="text-success">{{$employee_skill->skill->name}}</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Proficiency:</label>
                                                                        <select type="text" name="proficiency"
                                                                            class="form-control">
                                                                            <option {{$employee_skill->skill_level == 1 ? 'selected' : ''}} value="1">1</option>
                                                                            <option {{$employee_skill->skill_level == 2 ? 'selected' : ''}} value="2">2</option>
                                                                            <option {{$employee_skill->skill_level == 3 ? 'selected' : ''}} value="3">3</option>
                                                                            <option {{$employee_skill->skill_level == 4 ? 'selected' : ''}} value="4">4</option>
                                                                            <option {{$employee_skill->skill_level == 5 ? 'selected' : ''}} value="5">5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-4">
                                                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">save</button>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @if ($technical_skills->whereNotIn('id', App\Models\EmployeeSkill::where('employee_id', $employee->id)->pluck('skill_id')->toArray())->where('category', 'technical')->get()->count() > 0)
                                    
                                    <button data-toggle="modal" data-target="#add-technical-skill" class="btn button-theme bg-transparent mb-md-0 mb-3" type="button">Add Skill</button>
                                @endif


                                <div class="modal fade" id="add-technical-skill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <form class="modal-body p-4" method="post" action="{{route('employee.profile.skills.store')}}">
                                                @csrf
                                                <input type="hidden" name="skill_category" value="technical">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>skill:</label>
                                                            <select type="text" name="skill_id"
                                                                class="form-control">
                                                                <option selected value="" disabled>
                                                                    select
                                                                </option>
                                                                @foreach ($technical_skills->whereNotIn('id', App\Models\EmployeeSkill::where('employee_id', $employee->id)->pluck('skill_id')->toArray())->where('category', 'technical')->get() as $skill)
                                                                    <option
                                                                        {{ old('skill_id') == $skill->id ? 'selected' : '' }}
                                                                        value="{{ $skill->id }}">
                                                                        {{ $skill->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Proficiency:</label>
                                                            <select type="text" name="proficiency"
                                                                class="form-control">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">add</button>
                                                </div>
                                            </form>
    
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <p class="section-subtitle mb-0">What ERP, Tools, and Technologies skills do you
                                    have?
                                </p>technology
                            </div>
                            <div class="col-12 mb-3">
                                @foreach ($employee->employee_skills('technology') as $employee_skill)
                                    <div class="work-experience-box">
                                        <div class="description">
                                            <h5 class="title">{{$employee_skill->skill->name}}</h5>
                                            <p>
                                                Proficiency:

                                                <span class="stars" data-stars-number="{{$employee_skill->skill_level}}">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </p>
                                            
                                        </div>
                                        <form method="post" action="{{route('employee.profile.skills.destroy', $employee_skill->id)}}" class="d-inline">
                                            @csrf
                                            <button onclick="return confirm('Are you sure you want to delete?')"  class="delete-btn"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <button data-toggle="modal" data-target="#edit-skill-{{$employee_skill->id}}" type="button" class="edit-btn"><i class="fa fa-pencil-square-o"></i></button>
                                        <div class="modal fade" id="edit-skill-{{$employee_skill->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="modal-body text-left py-5">
                                                        <form method="post" action="{{route('employee.profile.skills.update', $employee_skill->id)}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>skill: <span class="text-success">{{$employee_skill->skill->name}}</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Proficiency:</label>
                                                                        <select type="text" name="proficiency"
                                                                            class="form-control">
                                                                            <option {{$employee_skill->skill_level == 1 ? 'selected' : ''}} value="1">1</option>
                                                                            <option {{$employee_skill->skill_level == 2 ? 'selected' : ''}} value="2">2</option>
                                                                            <option {{$employee_skill->skill_level == 3 ? 'selected' : ''}} value="3">3</option>
                                                                            <option {{$employee_skill->skill_level == 4 ? 'selected' : ''}} value="4">4</option>
                                                                            <option {{$employee_skill->skill_level == 5 ? 'selected' : ''}} value="5">5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-4">
                                                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">save</button>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @if ($technology_skills->whereNotIn('id', App\Models\EmployeeSkill::where('employee_id', $employee->id)->pluck('skill_id')->toArray())->where('category', 'technology')->get()->count() > 0)
                                    <button data-toggle="modal" data-target="#add-technology-skill" class="btn button-theme bg-transparent mb-md-0 mb-3" type="button">Add Skill</button>
                                @endif


                                <div class="modal fade" id="add-technology-skill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <form class="modal-body p-4" method="post" action="{{route('employee.profile.skills.store')}}">
                                                @csrf
                                                <input type="hidden" name="skill_category" value="technology">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>skill:</label>
                                                            <select type="text" name="skill_id"
                                                                class="form-control">
                                                                <option selected value="" disabled>
                                                                    select
                                                                </option>
                                                                @foreach ($technology_skills->whereNotIn('id', App\Models\EmployeeSkill::where('employee_id', $employee->id)->pluck('skill_id')->toArray())->where('category', 'technology')->get() as $skill)
                                                                    <option
                                                                        {{ old('skill_id') == $skill->id ? 'selected' : '' }}
                                                                        value="{{ $skill->id }}">
                                                                        {{ $skill->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Proficiency:</label>
                                                            <select type="text" name="proficiency"
                                                                class="form-control">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">add</button>
                                                </div>
                                            </form>
    
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <p class="section-subtitle mb-0">What languages do you know?
                                </p>
                            </div>
                            <div class="col-12 mb-3">
                                @foreach ($employee->employee_skills('language') as $employee_skill)
                                    <div class="work-experience-box">
                                        <div class="description">
                                            <h5 class="title">{{$employee_skill->skill->name}}</h5>
                                            <p>
                                                Proficiency:

                                                <span class="stars" data-stars-number="{{$employee_skill->skill_level}}">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </p>
                                            
                                        </div>
                                        <form method="post" action="{{route('employee.profile.skills.destroy', $employee_skill->id)}}" class="d-inline">
                                            @csrf
                                            <button onclick="return confirm('Are you sure you want to delete?')"  class="delete-btn"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <button data-toggle="modal" data-target="#edit-skill-{{$employee_skill->id}}" type="button" class="edit-btn"><i class="fa fa-pencil-square-o"></i></button>
                                        <div class="modal fade" id="edit-skill-{{$employee_skill->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="modal-body text-left py-5">
                                                        <form method="post" action="{{route('employee.profile.skills.update', $employee_skill->id)}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>skill: <span class="text-success">{{$employee_skill->skill->name}}</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Proficiency:</label>
                                                                        <select type="text" name="proficiency"
                                                                            class="form-control">
                                                                            <option {{$employee_skill->skill_level == 1 ? 'selected' : ''}} value="1">1</option>
                                                                            <option {{$employee_skill->skill_level == 2 ? 'selected' : ''}} value="2">2</option>
                                                                            <option {{$employee_skill->skill_level == 3 ? 'selected' : ''}} value="3">3</option>
                                                                            <option {{$employee_skill->skill_level == 4 ? 'selected' : ''}} value="4">4</option>
                                                                            <option {{$employee_skill->skill_level == 5 ? 'selected' : ''}} value="5">5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-4">
                                                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">save</button>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @if ($language_skills->whereNotIn('id', App\Models\EmployeeSkill::where('employee_id', $employee->id)->pluck('skill_id')->toArray())->where('category', 'language')->get()->count() > 0)
                                    <button data-toggle="modal" data-target="#add-language-skill" class="btn button-theme bg-transparent mb-md-0 mb-3" type="button">Add Skill</button>
                                @endif


                                <div class="modal fade" id="add-language-skill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <form class="modal-body p-4" method="post" action="{{route('employee.profile.skills.store')}}">
                                                @csrf
                                                <input type="hidden" name="skill_category" value="language">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>skill:</label>
                                                            <select type="text" name="skill_id"
                                                                class="form-control">
                                                                <option selected value="" disabled>
                                                                    select
                                                                </option>
                                                                @foreach ($language_skills->whereNotIn('id', App\Models\EmployeeSkill::where('employee_id', $employee->id)->pluck('skill_id')->toArray())->where('category', 'language')->get() as $skill)
                                                                    <option
                                                                        {{ old('skill_id') == $skill->id ? 'selected' : '' }}
                                                                        value="{{ $skill->id }}">
                                                                        {{ $skill->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Proficiency:</label>
                                                            <select type="text" name="proficiency"
                                                                class="form-control">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">add</button>
                                                </div>
                                            </form>
    
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <p class="section-subtitle mb-0">What  soft skills do you have?
                                </p>
                            </div>
                            <div class="col-12 mb-3">
                                @foreach ($employee->employee_skills('soft') as $employee_skill)
                                    <div class="work-experience-box">
                                        <div class="description">
                                            <h5 class="title">{{$employee_skill->skill->name}}</h5>
                                            <p>
                                                Proficiency:

                                                <span class="stars" data-stars-number="{{$employee_skill->skill_level}}">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </p>
                                            
                                        </div>
                                        <form method="post" action="{{route('employee.profile.skills.destroy', $employee_skill->id)}}" class="d-inline">
                                            @csrf
                                            <button onclick="return confirm('Are you sure you want to delete?')"  class="delete-btn"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <button data-toggle="modal" data-target="#edit-skill-{{$employee_skill->id}}" type="button" class="edit-btn"><i class="fa fa-pencil-square-o"></i></button>
                                        <div class="modal fade" id="edit-skill-{{$employee_skill->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="modal-body text-left py-5">
                                                        <form method="post" action="{{route('employee.profile.skills.update', $employee_skill->id)}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>skill: <span class="text-success">{{$employee_skill->skill->name}}</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Proficiency:</label>
                                                                        <select type="text" name="proficiency"
                                                                            class="form-control">
                                                                            <option {{$employee_skill->skill_level == 1 ? 'selected' : ''}} value="1">1</option>
                                                                            <option {{$employee_skill->skill_level == 2 ? 'selected' : ''}} value="2">2</option>
                                                                            <option {{$employee_skill->skill_level == 3 ? 'selected' : ''}} value="3">3</option>
                                                                            <option {{$employee_skill->skill_level == 4 ? 'selected' : ''}} value="4">4</option>
                                                                            <option {{$employee_skill->skill_level == 5 ? 'selected' : ''}} value="5">5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-4">
                                                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">save</button>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @if ($soft_skills->whereNotIn('id', App\Models\EmployeeSkill::where('employee_id', $employee->id)->pluck('skill_id')->toArray())->where('category', 'soft')->get()->count() > 0)
                                    <button data-toggle="modal" data-target="#add-soft-skill" class="btn button-theme bg-transparent mb-md-0 mb-3" type="button">Add Skill</button>
                                @endif


                                <div class="modal fade" id="add-soft-skill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <form class="modal-body p-4" method="post" action="{{route('employee.profile.skills.store')}}">
                                                @csrf
                                                <input type="hidden" name="skill_category" value="soft">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>skill:</label>
                                                            <select type="text" name="skill_id"
                                                                class="form-control">
                                                                <option selected value="" disabled>
                                                                    select
                                                                </option>
                                                                @foreach ($soft_skills->whereNotIn('id', App\Models\EmployeeSkill::where('employee_id', $employee->id)->pluck('skill_id')->toArray())->where('category', 'soft')->get() as $skill)
                                                                    <option
                                                                        {{ old('skill_id') == $skill->id ? 'selected' : '' }}
                                                                        value="{{ $skill->id }}">
                                                                        {{ $skill->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Proficiency:</label>
                                                            <select type="text" name="proficiency"
                                                                class="form-control">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">add</button>
                                                </div>
                                            </form>
    
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
