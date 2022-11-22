<?php
use Illuminate\Support\Facades\Redis;
/*
 تستردیس
Route::get('/', function () {
    Redis::set('name','SanayCo');
    return Redis::get('name');
})->name('home');
*/

Route::group(['prefix' => 'usercp'], function () {
    Auth::routes();
});


/* روت های بیرون از پنل مدیریت*/
Route::get('/', 'HomeController@index')->name('home');


Route::get('/about-us', 'SettingController@about')->name('about-us');
Route::get('/rules', 'SettingController@rules')->name('rules');
Route::get('/book/{book}', 'BookController@show')->name('showbook');
Route::get('/shelf/{shelf}', 'ShelfController@show')->name('showshelf');
Route::get('/chapter/{chapter}', 'ChapterController@show')->name('showchapter');
Route::get('/page/{page}', 'PageController@show')->name('showpage');

/*  روت های بررسی ورود و ثبت نام */
Route::post('/usercp/login/check', 'Auth\LoginController@check')->name('loginCheck');
Route::post('/usercp/register/check', 'Auth\RegisterController@check')->name('registerCheck');


/* روت هایی که نیاز به  دسترسی ورود دارند */
Route::group(['middleware' => 'auth', 'prefix' => 'usercp'], function () {


    /* روت های جدول های ajax */
    Route::get('/users/list', 'UserController@list')->name('users.list');
    Route::get('/audit/list', 'AuditController@list')->name('audit.list');
    Route::get('/books/list', 'BookController@list')->name('books.list');
    Route::get('/shelves/list', 'ShelfController@list')->name('shelves.list');
    Route::get('/chapters/list', 'ChapterController@list')->name('chapters.list');
    Route::get('/pages/list', 'PageController@list')->name('pages.list');
    Route::get('/roles/list', 'RoleController@list')->name('roles.list');


    /*منوهای پنل مدیریت*/
    Route::get('/', 'PanelController@index')->name('panel');
    Route::get('/users', 'UserController@index')->name('users')->middleware('role:users_view');
    Route::get('/comments', 'BookCommentController@index')->name('comments')->middleware('role:comments');
    Route::get('/comments/delete/{comment}', 'BookCommentController@destroy')->name('deleteComment')->middleware('role:comments');
    Route::get('/comments/verify/{comment}', 'BookCommentController@verify')->name('verifyComment')->middleware('role:comments');
    Route::get('/comments/unverify/{comment}', 'BookCommentController@unverify')->name('unverifyComment')->middleware('role:comments');


    Route::get('/audit-log', 'AuditController@index')->name('audit')->middleware('role:audit_view');
    Route::get('/books', 'BookController@index')->name('books')->middleware('role:books_view');
    Route::get('/roles', 'RoleController@index')->name('roles')->middleware('role:roles_view');
    Route::get('/settings', 'SettingController@show')->name('settings')->middleware('role:settings');
    Route::get('/permissions', 'RolePermitController@show')->name('permissions')->middleware('role:isAdmin');
    Route::get('/pages', 'PageController@index')->name('pages')->middleware('role:pages_view');
    Route::get('/chapters', 'ChapterController@index')->name('chapters')->middleware('role:chapters_view');
    Route::get('/shelves', 'ShelfController@index')->name('shelves')->middleware('role:shelves_view');
    Route::get('/create', 'ShelfController@create')->name('newShelf')->middleware('role:shelves_add');
    Route::get('/comments', 'BookCommentController@index')->name('comments')->middleware('role:comments');

    Route::get('/account', 'UserController@profile')->name('account');
    Route::post('/update/account/{user}', 'UserController@updateAccount')->name('updateAccount');


    /* روت های منو کاربران */
    Route::group(['prefix' => '/users'], function () {
        Route::post('/store', 'UserController@store')->name('saveUser')->middleware('role:users_add');
        Route::get('/create', 'UserController@create')->name('newUser')->middleware('role:users_add');
        Route::get('/edit/{user}', 'UserController@edit')->name('editUser')->middleware('role:users_edit');
        Route::post('/update/{user}', 'UserController@update')->name('updateUser')->middleware('role:users_edit');
        Route::get('/delete/{user}', 'UserController@destroy')->name('deleteUser')->middleware('role:users_delete');
    });

    /* روت های منو قفسه ها */
    Route::group(['prefix' => '/shelves'], function () {
        Route::post('/save', 'ShelfController@store')->name('saveShelf')->middleware('role:shelves_add');
        Route::get('/edit/{shelf}', 'ShelfController@edit')->name('editShelf')->middleware('role:shelves_edit');
        Route::post('/update/{shelf}', 'ShelfController@update')->name('updateShelf')->middleware('role:shelves_edit');
        Route::get('/delete/{shelf}', 'ShelfController@destroy')->name('deleteShelf')->middleware('role:shelves_delete');
    });

    /* روت های منو کتاب ها */
    Route::group(['prefix' => '/books'], function () {
        Route::get('/create', 'BookController@create')->name('createBook')->middleware('role:books_add');
        Route::post('/save', 'BookController@store')->name('saveBook')->middleware('role:books_add');
        Route::get('/edit/{book}', 'BookController@edit')->name('editBook')->middleware('role:books_edit');
        Route::post('/update/{book}', 'BookController@update')->name('updateBook')->middleware('role:books_edit');
        Route::get('/delete/{book}', 'BookController@destroy')->name('deleteBook')->middleware('role:books_delete');
    });

    /* روت های منو فصل ها */
    Route::group(['prefix' => '/chapters'], function () {
        Route::get('/create', 'ChapterController@create')->name('createChapter')->middleware('role:chapters_add');
        Route::post('/save', 'ChapterController@store')->name('saveChapter')->middleware('role:chapters_add');
        Route::get('/edit/{chapter}', 'ChapterController@edit')->name('editChapter')->middleware('role:chapters_edit');
        Route::post('/update/{chapter}', 'ChapterController@update')->name('updateChapter')->middleware('role:chapters_edit');
        Route::get('/delete/{chapter}', 'ChapterController@destroy')->name('deleteChapter')->middleware('role:chapters_delete');
    });

    /* روت های منو صفحه ها */
    Route::group(['prefix' => '/pages'], function () {
        Route::get('/create', 'PageController@create')->name('createPage')->middleware('role:pages_add');
        Route::post('/save', 'PageController@store')->name('savePage')->middleware('role:pages_add');
        Route::get('/edit/{page}', 'PageController@edit')->name('editPage')->middleware('role:pages_edit');
        Route::post('/update/{page}', 'PageController@update')->name('updatePage')->middleware('role:pages_edit');
        Route::get('/delete/{page}', 'PageController@destroy')->name('deletePage')->middleware('role:pages_delete');
    });
    /*روت های منو نقش ها */
    Route::group(['prefix' => '/roles'], function () {
        Route::get('/create', 'RoleController@create')->name('createRole')->middleware('role:roles_add');
        Route::post('/save', 'RoleController@store')->name('saveRole')->middleware('role:roles_add');
        Route::post('/update/{role}', 'RoleController@update')->name('updateRole')->middleware('role:roles_edit');
        Route::get('/edit/{role}', 'RoleController@edit')->name('editRole')->middleware('role:roles_edit');
        Route::get('/delete/{role}', 'RoleController@destroy')->name('deleteRole')->middleware('role:roles_delete');
    });

    Route::post('/settings/update', 'SettingController@update')->name('updateSetting')->middleware('role:Settings');


});

Route::post('/newcomment', 'BookCommentController@new')->name('newComment');
Route::get('/logout', 'LogoutController@index')->name('logout');


