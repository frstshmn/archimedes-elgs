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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/cabinet', array('before' => 'auth', function() {
	return view('cabinet.main');
}));

Route::get('/home', array('before' => 'auth', function() {
	return view('cabinet.main');
}));

Route::get('/getregisteredstudents', 'LessonController@get_registered_students')->name('getregisteredstudents');

Route::post('/lesson', 'LessonController@enter_via_code')->name('lesson');

Route::post('/getquestion', 'LessonController@get_question')->name('getquestion');

Route::post('/removelesson', 'LessonController@remove_lesson')->name('removelesson');

Route::post('/createlesson', 'LessonController@create_lesson')->name('createlesson');

Route::post('/startlesson', 'LessonController@start_lesson')->name('startlesson');

Route::post('/stoplesson', 'LessonController@stop_lesson')->name('stoplesson');

Route::post('/answer', 'LessonController@answer')->name('answer');

Route::post('/report', 'LessonController@report')->name('report');

Route::get('/examss', 'LessonController@examss')->name('examss');

Route::get('/error',function(){
  abort(404);
});

