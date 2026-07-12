<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Package;
use App\Models\AcademicYear;
use App\Models\PpdbRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PpdbControllerTest extends TestCase
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




    private function createPpdb()
    {
        $package = Package::create([
            'name' => 'Paket C',
        ]);



        $academicYear = AcademicYear::create([
            'year' => '2026/2027',
            'is_active' => true,
        ]);



        return PpdbRegistration::create([

            'academic_year_id' => $academicYear->id,

            'package_id' => $package->id,


            'registration_type' => 'mandiri',


            'email' => uniqid().'@gmail.com',


            'full_name' => 'Budi Santoso',


            'nisn' => '1234567890',

            'nik' => '12345678901234567890',


            'birth_place' => 'Samboja',

            'birth_date' => '2008-01-01',


            'gender' => 'L',


            'last_education' => 'SMP',


            'address' => 'Samboja',


            'phone' => '08123456789',



            'father_name' => 'Ayah Budi',

            'father_phone' => '081111111',


            'mother_name' => 'Ibu Budi',

            'mother_phone' => '082222222',



            // file wajib sesuai migration

            'family_card_file' => 'uploads/kartu_keluarga.pdf',

            'birth_certificate_file' => 'uploads/akta_kelahiran.pdf',

            'photo_file' => 'uploads/foto_siswa.jpg',

            'last_report_file' => 'uploads/raport.pdf',



            'status' => 'pending',

        ]);
    }








    /**
     * Admin melihat daftar PPDB
     */
    public function test_admin_can_view_ppdb_index()
    {
        $admin = $this->createAdmin();


        $response = $this
            ->actingAs($admin)
            ->get(
                route('admin.ppdb.index')
            );


        $response->assertStatus(200);
    }









    /**
     * Admin melihat detail PPDB
     */
    public function test_admin_can_view_ppdb_detail()
    {
        $admin = $this->createAdmin();


        $ppdb = $this->createPpdb();



        $response = $this
            ->actingAs($admin)
            ->get(
                route('admin.ppdb.show',$ppdb)
            );


        $response->assertStatus(200);
    }









    /**
     * Admin approve PPDB
     */
    public function test_admin_can_approve_ppdb()
    {
        $admin = $this->createAdmin();


        $ppdb = $this->createPpdb();



        $response = $this
            ->actingAs($admin)
            ->put(
                route('admin.ppdb.approve',$ppdb)
            );



        $response->assertRedirect(
            route('admin.ppdb.index')
        );



        // status PPDB berubah

        $this->assertDatabaseHas(
            'ppdb_registrations',
            [
                'id'=>$ppdb->id,
                'status'=>'approved',
            ]
        );



        // akun siswa dibuat

        $this->assertDatabaseHas(
            'users',
            [
                'email'=>$ppdb->email,
                'role'=>'student',
            ]
        );



        // data student dibuat

        $this->assertDatabaseHas(
            'students',
            [
                'nisn'=>$ppdb->nisn,
                'status'=>'active',
            ]
        );
    }









    /**
     * Tidak bisa approve PPDB dua kali
     */
    public function test_cannot_approve_ppdb_twice()
    {
        $admin = $this->createAdmin();


        $ppdb = $this->createPpdb();



        $ppdb->update([
            'status'=>'approved'
        ]);



        $response = $this
            ->actingAs($admin)
            ->put(
                route('admin.ppdb.approve',$ppdb)
            );



        $response->assertRedirect();



        $response->assertSessionHas(
            'error'
        );
    }









    /**
     * Admin reject PPDB
     */
    public function test_admin_can_reject_ppdb()
    {
        $admin = $this->createAdmin();


        $ppdb = $this->createPpdb();



        $response = $this
            ->actingAs($admin)
            ->put(
                route('admin.ppdb.reject',$ppdb)
            );



        $response->assertRedirect(
            route('admin.ppdb.index')
        );



        $this->assertDatabaseHas(
            'ppdb_registrations',
            [
                'id'=>$ppdb->id,
                'status'=>'rejected',
            ]
        );
    }









    /**
     * Admin hapus PPDB
     */
    public function test_admin_can_delete_ppdb()
    {
        $admin = $this->createAdmin();


        $ppdb = $this->createPpdb();



        $response = $this
            ->actingAs($admin)
            ->delete(
                route('admin.ppdb.destroy',$ppdb)
            );



        $response->assertRedirect(
            route('admin.ppdb.index')
        );



        $this->assertDatabaseMissing(
            'ppdb_registrations',
            [
                'id'=>$ppdb->id,
            ]
        );
    }

}