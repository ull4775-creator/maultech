<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Contact, ActivityLog};
use Illuminate\Http\Request;

class ContactController extends Controller {
    public function index() { $contacts = Contact::latest()->paginate(15); return view('admin.contact.index', compact('contacts')); }
    public function show(Contact $contact) {
        $contact->update(['is_read' => true]);
        return view('admin.contact.show', compact('contact'));
    }
    public function reply(Request $request, Contact $contact) {
        $request->validate(['reply' => 'required']);
        $contact->update(['reply' => $request->reply, 'replied_at' => now()]);
        ActivityLog::log('Contact', $contact->id, 'Reply', "Replied to contact from '{$contact->name}'");
        return back()->with('success','Balasan terkirim!');
    }
    public function destroy(Contact $contact) { $contact->delete(); return back()->with('success','Pesan dihapus!'); }
}