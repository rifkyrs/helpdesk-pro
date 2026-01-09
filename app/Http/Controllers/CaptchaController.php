<?php

namespace App\Http\Controllers;

use App\Services\MathCaptchaService;
use Illuminate\Http\Response;

class CaptchaController extends Controller
{
    public function show(MathCaptchaService $captchaService)
    {
        $text = $captchaService->generate(); // Returns "5 + 3 = ?"

        $width = 120;
        $height = 40;

        // Generate SVG
        $svg = '<?xml version="1.0" encoding="UTF-8"?>';
        $svg .= '<svg width="'.$width.'" height="'.$height.'" xmlns="http://www.w3.org/2000/svg">';
        
        // Background
        $svg .= '<rect width="100%" height="100%" fill="#f0f0f0"/>';
        
        // Noise (Random Lines)
        for ($i = 0; $i < 7; $i++) {
            $x1 = rand(0, $width);
            $y1 = rand(0, $height);
            $x2 = rand(0, $width);
            $y2 = rand(0, $height);
            $svg .= '<line x1="'.$x1.'" y1="'.$y1.'" x2="'.$x2.'" y2="'.$y2.'" stroke="#cccccc" stroke-width="1"/>';
        }
        
        // Text
        $svg .= '<text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="18" font-weight="bold" fill="#333333" letter-spacing="2">'.$text.'</text>';
        
        $svg .= '</svg>';

        return response($svg)->header('Content-Type', 'image/svg+xml');
    }
}
