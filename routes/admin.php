<?php

Route::group([ 'as' => 'admin.' ], function () {

    Route::get('login', 'AuthController@login')->name('login');
    Route::post('login/store', 'AuthController@store')->name('login.store');

    Route::group([ 'middleware' => 'auth' ], function (){

        Route::get('/', 'DashboardController@index')->name('dashboard.index');
        Route::get('/logout', 'AuthController@logout');
        Route::group(['middleware' => 'access.admin'], function (){

            Route::resource('users', 'User\UserController');
            Route::resource('roles', 'Role\RoleController');

            Route::prefix('/access')->group(function() {
                /**
                 * Role access
                 */
                Route::get('/role', 'Roles\AccessModuleController@role');
                Route::get('/role/{id}', 'Roles\AccessModuleController@role_assign');
                Route::put('/role/{id}', 'Roles\AccessModuleController@role_assign_update');
    
                /**
                 * Access permission
                 */
                Route::get('/permission', 'Roles\AccessModuleController@permission');
                Route::get('/permission/{id}', 'Roles\AccessModuleController@permission_assign');
                Route::put('/permission/{id}', 'Roles\AccessModuleController@permission_assign_update');
    
            }); 
        });

    });
});
