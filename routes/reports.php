<?php

use App\Http\Controllers\Reports\ReportsController;

Route::group(['middleware' => ['web', 'reports']], function () {
    Route::name('reports.')->group(function () {
        Route::get('/', [ReportsController::class, 'index'])->name('index');
        Route::get('/users', [ReportsController::class, 'users'])->name('users');
        Route::get('/jobs', [ReportsController::class, 'jobs'])->name('jobs');
        Route::get('/jobs', [ReportsController::class, 'jobs'])->name('jobs');
        Route::get('/employees', [ReportsController::class, 'employees'])->name('employees');
        Route::get('/employers', [ReportsController::class, 'employers'])->name('employers');
        Route::get('/courses', [ReportsController::class, 'courses'])->name('courses');
        Route::get('/apps', [ReportsController::class, 'apps'])->name('apps');
        Route::get('/instructors', [ReportsController::class, 'instructors'])->name('instructors');
        Route::get('/enrolls', [ReportsController::class, 'enrolls'])->name('enrolls');
        Route::get('/advanced', [ReportsController::class, 'advanced'])->name('advanced');
    });
});
