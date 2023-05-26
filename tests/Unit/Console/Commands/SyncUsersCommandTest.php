<?php

namespace Tests\Unit\Console\Commands;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SyncUsersCommandTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_syncs_users_from_json_placeholder_api()
    {


        // Disable logging during the test
        Log::spy();

        // Mock API response
        Http::fake([
            'jsonplaceholder.typicode.com/*' => Http::response([
                [
                    'id' => 1,
                    'name' => 'John Doe',
                    'email' => 'johndoe@example.com',
                    'address' => [
                        'street' => '123 Main St',
                        'suite' => 'Apt 4',
                        'city' => 'New York',
                        'zipcode' => '12345',
                        'geo' => [
                            'lat' => '40.7128',
                            'lng' => '-74.0060',
                        ],
                    ],
                    'phone' => '555-1234',
                    'website' => 'johndoe.com',
                    'company' => [
                        'name' => 'Acme Inc',
                        'catchPhrase' => 'Making the world a better place',
                        'bs' => 'Innovative solutions',
                    ],
                ],
            ]),
        ]);

        // Run the sync command
        $this->artisan('users:sync')
            ->expectsOutput('User synchronization complete')
            ->assertExitCode(0);

        // Assert users are synchronized in the database
        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '555-1234',
            'website' => 'johndoe.com',
            'street' => '123 Main St',
            'suite' => 'Apt 4',
            'city' => 'New York',
            'zipcode' => '12345',
            'geo_lat' => '40.7128',
            'geo_lng' => '-74.0060',
            'company_name' => 'Acme Inc',
            'company_catch_phrase' => 'Making the world a better place',
            'company_bs' => 'Innovative solutions',
        ]);

        // Assert no errors were logged
        Log::assertNotLogged('error');
    }

}
