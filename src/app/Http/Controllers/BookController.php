<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (! $keyword) {
            return response()->json([
                'message' => '検索キーワードを入力してください。',
            ]);
        }

        $apiKey = config('services.google_books.api_key');

        if (! $apiKey) {
            return response()->json([
                'message' => 'Google Books APIキーが設定されていません。',
            ], 500);
        }

        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => 'intitle:' . $keyword,
            'key' => $apiKey,
            'maxResults' => 8,
            'langRestrict' => 'ja',
            'printType' => 'books',
            'orderBy' => 'relevance',
        ]);

        if ($response->failed()) {
            return response()->json([
                'message' => 'Google Books APIの取得に失敗しました。',
                'status' => $response->status(),
            ], 500);
        }

        $items = $response->json('items', []);

        $results = collect($items)
            ->map(function ($item) {
                $volumeInfo = $item['volumeInfo'] ?? [];

                $imageLinks = $volumeInfo['imageLinks'] ?? [];
                $thumbnail = $imageLinks['thumbnail'] ?? null;

                if ($thumbnail) {
                    $thumbnail = str_replace('http://', 'https://', $thumbnail);
                }

                return [
                    'title' => $volumeInfo['title'] ?? '',
                    'authors' => $volumeInfo['authors'] ?? [],
                    'published_date' => $volumeInfo['publishedDate'] ?? '',
                    'description' => $volumeInfo['description'] ?? '',
                    'thumbnail_url' => $thumbnail,
                ];
            })
            ->filter(function ($item) {
                return ! empty($item['title']);
            })
            ->values();

        return response()->json($results, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
