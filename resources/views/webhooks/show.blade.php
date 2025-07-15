@extends('layouts.app')

@section('title', __('Webhook Details'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('webhooks.index') }}" class="btn btn-outline-secondary me-3">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ __('Back') }}
            </a>
            <div>
                <h1 class="h2 mb-1">{{ __('Webhook Details') }}</h1>
                <p class="text-muted">{{ __('Complete request information') }} {{ $webhook->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Request Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('Basic Information') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>{{ __('HTTP Method') }}:</strong>
                                <span class="badge method-badge method-{{ strtolower($webhook->method) }} ms-2">
                                    {{ $webhook->method }}
                                </span>
                            </div>
                            <div class="col-md-6">
                                <strong>{{ __('IP Address') }}:</strong>
                                <code class="ms-2">{{ $webhook->ip_address }}</code>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>{{ __('Full URL') }}:</strong>
                                <div class="code-block mt-2">{{ $webhook->url }}</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <strong>{{ __('User Agent') }}:</strong>
                                <div class="code-block mt-2">{{ $webhook->user_agent ?: __('Unknown') }}</div>
                            </div>
                            <div class="col-md-6">
                                <strong>{{ __('Content Type') }}:</strong>
                                <div class="code-block mt-2">{{ $webhook->content_type ?: __('Unknown') }}</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <strong>{{ __('Content Length') }}:</strong>
                                <span class="ms-2">{{ $webhook->content_length ? number_format($webhook->content_length) . ' ' . __('bytes') : __('Unknown') }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong>{{ __('Origin') }}:</strong>
                                <code class="ms-2">{{ $webhook->origin ?: __('Unknown') }}</code>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Query Parameters -->
                @if(!empty($webhook->query_parameters))
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('Query Parameters') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="code-block">{{ json_encode($webhook->query_parameters, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</div>
                    </div>
                </div>
                @endif

                <!-- Headers -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('HTTP Headers') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="code-block">{{ json_encode($webhook->headers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</div>
                    </div>
                </div>

                <!-- Body -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('Request Body') }}</h5>
                    </div>
                    <div class="card-body">
                        @if($webhook->body)
                            <div class="code-block">{{ $webhook->formatted_body }}</div>
                        @else
                            <p class="text-muted fst-italic">{{ __('No body content') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
