<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Student;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Membuat user.
     */
    private function createUser($role)
    {
        return User::create([
            'name' => ucfirst($role),
            'email' => $role . '@gmail.com',
            'password' => bcrypt('password123'),
            'role' => $role,
        ]);
    }

    /**
     * Admin dapat mengakses dashboard admin.
     */
    public function test_admin_can_access_admin_dashboard()
    {
        $admin = $this->createUser('admin');

        $response = $this
            ->actingAs($admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    /**
     * Tutor dapat mengakses dashboard tutor.
     */
    public function test_tutor_can_access_tutor_dashboard()
    {
        $user = $this->createUser('tutor');

        Tutor::create([
            'user_id' => $user->id,
            'npsn' => '198765',
            'gender' => 'L',
            'education' => 'S1 Pendidikan',
            'specialization' => 'Matematika',
            'phone' => '08123456789',
            'address' => 'Samboja',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('tutor.dashboard'));

        $response->assertStatus(200);
    }

    /**
     * Student dapat mengakses dashboard student.
     */
    public function test_student_can_access_student_dashboard()
    {
        $package = Package::create([
            'name' => 'Paket C',
        ]);

        $user = $this->createUser('student');

        Student::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'nisn' => '1234567890',
            'nik' => '6401111111111111',
            'gender' => 'L',
            'birth_place' => 'Samboja',
            'birth_date' => '2008-01-01',
            'address' => 'Samboja',
            'phone' => '08123456789',
            'parent_name' => 'Budi',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('student.dashboard'));

        $response->assertStatus(200);
    }

    /**
     * Tutor tidak boleh mengakses dashboard admin.
     */
    public function test_tutor_cannot_access_admin_dashboard()
    {
        $user = $this->createUser('tutor');

        Tutor::create([
            'user_id' => $user->id,
            'npsn' => '198765',
            'gender' => 'L',
            'education' => 'S1',
            'specialization' => 'IPA',
            'phone' => '08123',
            'address' => 'Samboja',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    /**
     * Student tidak boleh mengakses dashboard admin.
     */
    public function test_student_cannot_access_admin_dashboard()
    {
        $package = Package::create([
            'name' => 'Paket B',
        ]);

        $user = $this->createUser('student');

        Student::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'nisn' => '111111111',
            'nik' => '222222222',
            'gender' => 'L',
            'birth_place' => 'Samboja',
            'birth_date' => '2007-01-01',
            'address' => 'Alamat',
            'phone' => '08123',
            'parent_name' => 'Ayah',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    /**
     * Student tidak boleh mengakses dashboard tutor.
     */
    public function test_student_cannot_access_tutor_dashboard()
    {
        $package = Package::create([
            'name' => 'Paket A',
        ]);

        $user = $this->createUser('student');

        Student::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'nisn' => '99999999',
            'nik' => '88888888',
            'gender' => 'P',
            'birth_place' => 'Samboja',
            'birth_date' => '2006-01-01',
            'address' => 'Alamat',
            'phone' => '08123',
            'parent_name' => 'Orang Tua',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('tutor.dashboard'));

        $response->assertStatus(403);
    }

    /**
     * Guest harus login terlebih dahulu.
     */
    public function test_guest_cannot_access_dashboard()
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Dashboard tutor menampilkan 404 jika data tutor tidak ada.
     */
    public function test_dashboard_tutor_returns_404_if_tutor_not_found()
    {
        $user = $this->createUser('tutor');

        $response = $this
            ->actingAs($user)
            ->get(route('tutor.dashboard'));

        $response->assertStatus(404);
    }

    /**
     * Dashboard student menampilkan 404 jika data student tidak ada.
     */
    public function test_dashboard_student_returns_404_if_student_not_found()
    {
        $user = $this->createUser('student');

        $response = $this
            ->actingAs($user)
            ->get(route('student.dashboard'));

        $response->assertStatus(404);
    }
}