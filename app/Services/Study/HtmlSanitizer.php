<?php

namespace App\Services\Study;

use Mews\Purifier\Facades\Purifier;

class HtmlSanitizer
{
    public function clean(?string $html): string
    {
        if ($html === null || trim($html) === '') {
            return '';
        }

        // 1. Strip PHP open tags entirely.
        $html = preg_replace('/<\?(?:php|=|xml|\s)/i', '', $html) ?? '';

        // 2. Escape Blade delimiters so stored HTML can never be rendered as Blade.
        $html = strtr($html, [
            '{{'  => '&lbrace;&lbrace;',
            '}}'  => '&rbrace;&rbrace;',
            '{!!' => '&lbrace;&excl;&excl;',
            '!!}' => '&excl;&excl;&rbrace;',
            '@{{' => '&commat;&lbrace;&lbrace;',
        ]);

        // 3. HTMLPurifier — real sanitization pass.
        return (string) Purifier::clean($html, 'study');
    }
}
