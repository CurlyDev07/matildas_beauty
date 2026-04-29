<?php

namespace App\Http\Controllers\Api;

use App\CustomerFeedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerFeedbackController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'source'                   => 'nullable|string|max:100',
            'message'                  => 'required|string',
            'type'                     => 'nullable|string|max:100',
            'sentiment'                => 'nullable|string|max:100',
            'category'                 => 'nullable|string|max:100',
            'summary'                  => 'nullable|string',
            'recommended_action'       => 'nullable|string',
            'is_usable_as_testimonial' => 'nullable|boolean',
            'risk_level'               => 'nullable|string|max:100',
        ]);

        $feedback = CustomerFeedback::create([
            'source'                   => $data['source'] ?? null,
            'message'                  => $data['message'],
            'type'                     => $data['type'] ?? null,
            'sentiment'                => $data['sentiment'] ?? null,
            'category'                 => $data['category'] ?? null,
            'summary'                  => $data['summary'] ?? null,
            'recommended_action'       => $data['recommended_action'] ?? null,
            'is_usable_as_testimonial' => $data['is_usable_as_testimonial'] ?? false,
            'risk_level'               => $data['risk_level'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customer feedback saved successfully',
            'data'    => $feedback,
        ], 201);
    }
}
