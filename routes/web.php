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
    JobPostController
};
use App\Http\Controllers\jobPortal\front\employer\auth\{

    EmployerAuth,
};

use App\Http\Controllers\jobPortal\front\auth\{

    UsersAuth,
    ManageProfile,
};
use App\Http\Controllers\jobPortal\traits\{

    FetchCommonPost,
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

require_once __DIR__ . '/auth.php';
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
Route::middleware(['auth', 'userType:employer'])->name('employers.')->prefix('employers')->group(function () {
    Route::get('/dashboard', [Employer::class, 'dashboard'])->name('dashboard');
    Route::get('/job-seeker', [Employer::class, 'jobSeeker'])->name('job-seeker');
    Route::get('/job-posts', [JobPostController::class, 'jobPost'])->name('jobpost');
    Route::get('/job-posts-edit/{id}', [JobPostController::class, 'modifyJobPost'])->name('job-post-edit');
    Route::get('/job-posts-view/{id}', [JobPostController::class, 'showJobPost'])->name('job-post-view');
    Route::post('/job-posts-create', [JobPostController::class, 'jobPostCreate'])->name('jobpost.create');
    Route::post('/job-posts-update', [JobPostController::class, 'jobPostUpdate'])->name('jobpost.modify');
    Route::get('/post-list', [JobPostController::class, 'postList'])->name('post-list');
});

Route::middleware(['auth', 'userType:seeker'])->name('users.')->prefix('users')->group(function () {
    Route::get('/show-profile', [ManageProfile::class, 'showProfile'])->name('create-profile');
    Route::post('/create-profile', [ManageProfile::class, 'updateProfile'])->name('create-profile.post');
    Route::get('/index', [FrontUser::class, 'index'])->name('index');
    Route::get('/view-my-cv', [FrontUser::class, 'viewMyCv'])->name('my-cv');
    Route::post('/apply-job', [FrontUser::class, 'applyJob'])->name('apply-job');
    Route::get('/list-job-applied', [FrontUser::class, 'listApplyJob'])->name('list-apply-job');
    Route::get('/create-resume', [FrontUser::class, 'createResume'])->name('create-resume');
    Route::post('/create-resume', [FrontUser::class, 'createResumeStore'])->name('create-resume-post');
    Route::get('/upload-resume', [FrontUser::class, 'uploadResume'])->name('upload-resume');
});

Route::group(['prefix' => 'post','name' => 'fetch.','middleware' => ['auth']],function () {
    Route::post('/states-list', [FetchCommonPost::class, 'getStates'])->name('states');
    Route::post('/cities-list', [FetchCommonPost::class, 'getCities'])->name('cities');
});

Route::get('/users/job-posts', [ManageProfile::class, 'verfyUserForPost'])->name('users.job-posts');