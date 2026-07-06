<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TmdbController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (! $keyword) {
            return response()->json([
                'message' => '検索キーワードを入力してください。',
            ]);
        }

        $apiKey = config('services.tmdb.api_key');
        $imageBaseUrl = config('services.tmdb.image_base_url');

        if (! $apiKey) {
            return response()->json([
                'message' => 'TMDb APIキーが設定されていません。',
            ], 500);
        }

        $response = Http::get('https://api.themoviedb.org/3/search/movie', [
            'api_key' => $apiKey,
            'query' => $keyword,
            'language' => 'ja-JP',
            'include_adult' => false,
        ]);

        if ($response->failed()) {
            return response()->json([
                'message' => 'TMDb APIの取得に失敗しました。',
                'status' => $response->status(),
            ], 500);
        }

        $results = collect($response->json('results'))
            ->take(5)
            ->map(function ($item) use ($imageBaseUrl) {
                return [
                    'title' => $item['title'] ?? '',
                    'original_title' => $item['original_title'] ?? '',
                    'release_date' => $item['release_date'] ?? '',
                    'overview' => $item['overview'] ?? '',
                    'poster_url' => ! empty($item['poster_path'])
                        ? $imageBaseUrl . $item['poster_path']
                        : null,
                ];
            });

        return response()->json($results);
    }
}