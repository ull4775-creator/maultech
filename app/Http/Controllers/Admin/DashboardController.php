<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Portfolio,Service,Skill,Experience,Contact,ServiceOrder,Visitor,ActivityLog};
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller {
    public function index() {
        $data = [
            'total_portfolios' => Portfolio::count(),
            'total_services' => Service::where('status','active')->count(),
            'total_contacts' => Contact::where('is_read', false)->count(),
            'total_orders' => ServiceOrder::where('status','pending')->count(),
            'total_visitors' => Visitor::count(),
            'visitors_today' => Visitor::whereDate('visited_at', today())->count(),
            'recent_activities' => ActivityLog::with('user')->latest()->take(10)->get(),
            'recent_contacts' => Contact::latest()->take(5)->get(),
            'recent_orders' => ServiceOrder::with('service')->latest()->take(5)->get(),
            'visitor_chart' => Visitor::selectRaw('DATE(visited_at) as date, COUNT(*) as count')
                ->where('visited_at', '>=', now()->subDays(30))
                ->groupBy('date')->orderBy('date')->get(),
            'service_stats' => Service::withCount('orders')->get(),
            'portfolio_views' => Portfolio::orderByDesc('views')->take(5)->get(),
        ];
        return view('admin.dashboard', $data);
    }
}