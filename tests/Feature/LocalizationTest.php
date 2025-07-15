<?php

use App\Models\Webhook;

describe('Localization', function () {
    it('has correct default locale', function () {
        expect(app()->getLocale())->toBe('pt_BR');
    });

    it('has correct fallback locale', function () {
        expect(app()->getFallbackLocale())->toBe('en');
    });

    it('can translate common phrases', function () {
        expect(__('Webhook Dashboard'))->toBe('Dashboard de Webhooks');
        expect(__('View Details'))->toBe('Ver Detalhes');
        expect(__('Method'))->toBe('Método');
        expect(__('IP Address'))->toBe('Endereço IP');
        expect(__('Actions'))->toBe('Ações');
    });

    it('falls back to original text for untranslated phrases', function () {
        expect(__('Untranslated Phrase'))->toBe('Untranslated Phrase');
    });

    it('handles pluralization correctly', function () {
        expect(__('results'))->toBe('resultados');
    });

    it('displays translated content in dashboard', function () {
        // Criar um webhook para o dashboard mostrar a tabela
        Webhook::factory()->create();
        
        $response = $this->get('/webhooks');
        
        $response->assertSee('Dashboard de Webhooks');
        $response->assertSee('Método');
        $response->assertSee('Endereço IP');
        $response->assertSee('Ver Detalhes');
    });

    it('can change locale temporarily', function () {
        app()->setLocale('en');
        
        expect(__('Webhook Dashboard'))->toBe('Webhook Dashboard');
        expect(__('View Details'))->toBe('View Details');
        
        // Restore original locale
        app()->setLocale('pt_BR');
    });
});
