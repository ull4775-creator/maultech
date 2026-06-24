<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Skill, ActivityLog};
use Illuminate\Http\Request;

class SkillController extends Controller {
    public function index() {
        $skills = Skill::orderBy('sort_order')->paginate(20);
        return view('admin.skill.index', compact('skills'));
    }
    public function create() { return view('admin.skill.form'); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|string','icon'=>'nullable|string','category'=>'required|in:technical,soft,tool','level'=>'required|integer|min:0|max:100','color'=>'nullable|string']);
        $skill = Skill::create($data);
        ActivityLog::log('Skill', $skill->id, 'Create', "Skill '{$skill->name}' created");
        return redirect()->route('admin.skill.index')->with('success','Skill ditambahkan!');
    }
    public function edit(Skill $skill) { return view('admin.skill.form', compact('skill')); }
    public function update(Request $request, Skill $skill) {
        $data = $request->validate(['name'=>'required|string','icon'=>'nullable|string','category'=>'required|in:technical,soft,tool','level'=>'required|integer|min:0|max:100','color'=>'nullable|string']);
        $skill->update($data);
        ActivityLog::log('Skill', $skill->id, 'Update', "Skill '{$skill->name}' updated");
        return redirect()->route('admin.skill.index')->with('success','Skill diupdate!');
    }
    public function destroy(Skill $skill) { $skill->delete(); return back()->with('success','Skill dihapus!'); }
}