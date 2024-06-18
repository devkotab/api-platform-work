<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class BookTest extends ApiTestCase
{
    public function testCreateBook(): void
    {
        static::createClient()->request('POST', '/books', [
            'json' => [
                'isbn' => '9781782164104',
                'title' => 'Doctrine ORM Fundamentals',
                'description' => 'Dr Who',
                'author' => 'Who',
                'publicationDate' => '2013-12-01',
            ],
            'headers' => [
                'Content-Type' => 'application/ld+json',
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            '@context' => '/contexts/books',
            '@type' => 'Book',
            'isbn' => '9781782164104',
            'title'=> 'Doctrine ORM Fundamentals',
        ]);
    }
}