<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class TranslationController extends Controller
{
    public function translate(Request $request)
    {
        $request->validate([
            'lang' => 'required|string',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $lang = $request->input('lang');
        $title = $request->input('title');
        $description = $request->input('description');

        // OpenAI API çağrısı
        $client = OpenAI::client(config('customservices.openai.secret_key'));

        $prompt = "Translate the following content to {$lang}:\n\nTitle: {$title}\n\nDescription: {$description}";

        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'max_tokens' => 500,
            ]);

            $translatedText = $response['choices'][0]['text'];

            // Çeviriyi başlık ve açıklama olarak ayır
            $translatedParts = explode("\n\n", $translatedText);
            $translatedTitle = $translatedParts[0] ?? '';
            $translatedDescription = $translatedParts[1] ?? '';

            return response()->json([
                'success' => true,
                'translatedTitle' => trim($translatedTitle),
                'translatedDescription' => trim($translatedDescription),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
