<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\ListUserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => "home"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => "about",
        "name" => "Albertus Adrian S",
        "email" => "albertus.adrian@ti.ukdw.ac.id",
        "image" => "albertus.jpeg"
    ]);
});

Route::get('/posts', [PostController::class, 'index']);

Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

// Logout
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['guest']], function () {
    //Register
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::group(['prefix' => '/dashboard', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('', function () {
        return view('dashboard.index');
    });

    // Dashboard Post
    Route::get("/checkSlug", [DashboardPostController::class, "checkSlug"]);
    Route::resource('/posts', DashboardPostController::class);
});


// Authorization
// Admin Category
Route::get('/dashboard/categories/fetch-categories',[AdminCategoryController::class,"fetchCategories"]);
Route::resource('/dashboard/categories', AdminCategoryController::class)->middleware('admin');


Route::group(['middleware' => ['auth', 'checkAdmin']], function () {
    Route::get('/dashboard/list-users', [ListUserController::class, 'index']);
});

// Route::group(["middleware" => ["auth", "rolemkt"]], function() {
//     // Dashboard Post
//     Route::get("/dashboard/checkSlug",[DashboardPostController::class,"checkSlug"]);
//     Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
//     Route::get("/get-user",[DashboardPostController::class,"checkSlug"]);

//     // Admin Category
//     Route::resource('/dashboard/categories',AdminCategoryController::class)->except('show')->middleware('auth');
// });

// Route::group(["middleware" => ["auth", "rolemkt"]], function() {
//     // Dashboard Post
//     Route::get("/dashboard/checkSlug",[DashboardPostController::class,"checkSlug"]);
//     Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
//     Route::get("/get-user",[DashboardPostController::class,"checkSlug"]);

//     // Admin Category
//     Route::resource('/dashboard/categories',AdminCategoryController::class)->except('show')->middleware('auth');
// });


// Route::get('/categories/{category:category_slug}', function(Category $category) {
//     return view('posts', [
//         'title'=>"Post by Category : $category->category_name",
//         'active' => 'categories',
//         'posts'=>$category->posts->load('category','author')
//     ]);
// });

// Route::get('/author/{author:username}', function(User $author){
//     return view('posts', [
//         'title'=>"Post by Author : $author->name",
//         'active'=>"posts",
//         'posts'=>$author->posts->load('category','author')
//     ]);
// });