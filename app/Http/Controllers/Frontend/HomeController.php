<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\{Portfolio,Service,Skill,Education,Experience,Certification,Testimonial,Setting,Visitor};
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class HomeController extends Controller {
    public function index() {
        // Track visitor
        $agent = new Agent();
        Visitor::create([
            'ip_address' => request()->ip(),
            'page_visited' => '/',
            'browser' => $agent->browser(),
            'os' => $agent->platform(),
            'referrer' => request()->header('referer'),
            'visited_at' => now(),
        ]);

        $data = [
            'hero_title' => Setting::get('hero_title', 'I am a Full Stack Developer'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'Architecting seamless digital experiences with precision engineering.'),
            'hero_image' => Setting::get('hero_image'),
            'about_text' => Setting::get('about_text'),
            'featured_portfolios' => Portfolio::where('is_featured', true)->where('is_published', true)->take(6)->get(),
            'services' => Service::where('status','active')->orderBy('sort_order')->get(),
            'skills' => Skill::orderBy('sort_order')->get(),
            'educations' => Education::orderByDesc('year_start')->get(),
            'experiences' => Experience::orderByDesc('year_start')->get(),
            'certifications' => Certification::orderBy('sort_order')->get(),
            'testimonials' => Testimonial::where('is_published', true)->orderBy('sort_order')->get(),
            'site_name' => Setting::get('site_name', 'Portfolio.OS'),
            'site_logo' => Setting::get('site_logo'),
            'footer_text' => Setting::get('footer_text'),
            'social_facebook' => Setting::get('social_facebook'),
            'social_instagram' => Setting::get('social_instagram'),
            'social_linkedin' => Setting::get('social_linkedin'),
            'social_github' => Setting::get('social_github'),
            'contact_email' => Setting::get('contact_email'),
            'contact_phone' => Setting::get('contact_phone'),
            'contact_address' => Setting::get('contact_address'),
            'whatsapp_number' => Setting::get('whatsapp_number'),
'site_logo' => Setting::get('site_logo'),
'profile_photo' => Setting::get('profile_photo'),

        ];
        return view('frontend.home', $data);
    }
}