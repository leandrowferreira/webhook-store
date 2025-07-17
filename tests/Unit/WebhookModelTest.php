<?php

use App\Models\Webhook;

describe('Webhook Model', function () {
    it('has correct fillable attributes', function () {
        $webhook = new Webhook;

        expect($webhook->getFillable())->toBe([
            'method',
            'url',
            'headers',
            'query_parameters',
            'body',
            'content_type',
            'user_agent',
            'ip_address',
            'origin',
            'content_length',
        ]);
    });

    it('casts attributes correctly', function () {
        $webhook = new Webhook;

        expect($webhook->getCasts())->toMatchArray([
            'headers' => 'array',
            'query_parameters' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ]);
    });

    it('generates correct body preview', function () {
        $webhook = new Webhook([
            'body' => json_encode(['message' => 'This is a long message that should be truncated in the preview to show only the first part']),
        ]);

        $preview = $webhook->body_preview;

        expect($preview)->toContain('This is a long message');
        expect(strlen($preview))->toBeLessThanOrEqual(103); // 100 chars + '...'
    });

    it('handles empty body in preview', function () {
        $webhook = new Webhook(['body' => '']);

        expect($webhook->body_preview)->toBe('Empty body');
    });

    it('formats JSON body correctly', function () {
        $data = ['user' => ['name' => 'John', 'email' => 'john@example.com']];
        $webhook = new Webhook(['body' => json_encode($data)]);

        $formatted = $webhook->formatted_body;

        expect($formatted)->toContain('"user"');
        expect($formatted)->toContain('"name": "John"');
        expect(json_decode($formatted, true))->toBe($data);
    });

    it('handles non-JSON body in formatting', function () {
        $webhook = new Webhook(['body' => 'plain text body']);

        expect($webhook->formatted_body)->toBe('plain text body');
    });

    it('handles invalid JSON in formatted_body', function () {
        $webhook = new Webhook(['body' => '{"invalid": json}']);
        expect($webhook->formatted_body)->toBe('{"invalid": json}');
    });

    it('handles empty body in formatting', function () {
        $webhook = new Webhook(['body' => '']);

        expect($webhook->formatted_body)->toBeNull();
    });

    it('generates clean URL correctly', function () {
        $webhook = new Webhook([
            'url' => 'http://localhost:8000/webhook?param1=value1&param2=value2',
            'query_parameters' => ['param1' => 'value1', 'param2' => 'value2'],
        ]);

        $cleanUrl = $webhook->clean_url;

        expect($cleanUrl)->toBe('/webhook?param1=value1&param2=value2');
    });

    it('handles URL with only parameters', function () {
        $webhook = new Webhook([
            'url' => 'http://localhost:8000?param=value',
            'query_parameters' => ['param' => 'value'],
        ]);

        expect($webhook->clean_url)->toBe('/?param=value');
    });

    it('handles URL without query parameters', function () {
        $webhook = new Webhook([
            'url' => 'http://localhost:8000/webhook',
            'query_parameters' => [],
        ]);

        expect($webhook->clean_url)->toBe('/webhook');
    });

    it('handles URL without path', function () {
        $webhook = new Webhook([
            'url' => 'http://localhost:8000',
            'query_parameters' => [],
        ]);

        expect($webhook->clean_url)->toBe('/');
    });

    it('handles URL with fragments', function () {
        $webhook = new Webhook([
            'url' => 'http://localhost:8000/webhook#section',
            'query_parameters' => [],
        ]);

        expect($webhook->clean_url)->toBe('/webhook#section');
    });

    it('preserves array data in headers', function () {
        $headers = [
            'content-type' => ['application/json'],
            'user-agent' => ['Test/1.0'],
            'custom-header' => ['custom-value'],
        ];

        $webhook = new Webhook([
            'method' => 'POST',
            'url' => 'http://test.com/webhook',
            'headers' => $headers,
            'query_parameters' => [],
            'body' => '{}',
            'ip_address' => '127.0.0.1',
        ]);

        expect($webhook->headers)->toBe($headers);
        expect($webhook->headers['content-type'])->toBe(['application/json']);
    });

    it('preserves array data in query parameters', function () {
        $queryParams = [
            'param1' => 'value1',
            'param2' => 'value2',
            'array_param' => ['item1', 'item2'],
        ];

        $webhook = new Webhook([
            'method' => 'GET',
            'url' => 'http://test.com/webhook',
            'headers' => [],
            'query_parameters' => $queryParams,
            'body' => '',
            'ip_address' => '127.0.0.1',
        ]);

        expect($webhook->query_parameters)->toBe($queryParams);
        expect($webhook->query_parameters['array_param'])->toBe(['item1', 'item2']);
    });

});