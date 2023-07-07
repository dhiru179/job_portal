<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jobPortal\admin\{
    FormController,
    AdminDashboard,
    JobController
};
use App\Http\Controllers\jobPortal\front\{
    LandingPage,
};

use App\Http\Controllers\jobPortal\front\user\{
    FrontUser,
};
use App\Http\Controllers\jobPortal\front\employer\{
    Employer,
};


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

require_once __DIR__.'/auth.php';
Route::get('/', [LandingPage::class, 'landingPage'])->name('landing_page');
Route::middleware(['auth:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index']);
    Route::get('/create-form', [FormController::class, 'createForm'])->name('create-form');
    Route::post('/custom_form', [FormController::class, 'storeFormField'])->name('store-field-info');
    Route::get('/show-form-field', [FormController::class, 'showFormField'])->name('show-form-field');
    Route::post('/get_form-field', [FormController::class, 'getFormField'])->name('get-form-field');
    Route::post('/modify-form-field', [FormController::class, 'modifyFormField'])->name('modify-form-field');

    Route::post('/delete_custom_form', [FormController::class, 'deleteField']);
    Route::post('/delete_option', [FormController::class, 'deleteOption']);

    Route::get('/category', [FormController::class, 'showCategory']);
    Route::post('/store_category', [FormController::class, 'storeCategory']);


    Route::post('/get_form', [FormController::class, 'getForm']);

    #json ways
    Route::get('/form', [jsonFormController::class, 'dynamicForm']);
    Route::post('/store_form_data', [jsonFormController::class, 'storeFormData']);
    Route::get('/list_form_data', [jsonFormController::class, 'showFormData']);
    Route::get('/list_form_data/{id}', [jsonFormController::class, 'showFormData']);
    #end

    // Route::get('/signup', [AdminAuth::class, 'signUp'])->name('signup');
    // Route::get('/login', [AdminAuth::class, 'login'])->name('login');
    // Route::post('/login', [AdminAuth::class, 'login'])->name('login.post');
    // Route::post('/logout', [AdminAuth::class, 'signUp'])->name('logout');
});
Route::middleware(['auth:employer'])->name('employers.')->prefix('employers')->group(function () {
    Route::get('/dashboard', [Employer::class, 'dashboard'])->name('dashboard');
    Route::get('/job-posts', [Employer::class, 'jobPost'])->name('jobpost');
    Route::post('/job-posts', [Employer::class, 'jobPostStore'])->name('jobpost.post');
    Route::get('/post-list', [Employer::class, 'postList'])->name('post-list');
});

Route::middleware(['auth'])->name('users.')->prefix('users')->group(function () {
    
    Route::get('/index', [FrontUser::class, 'index'])->name('index');
    Route::post('/apply-job', [FrontUser::class, 'applyJob'])->name('apply-job');
    Route::get('/list-job-applied', [FrontUser::class, 'listApplyJob'])->name('list-apply-job');
    Route::get('/create-profile', [FrontUser::class, 'createProfile'])->name('create-profile');
    Route::post('/create-profile', [FrontUser::class, 'createProfileSave'])->name('create-profile.post');
    Route::get('/create-resume', [FrontUser::class, 'createResume'])->name('create-resume');
    Route::get('/upload-resume', [FrontUser::class, 'uploadResume'])->name('upload-resume');

});
