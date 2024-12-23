<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeeplTranslateController extends Controller
{
    public function translate(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'lang' => 'required|string|max:5', // Target language code (e.g., 'de', 'fr')
            'text' => 'required|string|max:10000', // Text to translate
        ]);

        if ($request->lang != 'sr') {
            // DeepL API Logic
            $apiKey = __cc('DEEPL_API_KEY');
            $apiUrl = __cc('DEEPL_API_URL_FREE');

            if (!$apiKey) {
                return response()->json([
                    'success' => false,
                    'message' => 'API key is missing. Please configure DEEPL_API_KEY in your .env file.',
                ], 500);
            }

            try {
                // Make the API request using query parameters
                $response = Http::get($apiUrl, [
                    'auth_key' => $apiKey,
                    'text' => $validated['text'],
                    'target_lang' => strtoupper($validated['lang']),
                ]);

                if ($response->failed()) {
                    Log::error('DeepL API Error:', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);

                    return response()->json([
                        'success' => false,
                        'message' => 'Translation failed. DeepL API responded with status: ' . $response->status(),
                    ], $response->status());
                }

                $data = $response->json();

                if (isset($data['translations'][0]['text'])) {
                    return response()->json([
                        'success' => true,
                        'translatedText' => $data['translations'][0]['text'],
                    ]);
                } else {
                    Log::error('DeepL API response did not include a translation:', $data);

                    return response()->json([
                        'success' => false,
                        'message' => 'Translation failed. Unexpected API response format.',
                    ], 500);
                }
            } catch (\Exception $e) {
                Log::error('Exception during DeepL API call:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing the translation: ' . $e->getMessage(),
                ], 500);
            }
        } else if ($request->lang == 'sr') {
            // OpenAI API Logic
            $openaiApiKey = __cc('OPENAI_SECRET_KEY');
            $openaiApiUrl = __cc('OPENAI_API_URL');

            $prompt = <<<EOT
Translate the following text to {$validated['lang']} (Serbian). Ensure that:
1. The meaning of the text is accurately translated.
2. All HTML tags and structures are preserved without modification.
3. Avoid adding extra context, comments, or explanations.

Text to translate:
{$validated['text']}
EOT;

            try {
                $openaiResponse = Http::withHeaders([
                    'Authorization' => "Bearer {$openaiApiKey}",
                    'Content-Type' => 'application/json',
                ])->post($openaiApiUrl, [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are a translation assistant. Your role is to translate texts while preserving their structure and tags.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ],
                    ],
                    'max_tokens' => 2000,
                    'temperature' => 0.3,
                ]);

                if ($openaiResponse->ok() && isset($openaiResponse->json()['choices'][0]['message']['content'])) {
                    $translatedContent = $openaiResponse->json()['choices'][0]['message']['content'];

                    // Gereksiz açıklamaları temizle
                    $translatedContent = preg_replace('/\n.*?Explanation:.*/s', '', $translatedContent);

                    return response()->json([
                        'success' => true,
                        'translatedText' => $translatedContent,
                    ]);
                }

                Log::error('OpenAI Translation API Error:', [
                    'status' => $openaiResponse->status(),
                    'body' => $openaiResponse->body(),
                ]);

            } catch (\Exception $e) {
                Log::error('Exception during translation:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred during the translation process: ' . $e->getMessage(),
                ], 500);
            }
        }
    }
}
