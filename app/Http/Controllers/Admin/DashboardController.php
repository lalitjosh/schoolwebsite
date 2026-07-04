<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Event;
use App\Models\Faculty;
use App\Models\Gallery;
use App\Models\AdmissionInquiry;
use App\Models\ContactMessage;
use App\Models\Notice;
use App\Models\Result;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'newsCount' => News::count(),
            'eventCount' => Event::count(),
            'facultyCount' => Faculty::count(),
            'galleryCount' => Gallery::count(),
            'noticeCount' => Notice::count(),
            'resultCount' => Result::count(),
            'testimonialCount' => Testimonial::count(),
            'contactCount' => ContactMessage::count(),
            'admissionCount' => AdmissionInquiry::count(),
        ]);
    }
}
