<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class Register
{
    protected static $supabaseUrl = 'https://oxpzbteqvmwtnfbqupoe.supabase.co';
    protected static $supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im94cHpidGVxdm13dG5mYnF1cG9lIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTI0MTQ1NzUsImV4cCI6MjA2Nzk5MDU3NX0.s9DbRwQXzhZLh-bF0mhPlbL2shjI7a7ilAyy55yoW48'; // your full key

    public static function registerUser($data)
    {
        // Check if user already exists
        $check = Http::withHeaders([
            'apikey' => self::$supabaseKey,
            'Authorization' => 'Bearer ' . self::$supabaseKey,
        ])->get(self::$supabaseUrl . '/rest/v1/user?select=id&or=(username.eq.' . $data['username'] . ',email.eq.' . $data['email'] . ')');


        if (!$check->successful()) {
            return ['error' => $check->body()];
        }

        if (count($check->json()) > 0) {
            return ['error' => 'Username or email already exists'];
        }

        // Insert new user
        $response = Http::withHeaders([
            'apikey' => self::$supabaseKey,
            'Authorization' => 'Bearer ' . self::$supabaseKey,
            'Content-Type' => 'application/json',
        ])->post(self::$supabaseUrl . '/rest/v1/user', [$data]);

        if (!$response->successful()) {
            return ['error' => $response->body()];
        }

        return ['success' => true];
    }
}
