<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\estudiante_grupoController;


Route::group(['prefix' => 'estudiantes_grupo','middleware' => 'auth_docentes'], function () {
    Route::get('/', [estudiante_grupoController::class, 'index'])->name('estudiantes_grupo.index');
    Route::get('/show/{id}', [estudiante_grupoController::class, 'show'])->name('estudiantes_grupo.show');
    Route::get('/create', [estudiante_grupoController::class, 'create'])->name('estudiantes_grupo.create');
    Route::post('/create', [estudiante_grupoController::class, 'store'])->name('estudiantes_grupo.store');
    Route::get('/edit/{id}', [estudiante_grupoController::class, 'edit'])->name('estudiantes_grupo.edit');
    Route::post('/edi/{id}', [estudiante_grupoController::class, 'update'])->name('estudiantes_grupo.update');
    Route::get('/delete/{id}', [estudiante_grupoController::class, 'delete'])->name('estudiantes_grupo.delete');
    Route::post('/delete/{id}', [estudiante_grupoController::class, 'destroy'])->name('estudiantes_grupo.destroy');
});
