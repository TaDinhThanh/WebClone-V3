<?php

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

Route::get('/rd/xml/a/export/{from}/{to}/{id_cam}', 'Admin\ToolCloneController@export_js');
Route::get('/rd/xml/a/export_txt/{from}/{to}/{id_cam}', 'Admin\ToolCloneController@export_txt_rd');
Route::get('/rd/xml/a/export_txt_wiki/{from}/{to}/{id_cam}', 'Admin\ToolCloneController@export_txt_wiki');

Route::get('/rd/xml/a/createTH_rd/{from}/{to}/{id_cam}', 'Admin\ToolCloneController@createTH_rd');
Route::get('/rd/xml/a/createTH_wiki/{from}/{to}/{id_cam}', 'Admin\ToolCloneController@createTH_wiki');
Route::get('/rd/xml/a/createTH_wiki_new/{from}/{to}/{id_cam}/{chon}', 'Admin\ToolCloneController@createTH_wiki_new');
Route::get('/rd/xml/a/createTH_xds/{from}/{to}/{id_cam}', 'Admin\ToolCloneController@createTH_xds');

Route::prefix('rd/xml/a')->group(function () {
    Route::controller(DataController::class)->group(function () {
        Route::post('tool-clone', 'parseURL');
    });
    Route::controller(HwpCampaignController::class)->group(function () {
        Route::get('get-cam', 'getCam');
        Route::post('save-cam', 'saveCam');
        Route::put('update-cam/{hwpCampaign}', 'updateStatusCam');
        Route::put('reset-cam/{hwpCampaign}', 'resetStatusCam');
        Route::delete('delete-campaign/{hwpCampaign}', 'deleteCam');
    });
    Route::controller(HwpKeyGoogleController::class)->group(function () {
        Route::get('get-all-key-google', 'getAllKeyGoogle');
        Route::get('get-key-google', 'getKeyGoogle');
        Route::get('get-first-key-google', 'getFirstKeyGoogle');
        Route::post('save-key-google', 'saveKeyGoogle');
        Route::put('get-next-key-google/{key_gg}', 'getNextKeyGoogle');
        Route::put('update-count-key-google/{key_gg}', 'updateCountKeyGoogle');
        Route::put('reset-all-key-google', 'resetAllKeyGoogle');
        Route::delete('delete-key-google/{key_gg}', 'deleteKeyGoogle');
        Route::delete('delete-all-key-google', 'deleteAllKeyGoogle');

        Route::get('get-all-key-youtube', 'getAllKeyYoutube');
        Route::get('get-key-youtube', 'getKeyYoutube');
        Route::get('get-first-key-youtube', 'getFirstKeyYoutube');
        Route::post('save-key-youtube', 'saveKeyYoutube');
        Route::put('get-next-key-youtube/{key_yt}', 'getNextKeyYoutube');
        Route::put('update-count-key-youtube/{key_yt}', 'updateCountKeyYoutube');
        Route::put('reset-all-key-youtube', 'resetAllKeyYoutube');
        Route::delete('delete-key-youtube/{key_yt}', 'deleteKeyYoutube');
        Route::delete('delete-all-key-youtube', 'deleteAllKeyYoutube');
    });
    Route::controller(HwpBlackListController::class)->group(function () {
        Route::get('get-black-list', 'getBlackList');
        Route::get('get-black-list-by-id-cam/{id_cam}', 'getBlackListByIdCam');
        Route::post('save-black-list', 'saveBlackList');
        Route::post('save-black-list-by-id-cam/{id_cam}', 'saveBlackListByIdCam');
        Route::delete('delete-black-list/{black_list}', 'xoaBlackKey');
        Route::delete('delete-all-black-list/{id_cam}', 'xoaAllBlackKey');
    });
    Route::controller(HwpKeyController::class)->group(function () {
        Route::get('get-ky-hieu/{key}', 'getKyHieu');
        Route::get('get-key-by-id-cam/{id_cam}', 'getKeyByIdCam');
        Route::get('get-id-key/{id_cam}', 'getIdKey');
        Route::get('get-key', 'getKey');
        Route::get('get-key-none-url/{id_cam}', 'getKeyNoneUrl');
        Route::get('find-key/{name}', 'findLikeKey');
        Route::get('get-data-id-have-video/{id_key}', 'getDataIdHaveVideo');
        Route::get('get-data-id-have-url-google/{id_key}', 'getDataIdHaveUrlGoogle');
        Route::post('save-key', 'saveKey');
        Route::post('save-key-by-id-cam/{id_cam}', 'saveKeyByIdCam');
        Route::put('update-key/{hwpKey}', 'updateKey');
        Route::put('reset-key/{key}', 'resetKey');
        Route::delete('delete-key/{hwpKey}', 'xoaKey');
        Route::delete('delete-all-key/{id_cam}', 'xoaAllKey');
    });
    Route::controller(HwpUrlController::class)->group(function () {
        Route::get('get-url/{id_key}', 'getUrl');
        Route::get('get-url-by-id/{id_url}', 'getUrlById');
        Route::get('get-url-by-id-key/{id_key}', 'getUrlByIdKey');
        Route::get('get-url-by-id-key2/{id_key}', 'getUrlByIdKey2');
        Route::post('save-url/{id_key}', 'saveUrl');
        Route::put('reset-url/{id_key}', 'resetUrl');
        Route::delete('delete-url/{id_url}', 'xoaURL');
        Route::delete('delete-url-by-id-key/{id_key}', 'xoaURLByIdKey');
    });
    Route::controller(HwpPostController::class)->group(function () {
        Route::post('save-video', 'saveVideo');
        Route::post('save-file', 'saveFileType');
        Route::post('save-web', 'saveWeb');
        Route::post('save-image', 'saveImage');
        Route::delete('delete-post-by-id-key/{id_key}', 'xoaPostByIdKey');
        Route::get('get-detail-post/{id}', 'getDetailPost');
    });
});
