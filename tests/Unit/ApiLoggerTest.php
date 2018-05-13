<?php

namespace Tests\Unit;

use App\Team;
use Tests\TestCase;

class ApiLoggerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiSendLog()
    {
        $team = Team::first();

        $response = $this->call('get', '/api/logs', [
            'name'    => $team->slug,
            'token'   => $team->token,
            'message' => '{"buildVersion":"1.0.549 2018-05-10 12:08","level":"ERROR","message":{"arguments":["method",null],"type":"non_object_property_load","message":"Cannot read property \'method\' of undefined","stack":"TypeError: Cannot read property \'method\' of undefined\n    at https://smi2.net/dashboard/scripts/app-4f2f8758e8.js:15:23813\n    at l (https://smi2.net/dashboard/scripts/vendor-6b59539b13.js:42:31028)\n    at https://smi2.net/dashboard/scripts/vendor-6b59539b13.js:42:31200\n    at f.$eval (https://smi2.net/dashboard/scripts/vendor-6b59539b13.js:43:6701)\n    at f.$digest (https://smi2.net/dashboard/scripts/vendor-6b59539b13.js:43:5210)\n    at https://smi2.net/dashboard/scripts/vendor-6b59539b13.js:43:6789\n    at r (https://smi2.net/dashboard/scripts/vendor-6b59539b13.js:41:21520)\n    at https://smi2.net/dashboard/scripts/vendor-6b59539b13.js:41:22974"},"url":"https://smi2.net/dashboard/login","timestamp":"2018-05-13T14:55:40.553Z","userAgent":"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24"}'
        ]);

        $response->assertStatus(200);
    }
}
