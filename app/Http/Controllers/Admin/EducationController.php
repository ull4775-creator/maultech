<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Education, ActivityLog};
use Illuminate\Http\Request;

class EducationController extends Controller {
    public function index() { $educations = Education::orderByDesc('year_start')->paginate(10); return view('admin.education.index', compact('educations')); }
    public function create() { return view('admin.education.form'); }
    public function store(Request $request) {
        $data = $request->validate(['degree'=>'required|string','institution'=>'required|string','year_start'=>'required|string','year_end'=>'nullable|string','description'=>'nullable']);
        $education = Education::create($data);
        ActivityLog::log('Education', $education->id, 'Create', "Education '{$education->degree}' created");
        return redirect()->route('admin.education.index')->with('success','Pendidikan ditambahkan!');
    }
    public function edit(Education $education) { return view('admin.education.form', compact('education')); }
    public function update(Request $request, Education $education) {
        $data = $request->validate(['degree'=>'required|string','institution'=>'required|string','year_start'=>'required|string','year_end'=>'nullable|string','description'=>'nullable']);
        $education->update($data);
        return redirect()->route('admin.education.index')->with('success','Pendidikan diupdate!');
    }
    public function destroy(Education $education) { $education->delete(); return back()->with('success','Pendidikan dihapus!'); }
}