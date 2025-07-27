<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GeminiController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function generateText(Request $request): JsonResponse
    {
        $prompt = $request->json('prompt');

        if (empty($prompt)) {
            return response()->json([
                'error' => 'Prompt is required.'
            ], 400);
        }

        $yourIdentity = "আমার নাম মেহেদি হাছান। আমি একজন Laravel developer. তুমি কাউকে উত্তর দেওয়ার সময় 'হেলো, আমি মেহেদি বলতেছি' এটা বলে শুরু করবে।";
        // $prompt = "একজন ইউজার জানতে চায় Laravel এ কিভাবে রিসোর্স কন্ট্রোলার তৈরি করতে হয়। তাকে সহজভাবে বুঝিয়ে বলো।";

        $fullPrompt = $yourIdentity . " " . " একজন ইউজার জানতে চায় " . $prompt;


        $generatedContent = $this->geminiService->generateContent($fullPrompt);

        if (str_contains($generatedContent, 'Error generating content:') || str_contains($generatedContent, 'An unexpected error occurred:')) {
            return response()->json([
                'error' => 'Failed to generate content',
                'details' => $generatedContent
            ], 500);
        }

        return response()->json([
            'prompt' => $prompt,
            'generated_content' => $generatedContent
        ]);
    }
}
