<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Package;
use Illuminate\Support\Facades\Hash;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        // menjalankan seluruh seeder
        $this->seed();
    }


    public function test_admin_can_create_student()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);


        $package = Package::first();


        $response = $this
            ->actingAs($admin)
            ->post(route('admin.students.store'), [

                'name' => 'Alber',

                'email' => 'alber@gmail.com',

                'package_id' => $package->id,

                'nisn' => '1234567890',

                'nik' => '6401',

                'gender' => 'L',

                'birth_place' => 'Samboja',

                'birth_date' => '2004-05-20',

                'address' => 'Jl. Contoh',

                'phone' => '08123456789',

                'parent_name' => 'Budi',

                'status' => 'active',
            ]);


        $response->assertRedirect(route('admin.students.index'));

        $response->assertSessionHas('success');


        $this->assertDatabaseHas('users', [
            'email' => 'alber@gmail.com'
        ]);


        $this->assertDatabaseHas('students', [
            'nisn' => '1234567890'
        ]);
    }



    public function test_email_is_required()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin2@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);


        $package = Package::first();


        $response = $this
            ->actingAs($admin)
            ->from(route('admin.students.create'))
            ->post(route('admin.students.store'), [

                'name' => 'Alber',

                'email' => '',

                'package_id' => $package->id,

                'nisn' => '111111',

                'gender' => 'L',

                'status' => 'active',
            ]);


        $response->assertRedirect(route('admin.students.create'));

        $response->assertSessionHasErrors('email');
    }



    public function test_email_must_be_unique()
    {

        User::create([
            'name' => 'User Lama',
            'email' => 'alber@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);


        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin3@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);


        $package = Package::first();


        $response = $this
            ->actingAs($admin)
            ->post(route('admin.students.store'), [

                'name' => 'Alber',

                'email' => 'alber@gmail.com',

                'package_id' => $package->id,

                'nisn' => '12345',

                'gender' => 'L',

                'status' => 'active',
            ]);


        $response->assertSessionHasErrors('email');
    }




    public function test_nisn_must_be_unique()
    {

        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin4@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);


        $package = Package::first();


        $user = User::create([
            'name' => 'Siswa Lama',
            'email' => 'siswa@test.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);


        Student::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'nisn' => '99999',
            'gender' => 'L',
            'status' => 'active',
        ]);



        $response = $this
            ->actingAs($admin)
            ->post(route('admin.students.store'), [

                'name' => 'Alber',

                'email' => 'baru@gmail.com',

                'package_id' => $package->id,

                'nisn' => '99999',

                'gender' => 'L',

                'status' => 'active',
            ]);


        $response->assertSessionHasErrors('nisn');
    }




    public function test_package_must_exist()
    {

        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin5@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);



        $response = $this
            ->actingAs($admin)
            ->post(route('admin.students.store'), [

                'name' => 'Alber',

                'email' => 'alber@gmail.com',

                'package_id' => 999,

                'nisn' => '12345',

                'gender' => 'L',

                'status' => 'active',
            ]);


        $response->assertSessionHasErrors('package_id');
    }
}