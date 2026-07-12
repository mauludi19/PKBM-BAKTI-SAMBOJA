<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Pengujian login berhasil.
     */
    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $response = $this->post('/login', [
            'email' => 'admin@pkbm.com',
            'password' => 'password123',
        ]);


        $response->assertRedirect();


        $this->assertAuthenticatedAs($user);
    }



    /**
     * Pengujian login gagal karena password salah.
     */
    public function test_user_cannot_login_with_wrong_password()
    {
        User::factory()->create([
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
        ]);


        $response = $this->post('/login', [
            'email' => 'admin@pkbm.com',
            'password' => 'salahpassword',
        ]);


        $response->assertSessionHasErrors();


        $this->assertGuest();
    }



    /**
     * Pengujian login gagal karena email tidak ada.
     */
    public function test_user_cannot_login_with_invalid_email()
    {
        $response = $this->post('/login', [
            'email' => 'tidakada@gmail.com',
            'password' => 'password123',
        ]);


        $response->assertSessionHasErrors();


        $this->assertGuest();
    }



    /**
     * Pengujian validasi email kosong.
     */
    public function test_email_is_required()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'password123',
        ]);


        $response->assertSessionHasErrors('email');
    }



    /**
     * Pengujian validasi password kosong.
     */
    public function test_password_is_required()
    {
        $response = $this->post('/login', [
            'email' => 'admin@pkbm.com',
            'password' => '',
        ]);


        $response->assertSessionHasErrors('password');
    }
}