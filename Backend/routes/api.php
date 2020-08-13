<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/getSiteDetails' ,[
    'uses' => 'SiteDetailsController@getSiteDetails'
]);

Route::post('/addDetails',[
   'uses' => 'SiteDetailsController@addDetails'
]);

Route::post('/addTemples',[
   'uses'=>'TemplesController@addTemple'
]);

Route::post('/upTemples/{id}',[
    'uses'=>'TemplesController@upTemples'
]);


Route::get('/getTemples' ,[
    'uses' => 'TemplesController@getTemples'
]);

Route::get('/getTemples/{id}' ,[
    'uses' => 'TemplesController@getTemplesByID'
]);

Route::get('/getTemplesbyLoc/{location}' ,[
    'uses' => 'TemplesController@getTemplesbyLoc'
]);

Route::delete('/deleteTemple/{id}',[
    'uses'=>'TemplesController@deleteTemple'
]);

Route::post('/addArticle',[
    'uses'=>'ArticlesController@addArticle'
]);

Route::get('/getArticles' ,[
    'uses' => 'ArticlesController@getArticles'
]);

Route::get('/getArticles/{id}' ,[
    'uses' => 'ArticlesController@getArticlesByID'
]);

Route::get('getPopularArticles/',[
    'uses' => 'MainPageController@getPopularArticles'
]);

Route::post('updateMainPage/',[
    'uses' => 'MainPageController@upMainPage'
]);

Route::post('/upArticle/{id}',[
    'uses'=>'ArticlesController@upArticle'
]);

Route::delete('/deleteArticle/{id}',[
    'uses'=>'ArticlesController@deleteArticle'
]);

Route::get('/allvideos',[
    'uses'=>'VideosController@getAllVideos'
]);

Route::post('/addvideos',[
    'uses'=>'VideosController@addVideo'
]);

Route::delete('/deleteVideo/{id}',[
    'uses'=>'VideosController@deleteVideo'
]);

Route::get('/searchVideo/{word}',[
    'uses'=>'VideosController@searchVideo'
]);

Route::get('/getSearchResults/{word}' ,[
    'uses' => 'SearchController@getSearchResults'
]);

Route::post('/loginCheck',[
    'uses'=>'LoginController@loginCheck'
]);

Route::post('/newMessage',[
    'uses'=> 'userMessageController@newMessage'
]);

Route::get('/getMessages',[
   'uses'=> 'userMessageController@getMessages'
]);

Route::get('/getMessages/{id}',[
    'uses'=> 'userMessageController@getMessagesByID'
]);

Route::delete('/deleteMessage/{id}',[
    'uses'=> 'userMessageController@deleteMessage'
]);

Route::post('/readMessages/{id}',[
    'uses' => 'userMessageController@readMessages'
]);

Route::get('/getAllDirectories',[
    'uses'=> 'DirectoryController@getAllDirectories'
]);

Route::get('/DirectoryById/{id}',[
    'uses'=> 'DirectoryController@DirectoryById'
]);

Route::post('/addDirectory',[
    'uses'=> 'DirectoryController@addDirectory'
]);

Route::post('/updateDirectory/{id}',[
    'uses'=> 'DirectoryController@updateDirectory'
]);

Route::get('/searchDirectory/{word}',[
   'uses'=> 'DirectoryController@searchDirectory'
]);

Route::get('/searchDirectoryByCat/{word}',[
    'uses'=> 'DirectoryController@searchDirectoryByCat'
]);

Route::delete('/deleteDirectory/{id}',[
    'uses'=> 'DirectoryController@deleteDirectory'
]);

Route::get('/mainPage',[
    'uses'=> 'MainPageController@getMainPage'
]);

Route::get('/news',[
    'uses'=> 'NewsController@getNews'
]);

Route::get('/news/{id}',[
    'uses'=> 'NewsController@getNewsByID'
]);

Route::delete('/deleteNews/{id}',[
    'uses'=> 'NewsController@deleteNews'
]);

Route::post('/updateNews/{id}',[
    'uses'=> 'NewsController@updateNews'
]);

Route::post('/addNews',[
    'uses'=> 'NewsController@newNews'
]);

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});




