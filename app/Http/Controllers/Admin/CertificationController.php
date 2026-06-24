<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Certification, ActivityLog};
use Illuminate\Http\Request;

class CertificationController extends Controller {
    public function index() { $certs = Certification::orderBy('sort_order')->paginate(10); return view('admin.certification.index', compact('certs')); }
    public function create() { return view('admin.certification.form'); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|string','issuer'=>'required|string','year'=>'nullable|string','credential_url'=>'nullable|url','icon'=>'nullable|string']);
        $cert = Certification::create($data);
        ActivityLog::log('Certification', $cert->id, 'Create', "Certification '{$cert->name}' created");
        return redirect()->route('admin.certification.index')->with('success','Sertifikasi ditambahkan!');
    }
    public function edit(Certification $certification) { return view('admin.certification.form', ['cert' => $certification]); }
    public function update(Request $request, Certification $certification) {
        $data = $request->validate(['name'=>'required|string','issuer'=>'required|string','year'=>'nullable|string','credential_url'=>'nullable|url','icon'=>'nullable|string']);
        $certification->update($data);
        return redirect()->route('admin.certification.index')->with('success','Sertifikasi diupdate!');
    }
    public function destroy(Certification $certification) { $certification->delete(); return back()->with('success','Sertifikasi dihapus!'); }
}