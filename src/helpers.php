<?php

namespace Tii\WowApi;

function strtocamel(string $string): string {
    $words = explode(' ', str_replace(['-', '_'], ' ', $string));
    $studlyWords = array_map(fn ($word) => ucfirst($word), $words);
    $studlyWords[0] = strtolower($studlyWords[0]);
    return implode('', $studlyWords);
}