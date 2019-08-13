<?php

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
// use App\Http\Middleware\ArchiveMiddleware;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
  return view('welcome', [
    'archives'=>$request->archives,
    'current_jobs'=>$request->current_jobs
  ]);
});
Route::get('/howtouse', 'HomeController@howToUse')->name('howtouse');
Route::get('/mypage', 'HomeController@mypage')->name('mypage');
// JobController
Route::resource('jobs', 'JobController');
Route::get('jobs/{year}/{month}', 'JobController@showFromArchives')->name('jobs.showFromArchives');
// CommentController
Route::post('/jobs/{job}/comments', 'CommentController@store')->name('comments.store');
// StoryController
Route::resource('stories', 'StoryController');

Route::delete('/jobs/{job}/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');



Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Auth::routes();



// LoginCheck
Route::group(['middleware' => 'auth'], function(){
  // rolesCheck
  Route::group(['middleware' => 'roles', 'roles' => 'admin'], function(){

    Route::get('admin', 'Admin\AdminController@index');
    Route::resource('admin/roles', 'Admin\RolesController');
    Route::resource('admin/permissions', 'Admin\PermissionsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::resource('admin/pages', 'Admin\PagesController');
    Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
      'index', 'show', 'destroy'
    ]);
    Route::resource('admin/settings', 'Admin\SettingsController');
    Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

  });

});
