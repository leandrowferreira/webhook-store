<?php

use App\Models\Webhook;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Webhook Capture', function () {
    it('can capture a POST webhook', function () {
        $response = $this->withoutMiddleware()->postJson('/webhook', [
            'message' => 'Hello World!',
            'timestamp' => '2025-07-15T10:30:00Z',
            'data' => ['key' => 'value'],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Webhook received successfully',
        ]);

        expect(Webhook::count())->toBe(1);

        $webhook = Webhook::first();
        expect($webhook->method)->toBe('POST');
        expect($webhook->url)->toContain('/webhook');
        expect($webhook->body)->toContain('Hello World!');
        expect($webhook->content_type)->toBe('application/json');
        expect($webhook->ip_address)->toBe('127.0.0.1');
    });

    it('can capture a GET webhook with query parameters', function () {
        $response = $this->withoutMiddleware()->get('/webhook?param1=value1&param2=value2');

        $response->assertStatus(200);

        $webhook = Webhook::first();
        expect($webhook->method)->toBe('GET');
        expect($webhook->query_parameters)->toBe([
            'param1' => 'value1',
            'param2' => 'value2',
        ]);
        expect($webhook->body)->toBeEmpty();
    });

    it('can capture a PUT webhook', function () {
        $response = $this->withoutMiddleware()->putJson('/webhook', ['updated' => true]);

        $response->assertStatus(200);

        $webhook = Webhook::first();
        expect($webhook->method)->toBe('PUT');
        expect($webhook->body)->toContain('updated');
    });

    it('can capture a DELETE webhook', function () {
        $response = $this->withoutMiddleware()->delete('/webhook');

        $response->assertStatus(200);

        $webhook = Webhook::first();
        expect($webhook->method)->toBe('DELETE');
    });

    it('can capture a PATCH webhook', function () {
        $response = $this->withoutMiddleware()->patchJson('/webhook', ['patched' => true]);

        $response->assertStatus(200);

        $webhook = Webhook::first();
        expect($webhook->method)->toBe('PATCH');
    });

    it('captures all headers correctly', function () {
        $response = $this->withoutMiddleware()->withHeaders([
            'X-Custom-Header' => 'custom-value',
            'User-Agent' => 'Test/1.0',
            'Origin' => 'https://example.com',
        ])->postJson('/webhook', ['test' => 'data']);

        $response->assertStatus(200);

        $webhook = Webhook::first();
        expect($webhook->headers)->toHaveKey('x-custom-header');
        expect($webhook->headers['x-custom-header'])->toContain('custom-value');
        expect($webhook->user_agent)->toBe('Test/1.0');
        expect($webhook->origin)->toBe('https://example.com');
    });

    it('captures JSON data correctly', function () {
        $data = [
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ],
            'action' => 'created',
        ];

        $response = $this->withoutMiddleware()->postJson('/webhook', $data);

        $response->assertStatus(200);

        $webhook = Webhook::first();
        $bodyData = json_decode($webhook->body, true);
        expect($bodyData['user']['name'])->toBe('John Doe');
        expect($bodyData['action'])->toBe('created');
    });

    it('returns webhook ID and timestamp in response', function () {
        $response = $this->withoutMiddleware()->postJson('/webhook', ['test' => 'data']);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'id',
            'timestamp',
        ]);

        $webhook = Webhook::first();
        $response->assertJson([
            'id' => $webhook->id,
        ]);
    });
});
