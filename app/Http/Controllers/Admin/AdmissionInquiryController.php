<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionInquiry;

class AdmissionInquiryController extends Controller
{
    public function index()
    {
        return view('admin.admission-inquiries', [
            'items' => AdmissionInquiry::query()->latest()->paginate(15),
        ]);
    }

    public function destroy(AdmissionInquiry $admissionInquiry)
    {
        $admissionInquiry->delete();

        return redirect()->route('admin.admission-inquiries.index')->with('success', 'Inquiry deleted.');
    }
}
