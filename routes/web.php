<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AdmissionInquiryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TestimonialController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/academics', [HomeController::class, 'academics'])->name('academics');
Route::get('/academics/elementary', [HomeController::class, 'academicsElementary'])->name('academics.elementary');
Route::get('/academics/primary', [HomeController::class, 'academicsPrimary'])->name('academics.primary');
Route::get('/academics/secondary', [HomeController::class, 'academicsSecondary'])->name('academics.secondary');
Route::get('/admission', [HomeController::class, 'admission'])->name('admission');
Route::get('/admissions', [HomeController::class, 'admission'])->name('admissions');
Route::redirect('/news', '/notice-event');
Route::get('/notice-event', [HomeController::class, 'news'])->name('news');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/faculty', [HomeController::class, 'faculty'])->name('faculty');
Route::get('/Frontend/faculty', [HomeController::class, 'faculty'])->name('frontend.faculty');
Route::get('/result', [HomeController::class, 'result'])->name('result');
Route::get('/contact', [HomeController::class, 'contactPage'])->name('contact');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');
Route::post('/admission-inquiry', [HomeController::class, 'admissionInquiry'])->name('admission.store');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe.store');

Auth::routes();

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard',
            [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('page-contents', PageContentController::class)->except(['show', 'create']);
        Route::resource('hero-sliders', HeroSliderController::class)->except(['show', 'create']);
        Route::resource('news', NewsController::class)->except(['show', 'create']);
        Route::resource('events', EventController::class)->except(['show', 'create']);
        Route::resource('notices', NoticeController::class)->except(['show', 'create']);
        Route::resource('results', ResultController::class)->except(['show', 'create']);
        Route::resource('faculties', FacultyController::class)->except(['show', 'create']);
        Route::resource('galleries', GalleryController::class)->except(['show', 'create']);
        Route::resource('testimonials', TestimonialController::class)->except(['show', 'create']);
        Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'destroy']);
        Route::resource('admission-inquiries', AdmissionInquiryController::class)->only(['index', 'destroy']);
        Route::resource('subscribers', SubscriberController::class)->only(['index', 'destroy']);

    });
