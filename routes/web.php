<?php

use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Users\UsersDashboardController;
use App\Http\Controllers\Users\UsersAttendanceController;


Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin', 'middleware'=>['auth','is_super_admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');
    Route::post('/clock-in', [AttendanceController::class, 'clockIn'])->name('admin_clock.in');
    Route::post('/clock-out', [AttendanceController::class, 'clockOut'])->name('admin_clock.out');
    Route::get('/users/index', [AdminController::class, 'index']);
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin_profile');
});   


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UsersDashboardController::class, 'index'])->name('user_dashboard');
    Route::post('/clock-in', [UsersAttendanceController::class, 'clockIn'])->name('user_clock.in');
    Route::post('/clock-out', [UsersAttendanceController::class, 'clockOut'])->name('user_clock.out');


    Route::get('/clients', [ClientController::class, 'index'])->name('clients_index');
    Route::get('clients/create', [ClientController::class, 'create'])->name('clients_create');
    Route::post('clients', [ClientController::class, 'store'])->name('client_store');
    Route::get('clients/{client}/edit', [ClientController::class, 'edit'])->name('client_edit');
    Route::put('clients/{client}', [ClientController::class, 'update'])->name('client_update');
    Route::delete('clients/{client}/delete', [ClientController::class, 'destroy'])->name('client_destroy');

    Route::get('/locations', [LocationController::class, 'index'])->name('locations_index');
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations_create');
    Route::post('/locations', [LocationController::class,'store'])->name('locations_store');
    Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations_edit');
    Route::put('/locations/{location}/update', [LocationController::class, 'update'])->name('locations_update');
    Route::delete('/locations/{location}/delete', [LocationController::class, 'destroy'])->name('locations_destroy');
    
    Route::get('/companies', [CompanyController::class,'index'])->name('companies_index');
    Route::get('companies/create', [CompanyController::class, 'create'])->name('companies_create');
    Route::post('companies', [CompanyController::class, 'store'])->name('company_store');
    Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])->name('company_edit');
    Route::put('companies/{company}', [CompanyController::class, 'update'])->name('company_update');
    Route::delete('companies/{company}/delete', [CompanyController::class, 'destroy'])->name('company_destroy');

    Route::get('/employees', [EmployeeController::class,'index'])->name('employees_index');

    Route::get('/projects', [ProjectController::class,'index'])->name('projects_index');
    Route::get('projects/{project:slug}/detail', [ProjectController::class, 'detail'])->name('project_detail');
    Route::put('/projects/{project:slug}/files', [ProjectController::class, 'updateFiles'])->name('project_update_files');
    
    Route::get('/teams', [TeamController::class,'index'])->name('teams_index');
    
    // Afișează toate cererile de concediu ale utilizatorului curent
    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves_index');
    // Afișează formularul de creare a unei noi cereri de concediu
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves_create');
    // Trimite cererea de concediu și o salvează în baza de date
    Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves_store');
    // Ștergere cerere de concediu
    Route::delete('/leaves/{leave}/delete', [LeaveController::class, 'destroy'])->name('leaves_delete');
    // Afișare formular de editare a cererii
    Route::get('/leaves/{leave}/edit', [LeaveController::class, 'edit'])->name('leaves_edit');
    // Actualizare cerere de concediu
    Route::put('/leaves/{leave}/update', [LeaveController::class, 'update'])->name('leaves_update');
    // Aprobare cerere de concediu de către substitute 
    Route::post('/leaves/{leave}/substituteApproved', [LeaveController::class, 'substituteApproved'])->name('leaves_substituteApproved');
    // Respingere cerere de concediu de către substitute 
    Route::post('/leaves/{leave}/substituteRejected', [LeaveController::class, 'substituteRejected'])->name('leaves_substituteRejected');
    // Aprobare cerere de concediu de către manager 
    Route::post('/leaves/{leave:name}/managerApproved', [LeaveController::class, 'managerApproved'])->name('leaves_managerApproved');
        // Respingere cerere de concediu de către manager 
    Route::post('/leaves/{leave}/managerRejected', [LeaveController::class, 'managerRejected'])->name('leaves_managerRejected');

    Route::get('/contacts', [ChatController::class, 'getContacts'])->name('getContacts');

    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat');
    Route::get('/messages/{user}', [ChatController::class, 'getMessages']);
    Route::post('/messages/{user}', [ChatController::class, 'sendMessage']);
    Route::post('/messages/{messageId}/mark-delivered', [ChatController::class, 'markAsDelivered']);
    Route::post('/messages/{messageId}/mark-read', [ChatController::class, 'markAsRead']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile_edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mail/inbox', function () {
    return view('mailbox.inbox');
    });
    Route::get('/mail/compose', function () {
        return view('mailbox.compose');
    });
    Route::get('/mail/read-mail', function () {
        return view('mailbox.read-mail');
    });

    Route::get('/api/companies/{company}/projects', function ($companyId) {
        return \App\Models\Project::where('company_id', $companyId)->pluck('name', 'id');
    });

    Route::get('/api/companies/{company}/employees', function ($companyId) {
        return \App\Models\Employee::where('company_id', $companyId)->pluck('employee_name', 'id');
    });

    Route::get('/users', [UserController::class, 'getContacts']);
    Route::get('/users/index', [UserController::class, 'index']);

});

require __DIR__.'/auth.php';
