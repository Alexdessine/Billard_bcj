<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\BlockMobileAccess;

class MobileDetectionTest extends TestCase
{
    public function test_mobile_detection_with_mobile_user_agent()
    {
        $middleware = new BlockMobileAccess();

        $request = new Request([], [], [], [], [], ['HTTP_USER_AGENT' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)']);

        $this->assertTrue($middleware->isMobile($request));
    }

    public function test_mobile_detection_with_desktop_user_agent()
    {
        $middleware = new BlockMobileAccess();

        $request = new Request([], [], [], [], [], ['HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36']);

        $this->assertFalse($middleware->isMobile($request));
    }
}


