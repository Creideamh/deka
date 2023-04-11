<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\beneficiaryController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\debitController;
use App\Http\Controllers\declarationController;
use App\Http\Controllers\EternityController;
use App\Http\Controllers\medicalController;
use App\Http\Controllers\officeController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\planController;
use App\Http\Controllers\premiumPaymentController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/deka-insurance', function () {
    return view('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/user-profile', [UserController::class, 'userProfile'])->name('user.profile');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/changePassword', [AuthController::class, 'changePassword'])->name('auth.change.password');

/**
 * User Routes
 */
Route::get('/users', [UserController::class, 'index'])->name('users.lists');
Route::get('/users/create-user', [UserController::class, 'create'])->name('create.user');
Route::get('users/edit-user/{id}', [UserController::class, 'show'])->name('edit.user');

/** FORM FUNCTIONS */
Route::get('/user-lists', [UserController::class, 'getAllUsers'])->name('get.users');
Route::post('/store-user', [UserController::class, 'store'])->name('store.user');
Route::post('/delete-user', [UserController::class, 'destroy'])->name('delete.user');
Route::post('/update-user', [UserController::class, 'update'])->name('update.user');


/** ROLES */
// GET ROUTES
Route::get('/roles', [RolesController::class, 'index'])->name('roles.lists');
Route::get('/roles/create-role', [RolesController::class, 'create'])->name('create.role');
// POST ROUTES 
Route::get('/roles-lists', [RolesController::class, 'allRoles'])->name('all.roles');
Route::post('/store-role', [RolesController::class, 'store'])->name('create.role');
Route::post('/update-role', [RolesController::class, 'update'])->name('update.role');
Route::post('/get-role-details', [RolesController::class, 'getRoleDetails'])->name('role.details');
Route::post('/delete-role', [RolesController::class, 'destroy'])->name('delete.role');



Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.lists');
// PERMISSION POST ROUTES 
Route::get('/permissions-lists', [PermissionsController::class, 'allPermissions'])->name('all.permissions');
Route::post('/store-permission', [PermissionsController::class, 'store'])->name('create.permission');
Route::post('/update-permission', [PermissionsController::class, 'update'])->name('update.permission');
Route::post('/get-permission-details', [PermissionsController::class, 'getPermissionDetails'])->name('permission.details');
Route::post('/delete-permission', [PermissionsController::class, 'destroy'])->name('delete.permission');

/**
 * Eternity Module Routes   
 * 
 */
Route::get('/eternity-plus', [EternityController::class, 'index'])->name('eternity.lists');
Route::get('/all-eternity-applications', [EternityController::class, 'allEternityApplications'])->name('all.eternity.applications');
Route::get('/eternity-plus/create-policy', [EternityController::class, 'create'])->name('create.plus');
Route::get('/eternity-plus/edit-policy/{id}', [EternityController::class, 'edit'])->name('edit.plus');
Route::post('/eternity-plus/delete-policy', [EternityController::class, 'destroy'])->name('delete.plus');
Route::post('/standard-premium', [EternityController::class, 'getStandardBenefitValue'])->name('eternity.standard.benefit');
Route::post('/optional-premium', [EternityController::class, 'getOptionalBenefitValue'])->name('eternity.optional.benefit');
Route::post('/delete-health', [EternityController::class, 'deleteHealth'])->name('eternity.delete.health');
Route::post('/delete-family-member', [EternityController::class, 'deleteMember'])->name('eternity.delete.family.member');
Route::post('/delete-beneficiary', [EternityController::class, 'deleteBeneficiary'])->name('eternity.delete.beneficiary');
Route::post('/store', [EternityController::class, 'store'])->name('store-fep-data');
Route::post('/update', [EternityController::class, 'update'])->name('edit-fep-data');


/**
 * Plan Details Routes
 */
Route::get('/plan-details/edit/{id}', [planController::class, 'edit'])->name('edit.plan-details');
Route::post('/plan-details/add/', [planController::class, 'create_Plan_Details'])->name('add.family.member');
Route::post('/plan-detail', [planController::class, 'get_Plan_Detail'])->name('get.plan.detail');
Route::get('plan-details-lists/{id}', [planController::class, 'getMembers'])->name('get.plan.details.lists');
Route::post('plan-details/update', [planController::class, 'updateMembers'])->name('update.plan');


/**
 * Customers Routes 
 */
Route::get('/customers', [customerController::class, 'index'])->name('customers.lists');
Route::get('/all-customers', [customerController::class, 'getCustomers'])->name('customers.get');
Route::get('/customer/edit/{id}', [customerController::class, 'edit'])->name('customers.edit');

Route::get('/all-members', [customerController::class, 'getMembers'])->name('members.get');
Route::get('/customer/plan-details/{id}', [customerController::class, 'planDetails'])->name('plan-details');
Route::post('/create-customer', [customerController::class, 'store'])->name('customer.create');
Route::post('/customer/edit-customer/{id}', [customerController::class, 'update'])->name('edit.customer');


/** Medical Routes */
Route::get('/medicals/edit/{id}', [medicalController::class, 'index'])->name('medicals.edit');
Route::post('/update/medical/{id}', [medicalController::class, 'updateMedics'])->name('update.medical');
Route::get('/all-health-info/{id}', [medicalController::class, 'allHealthInfo'])->name('all.health.info');
Route::post('/add-health-info', [medicalController::class, 'store'])->name('add.health.info');
Route::post('/health-info', [medicalController::class, 'healthInfo'])->name('get.health.info');
Route::post('/edit-health-info', [medicalController::class, 'update'])->name('edit.health.info');
Route::post('/delete-health-info', [medicalController::class, 'deleteMember'])->name('delete.health.info');


/**
 * Beneficiary Routes
 */
Route::get('/beneficiaries/edit/{id}', [beneficiaryController::class, 'index'])->name('beneficiaries.index');
Route::get('/all-beneficiaries/{id}', [beneficiaryController::class, 'allBeneficiaries'])->name('get.beneficiaries.lists');
Route::post('/delete-beneficiary', [beneficiaryController::class, 'deleteBeneficiary'])->name('delete.beneficiary');
Route::post('/add-beneficiary', [beneficiaryController::class, 'store'])->name('add.beneficiary');
Route::post('/edit-beneficiary-info', [beneficiaryController::class, 'update'])->name('edit.beneficiary.info');
Route::post('/beneficiary-detail', [beneficiaryController::class, 'getBeneficiaryDetail'])->name('get.beneficiary.detail');


/**
 * Declarations
 */
Route::get('/declarations/edit/{id}', [declarationController::class, 'index'])->name('get.declaration');
Route::post('/sign-declaration', [declarationController::class, 'update'])->name('declarant.signature');
Route::post('/appliation/details', [declarationController::class, 'getApplicationDetails'])->name('get.application.details');


/**
 * Office Only routes
 */
Route::get('/office_only/edit/{id}', [officeController::class, 'index'])->name('get.office');
Route::post('/sign-office', [officeController::class, 'update'])->name('office.signature');
Route::post('/office_only/details', [officeController::class, 'getApplicationDetails'])->name('get.application.details');



/** Premium Payments */
Route::get('/premium-payment/edit/{id}', [premiumPaymentController::class, 'index'])->name('get.premium-payments');
Route::post('/premium-payment', [premiumPaymentController::class, 'getPremiumPayment'])->name('get.premium.payment');
Route::post('/premium-details/edit', [premiumPaymentController::class, 'update'])->name('edit.premium.details');

/** Debits Routes */
Route::get('/debits/edit/{id}', [debitController::class, 'index'])->name('edit.debits');
Route::post('/debits', [debitController::class, 'getDebitDetails'])->name('get.debit.details');
Route::post('/debits/edit', [debitController::class, 'update'])->name('edit.debit.details');

// Preview policy 
Route::get('/preview/policy/{id}', [EternityController::class, 'show'])->name('preview.policy');
Route::get('/export-to-pdf/{id}', [EternityController::class, 'generate'])->name('export.pdf');
Route::get('edit-policy/{id}/{id2}', [EternityController::class, 'edit'])->name('edit.policy');
