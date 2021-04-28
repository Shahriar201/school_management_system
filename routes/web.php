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
        
        //Student Shift
        Route::get('/student/shift/view', 'Backend\Setup\ShiftController@view')->name('setups.student.shift.view');
        Route::get('/student/shift/add', 'Backend\Setup\ShiftController@add')->name('setups.student.shift.add');
        Route::post('/student/shift/store', 'Backend\Setup\ShiftController@store')->name('setups.student.shift.store');  
        Route::get('/student/shift/edit/{id}', 'Backend\Setup\ShiftController@edit')->name('setups.student.shift.edit');
        Route::post('/student/shift/update/{id}', 'Backend\Setup\ShiftController@update')->name('setups.student.shift.update');
        Route::get('/student/shift/delete/{id}', 'Backend\Setup\ShiftController@delete')->name('setups.student.shift.delete');
        
        //Fee Category
        Route::get('/fee/category/view', 'Backend\Setup\FeeCategoryController@view')->name('setups.fee.category.view');
        Route::get('/fee/category/add', 'Backend\Setup\FeeCategoryController@add')->name('setups.fee.category.add');
        Route::post('/fee/category/store', 'Backend\Setup\FeeCategoryController@store')->name('setups.fee.category.store');  
        Route::get('/fee/category/edit/{id}', 'Backend\Setup\FeeCategoryController@edit')->name('setups.fee.category.edit');
        Route::post('/fee/category/update/{id}', 'Backend\Setup\FeeCategoryController@update')->name('setups.fee.category.update');
        Route::get('/fee/category/delete/{id}', 'Backend\Setup\FeeCategoryController@delete')->name('setups.fee.category.delete');
        
        //Fee Category Amount
        Route::get('/fee/amount/view', 'Backend\Setup\FeeAmountController@view')->name('setups.fee.amount.view');
        Route::get('/fee/amount/add', 'Backend\Setup\FeeAmountController@add')->name('setups.fee.amount.add');
        Route::post('/fee/amount/store', 'Backend\Setup\FeeAmountController@store')->name('setups.fee.amount.store');  
        Route::get('/fee/amount/edit/{fee_category_id}', 'Backend\Setup\FeeAmountController@edit')->name('setups.fee.amount.edit');
        Route::post('/fee/amount/update/{fee_category_id}', 'Backend\Setup\FeeAmountController@update')->name('setups.fee.amount.update');
        Route::get('/fee/amount/delete/{id}', 'Backend\Setup\FeeAmountController@delete')->name('setups.fee.amount.delete');
        Route::get('/fee/amount/details/{fee_category_id}', 'Backend\Setup\FeeAmountController@details')->name('setups.fee.amount.details');
        
        //Exam Type
        Route::get('/exam/type/view', 'Backend\Setup\ExamTypeController@view')->name('setups.exam.type.view');
        Route::get('/exam/type/add', 'Backend\Setup\ExamTypeController@add')->name('setups.exam.type.add');
        Route::post('/exam/type/store', 'Backend\Setup\ExamTypeController@store')->name('setups.exam.type.store');  
        Route::get('/exam/type/edit/{id}', 'Backend\Setup\ExamTypeController@edit')->name('setups.exam.type.edit');
        Route::post('/exam/type/update/{id}', 'Backend\Setup\ExamTypeController@update')->name('setups.exam.type.update');
        Route::get('/exam/type/delete/{id}', 'Backend\Setup\ExamTypeController@delete')->name('setups.exam.type.delete');
       
        //Subjects
        Route::get('/subject/view', 'Backend\Setup\SubjectController@view')->name('setups.subject.view');
        Route::get('/subject/add', 'Backend\Setup\SubjectController@add')->name('setups.subject.add');
        Route::post('/subject/store', 'Backend\Setup\SubjectController@store')->name('setups.subject.store');  
        Route::get('/subject/edit/{id}', 'Backend\Setup\SubjectController@edit')->name('setups.subject.edit');
        Route::post('/subject/update/{id}', 'Backend\Setup\SubjectController@update')->name('setups.subject.update');
        Route::get('/subject/delete/{id}', 'Backend\Setup\SubjectController@delete')->name('setups.subject.delete');
        
        //Assign Subjects
        Route::get('/assign/subject/view', 'Backend\Setup\AssignSubjectController@view')->name('setups.assign.subject.view');
        Route::get('/assign/subject/add', 'Backend\Setup\AssignSubjectController@add')->name('setups.assign.subject.add');
        Route::post('/assign/subject/store', 'Backend\Setup\AssignSubjectController@store')->name('setups.assign.subject.store');  
        Route::get('/assign/subject/edit/{class_id}', 'Backend\Setup\AssignSubjectController@edit')->name('setups.assign.subject.edit');
        Route::post('/assign/subject/update/{class_id}', 'Backend\Setup\AssignSubjectController@update')->name('setups.assign.subject.update');
        Route::get('/assign/subject/delete/{id}', 'Backend\Setup\AssignSubjectController@delete')->name('setups.assign.subject.delete');
        Route::get('/assign/subject/details/{class_id}', 'Backend\Setup\AssignSubjectController@details')->name('setups.assign.subject.details');

        //Designation
        Route::get('/designation/view', 'Backend\Setup\DesignationController@view')->name('setups.designation.view');
        Route::get('/designation/add', 'Backend\Setup\DesignationController@add')->name('setups.designation.add');
        Route::post('/designation/store', 'Backend\Setup\DesignationController@store')->name('setups.designation.store');  
        Route::get('/designation/edit/{id}', 'Backend\Setup\DesignationController@edit')->name('setups.designation.edit');
        Route::post('/designation/update/{id}', 'Backend\Setup\DesignationController@update')->name('setups.designation.update');
        Route::get('/designation/delete/{id}', 'Backend\Setup\DesignationController@delete')->name('setups.designation.delete');
    });

});

