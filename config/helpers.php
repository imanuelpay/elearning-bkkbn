<?php

function textToSlug(string $text = ''): string
{
    $text = trim($text);
    if (empty($text)) return '';
    $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
    $text = strtolower(trim($text));
    $text = str_replace(' ', '-', $text);
    return $text_ori = preg_replace('/\-{2,}/', '-', $text);
}

function cleanData(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}