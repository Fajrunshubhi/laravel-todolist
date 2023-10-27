<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "fajrun",
            "password" => 123
        ])->assertRedirect("/")->assertSessionHas("user", "fajrun");
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText("User Or Password Is Required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User or Password Is Wrong");
    }
}
