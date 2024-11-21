<?php

namespace Tests\Feature;

use Tests\TestCase;

class BlockMobileAccessTest extends TestCase
{
    public function test_mobile_access_is_blocked()
    {
        $response = $this->get('/test-block', [
            'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)'
        ]);

        $response->assertStatus(403);
        $response->assertSee('Accès interdit depuis un appareil mobile.');
    }

    public function test_desktop_access_is_allowed()
    {
        $response = $this->get('/test-block', [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36'
        ]);

        $response->assertStatus(200);
        $response->assertSee('Accessible');
    }

}


