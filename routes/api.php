<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1','namespace'=>'Api'],function (){
Route::group(['prefix'=>'Front'],function (){
 Route::get('index','FrontController@index');
});
});
Route::group(['prefix'=>'v1','namespace'=>'Api'],function (){
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');

	Route::get('faculty/index','FacultyController@index');
	Route::get('department/index','DepartmentController@index');
    Route::get('field/index','FieldController@index');
    Route::get('techno/index','TechnologicalController@index');
    Route::get('courses/index','CourseController@index');




    Route::group(['middleware' => 'auth:api'],function (){

        Route::group(['prefix'=>'faculty'],function (){
            Route::post('add','FacultyController@AddFaculty');
          
            Route::post('update','FacultyController@update');
            Route::post('delete','FacultyController@delete');
        });
        Route::group(['prefix'=>'department'],function (){
            Route::post('add','DepartmentController@Add');
            Route::post('update','DepartmentController@update');
            Route::post('delete','DepartmentController@delete');
        });

        Route::group(['prefix'=>'field'],function (){
            Route::post('add','FieldController@Add');
            Route::post('update','FieldController@update');
            Route::post('delete','FieldController@delete');
        });

        Route::group(['prefix'=>'techno'],function (){
            Route::post('add','TechnologicalController@Add');
            Route::post('update','TechnologicalController@update');
            Route::post('delete','TechnologicalController@delete');
        });

        Route::group(['prefix'=>'courses'],function (){
            Route::post('add','CourseController@Add');
            Route::post('update','CourseController@update');
            Route::post('delete','CourseController@delete');
        });

    });
});
