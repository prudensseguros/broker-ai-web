<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/debug-assets', function () {
    $buildPath = public_path('build');
    $manifestPath = public_path('build/manifest.json');
    
    return response()->json([
        'build_exists' => file_exists($buildPath),
        'build_is_dir' => is_dir($buildPath),
        'manifest_exists' => file_exists($manifestPath),
        'manifest_content' => file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null,
        'build_files' => file_exists($buildPath) ? scandir($buildPath) : [],
        'public_path' => public_path(),
        'env' => app()->environment(),
    ]);
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return 'Laravel OK';
// });


