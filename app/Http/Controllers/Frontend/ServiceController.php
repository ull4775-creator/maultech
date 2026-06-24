<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\{Service, Setting};

class ServiceController extends Controller {
    public function index() {
        $services = Service::where('status','active')->orderBy('sort_order')->get();
        return view('frontend.services.index', compact('services'));
    }
    public function show($slug) {
        $service = Service::where('slug', $slug)->where('status','active')->firstOrFail();
        return view('frontend.services.show', compact('service'));
    }
}