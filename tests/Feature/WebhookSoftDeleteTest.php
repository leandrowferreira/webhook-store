<?php

use App\Models\Webhook;
use Illuminate\Foundation\Testing\RefreshDatabase;

describe('Webhook SoftDeletes', function () {
    uses(RefreshDatabase::class);

    it('soft deletes a webhook and excludes from default queries', function () {
        $webhook = Webhook::create([
            'method' => 'POST',
            'url' => 'http://test.com/webhook',
            'headers' => [],
            'query_parameters' => [],
            'body' => '{}',
            'ip_address' => '127.0.0.1',
        ]);

        $webhook->delete();

        expect(Webhook::find($webhook->id))->toBeNull();
        expect(Webhook::withTrashed()->find($webhook->id))->not->toBeNull();
        expect(Webhook::onlyTrashed()->find($webhook->id))->not->toBeNull();
        expect(Webhook::withTrashed()->find($webhook->id)->deleted_at)->not->toBeNull();
    });

    it('restores a soft deleted webhook', function () {
        $webhook = Webhook::create([
            'method' => 'POST',
            'url' => 'http://test.com/webhook',
            'headers' => [],
            'query_parameters' => [],
            'body' => '{}',
            'ip_address' => '127.0.0.1',
        ]);
        $webhook->delete();
        expect(Webhook::onlyTrashed()->find($webhook->id))->not->toBeNull();
        $webhook->restore();
        expect(Webhook::find($webhook->id))->not->toBeNull();
        expect(Webhook::onlyTrashed()->find($webhook->id))->toBeNull();
        expect(Webhook::find($webhook->id)->deleted_at)->toBeNull();
    });

    it('force deletes a webhook', function () {
        $webhook = Webhook::create([
            'method' => 'POST',
            'url' => 'http://test.com/webhook',
            'headers' => [],
            'query_parameters' => [],
            'body' => '{}',
            'ip_address' => '127.0.0.1',
        ]);
        $id = $webhook->id;
        $webhook->forceDelete();
        expect(Webhook::find($id))->toBeNull();
        expect(Webhook::withTrashed()->find($id))->toBeNull();
        expect(Webhook::onlyTrashed()->find($id))->toBeNull();
    });
});
