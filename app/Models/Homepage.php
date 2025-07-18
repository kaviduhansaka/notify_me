<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class Homepage
{
    protected static $supabaseUrl = 'https://cfekqosjusrbwutzxeee.supabase.co';
    protected static $supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImNmZWtxb3NqdXNyYnd1dHp4ZWVlIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTIwNzc1ODksImV4cCI6MjA2NzY1MzU4OX0.96cczWCOScRB3RgQ1gTgze14eC5FcTQ_Fp07Q3qOgLg';

    public static function getProducts()
    {
        $response = Http::withHeaders([
            'apikey' => self::$supabaseKey,
            'Authorization' => 'Bearer ' . self::$supabaseKey,
        ])->get(self::$supabaseUrl . '/rest/v1/products', [
            'select' => '*'
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }
}
