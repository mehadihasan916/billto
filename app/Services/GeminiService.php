<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $client;
    protected $apiKey;
    protected $modelUrl;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');

        // *** এখানে পরিবর্তন করুন ***
        // নতুন মডেল: gemini-1.5-flash ব্যবহার করুন
        // Google AI Studio-তে আপনার জন্য উপলব্ধ সঠিক মডেলের নাম নিশ্চিত করুন।
        $this->modelUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$this->apiKey}";
        // অথবা, যদি gemini-1.5-pro ব্যবহার করতে চান:
        // $this->modelUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key={$this->apiKey}";


        $this->client = new Client([
            'base_uri' => 'https://generativelanguage.googleapis.com/',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        if (empty($this->apiKey)) {
            throw new \Exception("GEMINI_API_KEY is not set in .env file. Please generate an API Key from Google AI Studio.");
        }
    }

    // generateContent মেথডটি আগের মতোই থাকবে
    public function generateContent(string $prompt): string
    {
        try {
            $response = $this->client->post($this->modelUrl, [
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            if (isset($body['candidates'][0]['content']['parts'][0]['text'])) {
                return $body['candidates'][0]['content']['parts'][0]['text'];
            }

            Log::warning('Gemini API returned no content for prompt: ' . $prompt, ['response' => $body]);
            return 'No content generated from API.';
        } catch (RequestException $e) {
            $errorMessage = "Error connecting to Gemini API: " . $e->getMessage();
            if ($e->hasResponse()) {
                $errorMessage .= " Response: " . $e->getResponse()->getBody()->getContents();
            }
            Log::error($errorMessage);
            return 'Error generating content: ' . $errorMessage;
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred with Gemini API: ' . $e->getMessage());
            return 'An unexpected error occurred: ' . $e->getMessage();
        }
    }
}
