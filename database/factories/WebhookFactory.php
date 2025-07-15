<?php

namespace Database\Factories;

use App\Models\Webhook;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebhookFactory extends Factory
{
    protected $model = Webhook::class;

    public function definition(): array
    {
        $methods = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'];
        $contentTypes = ['application/json', 'application/x-www-form-urlencoded', 'text/plain', null];
        
        return [
            'method' => $this->faker->randomElement($methods),
            'url' => $this->faker->url() . '/webhook',
            'headers' => [
                'host' => [$this->faker->domainName()],
                'user-agent' => [$this->faker->userAgent()],
                'accept' => ['application/json'],
                'content-type' => $this->faker->randomElement($contentTypes) ? [$this->faker->randomElement($contentTypes)] : null,
            ],
            'query_parameters' => $this->faker->boolean(30) ? [
                'param1' => $this->faker->word(),
                'param2' => $this->faker->word(),
            ] : [],
            'body' => $this->faker->boolean(70) ? json_encode([
                'message' => $this->faker->sentence(),
                'timestamp' => $this->faker->iso8601(),
                'data' => [
                    'id' => $this->faker->uuid(),
                    'type' => $this->faker->word(),
                    'value' => $this->faker->randomFloat(2, 0, 1000),
                ]
            ]) : '',
            'content_type' => $this->faker->randomElement($contentTypes),
            'user_agent' => $this->faker->userAgent(),
            'ip_address' => $this->faker->ipv4(),
            'origin' => $this->faker->boolean(40) ? $this->faker->url() : null,
            'content_length' => $this->faker->numberBetween(0, 5000),
        ];
    }

    /**
     * Indicate that the webhook is a GET request.
     */
    public function get(): static
    {
        return $this->state(fn (array $attributes) => [
            'method' => 'GET',
            'body' => '',
            'content_type' => null,
            'content_length' => 0,
        ]);
    }

    /**
     * Indicate that the webhook is a POST request.
     */
    public function post(): static
    {
        return $this->state(fn (array $attributes) => [
            'method' => 'POST',
            'content_type' => 'application/json',
        ]);
    }

    /**
     * Indicate that the webhook has JSON body.
     */
    public function withJsonBody(array $data = null): static
    {
        $jsonData = $data ?? [
            'message' => $this->faker->sentence(),
            'timestamp' => now()->toISOString(),
            'user' => [
                'id' => $this->faker->uuid(),
                'name' => $this->faker->name(),
                'email' => $this->faker->email(),
            ]
        ];

        return $this->state(fn (array $attributes) => [
            'body' => json_encode($jsonData),
            'content_type' => 'application/json',
            'content_length' => strlen(json_encode($jsonData)),
        ]);
    }

    /**
     * Indicate that the webhook has form data body.
     */
    public function withFormBody(): static
    {
        $formData = http_build_query([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'message' => $this->faker->sentence(),
        ]);

        return $this->state(fn (array $attributes) => [
            'body' => $formData,
            'content_type' => 'application/x-www-form-urlencoded',
            'content_length' => strlen($formData),
        ]);
    }

    /**
     * Indicate that the webhook has query parameters.
     */
    public function withQueryParams(array $params = null): static
    {
        $queryParams = $params ?? [
            'filter' => $this->faker->word(),
            'sort' => $this->faker->randomElement(['asc', 'desc']),
            'limit' => $this->faker->numberBetween(1, 100),
        ];

        return $this->state(fn (array $attributes) => [
            'query_parameters' => $queryParams,
            'url' => $attributes['url'] . '?' . http_build_query($queryParams),
        ]);
    }

    /**
     * Indicate that the webhook has custom headers.
     */
    public function withHeaders(array $headers): static
    {
        return $this->state(fn (array $attributes) => [
            'headers' => array_merge($attributes['headers'], $headers),
        ]);
    }

    /**
     * Indicate that the webhook is from a specific IP.
     */
    public function fromIp(string $ip): static
    {
        return $this->state(fn (array $attributes) => [
            'ip_address' => $ip,
        ]);
    }

    /**
     * Indicate that the webhook has a specific origin.
     */
    public function fromOrigin(string $origin): static
    {
        return $this->state(fn (array $attributes) => [
            'origin' => $origin,
        ]);
    }
}
