<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\{Service, ServiceOrder};
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function create($serviceSlug) {
        $service = Service::where('slug', $serviceSlug)->where('status','active')->firstOrFail();
        return view('frontend.order', compact('service'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email',
            'client_phone' => 'required|string',
            'client_address' => 'nullable|string',
            'description' => 'required|string',
        ]);
        $order = ServiceOrder::create($data);
        return redirect()->route('order.success', $order->order_number)->with('success','Order berhasil dibuat!');
    }
    public function success($orderNumber) {
        $order = ServiceOrder::where('order_number', $orderNumber)->firstOrFail();
        return view('frontend.order-success', compact('order'));
    }
}