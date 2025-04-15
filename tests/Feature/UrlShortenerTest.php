<?php

namespace Tests\Feature;

use App\Contracts\CryptoService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    protected CryptoService $cryptoService;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->cryptoService = app()->make(CryptoService::class);
    }

    public function test_encode(): void
    {
        $response = $this->postJson('/api/encode', [
            'url' => 'https://example.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['url']);
    }

    public function test_encode_invalid_url(): void
    {
        $response = $this->postJson('/api/encode', [
            'url' => 'invalid-url',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['url']);
    }

    public function test_encode_missing_url(): void
    {
        $response = $this->postJson('/api/encode');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['url']);
    }

    public function test_decode(): void
    {
        $original = 'https://example.com';
        $shortened = $this->cryptoService->encode($original);

        $queryParameters = [
            'url' => $shortened,
        ];

        $response = $this->get('/api/decode' . '?' . http_build_query($queryParameters));

        $response->assertStatus(200)
            ->assertJsonStructure(['url'])
            ->assertJson(['url' => $original]);
    }

    public function test_decode_invalid_url(): void
    {
        $queryParameters = [
            'url' => 'invalid-url',
        ];

        $response = $this->get('/api/decode' . '?' . http_build_query($queryParameters));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['url']);
    }

    public function test_decode_missing_url(): void
    {
        $response = $this->get('/api/decode');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['url']);
    }

    public function test_decode_new_url(): void
    {
        $queryParameters = [
            'url' => 'https://google.com/' . rand(),
        ];

        $response = $this->get('/api/decode' . '?' . http_build_query($queryParameters));

        $response->assertStatus(404)
            ->assertJson(['error' => 'URL not found']);
    }

    public function test_encode_and_decode(): void
    {
        $originalUrl = 'https://www.thisisalongdomain.com/with/some/parameters?and=here_too';

        // Encode the URL
        $encodeResponse = $this->postJson('/api/encode', [
            'url' => $originalUrl,
        ]);

        $encodeResponse->assertStatus(200)
            ->assertJsonStructure(['url']);

        $shortenedUrl = $encodeResponse->json('url');

        // Decode the URL
        $decodeResponse = $this->get('/api/decode' . '?' . http_build_query(['url' => $shortenedUrl]));

        $decodeResponse->assertStatus(200)
            ->assertJson(['url' => $originalUrl]);
    }
}
