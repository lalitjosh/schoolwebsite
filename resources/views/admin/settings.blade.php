@extends('adminlte::page')

@section('title', 'Website Settings')

@section('content_header')
    <h1>Website Settings</h1>
@endsection

@section('content')
@include('admin.partials.alerts')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header"><strong>School Identity</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>School name</label>
                    <input name="school_name" class="form-control @error('school_name') is-invalid @enderror" value="{{ old('school_name', $setting->school_name) }}" required>
                    @error('school_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-3 form-group">
                    <label>Tagline</label>
                    <input name="tagline" class="form-control @error('tagline') is-invalid @enderror" value="{{ old('tagline', $setting->tagline) }}">
                    @error('tagline')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-3 form-group">
                    <label>Established year</label>
                    <input name="established_year" class="form-control @error('established_year') is-invalid @enderror" value="{{ old('established_year', $setting->established_year) }}">
                    @error('established_year')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><strong>Contact Number & Email</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Contact number</label>
                    <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $setting->phone) }}" placeholder="9801181818">
                    @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    <small class="text-muted">Shown on the contact page and website footer.</small>
                </div>

                <div class="col-md-6 form-group">
                    <label>Email ID</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $setting->email) }}" placeholder="admin@cambridgeps.edu.np">
                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    <small class="text-muted">Shown on the contact page and website footer.</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="small text-muted">Current call link</div>
                    <a href="tel:{{ $setting->phone }}" class="font-weight-bold">{{ $setting->phone ?: 'Not set' }}</a>
                </div>
                <div class="col-md-6">
                    <div class="small text-muted">Current email link</div>
                    <a href="mailto:{{ $setting->email }}" class="font-weight-bold">{{ $setting->email ?: 'Not set' }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><strong>Location, Media & Footer</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Address</label>
                    <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $setting->address) }}</textarea>
                    @error('address')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-8 form-group">
                    <label>Google map embed URL</label>
                    <input name="map_embed_url" type="url" class="form-control @error('map_embed_url') is-invalid @enderror" value="{{ old('map_embed_url', $setting->map_embed_url) }}" placeholder="https://maps.google.com/maps?...&output=embed">
                    @error('map_embed_url')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    <small class="text-muted">Use the embed URL used inside the map iframe.</small>
                </div>

                <div class="col-md-4 form-group">
                    <label>Google map external URL</label>
                    <input name="map_external_url" type="url" class="form-control @error('map_external_url') is-invalid @enderror" value="{{ old('map_external_url', $setting->map_external_url) }}" placeholder="https://maps.app.goo.gl/...">
                    @error('map_external_url')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>Logo</label>
                    <input name="logo" type="file" accept="image/*" class="form-control @error('logo') is-invalid @enderror">
                    @error('logo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    @if ($setting->logo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Current logo" style="height: 70px; max-width: 180px; object-fit: contain;">
                            <small class="d-block text-muted">{{ $setting->logo }}</small>
                        </div>
                    @endif
                </div>

                <div class="col-md-6 form-group">
                    <label>Favicon</label>
                    <input name="favicon" type="file" accept="image/*,.ico" class="form-control @error('favicon') is-invalid @enderror">
                    @error('favicon')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    @if ($setting->favicon)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $setting->favicon) }}" alt="Current favicon" style="height: 40px; max-width: 80px; object-fit: contain;">
                            <small class="d-block text-muted">{{ $setting->favicon }}</small>
                        </div>
                    @endif
                </div>

                <div class="col-md-4 form-group">
                    <label>Facebook URL</label>
                    <input name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $setting->facebook) }}">
                    @error('facebook')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>Instagram URL</label>
                    <input name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $setting->instagram) }}">
                    @error('instagram')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>YouTube URL</label>
                    <input name="youtube" class="form-control @error('youtube') is-invalid @enderror" value="{{ old('youtube', $setting->youtube) }}">
                    @error('youtube')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-8 form-group">
                    <label>Footer about text</label>
                    <textarea name="footer_about" rows="3" class="form-control @error('footer_about') is-invalid @enderror">{{ old('footer_about', $setting->footer_about) }}</textarea>
                    @error('footer_about')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>Footer credit</label>
                    <input name="footer_credit" class="form-control @error('footer_credit') is-invalid @enderror" value="{{ old('footer_credit', $setting->footer_credit) }}">
                    @error('footer_credit')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Save Settings</button>
        </div>
    </div>
</form>
@endsection
