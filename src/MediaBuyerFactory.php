<?php

namespace App\Factories;

class MediaBuyerFactory
{
    public static function createValidMediaBuyer(array $overrides = []): array
    {
        return array_merge([
            'mbId' => '1234',
            'initials' => 'SJ',
            'name' => 'Sarah Jones',
            'email' => 'sarah.jones@example.com',
            'slackUserId' => 'U0690MMT3KJ',
            'active' => true
        ], $overrides);
    }

    public static function createMinimalMediaBuyer(array $overrides = []): array
    {
        return array_merge([
            'mbId' => '1234',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'active' => true
        ], $overrides);
    }

    public static function createInvalidMediaBuyer(array $overrides = []): array
    {
        return array_merge([
            'mbId' => '',
            'initials' => '',
            'name' => '',
            'email' => 'invalid-email',
            'slackUserId' => '',
            'active' => false
        ], $overrides);
    }
}