<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function a_user_can_register()
    {
    
        $response = $this->post('/register', [
            'name' => 'kossay',
            'email' => 'kossay@example.com',
            'password' => '123456789',
            'password_confirmation' => '123456789',
        ]);

      
        $this->assertAuthenticated();
        $this->assertEquals('kossay', auth()->user()->name);
 
        $response->assertRedirect('/home');
    }

    public function a_user_can_login()
    {
 
        $this->post('/register', [
            'name' => 'kossay',
            'email' => 'kossay@example.com',
            'password' => '123456789',
            'password_confirmation' => '123456789',
        ]);

       
        $response = $this->post('/login', [
            'email' => 'kossay',
            'password' => '123456789',
        ]);
        
        $this->assertAuthenticated(); 
        $response->assertRedirect('/home'); 
    }

    /** @test */
    public function a_user_can_visit_home_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
