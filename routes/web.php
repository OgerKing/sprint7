<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\WratsUserApplicationHistoryController;
use Illuminate\Support\Facades\Route;

Route::view('adjudications', 'adjudications')->name('adjudications');
Route::view('combine', 'combine')->name('combine');
Route::view('courts-and-judges', 'courts-and-judges')->name('courts-and-judges');
Route::view('dashboard', 'dashboard')->name('dashboard')->middleware('verified');
Route::view('global-document', 'global-documents')->name('global-document');
Route::view('knowledge-base', 'knowledge-base')->name('knowledge-base');
Route::view('records', 'records')->name('records');
Route::view('reports', 'reports')->name('reports');
Route::view('sections', 'adjudication-sections')->name('sections');
Route::view('split', 'split')->name('split');
Route::view('support', 'support')->name('support');

Route::controller(ProfileController::class)->name('profile.')->prefix('profile')->group(function () {
    Route::get('', 'edit')->name('edit');
    Route::patch('', 'update')->name('update');
    Route::delete('', 'destroy')->name('destroy');
});

Route::resource('wrats-user-application-histories', WratsUserApplicationHistoryController::class);

Route::get('my-history', [WratsUserApplicationHistoryController::class, 'show'])->name('my-history');
Route::get('account-settings', [UserSettingController::class, 'show'])->name('account-settings');

Route::get('document-management/{type}/{document_id}', function ($type, $document_id) {
    return view('document-management', ['type' => $type, 'document_id' => $document_id]);
})->where('type', 'global|defendant|adjudication|hydrographic')->name('document-management');

Route::prefix('records')->name('records.')->group(function () {
    Route::redirect('', '/records/subfiles');
    Route::view('authorized-agents', 'records.authorized-agents')->name('authorized-agents');
    Route::view('documents', 'records.documents')->name('documents');
    Route::view('persons', 'records.persons')->name('persons');
    Route::view('places-of-use', 'records.places-of-use')->name('places-of-use');
    Route::view('points-of-diversion', 'records.points-of-diversion')->name('points-of-diversion');
    Route::view('subfiles', 'records.subfiles')->name('subfiles');
    Route::view('water-rights', 'records.water-rights')->name('water-rights');
});
