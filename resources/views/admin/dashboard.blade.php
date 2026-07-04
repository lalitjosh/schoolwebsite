@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">

    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $newsCount }}</h3>
                <p>News</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $eventCount }}</h3>
                <p>Events</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $facultyCount }}</h3>
                <p>Faculty</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $admissionCount }}</h3>
                <p>Admission Inquiries</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $resultCount }}</h3>
                <p>Results</p>
            </div>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Manage Website Content</h3>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ([
                ['Hero Sliders', 'admin.hero-sliders.index'],
                ['Notice/Event', 'admin.news.index'],
                ['Events', 'admin.events.index'],
                ['Notices', 'admin.notices.index'],
                ['Results', 'admin.results.index'],
                ['Faculty', 'admin.faculties.index'],
                ['Galleries', 'admin.galleries.index'],
                ['Testimonials', 'admin.testimonials.index'],
                ['Contact Messages', 'admin.contact-messages.index'],
                ['Admission Inquiries', 'admin.admission-inquiries.index'],
                ['Website Settings', 'admin.settings.edit'],
                ['Page Sections', 'admin.page-contents.index'],
            ] as [$label, $route])
                <div class="col-md-3 mb-2">
                    <a href="{{ route($route) }}" class="btn btn-outline-primary btn-block">{{ $label }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
