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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Frontend\FrontendController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>'auth'], function(){

    Route::prefix('users')->group(function(){

        Route::get('/view', 'Backend\UserController@view')->name('users.view');
        Route::get('/add', 'Backend\UserController@add')->name('users.add');
        Route::post('/store', 'Backend\UserController@store')->name('users.store');  
        Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
        Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
        Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
        
    });
    
    Route::prefix('profiles')->group(function(){
    
        Route::get('/view', 'Backend\ProfileController@view')->name('profiles.view');
        Route::get('/edit', 'Backend\ProfileController@edit')->name('profiles.edit');
        Route::post('/store', 'Backend\ProfileController@update')->name('profiles.update');
        Route::get('/password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
        Route::post('/password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
        
    });

    Route::prefix('setups')->group(function(){
        //Student Class
        Route::get('/student/class/view', 'Backend\Setup\StudentClassController@view')->name('setups.student.class.view');
        Route::get('/student/class/add', 'Backend\Setup\StudentClassController@add')->name('setups.student.class.add');
        Route::post('/student/class/store', 'Backend\Setup\StudentClassController@store')->name('setups.student.class.store');  
        Route::get('/student/class/edit/{id}', 'Backend\Setup\StudentClassController@edit')->name('setups.student.class.edit');
        Route::post('/student/class/update/{id}', 'Backend\Setup\StudentClassController@update')->name('setups.student.class.update');
        Route::get('/student/class/delete/{id}', 'Backend\Setup\StudentClassController@delete')->name('setups.student.class.delete');
        
        //Student year/Session
        Route::get('/student/year/view', 'Backend\Setup\YearController@view')->name('setups.student.year.view');
        Route::get('/student/year/add', 'Backend\Setup\YearController@add')->name('setups.student.year.add');
        Route::post('/student/year/store', 'Backend\Setup\YearController@store')->name('setups.student.year.store');  
        Route::get('/student/year/edit/{id}', 'Backend\Setup\YearController@edit')->name('setups.student.year.edit');
        Route::post('/student/year/update/{id}', 'Backend\Setup\YearController@update')->name('setups.student.year.update');
        Route::get('/student/year/delete/{id}', 'Backend\Setup\YearController@delete')->name('setups.student.year.delete');
        
        //Student Group
        Route::get('/student/group/view', 'Backend\Setup\GroupController@view')->name('setups.student.group.view');
        Route::get('/student/group/add', 'Backend\Setup\GroupController@add')->name('setups.student.group.add');
        Route::post('/student/group/store', 'Backend\Setup\GroupController@store')->name('setups.student.group.store');  
        Route::get('/student/group/edit/{id}', 'Backend\Setup\GroupController@edit')->name('setups.student.group.edit');
        Route::post('/student/group/update/{id}', 'Backend\Setup\GroupController@update')->name('setups.student.group.update');
        Route::get('/student/group/delete/{id}', 'Backend\Setup\GroupController@delete')->name('setups.student.group.delete');
    });

});

