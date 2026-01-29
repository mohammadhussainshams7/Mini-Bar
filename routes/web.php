<?php

use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Admin\AddRoom;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\ItemExpiredColtroller;
use App\Http\Controllers\Admin\StandarInRoomMinibarsController;
use App\Http\Controllers\Admin\AddTheValidityOfTheItemsInTheRoomController;

Route::get('admin/login', function () {
    return redirect()->route("login");
})->name('admin.login');


Route::get('/', function () {
    return redirect()->route("user.addTheValidityOfTheItemsInTheRoom.index");
})->name('/');



/*
Route::get('/', function () {
    return view('welcome');
})->name('home');
*/
Route::middleware(['SetLocale'])->group(function () {


            Route::prefix("user")->name("user.")->group(function () {
                Route::prefix('addTheValidityOfTheItemsInTheRoom')->name("addTheValidityOfTheItemsInTheRoom.")->group(function () {
                Route::get('create', [AddTheValidityOfTheItemsInTheRoomController::class, 'create'])->name("create");
                Route::get('/', [AddTheValidityOfTheItemsInTheRoomController::class, 'index'])->name("index");
                Route::post('store', [AddTheValidityOfTheItemsInTheRoomController::class, 'store'])->name("store");
                Route::get('edit/{id}', [AddTheValidityOfTheItemsInTheRoomController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [AddTheValidityOfTheItemsInTheRoomController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [AddTheValidityOfTheItemsInTheRoomController::class, 'destroy'])->name('destroy');
                Route::get('changeditems', [AddTheValidityOfTheItemsInTheRoomController::class, 'changeditems'])->name("changeditems");

                });
            });

            Route::post('/locale', LocaleController::class)
            ->name('locale.change');





Route::middleware(['auth'])->group(function () {
   Route::prefix('admin')->name("admin.")->group(function () {
                Route::prefix('room')->name("room.")->group(function () {
                    Route::get('create', [AddRoom::class, 'create'])->name("create");
                    Route::get('/', [AddRoom::class, 'index'])->name("index");
                    Route::post('store', [AddRoom::class, 'store'])->name("store");
                    Route::get('edit/{id}', [AddRoom::class, 'edit'])->name('edit');
                    Route::put('update/{id}', [AddRoom::class, 'update'])->name('update');
                    Route::delete('destroy/{id}', [AddRoom::class, 'destroy'])->name('destroy');
                });




            Route::prefix('item')->name("item.")->group(function () {
                Route::get('create', [ItemsController::class, 'create'])->name("create");
                Route::get('/', [ItemsController::class, 'index'])->name("index");
                Route::post('store', [ItemsController::class, 'store'])->name("store");
                Route::get('edit/{id}', [ItemsController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [ItemsController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [ItemsController::class, 'destroy'])->name('destroy');
                });

            Route::prefix('itemexpired')->name("itemexpired.")->group(function () {
                Route::get('create', [ItemExpiredColtroller::class, 'create'])->name("create");
                Route::get('/', [ItemExpiredColtroller::class, 'index'])->name("index");
                Route::post('store', [ItemExpiredColtroller::class, 'store'])->name("store");
                Route::get('edit/{id}', [ItemExpiredColtroller::class, 'edit'])->name('edit');
                Route::put('update/{id}', [ItemExpiredColtroller::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [ItemExpiredColtroller::class, 'destroy'])->name('destroy');

            });

            Route::prefix('standarInRoomMinibars')->name("standarInRoomMinibars.")->group(function () {
                Route::get('create', [StandarInRoomMinibarsController::class, 'create'])->name("create");
                Route::get('/', [StandarInRoomMinibarsController::class, 'index'])->name("index");
                Route::post('store', [StandarInRoomMinibarsController::class, 'store'])->name("store");
                Route::delete('destroy/{id}', [StandarInRoomMinibarsController::class, 'destroy'])->name('destroy');

            });



            });
});

});









Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
    