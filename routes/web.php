<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\{HomeController, ServiceController as FrontServiceController, PortfolioController as FrontPortfolioController, ContactController as FrontContactController, OrderController as FrontOrderController};
use App\Http\Controllers\Admin\{DashboardController, PortfolioController, ServiceController, SkillController, EducationController, ExperienceController, CertificationController, TestimonialController, ContactController as AdminContactController, OrderController as AdminOrderController, SettingController, VisitorController};

Route::post('login', [LoginController::class, 'login'])->middleware('throttle:login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('throttle:5,1')->name('login.post');

// FRONTEND ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [FrontServiceController::class, 'index'])->name('frontend.services');
Route::get('/services/{slug}', [FrontServiceController::class, 'show'])->name('frontend.services.show');
Route::get('/portfolio', [FrontPortfolioController::class, 'index'])->name('frontend.portfolio');
Route::get('/portfolio/{slug}', [FrontPortfolioController::class, 'show'])->name('frontend.portfolio.show');
Route::get('/contact', [FrontContactController::class, 'index'])->name('frontend.contact');
Route::post('/contact', [FrontContactController::class, 'store'])->name('frontend.contact.store');
Route::get('/order/{serviceSlug}', [FrontOrderController::class, 'create'])->name('frontend.order.create');
Route::post('/order', [FrontOrderController::class, 'store'])->name('frontend.order.store');
Route::get('/order/success/{orderNumber}', [FrontOrderController::class, 'success'])->name('order.success');

// ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('portfolio', PortfolioController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('skill', SkillController::class);
    Route::resource('education', EducationController::class);
    Route::resource('experience', ExperienceController::class);
    Route::resource('certification', CertificationController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('contact', AdminContactController::class)->only(['index','show','destroy']);
    Route::post('contact/{contact}/reply', [AdminContactController::class, 'reply'])->name('contact.reply');
    Route::resource('order', AdminOrderController::class)->only(['index','show','destroy']);
    Route::put('order/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('order.status');
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
Route::get('change-password', [\App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('change-password');
Route::post('change-password', [\App\Http\Controllers\Admin\UserController::class, 'updatePassword'])->name('change-password.update');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('visitors', [VisitorController::class, 'index'])->name('visitors');
});

Auth::routes(['register' => false]);