<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VfrController extends Controller
{
   public function index()
    {
        return view('vfr');
    }

    public function tryOn(Request $request)
    {
        $request->validate([
            'user_image' => 'required|image',
            'cloth_image' => 'required|image',
        ]);

      $response = Http::withOptions([
    'proxy' => null,     // Force NO proxy
    'timeout' => 60,     // Keep the long timeout
])
->attach('user_img', file_get_contents($request->file('user_image')), 'user.jpg')
->attach('cloth_img', file_get_contents($request->file('cloth_image')), 'cloth.png')
->post('http://127.0.0.1:8001/process-vfr');

            dd(  $response );
        if ($response->successful()) {
            $hexData = $response->json()['image_hex'];
            
            // 1. Convert Hex to Binary
            $binary = hex2bin($hexData);
            
            // 2. Convert Binary to Base64
            $base64 = base64_encode($binary);

            return view('vfr_result', ['image' => $base64]);
        }

        return back()->with('error', 'AI Service is unreachable.');
    }
}
