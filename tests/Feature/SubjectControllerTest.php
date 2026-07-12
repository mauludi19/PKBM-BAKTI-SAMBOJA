<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Admin dapat melihat daftar mata pelajaran
     */
    public function test_admin_can_view_subject_index()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $response = $this
            ->actingAs($admin)
            ->get(route('admin.subjects.index'));


        $response->assertStatus(200);
    }





    /**
     * Admin dapat membuka form tambah
     */
    public function test_admin_can_view_subject_create_page()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);


        $response = $this
            ->actingAs($admin)
            ->get(route('admin.subjects.create'));


        $response->assertStatus(200);
    }






    /**
     * Admin dapat menambah mata pelajaran
     */
    public function test_admin_can_create_subject()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);



        $response = $this
            ->actingAs($admin)
            ->post(
                route('admin.subjects.store'),
                [

                    'code' => 'MTK01',

                    'name' => 'Matematika',

                ]
            );



        $response->assertRedirect(
            route('admin.subjects.index')
        );


        $response->assertSessionHas('success');


        $this->assertDatabaseHas('subjects', [

            'code' => 'MTK01',

            'name' => 'Matematika',

        ]);
    }








    /**
     * Kode mata pelajaran wajib
     */
    public function test_subject_code_is_required()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);



        $response = $this
            ->actingAs($admin)
            ->post(
                route('admin.subjects.store'),
                [

                    'code' => '',

                    'name' => 'Matematika',

                ]
            );



        $response->assertSessionHasErrors('code');
    }








    /**
     * Kode mata pelajaran tidak boleh sama
     */
    public function test_subject_code_must_be_unique()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);



        Subject::create([
            'code' => 'MTK01',
            'name' => 'Matematika',
        ]);



        $response = $this
            ->actingAs($admin)
            ->post(
                route('admin.subjects.store'),
                [

                    'code' => 'MTK01',

                    'name' => 'Fisika',

                ]
            );



        $response->assertSessionHasErrors('code');
    }








    /**
     * Nama mata pelajaran tidak boleh sama
     */
    public function test_subject_name_must_be_unique()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);



        Subject::create([
            'code' => 'MTK01',
            'name' => 'Matematika',
        ]);



        $response = $this
            ->actingAs($admin)
            ->post(
                route('admin.subjects.store'),
                [

                    'code' => 'MTK02',

                    'name' => 'Matematika',

                ]
            );



        $response->assertSessionHasErrors('name');
    }








    /**
     * Admin dapat melihat detail mata pelajaran
     */
    public function test_admin_can_view_subject_detail()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);



        $subject = Subject::create([
            'code' => 'BIO01',
            'name' => 'Biologi',
        ]);



        $response = $this
            ->actingAs($admin)
            ->get(
                route('admin.subjects.show', $subject)
            );



        $response->assertStatus(200);
    }








    /**
     * Admin dapat membuka halaman edit
     */
    public function test_admin_can_view_subject_edit_page()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);



        $subject = Subject::create([
            'code' => 'IPA01',
            'name' => 'IPA',
        ]);



        $response = $this
            ->actingAs($admin)
            ->get(
                route('admin.subjects.edit', $subject)
            );



        $response->assertStatus(200);
    }








    /**
     * Admin dapat update mata pelajaran
     */
    public function test_admin_can_update_subject()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);



        $subject = Subject::create([
            'code' => 'MTK01',
            'name' => 'Matematika',
        ]);



        $response = $this
            ->actingAs($admin)
            ->put(
                route('admin.subjects.update', $subject),
                [

                    'code' => 'MTK02',

                    'name' => 'Matematika Dasar',

                ]
            );



        $response->assertRedirect(
            route('admin.subjects.index')
        );


        $this->assertDatabaseHas('subjects', [

            'code' => 'MTK02',

            'name' => 'Matematika Dasar',

        ]);
    }









    /**
     * Admin dapat menghapus mata pelajaran
     */
    public function test_admin_can_delete_subject()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);



        $subject = Subject::create([
            'code' => 'KIM01',
            'name' => 'Kimia',
        ]);



        $response = $this
            ->actingAs($admin)
            ->delete(
                route('admin.subjects.destroy', $subject)
            );



        $response->assertRedirect(
            route('admin.subjects.index')
        );



        $this->assertDatabaseMissing(
            'subjects',
            [
                'id' => $subject->id,
            ]
        );
    }

}