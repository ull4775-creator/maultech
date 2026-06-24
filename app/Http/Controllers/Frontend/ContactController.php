<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\{Contact, Setting};
use Illuminate\Http\Request;

class ContactController extends Controller {
    public function index() {
        return view('frontend.contact', [
            'contact_email' => Setting::get('contact_email'),
            'contact_phone' => Setting::get('contact_phone'),
            'contact_address' => Setting::get('contact_address'),
            'whatsapp_number' => Setting::get('whatsapp_number'),
        ]);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'nullable|string',
            'message' => 'required|string',
            'service_type' => 'nullable|string',
        ]);
        Contact::create($data);
        return back()->with('success','Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}