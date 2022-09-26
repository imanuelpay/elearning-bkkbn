<?php

use Ramsey\Uuid\Uuid;

require '../vendor/autoload.php';

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

function getUUID(): string
{
    $uuid4 = Uuid::uuid4();
    return $uuid4->toString();
}

function randomString(int $lenght): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $lenght; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}