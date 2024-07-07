<?php

namespace YuvrajJhala\BacsPackage\Tests\Feature;

use Tests\TestCase;

class BacsControllerTest extends TestCase
{
    public function test_it_returns_bacs_response(): void
    {
        $response = $this->getJson('/api/v1/bacs-response');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'vol',
                    'hdr1',
                    'hdr2',
                    'uhl',
                    'standard',
                    'eof1',
                    'eof2',
                    'utl',
                ],
            ]);
    }
}
