<?php

use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Simple-Qrcode Generator 
Route::get('/welcome', function () {
    return view('welcome');
});

// Use google api to sign up with gmail
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('redirect.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/faqs', [FaqController::class, 'faq_guest'])->name('faqs');
Route::get('/about-us', [HomeController::class, 'about_us_guest'])->name('about_us_guest');
Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('website.contact_us');
Route::post('/contact-us/create', [ContactUsController::class, 'store'])->name('website.contact_us.create');


// Auth Routes
Route::group(['middleware' => ['guest']], function () {
    Route::get('/employee/register', 'AuthController@employee_register_page')->name('employee_register_page');
    Route::post('/employee/register', 'AuthController@employee_register')->name('employee_register');

    Route::get('/employer/register', 'AuthController@employer_register_page')->name('employer_register_page');
    Route::post('/employer/register', 'AuthController@employer_register')->name('employer_register');
    Route::get('/Active-Account', 'AuthController@active_account')->name('active_account');


    Route::get('/login', 'AuthController@login_page')->name('login_page');
    Route::post('/login', 'AuthController@login')->name('login');
    Route::get('/Forget-Password', 'AuthController@forget_password')->name('forget_password');
    Route::post('/New-Password', 'AuthController@new_password')->name('new_password');
});
Route::post('/logout', 'AuthController@logout')->name('logout');



Route::namespace('Website')->group(function () {
    Route::name('website.')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/jobs', 'JobController@index')->name('jobs');
        Route::get('/jobs/{job_uuid}', 'JobController@show')->name('job-details');
    });

    Route::get('/employee/profile/view/{id?}', 'EmployeeProfileController@view_profile')->name('employee.profile.view');
    //employee routes

    // delete job application by user
    Route::get('/employee/jobs/destroy-application/{id}', 'EmployeeJobController@destroy_application')->name('job_application.destroy');

    Route::name('employee.')->middleware('EmployeeMiddleware')->group(function () {
        Route::get('/employee/create-profile', 'EmployeeProfileController@create')->name('profile.create');
        Route::post('/employee/create-profile', 'EmployeeProfileController@store')->name('profile.store');


        Route::get('/employee/profile/edit-general-info', 'EmployeeProfileController@edit_general_info')->name('profile.general-info.edit');
        Route::post('/employee/profile/edit-general-info', 'EmployeeProfileController@update_general_info')->name('profile.general-info.update');

        Route::get('/employee/profile/edit-career-inetrests', 'EmployeeProfileController@edit_career_inetrests')->name('profile.career-inetrests.edit');
        Route::post('/employee/profile/edit-career-inetrests', 'EmployeeProfileController@update_career_inetrests')->name('profile.career-inetrests.update');

        Route::get('/employee/profile/edit-experiences', 'EmployeeProfileController@edit_experiences')->name('profile.experiences.edit');
        Route::post('/employee/profile/edit-experiences/{experience_id}', 'EmployeeProfileController@update_experiences')->name('profile.experiences.update');
        Route::post('/employee/profile/create-experiences', 'EmployeeProfileController@store_experiences')->name('profile.experiences.store');
        Route::post('/employee/profile/destroy-experiences/{experience_id}', 'EmployeeProfileController@destroy_experiences')->name('profile.experiences.destroy');

        Route::get('/employee/profile/edit-educations', 'EmployeeProfileController@edit_educations')->name('profile.educations.edit');
        Route::post('/employee/profile/edit-educations/{education_id}', 'EmployeeProfileController@update_educations')->name('profile.educations.update');
        Route::post('/employee/profile/create-educations', 'EmployeeProfileController@store_educations')->name('profile.educations.store');
        Route::post('/employee/profile/destroy-educations/{education_id}', 'EmployeeProfileController@destroy_educations')->name('profile.educations.destroy');

        Route::get('/employee/profile/edit-skills', 'EmployeeProfileController@edit_skills')->name('profile.skills.edit');
        Route::post('/employee/profile/edit-skills/{employee_skill_id}', 'EmployeeProfileController@update_skills')->name('profile.skills.update');
        Route::post('/employee/profile/create-skills', 'EmployeeProfileController@store_skills')->name('profile.skills.store');
        Route::post('/employee/profile/destroy-skills/{employee_skill_id}', 'EmployeeProfileController@destroy_skills')->name('profile.skills.destroy');

        Route::get('/employee/profile/edit-online-presence', 'EmployeeProfileController@edit_online_presence')->name('profile.online-presence.edit');
        Route::post('/employee/profile/edit-online-presence', 'EmployeeProfileController@update_online_presence')->name('profile.online-presence.update');

        Route::get('/employee/profile/edit-cv', 'EmployeeProfileController@edit_cv')->name('profile.cv.edit');
        Route::post('/employee/profile/edit-cv', 'EmployeeProfileController@update_cv')->name('profile.cv.update');
        Route::post('/employee/profile/destroy-cv/{cv_id}', 'EmployeeProfileController@destroy_cv')->name('profile.cv.destroy');

        Route::get('/employee/profile/edit-achievements', 'EmployeeProfileController@edit_achievements')->name('profile.achievements.edit');
        Route::post('/employee/profile/edit-achievements', 'EmployeeProfileController@update_achievements')->name('profile.achievements.update');
        Route::get('/employee/profile/delete-achievements/{id}', 'EmployeeProfileController@delete_achievements')->name('profile.achievements.delete');

        Route::get('/employee/profile/edit-certificates', 'EmployeeProfileController@edit_certificates')->name('profile.certificates.edit');
        Route::post('/employee/profile/edit-certificates', 'EmployeeProfileController@update_certificates')->name('profile.certificates.update');
        Route::get('/employee/profile/delete-certificates/{id}', 'EmployeeProfileController@delete_certificates')->name('profile.certificates.delete');
        Route::get('/employee/profile/change-password', 'EmployeeProfileController@change_password_page')->name('profile.change_password.edit');
        Route::post('/employee/profile/change-password-update', 'EmployeeProfileController@change_password_update')->name('profile.change_password.update');
        Route::get('/employee/profile/delete-account', 'EmployeeProfileController@delete_account_page')->name('profile.delete_account.page');
        Route::post('/employee/profile/delete-account/post', 'EmployeeProfileController@delete_account_post')->name('profile.delete_account.post');



        Route::get('employee/jobs/save-job/{id}', 'EmployeeJobController@save_job')->name('jobs.save-job');
        Route::get('employee/jobs/unsave-job/{id}', 'EmployeeJobController@unsave_job')->name('jobs.unsave-job');
        Route::get('employee/jobs/apply-job/{id}', 'EmployeeJobController@apply_job')->name('jobs.apply-job.get');
        Route::post('employee/jobs/apply-job/{id}', 'EmployeeJobController@apply_job')->name('jobs.apply-job');
        Route::get('/employee/jobs/saved-jobs', 'EmployeeJobController@saved_jobs')->name('jobs.saved-jobs');
        Route::get('/employee/jobs/applications', 'EmployeeJobController@applications')->name('jobs.applications');
    });




    //employee routes
    Route::name('employer.')->group(function () {
        Route::get('/employer/{uuid}', 'EmployerProfileController@profile')->name('profile');
        Route::get('/employer_profile/{id}', 'EmployerProfileController@employer_profile')->name('profile.employer_id'); // same previous route but using id instead of uuid
    });
});
