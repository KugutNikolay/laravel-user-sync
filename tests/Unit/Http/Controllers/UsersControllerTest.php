<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_method_returns_view_with_paginated_users()
    {

        // Call the get() method on the UsersController
        $controller = new UsersController();
        $response = $controller->get();

        // Assert that the response is a View instance
        $this->assertInstanceOf(View::class, $response);

        // Assert that the view has the correct name
        $this->assertEquals('users.index', $response->getName());

        // Assert that the view has the 'users' variable
        $this->assertTrue($response->offsetExists('users'));

        // Get the value of the 'users' variable from the view
        $users = $response->offsetGet('users');

        // Assert that the users variable is a LengthAwarePaginator instance
        $this->assertInstanceOf(LengthAwarePaginator::class, $users);
    }
}
