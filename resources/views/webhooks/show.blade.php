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
            <div class="flex-grow-1">
                <h1 class="h2 mb-1">{{ __('Webhook Details') }}</h1>
                <p class="text-muted">{{ __('Complete request information') }} {{ $webhook->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <button type="button" class="btn btn-outline-danger ms-auto" data-bs-toggle="modal" data-bs-target="#deleteWebhookModal">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" class="me-1">
                    <path d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12zm2-10h8v10H8V9zm7-5V4H9v1H4v2h16V5h-5z"/>
                </svg>
                {{ __('Delete') }}
            </button>
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

                <!-- Request Body (Aberto por padrão, aparece primeiro) -->
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between" style="cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#bodyCollapse" aria-expanded="true" aria-controls="bodyCollapse">
                        <span class="fw-bold text-secondary">{{ __('Request Body') }}</span>
                        <span class="chevron transition" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </span>
                    </div>
                    <div id="bodyCollapse" class="collapse show">
                        <div class="card-body p-0">
                            @if($webhook->body)
                                <div id="json-viewer"></div>
                            @else
                            <div class="pt-3 px-3">
                                <p class="text-muted fst-italic">{{ __('No body content') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- HTTP Headers (Fechado por padrão, aparece depois) -->
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between" style="cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#headersCollapse" aria-expanded="false" aria-controls="headersCollapse">
                        <span class="fw-bold text-secondary">{{ __('HTTP Headers') }}</span>
                        <span class="chevron transition collapsed" aria-hidden="true" data-bs-toggle="collapse" data-bs-target="#headersCollapse">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </span>
                    </div>

                    <div id="headersCollapse" class="collapse">
                        <div class="card-body">
                            <div class="code-block">{{ json_encode($webhook->headers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteWebhookModal" tabindex="-1" aria-labelledby="deleteWebhookModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteWebhookModalLabel">{{ __('Confirm Deletion') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>{{ __('Are you sure you want to delete this webhook? This action cannot be undone.') }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <form method="POST" action="{{ route('webhooks.destroy', $webhook) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>window.webhookBody = @json($webhook->body);</script>
@endsection


