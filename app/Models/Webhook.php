<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webhook extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'method',
        'url',
        'headers',
        'query_parameters',
        'body',
        'content_type',
        'user_agent',
        'ip_address',
        'origin',
        'content_length',
    ];

    protected $casts = [
        'headers' => 'array',
        'query_parameters' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getBodyPreviewAttribute()
    {
        if (empty($this->body)) {
            return 'Empty body';
        }

        $preview = substr($this->body, 0, 100);

        return strlen($this->body) > 100 ? $preview.'...' : $preview;
    }

    public function getFormattedBodyAttribute()
    {
        if (empty($this->body)) {
            return null;
        }

        // Try to decode as JSON first
        $decoded = json_decode($this->body, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // If not JSON, return as is
        return $this->body;
    }

    public function getCleanUrlAttribute()
    {
        $parsed = parse_url($this->url);
        $path = $parsed['path'] ?? '/';

        if (! empty($this->query_parameters)) {
            $queryString = http_build_query($this->query_parameters);

            return $path.'?'.$queryString;
        }

        return $path;
    }
}
