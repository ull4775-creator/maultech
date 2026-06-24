<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller {
    public function index() {
        $settings = Setting::all()->groupBy('group');
        return view('admin.setting.index', compact('settings'));
    }
    
    public function update(Request $request) {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico,jpg|max:1024',
            'profile_photo' => 'nullable|image|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',
            'about_text' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_github' => 'nullable|url',
        ]);

        foreach($request->except('_token','_method','site_logo','favicon','profile_photo','hero_image') as $key => $value) {
            if($value !== null) {
                Setting::set($key, $value);
            }
        }

        // Helper untuk upload gambar
        $uploadImage = function($field, $folder) {
            if(request()->hasFile($field)) {
                $old = Setting::get($field);
                if($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
                $path = request()->file($field)->store('settings/' . $folder, 'public');
                Setting::set($field, $path, 'image');
            }
        };

        $uploadImage('site_logo', 'logos');
        $uploadImage('favicon', 'favicons');
        $uploadImage('profile_photo', 'profiles');
        $uploadImage('hero_image', 'heroes');

        return back()->with('success','Pengaturan berhasil disimpan!');
    }
}