<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::get('profile', 'ProfileController@profile');
    Route::put('profile', 'ProfileController@updateProfile');
    Route::post('change-password', 'ProfileController@changePassword');
    Route::get('tag/list', 'TagController@list');
    Route::get('category/list', 'CategoryController@list');
    Route::get('site/list', 'SiteController@list');
    Route::get('complain/list', 'ComplaintController@list');
    Route::post('product/upload', 'ProductController@upload');
    Route::get('all-complaints', 'DashboadController@AllComplaints');
    Route::get('open-complaints', 'DashboadController@OpenComplaints');
    Route::get('closed-complaints', 'DashboadController@ClosedComplaints');

    Route::apiResources([
        'user' => 'UserController',
        'product' => 'ProductController',
        'category' => 'CategoryController',
        'site' => 'SiteController',
        'complain' => 'ComplaintController',
        'tag' => 'TagController',
    ]);
});

