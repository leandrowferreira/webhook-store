<?php

describe('Application Routes', function () {
    it('has webhook capture route', function () {
        $response = $this->post('/webhook', ['test' => 'data']);
        $response->assertStatus(200);
    });

    it('has dashboard route', function () {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    });

    it('has webhooks index route', function () {
        $response = $this->get('/webhooks');
        $response->assertStatus(200);
    });

    it('redirects root to webhooks index', function () {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/webhooks');
    });

    it('accepts all HTTP methods on webhook endpoint', function () {
        $methods = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'];
        
        foreach ($methods as $method) {
            $response = $this->call($method, '/webhook', ['test' => 'data']);
            expect($response->getStatusCode())->toBe(200);
        }
    });

    it('has correct route names', function () {
        expect(route('webhook.receive'))->toBe(url('/webhook'));
        expect(route('webhooks.index'))->toBe(url('/webhooks'));
        expect(route('dashboard'))->toBe(url('/dashboard'));
    });
});
