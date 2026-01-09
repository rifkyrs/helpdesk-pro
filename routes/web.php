<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tickets', \App\Http\Controllers\TicketController::class);
    Route::get('tickets/{ticket}/download/{attachment}', [\App\Http\Controllers\DownloadController::class, 'download'])
         ->name('tickets.download');

    // TMP DEBUG SMTP
    Route::get('/debug-smtp', function() {
        $config = config('mail.mailers.smtp');
        return response()->json([
            'status' => 'Debug Config',
            'transport' => $config['transport'],
            'host' => $config['host'],
            'port' => $config['port'],
            'username' => $config['username'],
            'password_set' => !empty($config['password']),
            'password_length' => strlen($config['password']),
            'encryption' => $config['encryption'],
            'from' => config('mail.from'),
        ]);
    });
});

// Captcha Routes
Route::get('/captcha/image', [\App\Http\Controllers\CaptchaController::class, 'show'])->name('captcha.image');



require __DIR__.'/auth.php';
