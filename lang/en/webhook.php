<?php

return [
    'title' => 'Webhook Store',
    'subtitle' => 'Development webhook capture system',
    'navigation' => [
        'dashboard' => 'Dashboard',
        'webhooks' => 'Webhooks',
        'home' => 'Home',
    ],
    'dashboard' => [
        'title' => 'Webhook Dashboard',
        'description' => 'Monitor and manage all received webhook requests',
        'empty' => [
            'title' => 'No webhooks',
            'description' => 'Start by sending a webhook request to',
            'get_started' => 'Get started by sending a webhook request to',
        ],
    ],
    'table' => [
        'headers' => [
            'id' => 'ID',
            'method' => 'Method',
            'url' => 'URL',
            'timestamp' => 'Timestamp',
            'content_type' => 'Content Type',
            'body' => 'Body',
            'actions' => 'Actions',
        ],
        'actions' => [
            'view_details' => 'View Details',
            'back' => 'Back',
        ],
    ],
    'pagination' => [
        'items_per_page' => 'Items per page:',
        'showing' => 'Showing',
        'to' => 'to',
        'of' => 'of',
        'results' => 'results',
        'previous' => 'Previous',
        'next' => 'Next',
    ],
    'details' => [
        'title' => 'Webhook Details',
        'subtitle' => 'Complete request information',
        'sections' => [
            'basic_info' => 'Basic Information',
            'headers' => 'HTTP Headers',
            'query_parameters' => 'Query Parameters',
            'body' => 'Request Body',
        ],
        'fields' => [
            'id' => 'ID',
            'method' => 'HTTP Method',
            'url' => 'Full URL',
            'clean_url' => 'Clean URL',
            'timestamp' => 'Timestamp',
            'content_type' => 'Content Type',
            'user_agent' => 'User Agent',
            'ip_address' => 'IP Address',
            'origin' => 'Origin',
            'content_length' => 'Content Length',
            'no_headers' => 'No additional headers',
            'no_query_params' => 'No query parameters',
            'no_body' => 'No request body',
            'bytes' => 'bytes',
        ],
    ],
    'footer' => [
        'developed_with' => 'Developed with',
        'by' => 'by',
    ],
    'common' => [
        'unknown' => 'Unknown',
        'none' => 'None',
        'empty' => 'Empty',
    ],
];
