<?php

namespace App\Http\Controllers;

use App\Models\Webhook;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Receive and store webhook requests
     */
    public function receive(Request $request)
    {
        $rawBody = $request->getContent();
        // Garante que o corpo está em UTF-8
        $body = mb_convert_encoding($rawBody, 'UTF-8', 'auto');
        $webhook = Webhook::create([
            'method' => $request->getMethod(),
            'url' => $request->fullUrl(),
            'headers' => $request->headers->all(),
            'query_parameters' => $request->query->all(),
            'body' => $body,
            'content_type' => $request->header('Content-Type'),
            'user_agent' => $request->header('User-Agent'),
            'ip_address' => $request->ip(),
            'origin' => $request->header('Origin'),
            'content_length' => $request->header('Content-Length'),
        ]);

        return response()->json([
            'message' => 'Webhook received successfully',
            'id' => $webhook->id,
            'timestamp' => $webhook->created_at->toISOString(),
        ], 200);
    }

    /**
     * List all webhooks with pagination
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        // Validate per_page parameter
        if (! in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $webhooks = Webhook::latest()
            ->paginate($perPage)
            ->withQueryString(); // Preserve query parameters in pagination links

        return view('webhooks.index', compact('webhooks'));
    }

    /**
     * Show detailed view of a specific webhook
     */
    public function show(Webhook $webhook)
    {
        return view('webhooks.show', compact('webhook'));
    }

    /**
     * Delete a webhook
     */
    public function destroy(Webhook $webhook)
    {
        $webhook->delete();

        return redirect()->route('webhooks.index')
            ->with('success', __('Webhook deleted successfully.'));
    }
}
