<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{User, ActivityLog};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller {
    public function index() {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.user.index', compact('users'));
    }

    public function create() {
        return view('admin.user.form');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        ActivityLog::log('User', $user->id, 'Create', "User '{$user->name}' created");

        return redirect()->route('admin.user.index')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function edit(User $user) {
        return view('admin.user.form', compact('user'));
    }

    public function update(Request $request, User $user) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if(!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        ActivityLog::log('User', $user->id, 'Update', "User '{$user->name}' updated");

        return redirect()->route('admin.user.index')->with('success', 'Akun berhasil diupdate!');
    }

    public function destroy(User $user) {
        // Cegah hapus diri sendiri
        if($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $name = $user->name;
        $user->delete();
        ActivityLog::log('User', 0, 'Delete', "User '{$name}' deleted");

        return redirect()->route('admin.user.index')->with('success', 'Akun berhasil dihapus!');
    }

    // Ganti password sendiri
    public function changePassword() {
        return view('admin.user.change-password');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if(!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        ActivityLog::log('User', $user->id, 'Password Change', "Password changed");

        return back()->with('success', 'Password berhasil diubah!');
    }
}