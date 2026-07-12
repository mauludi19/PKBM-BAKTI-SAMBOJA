<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\AcademicYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademicYearControllerTest extends TestCase
{
    use RefreshDatabase;



    private function createAdmin()
    {
        return User::create([
            'name' => 'Admin',
            'email' => uniqid().'@pkbm.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
    }



    /**
     * Admin dapat melihat daftar tahun ajaran
     */
    public function test_admin_can_view_academic_year_index()
    {
        $admin = $this->createAdmin();


        $response = $this
            ->actingAs($admin)
            ->get(route('admin.academic-years.index'));


        $response->assertStatus(200);
    }





    /**
     * Admin dapat membuka form tambah
     */
    public function test_admin_can_view_academic_year_create()
    {
        $admin = $this->createAdmin();


        $response = $this
            ->actingAs($admin)
            ->get(route('admin.academic-years.create'));


        $response->assertStatus(200);
    }





    /**
     * Admin berhasil menambah tahun ajaran
     */
    public function test_admin_can_create_academic_year()
    {
        $admin = $this->createAdmin();


        $response = $this
            ->actingAs($admin)
            ->post(
                route('admin.academic-years.store'),
                [
                    'year' => '2026/2027',
                    'is_active' => false,
                ]
            );


        $response->assertRedirect(
            route('admin.academic-years.index')
        );


        $response->assertSessionHas('success');


        $this->assertDatabaseHas(
            'academic_years',
            [
                'year' => '2026/2027',
                'is_active' => false,
            ]
        );
    }





    /**
     * Tahun wajib diisi
     */
    public function test_year_is_required()
    {
        $admin = $this->createAdmin();


        $response = $this
            ->actingAs($admin)
            ->post(
                route('admin.academic-years.store'),
                [
                    'year' => '',
                ]
            );


        $response->assertSessionHasErrors('year');
    }





    /**
     * Tahun tidak boleh duplikat
     */
    public function test_year_must_be_unique()
    {
        $admin = $this->createAdmin();


        AcademicYear::create([
            'year' => '2025/2026',
            'is_active' => false,
        ]);



        $response = $this
            ->actingAs($admin)
            ->post(
                route('admin.academic-years.store'),
                [
                    'year' => '2025/2026',
                ]
            );


        $response->assertSessionHasErrors('year');
    }





    /**
     * Jika tahun baru aktif,
     * tahun lama menjadi tidak aktif
     */
    public function test_new_active_year_disable_old_active_year()
    {
        $admin = $this->createAdmin();



        AcademicYear::create([
            'year' => '2025/2026',
            'is_active' => true,
        ]);



        $response = $this
            ->actingAs($admin)
            ->post(
                route('admin.academic-years.store'),
                [
                    'year' => '2026/2027',
                    'is_active' => true,
                ]
            );



        $response->assertRedirect(
            route('admin.academic-years.index')
        );



        $this->assertDatabaseHas(
            'academic_years',
            [
                'year' => '2025/2026',
                'is_active' => false,
            ]
        );



        $this->assertDatabaseHas(
            'academic_years',
            [
                'year' => '2026/2027',
                'is_active' => true,
            ]
        );
    }





    /**
     * Admin dapat melihat detail tahun ajaran
     */
    public function test_admin_can_view_academic_year_detail()
    {
        $admin = $this->createAdmin();



        $academicYear = AcademicYear::create([
            'year' => '2025/2026',
            'is_active' => true,
        ]);



        $response = $this
            ->actingAs($admin)
            ->get(
                route('admin.academic-years.show',$academicYear)
            );


        $response->assertStatus(200);
    }





    /**
     * Admin dapat membuka halaman edit
     */
    public function test_admin_can_view_academic_year_edit()
    {
        $admin = $this->createAdmin();



        $academicYear = AcademicYear::create([
            'year' => '2025/2026',
            'is_active' => false,
        ]);



        $response = $this
            ->actingAs($admin)
            ->get(
                route('admin.academic-years.edit',$academicYear)
            );


        $response->assertStatus(200);
    }





    /**
     * Admin dapat update tahun ajaran
     */
    public function test_admin_can_update_academic_year()
    {
        $admin = $this->createAdmin();



        $academicYear = AcademicYear::create([
            'year' => '2025/2026',
            'is_active' => false,
        ]);



        $response = $this
            ->actingAs($admin)
            ->put(
                route('admin.academic-years.update',$academicYear),
                [
                    'year' => '2026/2027',
                    'is_active' => true,
                ]
            );



        $response->assertRedirect(
            route('admin.academic-years.index')
        );


        $this->assertDatabaseHas(
            'academic_years',
            [
                'year'=>'2026/2027',
                'is_active'=>true,
            ]
        );
    }





    /**
     * Admin dapat menghapus tahun ajaran
     */
    public function test_admin_can_delete_academic_year()
    {
        $admin = $this->createAdmin();



        $academicYear = AcademicYear::create([
            'year'=>'2024/2025',
            'is_active'=>false,
        ]);



        $response = $this
            ->actingAs($admin)
            ->delete(
                route('admin.academic-years.destroy',$academicYear)
            );



        $response->assertRedirect(
            route('admin.academic-years.index')
        );


        $this->assertDatabaseMissing(
            'academic_years',
            [
                'id'=>$academicYear->id,
            ]
        );
    }

}