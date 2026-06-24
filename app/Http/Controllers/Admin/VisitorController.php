<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller {
    public function index() {
        $visitors = Visitor::latest('visited_at')->paginate(30);
        $stats = [
            'total' => Visitor::count(),
            'today' => Visitor::whereDate('visited_at', today())->count(),
            'week' => Visitor::where('visited_at', '>=', now()->subWeek())->count(),
            'month' => Visitor::where('visited_at', '>=', now()->subMonth())->count(),
        ];
        return view('admin.visitor.index', compact('visitors','stats'));
    }
}