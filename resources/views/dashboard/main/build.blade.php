Route::get('admin/main', [App\Http\Controllers\Admin\mainController::class, 'index'])->name('main');
Route::get('admin/main/trash', [App\Http\Controllers\Admin\mainController::class, 'trash'])->name('trash-main');
Route::get('admin/main/restore/{id}', [App\Http\Controllers\Admin\mainController::class, 'restore'])->name('trash-restore-main');
Route::get('admin/main/force/{id}', [App\Http\Controllers\Admin\mainController::class, 'force'])->name('trash-force-main');
Route::get('admin/main/create', [App\Http\Controllers\Admin\mainController::class, 'create'])->name('add-main');
Route::post('admin/main/create/success', [App\Http\Controllers\Admin\mainController::class, 'store'])->name('store-main');
Route::get('admin/main/edit/{id}', [App\Http\Controllers\Admin\mainController::class, 'edit'])->name('edit-main');
Route::resource('/main-update', \App\Http\Controllers\Admin\mainController::class);
Route::delete('admin/main/deleted{id}', [App\Http\Controllers\Admin\mainController::class, 'destroy'])->name('destroy-main');
Route::get('admin/main/show{id}', [App\Http\Controllers\Admin\mainController::class, 'show'])->name('show-main');
Route::post('admin/main/image', [App\Http\Controllers\Admin\mainController::class, 'storeImage'])->name('storeImages-main');