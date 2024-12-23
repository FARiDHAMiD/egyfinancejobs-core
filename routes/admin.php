<?php




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
    Route::resource('/universities', 'UniversityController');

    Route::get('/job-applications', 'HomeController@job_applications')->name('admin.job_applications');
    Route::post('/job-applications/{id}', 'JobApplicationController@update')->name('admin.job_applications');

    Route::get('/logout', 'AuthController@logout')->name('admin.logout');
});



Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'AuthController@login')->name('admin.login');
    Route::post('/login', 'AuthController@login_auth')->name('admin.login.auth');
});
