<?php

    use App\Http\Controllers\JobController;
    use App\Http\Controllers\RegisteredUserController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\SessionController;
    use App\Http\Controllers\SearchController;
    use App\Http\Controllers\TagController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', [JobController::class, 'index']);
    Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
    Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
    Route::get('/jobs', [JobController::class, 'list'])->name('jobs.list');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware('auth');
    Route::patch('/jobs/{job}', [JobController::class, 'update'])->middleware('auth');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware('auth');
    Route::get('/my-jobs', [JobController::class, 'myJobs'])->middleware('auth')->name('jobs.my-jobs');

    Route::get('/search', SearchController::class);
    Route::get('/tags/{tag:name}', TagController::class);
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create']);
        Route::post('/register', [RegisteredUserController::class, 'store']);
        Route::get('/login', [SessionController::class, 'create']);
        Route::post('/login', [SessionController::class, 'store']);
    });
    Route::get('/profile/edit', [UserController::class, 'edit'])->middleware('auth');
    Route::patch('/profile', [UserController::class, 'update'])->middleware('auth');
    Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
