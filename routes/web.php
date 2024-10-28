<?php

use App\Events\MessageSent;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Users\UsersAttendanceController;
use App\Http\Controllers\Users\UsersDashboardController;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


Route::group(['role:Employee||Manager', 'middleware'=>['auth']], function () {
    Route::get('/dashboard', [UsersDashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/clock-in', [UsersAttendanceController::class, 'clockIn'])->name('user.clock.in');
    Route::post('/clock-out', [UsersAttendanceController::class, 'clockOut'])->name('user.clock.out');
});

Route::group(['prefix'=>'admin', 'middleware'=>['auth','is_super_admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/clock-in', [AttendanceController::class, 'clockIn'])->name('admin.clock.in');
    Route::post('/clock-out', [AttendanceController::class, 'clockOut'])->name('admin.clock.out');
    Route::get('/users/index', [AdminController::class, 'index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    // Afișează toate cererile de concediu ale utilizatorului curent
    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');

    // Afișează formularul de creare a unei noi cereri de concediu
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');

    // Trimite cererea de concediu și o salvează în baza de date
    Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');

    // Ștergere cerere de concediu
    Route::delete('/leaves/{leave}/delete', [LeaveController::class, 'destroy'])->name('leaves.delete');
    
    // Afișare formular de editare a cererii
    Route::get('/leaves/{leave}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
    
    // Actualizare cerere de concediu
    Route::put('/leaves/{leave}/update', [LeaveController::class, 'update'])->name('leaves.update');
    
    // Aprobare cerere de concediu de către substitute 
    Route::post('/leaves/{leave}/substituteApproved', [LeaveController::class, 'substituteApproved'])->name('leaves.substituteApproved');
    
    // Respingere cerere de concediu de către substitute 
    Route::post('/leaves/{leave}/substituteRejected', [LeaveController::class, 'substituteRejected'])->name('leaves.substituteRejected');
    
    // Aprobare cerere de concediu de către manager 
    Route::post('/leaves/{leave:name}/managerApproved', [LeaveController::class, 'managerApproved'])->name('leaves.managerApproved');

        // Respingere cerere de concediu de către manager 
    Route::post('/leaves/{leave}/managerRejected', [LeaveController::class, 'managerRejected'])->name('leaves.managerRejected');
    

    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat');
    Route::get('/messages/{user}', [ChatController::class, 'getMessages']);
    Route::post('/messages/{user}', [ChatController::class, 'sendMessage']);
    Route::post('/messages/{messageId}/mark-delivered', [ChatController::class, 'markAsDelivered']);
    Route::post('/messages/{messageId}/mark-read', [ChatController::class, 'markAsRead']);

    Route::get('/users', [UserController::class, 'getContacts']);
    Route::get('/users/index', [UserController::class, 'index']);

});

require __DIR__.'/auth.php';
