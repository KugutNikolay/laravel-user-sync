<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncUsersCommand extends Command
{
    protected $signature = 'users:sync';

    protected $description = 'Synchronize user data from JSONPlaceholder';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->syncUsers();
    }

    private function syncUsers()
    {
        // Retrieve user data from JSONPlaceholder API
        $response = Http::get('https://jsonplaceholder.typicode.com/users');

        if ($response->failed()) {
            // Log the error message if the API request fails
            $errorMessage = $response->serverError() ? 'Server error occurred.' : 'Failed to retrieve user data from the API.';
            Log::error($errorMessage);
            $this->error($errorMessage);
            return;
        }

        // Extract users from API response
        $users = $response->json();
        $ids = array_column($users, 'id');

        // Restore soft-deleted users if they exist in the API response
        User::whereIn('id', $ids)->restore();
        // Soft-delete users that are absent in the API response
        User::whereNotIn('id', $ids)->delete();

        foreach ($users as $user) {
            // Update or create user based on the ID
            User::updateOrCreate(
                ['id' => $user['id']],
                [
                    'id'                   => $user['id'],
                    'name'                 => $user['name'] ?? '',
                    'username'             => $user['username'] ?? '',
                    'email'                => $user['email'] ?? '',
                    'street'               => $user['address']['street'] ?? '',
                    'suite'                => $user['address']['suite'] ?? '',
                    'city'                 => $user['address']['city'] ?? '',
                    'zipcode'              => $user['address']['zipcode'] ?? '',
                    'geo_lat'              => $user['address']['geo']['lat'] ?? '',
                    'geo_lng'              => $user['address']['geo']['lng'] ?? '',
                    'phone'                => $user['phone'] ?? '',
                    'website'              => $user['website'] ?? '',
                    'company_name'         => $user['company']['name'] ?? '',
                    'company_catch_phrase' => $user['company']['catchPhrase'] ?? '',
                    'company_bs'           => $user['company']['bs'] ?? '',
                ]
            );
        }

        $this->info(__('User synchronization complete'));
    }
}
