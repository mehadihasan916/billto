<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('status_due_paid', '!=', 'draft')
            ->latest()
            ->get();
        return view('admin.invoice.index', compact('invoices'));
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        // Delete all related invoice products first
        $invoice->products()->delete();
        // Then delete the invoice
        $invoice->delete();
        return redirect()->back()->with('success', 'Invoice deleted successfully');
    }

    public function userInvoices($id)
    {
        $invoices = Invoice::where('user_id', $id)
            ->where('status_due_paid', '!=', 'draft')
            ->latest()
            ->get();

        $total_invoices = $invoices->count();
        $total_paid = $invoices->sum('receive_advance_amount');
        $total_due = $invoices->sum('balanceDue_amounts');
        // fetch user
        $user = User::with('latestSubscription')->find($id);
        $subscription = $user->latestSubscription;
        // dd($subscription);

        return view('admin.invoice.user_invoices', compact('invoices', 'total_invoices', 'total_paid', 'total_due', 'user', 'subscription'));
    }
}
