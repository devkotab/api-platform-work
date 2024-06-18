<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ReviewTest extends ApiTestCase
{
    public function testCreateReview(): void
    {
        static::createClient()->request('POST', '/reviews', [
            'json' => [
                'book'=> '/books/1',
                'rating'=> '5',
                'body'=> 'Good Book',
                'author' => 'Kévin',
                'publicationDate'=> 'September 1 2021',
            ],
            'headers' => [
                'Content-Type' => 'application/ld+json',
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            '@context' => '/contexts/reviews',
            '@type' => 'Review',
            'book' => '/books/1',
            'rating'=> '5',
            'author'=> 'Kévin',
        ]);
    }
}
