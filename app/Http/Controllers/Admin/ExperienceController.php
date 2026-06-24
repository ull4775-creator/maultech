<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Experience, ActivityLog};
use Illuminate\Http\Request;

class ExperienceController extends Controller {
    public function index() { $experiences = Experience::orderByDesc('year_start')->paginate(10); return view('admin.experience.index', compact('experiences')); }
    public function create() { return view('admin.experience.form'); }
    public function store(Request $request) {
        $data = $request->validate(['position'=>'required|string','company'=>'required|string','year_start'=>'required|string','year_end'=>'nullable|string','description'=>'nullable','is_current'=>'boolean']);
        $data['is_current'] = $request->has('is_current');
        $experience = Experience::create($data);
        ActivityLog::log('Experience', $experience->id, 'Create', "Experience '{$experience->position}' created");
        return redirect()->route('admin.experience.index')->with('success','Pengalaman ditambahkan!');
    }
    public function edit(Experience $experience) { return view('admin.experience.form', compact('experience')); }
    public function update(Request $request, Experience $experience) {
        $data = $request->validate(['position'=>'required|string','company'=>'required|string','year_start'=>'required|string','year_end'=>'nullable|string','description'=>'nullable','is_current'=>'boolean']);
        $data['is_current'] = $request->has('is_current');
        $experience->update($data);
        return redirect()->route('admin.experience.index')->with('success','Pengalaman diupdate!');
    }
    public function destroy(Experience $experience) { $experience->delete(); return back()->with('success','Pengalaman dihapus!'); }
}