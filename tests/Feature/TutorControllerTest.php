<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tutor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TutorControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Pengujian halaman daftar tutor
     */
    public function test_admin_can_view_tutor_index()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $response = $this
            ->actingAs($admin)
            ->get(route('admin.tutors.index'));


        $response->assertStatus(200);
    }



    /**
     * Pengujian tambah tutor berhasil
     */
    public function test_admin_can_create_tutor()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $response = $this
            ->actingAs($admin)
            ->post(route('admin.tutors.store'), [

                'name' => 'Budi Santoso',

                'email' => 'budi@gmail.com',

                'npsn' => '12345',

                'gender' => 'L',

                'education' => 'S1 Pendidikan',

                'specialization' => 'Matematika',

                'phone' => '08123456789',

                'address' => 'Samboja',

            ]);


        $response->assertRedirect(
            route('admin.tutors.index')
        );


        $response->assertSessionHas('success');


        $this->assertDatabaseHas('users', [
            'email' => 'budi@gmail.com',
            'role' => 'tutor',
        ]);


        $this->assertDatabaseHas('tutors', [
            'npsn' => '12345',
        ]);
    }




    /**
     * Pengujian email wajib diisi
     */
    public function test_tutor_email_is_required()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $response = $this
            ->actingAs($admin)
            ->post(route('admin.tutors.store'), [

                'name' => 'Budi',

                'email' => '',

                'gender' => 'L',

            ]);


        $response->assertSessionHasErrors('email');
    }





    /**
     * Pengujian email duplikat
     */
    public function test_tutor_email_must_be_unique()
    {
        User::create([
            'name' => 'Tutor Lama',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'tutor',
        ]);


        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $response = $this
            ->actingAs($admin)
            ->post(route('admin.tutors.store'), [

                'name' => 'Tutor Baru',

                'email' => 'budi@gmail.com',

                'gender' => 'L',

            ]);


        $response->assertSessionHasErrors('email');
    }





    /**
     * Pengujian gender harus L atau P
     */
    public function test_gender_must_be_L_or_P()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $response = $this
            ->actingAs($admin)
            ->post(route('admin.tutors.store'), [

                'name' => 'Budi',

                'email' => 'budi@gmail.com',

                'gender' => 'X',

            ]);


        $response->assertSessionHasErrors('gender');
    }







    /**
     * Pengujian detail tutor
     */
    public function test_admin_can_view_tutor_detail()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $user = User::create([
            'name' => 'Tutor Lama',
            'email' => 'tutor@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'tutor',
        ]);


        $tutor = Tutor::create([
            'user_id' => $user->id,
            'npsn' => '11111',
            'gender' => 'L',
            'education' => 'S1',
            'specialization' => 'IPA',
            'phone' => '081111111',
            'address' => 'Samboja',
        ]);



        $response = $this
            ->actingAs($admin)
            ->get(
                route('admin.tutors.show', $tutor)
            );


        $response->assertStatus(200);
    }







    /**
     * Pengujian update tutor
     */
    public function test_admin_can_update_tutor()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $user = User::create([
            'name' => 'Tutor Lama',
            'email' => 'lama@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'tutor',
        ]);


        $tutor = Tutor::create([
            'user_id' => $user->id,
            'npsn' => '11111',
            'gender' => 'L',
        ]);



        $response = $this
            ->actingAs($admin)
            ->put(
                route('admin.tutors.update', $tutor),
                [

                    'name' => 'Tutor Update',

                    'email' => 'update@gmail.com',

                    'npsn' => '22222',

                    'gender' => 'P',

                    'education' => 'S2',

                    'specialization' => 'Bahasa',

                    'phone' => '082222222',

                    'address' => 'Balikpapan',

                ]
            );



        $response->assertRedirect(
            route('admin.tutors.index')
        );


        $this->assertDatabaseHas('users', [
            'email' => 'update@gmail.com',
        ]);


        $this->assertDatabaseHas('tutors', [
            'npsn' => '22222',
        ]);
    }








    /**
     * Pengujian hapus tutor
     */
    public function test_admin_can_delete_tutor()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $user = User::create([
            'name' => 'Tutor Hapus',
            'email' => 'hapus@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'tutor',
        ]);


        $tutor = Tutor::create([
            'user_id' => $user->id,
            'npsn' => '99999',
            'gender' => 'L',
        ]);



        $response = $this
            ->actingAs($admin)
            ->delete(
                route('admin.tutors.destroy', $tutor)
            );



        $response->assertRedirect(
            route('admin.tutors.index')
        );


        $this->assertDatabaseMissing(
            'tutors',
            [
                'id' => $tutor->id,
            ]
        );


        $this->assertDatabaseMissing(
            'users',
            [
                'id' => $user->id,
            ]
        );
    }

}