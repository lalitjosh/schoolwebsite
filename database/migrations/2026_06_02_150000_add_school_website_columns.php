<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (! Schema::hasColumn('settings', 'school_name')) {
                $table->string('school_name')->default('Bright Future Academy');
            }
            if (! Schema::hasColumn('settings', 'logo')) {
                $table->string('logo')->nullable();
            }
            if (! Schema::hasColumn('settings', 'favicon')) {
                $table->string('favicon')->nullable();
            }
            if (! Schema::hasColumn('settings', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (! Schema::hasColumn('settings', 'email')) {
                $table->string('email')->nullable();
            }
            if (! Schema::hasColumn('settings', 'address')) {
                $table->text('address')->nullable();
            }
            if (! Schema::hasColumn('settings', 'facebook')) {
                $table->string('facebook')->nullable();
            }
            if (! Schema::hasColumn('settings', 'instagram')) {
                $table->string('instagram')->nullable();
            }
            if (! Schema::hasColumn('settings', 'youtube')) {
                $table->string('youtube')->nullable();
            }
        });

        Schema::table('hero_sliders', function (Blueprint $table) {
            if (! Schema::hasColumn('hero_sliders', 'title')) {
                $table->string('title');
            }
            if (! Schema::hasColumn('hero_sliders', 'subtitle')) {
                $table->string('subtitle')->nullable();
            }
            if (! Schema::hasColumn('hero_sliders', 'image')) {
                $table->string('image');
            }
            if (! Schema::hasColumn('hero_sliders', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
            if (! Schema::hasColumn('hero_sliders', 'status')) {
                $table->boolean('status')->default(true);
            }
        });

        Schema::table('news', function (Blueprint $table) {
            if (! Schema::hasColumn('news', 'title')) {
                $table->string('title');
            }
            if (! Schema::hasColumn('news', 'slug')) {
                $table->string('slug')->unique();
            }
            if (! Schema::hasColumn('news', 'featured_image')) {
                $table->string('featured_image')->nullable();
            }
            if (! Schema::hasColumn('news', 'content')) {
                $table->longText('content');
            }
            if (! Schema::hasColumn('news', 'featured')) {
                $table->boolean('featured')->default(false);
            }
        });

        Schema::table('events', function (Blueprint $table) {
            if (! Schema::hasColumn('events', 'title')) {
                $table->string('title');
            }
            if (! Schema::hasColumn('events', 'description')) {
                $table->text('description')->nullable();
            }
            if (! Schema::hasColumn('events', 'event_date')) {
                $table->date('event_date')->nullable();
            }
            if (! Schema::hasColumn('events', 'location')) {
                $table->string('location')->nullable();
            }
            if (! Schema::hasColumn('events', 'image')) {
                $table->string('image')->nullable();
            }
        });

        Schema::table('galleries', function (Blueprint $table) {
            if (! Schema::hasColumn('galleries', 'title')) {
                $table->string('title');
            }
            if (! Schema::hasColumn('galleries', 'cover_image')) {
                $table->string('cover_image')->nullable();
            }
            if (! Schema::hasColumn('galleries', 'description')) {
                $table->text('description')->nullable();
            }
        });

        Schema::table('gallery_images', function (Blueprint $table) {
            if (! Schema::hasColumn('gallery_images', 'gallery_id')) {
                $table->foreignId('gallery_id')->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('gallery_images', 'image')) {
                $table->string('image');
            }
            if (! Schema::hasColumn('gallery_images', 'caption')) {
                $table->string('caption')->nullable();
            }
        });

        Schema::table('faculties', function (Blueprint $table) {
            if (! Schema::hasColumn('faculties', 'name')) {
                $table->string('name');
            }
            if (! Schema::hasColumn('faculties', 'photo')) {
                $table->string('photo')->nullable();
            }
            if (! Schema::hasColumn('faculties', 'designation')) {
                $table->string('designation');
            }
            if (! Schema::hasColumn('faculties', 'qualification')) {
                $table->string('qualification');
            }
            if (! Schema::hasColumn('faculties', 'department')) {
                $table->string('department');
            }
        });

        Schema::table('downloads', function (Blueprint $table) {
            if (! Schema::hasColumn('downloads', 'title')) {
                $table->string('title');
            }
            if (! Schema::hasColumn('downloads', 'file')) {
                $table->string('file');
            }
        });

        Schema::table('notices', function (Blueprint $table) {
            if (! Schema::hasColumn('notices', 'title')) {
                $table->string('title');
            }
            if (! Schema::hasColumn('notices', 'content')) {
                $table->text('content');
            }
            if (! Schema::hasColumn('notices', 'publish_date')) {
                $table->date('publish_date');
            }
        });

        Schema::table('testimonials', function (Blueprint $table) {
            if (! Schema::hasColumn('testimonials', 'name')) {
                $table->string('name');
            }
            if (! Schema::hasColumn('testimonials', 'photo')) {
                $table->string('photo')->nullable();
            }
            if (! Schema::hasColumn('testimonials', 'designation')) {
                $table->string('designation');
            }
            if (! Schema::hasColumn('testimonials', 'message')) {
                $table->text('message');
            }
        });

        Schema::table('subscribers', function (Blueprint $table) {
            if (! Schema::hasColumn('subscribers', 'email')) {
                $table->string('email')->unique();
            }
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            if (! Schema::hasColumn('contact_messages', 'name')) {
                $table->string('name');
            }
            if (! Schema::hasColumn('contact_messages', 'email')) {
                $table->string('email');
            }
            if (! Schema::hasColumn('contact_messages', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (! Schema::hasColumn('contact_messages', 'subject')) {
                $table->string('subject');
            }
            if (! Schema::hasColumn('contact_messages', 'message')) {
                $table->longText('message');
            }
        });

        Schema::table('admission_inquiries', function (Blueprint $table) {
            if (! Schema::hasColumn('admission_inquiries', 'student_name')) {
                $table->string('student_name');
            }
            if (! Schema::hasColumn('admission_inquiries', 'dob')) {
                $table->date('dob');
            }
            if (! Schema::hasColumn('admission_inquiries', 'gender')) {
                $table->string('gender');
            }
            if (! Schema::hasColumn('admission_inquiries', 'parent_name')) {
                $table->string('parent_name');
            }
            if (! Schema::hasColumn('admission_inquiries', 'phone')) {
                $table->string('phone');
            }
            if (! Schema::hasColumn('admission_inquiries', 'email')) {
                $table->string('email')->nullable();
            }
            if (! Schema::hasColumn('admission_inquiries', 'grade')) {
                $table->string('grade');
            }
            if (! Schema::hasColumn('admission_inquiries', 'previous_school')) {
                $table->string('previous_school')->nullable();
            }
            if (! Schema::hasColumn('admission_inquiries', 'message')) {
                $table->longText('message')->nullable();
            }
        });
    }

    public function down(): void
    {
        //
    }
};
