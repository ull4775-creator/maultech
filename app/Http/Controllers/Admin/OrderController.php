<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{ServiceOrder, ActivityLog};
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function index() { $orders = ServiceOrder::with('service')->latest()->paginate(15); return view('admin.order.index', compact('orders')); }
    public function show(ServiceOrder $order) { return view('admin.order.show', compact('order')); }
    public function updateStatus(Request $request, ServiceOrder $order) {
        $request->validate(['status' => 'required|in:pending,processing,completed,cancelled']);
        $order->update(['status' => $request->status, 'notes' => $request->notes]);
        ActivityLog::log('Order', $order->id, 'Status Update', "Order #{$order->order_number} status changed to {$request->status}");
        return back()->with('success','Status order diupdate!');
    }
    public function destroy(ServiceOrder $order) { $order->delete(); return back()->with('success','Order dihapus!'); }
}