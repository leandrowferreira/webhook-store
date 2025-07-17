<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('webhooks.index');
});

// Webhook endpoint para receber dados
Route::any('/webhook', [WebhookController::class, 'receive'])->name('webhook.receive');

// Dashboard redirect para compatibilidade
Route::get('/dashboard', [WebhookController::class, 'index'])->name('dashboard');

// Rotas RESTful para webhooks
Route::resource('/webhooks', WebhookController::class)->only(['index', 'show', 'destroy']);
