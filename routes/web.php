<?php

use Illuminate\Support\Facades\Route;

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

//database links
Route::get('/', 'japanese@kanjiList');
Route::get('/datakanji', 'datahandler@dataOutputKanji');
Route::get('/datakotoba', 'datahandler@dataOutputKotoba');

//kanjicards
Route::get('/kanjicards', 'japanese@kanjiCardsNormal');
Route::get('/kanjicardsactive', 'japanese@kanjiCardsActive', ["as" => "kanjicards"]);
Route::get('/kanjicardspassive', 'japanese@kanjiCardsPassive', ["as" => "kanjicards"]);
Route::get('/listen_practice', 'japanese@listenRenshuu');

//kotoba
Route::get('/kotobacards', 'japanese@kotobaCards');

Route::get('/rotate_tts', 'japanese@rotateTTS');

//posts data adding
Route::post('addkanji', 'datahandler@dataStoreKanji');
Route::post('addkotoba', 'datahandler@dataStoreKotoba');

//posts data change
Route::post('kanjicardsuccess', 'datahandler@kanjicardSuccess');
Route::post('kanjicardrelearn', 'datahandler@kanjicardRelearn');

Route::post('kotobacardsuccess', 'datahandler@kotobacardSuccess');
Route::post('kotobacardrelearn', 'datahandler@kotobacardRelearn');

Route::post('pointchange', 'datahandler@pointchange');
Route::post('kanjistatus', 'datahandler@kanjistatus');
Route::post('kotobastatus', 'datahandler@kotobastatus');
Route::post('lessonpick', 'datahandler@lessonpick');
Route::post('kotobaoccur', 'datahandler@kotobaoccur');
// Route::post('kanjicardrelearn', 'datahandler@kanjicardRelearn');
