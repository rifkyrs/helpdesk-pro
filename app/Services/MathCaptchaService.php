<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class MathCaptchaService
{
    public function generate()
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $operator = rand(0, 1) ? '+' : 'x';
        
        if ($operator === '+') {
            $answer = $num1 + $num2;
            $question = "$num1 + $num2 = ?";
        } else {
            // Keep multiplication simple
            $num1 = rand(1, 5); 
            $num2 = rand(1, 5); 
            $answer = $num1 * $num2;
            $question = "$num1 x $num2 = ?";
        }

        Session::put('math_captcha_answer', $answer);
        return $question;
    }

    public function check($input)
    {
        if (!Session::has('math_captcha_answer')) {
            return false;
        }

        return (int)$input === (int)Session::get('math_captcha_answer');
    }
}
