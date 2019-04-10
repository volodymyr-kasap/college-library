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
   

//Просмотр книг
Route::group(['middleware' => ['auth','permission:view-book']], function () {
    

    Route::get('/','MenuController@index')->name('index');
    Route::post('/','MenuController@indexPost')->name('indexPost');
    Route::get('/category/{id}','MenuController@filterCategory')->name('filter');
    Route::get('/category/subject/{id}','MenuController@filterBook')->name('filterBook');    

    Route::resource('doc','DocController', ['only' => [
        'index', 'show']]);
    Route::post('/download','FileController@downloadFile')->name('downloadFile');
    
    //редактирование
    Route::group(['middleware' => ['permission:edit-book']] , function () {
        Route::resource('doc','DocController', ['only' => [
             'update','edit']]);
    });

    //добавление
    Route::group(['middleware' => ['permission:add-book']] , function () {
        Route::resource('doc','DocController', ['only' => [
            'store']]);

        Route::get('/language',"ComponentController@Lang")->name('Lang');
        Route::post('/language',"ComponentController@addLang")->name('addLang');

        Route::get('/publisher',"ComponentController@Publisher")->name('Publisher');
        Route::post('/publisher',"ComponentController@addPublisher")->name('addPublisher');

        Route::get('/source',"ComponentController@Source")->name('Source');
        Route::post('/source',"ComponentController@addSource")->name('addSource');

        Route::get('/subject',"ComponentController@Subject")->name('Subject');
        Route::post('/subject',"ComponentController@addSubject")->name('addSubject');

        Route::get('/creator',"ComponentController@Creator")->name('Creator');
        Route::post('/creator',"ComponentController@addCreator")->name('addCreator');

        Route::get('/contributor',"ComponentController@Contributor")->name('Contributor');
        Route::post('/contributor',"ComponentController@addContributor")->name('addContributor');

        Route::get('/create','AdminController@createDoc')->name('create');
    });

    //удаление
    Route::group(['middleware' => ['permission:delete-book']] , function () {

        Route::resource('doc','DocController', ['only' => [
            'destroy']]);
    });
});

//Админка
Route::group(['prefix'=>'admin','middleware'=>['auth', 'role:admin']] , function () {

    Route::get('/', 'AdminController@execute')->name('admin');

    Route::resource('role', 'RolesController', ['only' => [
        'edit', 'update', 'index']]);

    Route::resource('user', 'UserController', ['only' => [
        'update', 'index']]);
});


//Авторизация, регистрация и т.д
Auth::routes();

//DB::listen(function($query) {
//    dump($query->sql);
//});


