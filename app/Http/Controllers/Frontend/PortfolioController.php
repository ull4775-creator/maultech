<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\{Portfolio, Visitor};
use Jenssegers\Agent\Agent;

class PortfolioController extends Controller {
    public function index() {
        $portfolios = Portfolio::where('is_published', true)->orderByDesc('is_featured')->orderBy('sort_order')->paginate(12);
        return view('frontend.portfolio.index', compact('portfolios'));
    }
    public function show($slug) {
        $portfolio = Portfolio::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $portfolio->increment('views');
        
        $agent = new Agent();
        Visitor::create([
            'ip_address' => request()->ip(),
            'page_visited' => "/portfolio/{$slug}",
            'browser' => $agent->browser(),
            'os' => $agent->platform(),
            'visited_at' => now(),
        ]);
        
        return view('frontend.portfolio.show', compact('portfolio'));
    }
}