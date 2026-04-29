<?php

namespace App\Http\Controllers\Admin;

use App\CustomerFeedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerFeedbackCon extends Controller
{
    public function index(Request $request)
    {
        $query = CustomerFeedback::orderBy('created_at', 'desc');

        if ($request->filled('sentiment')) {
            $query->where('sentiment', $request->sentiment);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('risk_level')) {
            $query->where('risk_level', $request->risk_level);
        }

        if ($request->filled('testimonial')) {
            $query->where('is_usable_as_testimonial', $request->testimonial === '1');
        }

        $feedbacks  = $query->paginate(20)->appends($request->query());
        $total      = CustomerFeedback::count();
        $positive   = CustomerFeedback::where('sentiment', 'positive')->count();
        $negative   = CustomerFeedback::where('sentiment', 'negative')->count();
        $testimonials = CustomerFeedback::where('is_usable_as_testimonial', true)->count();
        $categories = CustomerFeedback::select('category')->distinct()->whereNotNull('category')->pluck('category');

        return view('admin.fbads.customer_feedback.index', compact(
            'feedbacks', 'total', 'positive', 'negative', 'testimonials', 'categories'
        ));
    }
}
