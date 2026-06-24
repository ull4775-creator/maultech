<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Portfolio, ActivityLog};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller {
    public function index() {
        $portfolios = Portfolio::orderBy('sort_order')->orderByDesc('created_at')->paginate(12);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create() { return view('admin.portfolio.form'); }

    public function store(Request $request) {
        // SEMUA FIELD OPSIONAL - hanya title yang wajib
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'category' => 'nullable|in:web,cctv,hardware,other',
            'tech_stack' => 'nullable|string',
            'tech_stack_detail' => 'nullable|array',
            'tech_stack_detail.*' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'link_demo' => 'nullable|string',
            'link_github' => 'nullable|string',
            'project_url' => 'nullable|string',
            'client_name' => 'nullable|string',
            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'result' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['category'] = $data['category'] ?? 'web';
        $data['is_featured'] = $request->has('is_featured');
        $data['is_published'] = $request->has('is_published');

        // Handle cover image
        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portfolios','public');
        }

        // Handle gallery images
        $images = [];
        if($request->hasFile('images')) {
            foreach($request->file('images') as $img) {
                $images[] = $img->store('portfolios/gallery','public');
            }
        }
        $data['images'] = !empty($images) ? $images : null;

        // Handle tech stack detail
        $data['tech_stack_detail'] = !empty($request->tech_stack_detail) 
            ? array_filter($request->tech_stack_detail) 
            : null;

        // Handle features
        $data['features'] = !empty($request->features) 
            ? array_filter($request->features) 
            : null;

        $portfolio = Portfolio::create($data);
        ActivityLog::log('Portfolio', $portfolio->id, 'Create', "Portfolio '{$portfolio->title}' created");

        return redirect()->route('admin.portfolio.index')->with('success','Portfolio berhasil ditambahkan!');
    }

    public function edit(Portfolio $portfolio) { return view('admin.portfolio.form', compact('portfolio')); }

    public function update(Request $request, Portfolio $portfolio) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'category' => 'nullable|in:web,cctv,hardware,other',
            'tech_stack' => 'nullable|string',
            'tech_stack_detail' => 'nullable|array',
            'tech_stack_detail.*' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'link_demo' => 'nullable|string',
            'link_github' => 'nullable|string',
            'project_url' => 'nullable|string',
            'client_name' => 'nullable|string',
            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'result' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['category'] = $data['category'] ?? 'web';
        $data['is_featured'] = $request->has('is_featured');
        $data['is_published'] = $request->has('is_published');

        // Handle cover image
        if($request->hasFile('image')) {
            if($portfolio->image) Storage::disk('public')->delete($portfolio->image);
            $data['image'] = $request->file('image')->store('portfolios','public');
        }

        // Handle gallery images
        if($request->hasFile('images')) {
            foreach($portfolio->images ?? [] as $oldImg) {
                if($oldImg) Storage::disk('public')->delete($oldImg);
            }
            $images = [];
            foreach($request->file('images') as $img) {
                $images[] = $img->store('portfolios/gallery','public');
            }
            $data['images'] = !empty($images) ? $images : null;
        }

        // Handle tech stack detail
        $data['tech_stack_detail'] = !empty($request->tech_stack_detail) 
            ? array_filter($request->tech_stack_detail) 
            : null;

        // Handle features
        $data['features'] = !empty($request->features) 
            ? array_filter($request->features) 
            : null;

        $portfolio->update($data);
        ActivityLog::log('Portfolio', $portfolio->id, 'Update', "Portfolio '{$portfolio->title}' updated");

        return redirect()->route('admin.portfolio.index')->with('success','Portfolio berhasil diupdate!');
    }

    public function destroy(Portfolio $portfolio) {
        if($portfolio->image) Storage::disk('public')->delete($portfolio->image);
        foreach($portfolio->images ?? [] as $img) {
            if($img) Storage::disk('public')->delete($img);
        }
        $title = $portfolio->title;
        $portfolio->delete();
        ActivityLog::log('Portfolio', 0, 'Delete', "Portfolio '{$title}' deleted");
        return redirect()->route('admin.portfolio.index')->with('success','Portfolio berhasil dihapus!');
    }
}