@extends('layouts.app')

@section('title', __('Webhook Dashboard'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-1">{{ __('Webhook Dashboard') }}</h1>
                <p class="text-muted">{{ __('Monitor and manage all received webhook requests') }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($webhooks->count() > 0)
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('Timestamp') }}</th>
                                    <th>{{ __('Method') }}</th>
                                    <th>{{ __('URL') }}</th>
                                    <th>{{ __('IP Address') }}</th>
                                    <th>{{ __('Content Type') }}</th>
                                    <th>{{ __('Body Preview') }}</th>
                                    <th class="text-end">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($webhooks as $webhook)
                                    <tr>
                                        <td class="text-nowrap">
                                            <small>{{ $webhook->created_at->format('Y-m-d H:i:s') }}</small>
                                        </td>
                                        <td>
                                            <span class="badge method-badge method-{{ strtolower($webhook->method) }}">
                                                {{ $webhook->method }}
                                            </span>
                                        </td>
                                        <td>
                                            <code class="small text-truncate-custom">{{ $webhook->clean_url }}</code>
                                        </td>
                                        <td>
                                            <code class="small">{{ $webhook->ip_address }}</code>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $webhook->content_type ?: __('Unknown') }}</small>
                                        </td>
                                        <td>
                                            <span class="text-truncate-custom">{{ $webhook->body_preview }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('webhooks.show', $webhook) }}" class="btn btn-sm btn-outline-primary">
                                                {{ __('View Details') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="card text-center py-5">
                <div class="card-body">
                    <svg class="mb-3 text-muted" width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="h5 mb-2">{{ __('No webhooks') }}</h3>
                    <p class="text-muted">{{ __('Get started by sending a webhook request to') }} <code>/webhook</code></p>
                </div>
            </div>
        @endif

        <!-- Always show pagination and per-page controls -->
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <label for="perPage" class="form-label me-2 mb-0">{{ __('Items per page:') }}</label>
                    <select class="form-select form-select-sm" id="perPage" style="width: auto;" onchange="changePerPage(this.value)">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                
                <!-- Pagination Info -->
                @if($webhooks->count() > 0)
                    <div class="text-muted">
                        {{ __('Showing') }} {{ $webhooks->firstItem() }} {{ __('to') }} {{ $webhooks->lastItem() }} {{ __('of') }} {{ $webhooks->total() }} {{ __('results') }}
                    </div>
                @endif
            </div>

            <!-- Always visible pagination -->
            <div class="d-flex justify-content-center">
                <nav aria-label="Webhook pagination">
                    <ul class="pagination pagination-sm">
                        <li class="page-item {{ !$webhooks->onFirstPage() ?: 'disabled' }}">
                            <a class="page-link" href="{{ $webhooks->previousPageUrl() }}" {{ $webhooks->onFirstPage() ? 'tabindex="-1" aria-disabled="true"' : '' }}>
                                {{ __('Previous') }}
                            </a>
                        </li>
                        
                        @if($webhooks->hasPages())
                            <!-- Generate page numbers -->
                            @foreach ($webhooks->getUrlRange(1, $webhooks->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $webhooks->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                        @else
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                        @endif
                        
                        <li class="page-item {{ $webhooks->hasMorePages() ?: 'disabled' }}">
                            <a class="page-link" href="{{ $webhooks->nextPageUrl() }}" {{ !$webhooks->hasMorePages() ? 'tabindex="-1" aria-disabled="true"' : '' }}>
                                {{ __('Next') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="mt-5 py-4 border-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted mb-0">
                    <strong>{{ __('Webhook Store') }}</strong> - {{ __('Development webhook capture system') }}
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-muted mb-0">
                    {{ __('Developed with') }} <span class="text-danger">♥</span>
                </p>
            </div>
        </div>
    </div>
</footer>

<script>
function changePerPage(perPage) {
    const url = new URL(window.location);
    url.searchParams.set('per_page', perPage);
    url.searchParams.delete('page'); // Reset to first page when changing per_page
    window.location = url.toString();
}
</script>

@endsection
