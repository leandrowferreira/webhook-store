<?php

use App\Models\Webhook;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Webhook Dashboard', function () {
    beforeEach(function () {
        // Criar alguns webhooks de teste
        Webhook::factory()->create([
            'method' => 'POST',
            'url' => 'http://localhost/webhook',
            'body' => json_encode(['message' => 'Test POST']),
            'content_type' => 'application/json',
            'ip_address' => '192.168.1.1',
            'created_at' => now()->subMinutes(5),
        ]);

        Webhook::factory()->create([
            'method' => 'GET',
            'url' => 'http://localhost/webhook?test=true',
            'query_parameters' => ['test' => 'true'],
            'body' => '',
            'content_type' => null,
            'ip_address' => '192.168.1.2',
            'created_at' => now()->subMinutes(10),
        ]);

        Webhook::factory()->create([
            'method' => 'PUT',
            'url' => 'http://localhost/webhook',
            'body' => json_encode(['updated' => true]),
            'content_type' => 'application/json',
            'ip_address' => '192.168.1.3',
            'created_at' => now()->subMinutes(15),
        ]);
    });

    it('can access dashboard index page', function () {
        $response = $this->get('/webhooks');

        $response->assertStatus(200);
        $response->assertViewIs('webhooks.index');
        $response->assertViewHas('webhooks');
    });

    it('can access dashboard via /dashboard route', function () {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('webhooks.index');
    });

    it('redirects root to dashboard', function () {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect(route('webhooks.index'));
    });

    it('displays webhooks in correct order (newest first)', function () {
        $response = $this->get('/webhooks');

        $response->assertStatus(200);
        $webhooks = $response->viewData('webhooks');

        expect($webhooks->count())->toBe(3);
        expect($webhooks->first()->method)->toBe('POST'); // Mais recente
        expect($webhooks->last()->method)->toBe('PUT'); // Mais antigo
    });

    it('supports pagination', function () {
        // Criar mais webhooks para testar paginação
        Webhook::factory()->count(15)->create();

        $response = $this->get('/webhooks?per_page=10');

        $response->assertStatus(200);
        $webhooks = $response->viewData('webhooks');

        expect($webhooks->count())->toBe(10);
        expect($webhooks->hasPages())->toBeTrue();
    });

    it('validates per_page parameter', function () {
        $response = $this->get('/webhooks?per_page=999');

        $response->assertStatus(200);
        $webhooks = $response->viewData('webhooks');

        // Deve voltar ao padrão (10) se valor inválido
        expect($webhooks->perPage())->toBe(10);
    });

    it('preserves query parameters in pagination', function () {
        Webhook::factory()->count(15)->create();

        $response = $this->get('/webhooks?per_page=5');

        $response->assertStatus(200);
        $webhooks = $response->viewData('webhooks');

        expect($webhooks->appends(request()->query()))->not->toBeNull();
    });

    it('displays webhook details correctly', function () {
        $webhook = Webhook::first();

        $response = $this->get("/webhooks/{$webhook->id}");

        $response->assertStatus(200);
        $response->assertViewIs('webhooks.show');
        $response->assertViewHas('webhook', $webhook);
    });

    it('returns 404 for non-existent webhook', function () {
        $response = $this->get('/webhooks/999');

        $response->assertStatus(404);
    });

    it('displays translated content', function () {
        // Set locale to pt_BR for this test
        app()->setLocale('pt_BR');

        $response = $this->get('/webhooks');

        $response->assertStatus(200);
        $response->assertSee('Dashboard de Webhooks');
        $response->assertSee('Ver Detalhes');
    });
});
