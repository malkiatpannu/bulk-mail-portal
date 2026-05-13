<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/test-mail', function () {

    Mail::raw('Mailgun test successful', function ($message) {

        $message->to('malkiatpannu@gmail.com')
            ->subject('Mailgun Test');

    });

    return 'Email sent';
});
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    /*
    |--------------------------------------------------------------------------
    | Contacts
    |--------------------------------------------------------------------------
    */

    Route::get('/contacts', [ContactController::class, 'index'])
    ->name('contacts.index');

    Route::get('/contacts/create', [ContactController::class, 'create'])
    ->name('contacts.create');

    Route::post('/contacts', [ContactController::class, 'store'])
    ->name('contacts.store');

    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])
    ->name('contacts.edit');

    Route::put('/contacts/{contact}', [ContactController::class, 'update'])
    ->name('contacts.update');

    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])
    ->name('contacts.destroy');

    Route::post('/contacts/import', [ContactController::class, 'import'])
    ->name('contacts.import');

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    */

    Route::get('/templates', [TemplateController::class, 'index'])
    ->name('templates.index');

    Route::get('/templates/create', [TemplateController::class, 'create'])
    ->name('templates.create');

    Route::post('/templates', [TemplateController::class, 'store'])
    ->name('templates.store');

    Route::get('/templates/{template}/edit', [TemplateController::class, 'edit'])
    ->name('templates.edit');

    Route::put('/templates/{template}', [TemplateController::class, 'update'])
    ->name('templates.update');

    Route::delete('/templates/{template}', [TemplateController::class, 'destroy'])
    ->name('templates.destroy');

    Route::get('/templates/{template}/preview', [TemplateController::class, 'preview'])
    ->name('templates.preview');
    Route::resource('campaigns', CampaignController::class);

    /*
    |--------------------------------------------------------------------------
    | Campaigns
    |--------------------------------------------------------------------------
    */

    Route::get('/campaigns', [CampaignController::class, 'index'])
    ->name('campaigns.index');

    Route::get('/campaigns/create', [CampaignController::class, 'create'])
    ->name('campaigns.create');

    Route::post('/campaigns', [CampaignController::class, 'store'])
    ->name('campaigns.store');

    Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])
    ->name('campaigns.show');
});

require __DIR__.'/auth.php';
