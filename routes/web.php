<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Livewire\ShowHome;
use App\Livewire\EventoDetalhes;
use App\Livewire\ShowSobreNos;
use App\Http\Controllers\InscricaoController;
use Filament\Facades\Filament;


// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/dashboard', function () {
//    return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Rotas de autenticação para usuários não autenticados (guest)
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Rotas para usuários autenticados (auth)
Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota de logout (usuários logados)
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::middleware(['auth'])->group(function () {
    // Suas rotas que exigem autenticação
    Route::post('/evento/{eventoId}/inscrever', [InscricaoController::class, 'inscrever'])->name('inscrever');
    Route::post('/evento/{evento}/cancelar', [InscricaoController::class, 'cancelarInscricao'])->name('cancelar.inscricao');
});
// Route::post('/evento/{eventoId}/inscrever', [InscricaoController::class, 'inscrever'])->name('inscrever');

// Filament::routeMiddleware([
//     'admin' => \App\Http\Middleware\AdminMiddleware::class,
// ]);

// Route::middleware(['auth', 'admin'])->group(function () {
//     Filament::routes();
// });



require __DIR__.'/auth.php';

// Rotas públicas
Route::get('/', ShowHome::class)->name('evento');
Route::get('/evento/{id}', EventoDetalhes::class)->name('eventoDetalhes');
Route::get('/sobreNos', ShowSobreNos::class)->name('sobreNos');



