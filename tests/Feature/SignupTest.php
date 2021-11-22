<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignupTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        User::where('phone', '8559108712')->delete();
    }

    public function testSignupWithInvalidPhoneNumber()
    {
        $response = $this->post('/register', ['phone' => '123']);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['phone']);
    }

    public function testSignupWithNoPhoneNumber()
    {
        $response = $this->post('/register', []);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['phone']);
    }

    public function testSignupWithValidPhoneNumber()
    {
        $response = $this->post('/register', ['phone' => '855-910-8712']);

        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors(['phone']);

        $this->assertDatabaseHas('users', [
            'phone' => '8559108712',
        ]);
    }

    public function testSignupWithSamePhoneNumber()
    {
        User::create(['phone' => '8559108712', 'code' => 'foo']);

        $response = $this->followingRedirects()
            ->post('/register', ['phone' => '855-910-8712']);

        $response->assertSee('https://nudge.sh/foo');
    }
}
