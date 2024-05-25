<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RegisterTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function it_registers_a_user_with_valid_data()
    {
        // Prepare the input data
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'Hesham12345-',
            'phone' => '31234567',
        ];

        // Make the HTTP POST request to register the user
        $response = $this->post('/register', $data);

        // Check that the response redirects to the homepage with a success message
        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Registration successful!');

        // Verify that the user was added to the database
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
            'contact_no' => '31234567',
        ]);

        // Clean up: delete the user
        User::where('email', 'john.doe@example.com')->delete();
    }

    /** @test */
    public function it_requires_valid_data_to_register_a_user()
    {
        // Prepare invalid input data
        $data = [
            'name' => 'John123', // Invalid name
            'email' => 'john.doe@com', // Invalid email
            'password' => 'pass', // Invalid password
            'phone' => '23455678', // Invalid phone (doesn't start with 3, 6, or 1)
        ];

        // Make the HTTP POST request to register the user
        $response = $this->post('/register', $data);

        // Check that the response contains validation errors
        $response->assertSessionHasErrors([
            'name',
            'email',
            'password',
            'phone',
        ]);
    }
}
