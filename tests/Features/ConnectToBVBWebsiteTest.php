<?php

namespace BVB\Tests\Features;

class ConnectToBVBWebsiteTest extends BaseTestCase
{
    public function testAccesingBVBWebsite()
    {
        $response = $this->get('https://bvb.ro');
        $this->assertTrue(200 === $response->getStatusCode());
    }
}
