<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Testimonial, ActivityLog};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller {
    public function index() { $testimonials = Testimonial::orderBy('sort_order')->paginate(10); return view('admin.testimonial.index', compact('testimonials')); }
    public function create() { return view('admin.testimonial.form'); }
    public function store(Request $request) {
        $data = $request->validate(['client_name'=>'required|string','client_position'=>'nullable|string','client_avatar'=>'nullable|image|max:1024','message'=>'required|string','rating'=>'required|integer|min:1|max:5','is_published'=>'boolean']);
        $data['is_published'] = $request->has('is_published');
        if($request->hasFile('client_avatar')) $data['client_avatar'] = $request->file('client_avatar')->store('testimonials','public');
        $testimonial = Testimonial::create($data);
        ActivityLog::log('Testimonial', $testimonial->id, 'Create', "Testimonial from '{$testimonial->client_name}' created");
        return redirect()->route('admin.testimonial.index')->with('success','Testimonial ditambahkan!');
    }
    public function edit(Testimonial $testimonial) { return view('admin.testimonial.form', compact('testimonial')); }
    public function update(Request $request, Testimonial $testimonial) {
        $data = $request->validate(['client_name'=>'required|string','client_position'=>'nullable|string','client_avatar'=>'nullable|image|max:1024','message'=>'required|string','rating'=>'required|integer|min:1|max:5','is_published'=>'boolean']);
        $data['is_published'] = $request->has('is_published');
        if($request->hasFile('client_avatar')) {
            if($testimonial->client_avatar) Storage::disk('public')->delete($testimonial->client_avatar);
            $data['client_avatar'] = $request->file('client_avatar')->store('testimonials','public');
        }
        $testimonial->update($data);
        return redirect()->route('admin.testimonial.index')->with('success','Testimonial diupdate!');
    }
    public function destroy(Testimonial $testimonial) { $testimonial->delete(); return back()->with('success','Testimonial dihapus!'); }
}