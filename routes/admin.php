<?php

use App\Http\Controllers\Courses\CourseController;
use App\Http\Controllers\Courses\InstructorProfileController;
use App\Models\Courses\InstructorProfile;

Route::group(['middleware' => ['web', 'admin']], function () {
    Route::get('admin-mark-notification-as_readed', 'HomeController@ReadNotification')->name('admin-mark-notification-as_readed');
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::get('export-application', 'HomeController@export_application');
    Route::get('/AboutUs', 'HomeController@about_us')->name('AboutUs.index');
    Route::post('/AboutUs-Update',  'HomeController@about_us_update')->name('AboutUsUpdate');


    Route::resource('/job-applications', 'JobApplicationController');
    Route::resource('/jobs', 'JobController');
    Route::resource('/employers', 'EmployerController');
    Route::resource('/employees', 'EmployeeController');

    // Instructors
    // Route::get('/instructors',  'InstructorProfileController@index')->name('instructor.index');
    Route::get('/instructors',  [InstructorProfileController::class, 'index'])->name('instructor.index');
    Route::get('/instructor/verify/{id}',  [InstructorProfileController::class, 'verify_instructor'])->name('admin.instructor.verify');
    Route::post('/instructor/delete/{id}',  [InstructorProfileController::class, 'delete_instructor'])->name('admin.instructor.delete');

    // Courses
    Route::get('/courses',  [CourseController::class, 'admin_index'])->name('admin.course.index');

    // force create new job with similar requirements
    Route::post('/jobs/force_submit',  'JobController@force_submit')->name('admin.job.force_submit');

    // Job archive / reactivate
    Route::get('/jobs/archive/{job_id}',  'JobController@archive')->name('admin.job.archive');
    Route::get('/jobs/reactivate//{job_id}',  'JobController@reactivate')->name('admin.job.reactivate');

    // employee application by id
    Route::get('/employee/applications/{id}',  'EmployeeController@employee_applications')->name('admin.employee.applications');

    // employee application asnwers  by application_id and emp_id
    Route::get('/employee/applications_answers/{app_id}/{emp_id}',  'EmployeeController@employee_applications_answers')->name('admin.employee.applications.asnwers');


    Route::resource('/countries', 'CountryController');
    Route::resource('/cities', 'CityController');
    Route::resource('/areas', 'AreaController');
    Route::resource('/admins', 'AdminController');

    Route::resource('/career-levels', 'CareerLevelController');
    Route::resource('/education-levels', 'EducationLevelController');
    Route::resource('/industries', 'IndustryController');
    Route::resource('/job-categories', 'JobCategoryController');
    Route::resource('/job-titles', 'JobTitleController');
    Route::resource('/job-types', 'JobTypeController');
    Route::resource('/skills', 'SkillController');
    Route::resource('/currencies', 'CurrencyController');
    Route::resource('/faqs', 'FaqController');
    Route::resource('/contact_us', 'ContactUsController');
    Route::resource('/universities', 'UniversityController');

    Route::get('/job-applications', 'HomeController@job_applications')->name('admin.job_applications');
    Route::post('/job-applications/{id}', 'JobApplicationController@update')->name('admin.job_application');

    // update application statu by admin
    Route::post('/job-application/{id}', 'JobApplicationController@update_statu')->name('job_application.update_statu');

    // delete job application by user
    Route::post('/job-applications/{id}', 'JobApplicationController@destroy')->name('job_application.admin.destroy');
    // Route::post('/job-applications/{id}', 'JobApplicationController@update')->name('admin.job_applications');

    Route::get('/logout', 'AuthController@logout')->name('admin.logout');
});



Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'AuthController@login')->name('admin.login');
    Route::post('/login', 'AuthController@login_auth')->name('admin.login.auth');
});
