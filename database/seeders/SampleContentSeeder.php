<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Gallery;
use App\Models\HeroSlider;
use App\Models\PageContent;
use Illuminate\Database\Seeder;

class SampleContentSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlider::updateOrCreate([
            'title' => 'Where Young Minds Flourish',
        ], [
            'subtitle' => 'Quality education from PG to Grade 12 with modern learning, values, and holistic student development.',
            'image' => 'hero/h28W4Fb0HccRX9XgUTKlVXAmDpOmjJU7P262AMJR.jpg',
            'sort_order' => 0,
            'status' => true,
        ]);

        Gallery::updateOrCreate([
            'cover_image' => 'gallery/ArWr3F4HPEA7wyJkfZMAN4gBlZ12A9ZYkmDp7PUg.jpg',
        ], [
            'title' => 'Cambridge School Life',
            'description' => 'Students taking part in school learning, sports, and co-curricular activities.',
        ]);

        Faculty::updateOrCreate([
            'name' => 'Mr. Bodh Raj Nepal',
        ], [
            'photo' => 'faculty/principal.svg',
            'designation' => 'Principal',
            'qualification' => 'M.Ed.',
            'department' => 'Administration',
        ]);

        $sections = [
            [
                'key' => 'home.hero',
                'page' => 'Home',
                'section' => 'Hero',
                'eyebrow' => 'Est. 2062 BS - Admissions Open',
                'title' => 'Where Young',
                'subtitle' => 'Cambridge Public School Amargadhi-5, Dadeldhura nurtures learners from PG to Grade 12 with strong academics, modern teaching, discipline, creativity, and values.',
                'button_label' => 'Apply Now',
                'button_url' => '/admissions',
                'items' => ['Minds Flourish', 'Leaders Emerge', 'Futures Begin', 'Dreams Take Root'],
            ],
            [
                'key' => 'home.about',
                'page' => 'Home',
                'section' => 'About',
                'eyebrow' => 'About Our School',
                'title' => 'Fostering excellence, inspiring futures.',
                'body' => 'Cambridge Public School blends academic discipline with creativity, care, communication, and practical learning so every child grows with confidence.',
                'button_label' => 'Learn More',
                'button_url' => '/about',
            ],
            [
                'key' => 'home.features',
                'page' => 'Home',
                'section' => 'Features',
                'eyebrow' => 'Why Choose Us',
                'title' => 'A complete environment for student growth.',
                'items' => ['Modern Learning|Smart teaching methods, practical activities, and student-centered classrooms.', 'Expert Faculty|Experienced teachers who guide every child with care and academic clarity.', 'Career Counseling|Structured guidance for stream selection, higher education, and future goals.', 'Safe Environment|Disciplined, caring, and secure campus culture for confident learning.'],
            ],
            [
                'key' => 'home.stats',
                'page' => 'Home',
                'section' => 'Stats',
                'items' => ['1000+|Students', '50+|Teachers', '17+|Years', '40+|Activities'],
            ],
            [
                'key' => 'home.cta',
                'page' => 'Home',
                'section' => 'CTA',
                'eyebrow' => 'Join Our Community',
                'title' => 'Give Your Child the Gift of Quality Education',
                'subtitle' => 'Admissions are now open for this academic year. Limited seats available, secure your child\'s future today.',
                'button_label' => 'Apply Now',
                'button_url' => '/admissions',
            ],
            [
                'key' => 'principal.message',
                'page' => 'Home',
                'section' => 'Principal Message',
                'eyebrow' => 'A Word From Our Leader',
                'title' => 'Message From the Principal',
                'body' => 'Our School is committed to fostering essential skills and helping students achieve their goals by identifying latent talents and stimulating innovative thinking.',
                'image' => 'faculty/principal.svg',
            ],
            [
                'key' => 'about.hero',
                'page' => 'About',
                'section' => 'Hero',
                'eyebrow' => 'About Us',
                'title' => 'A caring school community with high academic expectations.',
                'subtitle' => 'Cambridge Public School Amargadhi-5, Dadeldhura provides quality education from PG to Grade 12 with modern teaching, strong academics, and holistic student development.',
                'items' => ['Our Mission|To provide practical, joyful, and disciplined learning where every student is known, challenged, and supported.', 'Our Vision|To prepare thoughtful learners who lead with knowledge, kindness, responsibility, and confidence.', 'Our Values|Respect, curiosity, honesty, teamwork, service, and steady improvement guide school life.'],
            ],
            [
                'key' => 'admissions.hero',
                'page' => 'Admissions',
                'section' => 'Hero',
                'eyebrow' => 'Admissions',
                'title' => 'Apply for the new academic session.',
                'subtitle' => 'Submit the inquiry form and the school office will contact you with documents, entrance details, and seat availability.',
                'items' => ['Send inquiry details.', 'Visit school with required documents.', 'Complete assessment and parent interaction.', 'Confirm seat and start classes.'],
            ],
            [
                'key' => 'academics.overview',
                'page' => 'Academics',
                'section' => 'Overview',
                'eyebrow' => 'Academics',
                'title' => 'Learning that balances fundamentals, projects, and exam readiness.',
                'subtitle' => 'PG to Grade 12',
                'body' => 'Cambridge Public School supports students through early learning, middle school foundations, and high school preparation.',
                'items' => ['Kids School: Nursery - Grade 3', 'Middle School: Grade 4 - 8', 'High School: Grade 9 - 12', 'Practical learning and projects', 'Co-curricular activities', 'Guidance and mentoring'],
            ],
            [
                'key' => 'academics.elementary',
                'page' => 'Academics',
                'section' => 'Kids School',
                'eyebrow' => 'Kids School',
                'title' => 'A joyful foundation for early learners.',
                'subtitle' => 'Nursery - Grade 3',
                'body' => 'Young children learn through stories, numbers, movement, art, play, habits, and guided discovery.',
                'items' => ['Phonics and early literacy', 'Number sense and patterns', 'Creative expression', 'Social confidence', 'Daily routines and values', 'Play-based assessment'],
            ],
            [
                'key' => 'academics.primary',
                'page' => 'Academics',
                'section' => 'Middle School',
                'eyebrow' => 'Middle School',
                'title' => 'Strong fundamentals with practical exploration.',
                'subtitle' => 'Grade 4 - 8',
                'body' => 'Students build language, mathematics, science, social studies, computing, teamwork, and presentation confidence.',
                'items' => ['Project-based learning', 'Reading and writing habits', 'STEM activities', 'Computer literacy', 'Clubs and competitions', 'Regular academic support'],
            ],
            [
                'key' => 'academics.secondary',
                'page' => 'Academics',
                'section' => 'High School',
                'eyebrow' => 'High School',
                'title' => 'Focused preparation for exams, leadership, and future study.',
                'subtitle' => 'Grade 9 - 12',
                'body' => 'Senior students receive subject depth, lab exposure, exam practice, mentoring, and career counseling.',
                'items' => ['SEE and board preparation', 'Science and computer labs', 'Career counseling', 'Leadership activities', 'Debate and presentations', 'Stream selection guidance'],
            ],
            [
                'key' => 'contact.hero',
                'page' => 'Contact',
                'section' => 'Hero',
                'eyebrow' => 'Contact',
                'title' => 'Reach the school office.',
            ],
            [
                'key' => 'gallery.hero',
                'page' => 'Gallery',
                'section' => 'Hero',
                'eyebrow' => 'Gallery',
                'title' => 'Campus moments, activities, and celebrations.',
            ],
            [
                'key' => 'news.hero',
                'page' => 'News',
                'section' => 'Hero',
                'eyebrow' => 'Notice/Event',
                'title' => 'Latest notices and event updates.',
            ],
            [
                'key' => 'faculty.hero',
                'page' => 'Faculty',
                'section' => 'Hero',
                'eyebrow' => 'Faculty',
                'title' => 'Meet the teachers guiding every learner.',
            ],
            [
                'key' => 'result.hero',
                'page' => 'Result',
                'section' => 'Hero',
                'eyebrow' => 'Result',
                'title' => 'Student result information.',
                'subtitle' => 'Entrance and exam result notices can be linked here when the school publishes them.',
                'body' => 'Results will be available soon. Please contact the school office or check the notice board for the latest result publication updates.',
                'button_label' => 'Contact Office',
                'button_url' => '/contact',
            ],
        ];

        foreach ($sections as $section) {
            PageContent::updateOrCreate(
                ['key' => $section['key']],
                array_merge([
                    'is_active' => true,
                    'sort_order' => 0,
                ], $section)
            );
        }
    }
}
