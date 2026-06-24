<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Service, ActivityLog};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller {
    public function index() {
    $services = Service::withCount('orders')->orderBy('sort_order')->paginate(10);
    return view('admin.service.index', compact('services'));
}

    public function create() { return view('admin.service.form'); }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
            'price_min' => 'nullable|numeric',
            'price_max' => 'nullable|numeric',
            'price_label' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'features' => 'nullable|array',
            'features.*' => 'string',
        ]);

        $data['slug'] = Str::slug($data['title']);
        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services','public');
        }

        $service = Service::create($data);
        ActivityLog::log('Service', $service->id, 'Create', "Service '{$service->title}' created");
        return redirect()->route('admin.service.index')->with('success','Service berhasil ditambahkan!');
    }

    public function edit(Service $service) { return view('admin.service.form', compact('service')); }

    public function update(Request $request, Service $service) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
            'price_min' => 'nullable|numeric',
            'price_max' => 'nullable|numeric',
            'price_label' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'features' => 'nullable|array',
            'features.*' => 'string',
        ]);

        $data['slug'] = Str::slug($data['title']);
        if($request->hasFile('image')) {
            if($service->image) Storage::disk('public')->delete($service->image);
            $data['image'] = $request->file('image')->store('services','public');
        }

        $service->update($data);
        ActivityLog::log('Service', $service->id, 'Update', "Service '{$service->title}' updated");
        return redirect()->route('admin.service.index')->with('success','Service berhasil diupdate!');
    }

    public function destroy(Service $service) {
        if($service->image) Storage::disk('public')->delete($service->image);
        $title = $service->title;
        $service->delete();
        ActivityLog::log('Service', 0, 'Delete', "Service '{$title}' deleted");
        return redirect()->route('admin.service.index')->with('success','Service berhasil dihapus!');
    }
}