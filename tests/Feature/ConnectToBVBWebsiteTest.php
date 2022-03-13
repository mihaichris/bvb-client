<?php

namespace BVB\Tests\Feature;

test('can access Bucharest Stock Exchange website', function () {
    $response = http('GET', 'https://bvb.ro');
    $this->assertTrue(200 === $response->getStatusCode());
})->group('browser', 'sanity');
