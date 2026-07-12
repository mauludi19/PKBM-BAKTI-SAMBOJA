<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GradeControllerTest extends TestCase
{
    use RefreshDatabase;


    private function createTutor()
    {
        $user = User::create([
            'name' => 'Tutor Test',
            'email' => 'tutor@test.com',
            'password' => bcrypt('password123'),
            'role' => 'tutor',
        ]);


        return Tutor::create([
            'user_id' => $user->id,
            'npsn' => '12345',
            'gender' => 'L',
            'education' => 'S1',
            'specialization' => 'Matematika',
            'phone' => '08123456789',
            'address' => 'Samboja',
        ]);
    }



    private function createStudent()
    {
        $package = Package::create([
            'name' => 'Paket C',
        ]);


        $user = User::create([
            'name' => 'Budi',
            'email' => 'budi@test.com',
            'password' => bcrypt('password123'),
            'role' => 'student',
        ]);


        return Student::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'nisn' => '123456789',
            'gender' => 'L',
            'status' => 'active',
        ]);
    }



    private function createSubject()
    {
        return Subject::create([
            'code' => 'MTK',
            'name' => 'Matematika',
        ]);
    }



    /**
     * Tutor dapat melihat daftar nilai
     */
    public function test_tutor_can_view_grade_index()
    {
        $tutor = $this->createTutor();


        $response = $this
            ->actingAs($tutor->user)
            ->get(
                route('tutor.grades.index')
            );


        $response->assertStatus(200);
    }




    /**
     * Tutor dapat membuka form input nilai
     */
    public function test_tutor_can_view_create_grade()
    {
        $tutor = $this->createTutor();


        $response = $this
            ->actingAs($tutor->user)
            ->get(
                route('tutor.grades.create')
            );


        $response->assertStatus(200);
    }





    /**
     * Tutor berhasil input nilai
     */
    public function test_tutor_can_store_grade()
    {
        $tutor = $this->createTutor();

        $student = $this->createStudent();

        $subject = $this->createSubject();



        $response = $this
            ->actingAs($tutor->user)
            ->post(
                route('tutor.grades.store'),
                [

                    'student_id' => $student->id,

                    'subject_id' => $subject->id,

                    'semester' => 1,

                    'academic_year' => '2026/2027',

                    'assignment_score' => 80,

                    'mid_score' => 85,

                    'final_score' => 90,

                    'notes' => 'Bagus',

                ]
            );



        $response->assertRedirect(
            route('tutor.grades.index')
        );



        // cek data tersimpan

        $this->assertDatabaseHas(
            'grades',
            [
                'student_id' => $student->id,

                'subject_id' => $subject->id,

                'final_grade' => 85,

            ]
        );
    }





    /**
     * Nilai tidak boleh lebih dari 100
     */
    public function test_score_cannot_more_than_100()
    {
        $tutor = $this->createTutor();

        $student = $this->createStudent();

        $subject = $this->createSubject();



        $response = $this
            ->actingAs($tutor->user)
            ->post(
                route('tutor.grades.store'),
                [

                    'student_id'=>$student->id,

                    'subject_id'=>$subject->id,

                    'semester'=>1,

                    'academic_year'=>'2026/2027',

                    'assignment_score'=>150,

                    'mid_score'=>80,

                    'final_score'=>90,

                ]
            );



        $response->assertSessionHasErrors(
            'assignment_score'
        );
    }





    /**
     * Tutor dapat update nilai
     */
    public function test_tutor_can_update_grade()
    {
        $tutor = $this->createTutor();

        $student = $this->createStudent();

        $subject = $this->createSubject();



        $grade = Grade::create([

            'student_id'=>$student->id,

            'subject_id'=>$subject->id,

            'tutor_id'=>$tutor->id,

            'semester'=>1,

            'academic_year'=>'2026/2027',

            'assignment_score'=>70,

            'mid_score'=>70,

            'final_score'=>70,

            'final_grade'=>70,

        ]);



        $response = $this
            ->actingAs($tutor->user)
            ->put(
                route('tutor.grades.update',$grade),
                [

                    'student_id'=>$student->id,

                    'subject_id'=>$subject->id,

                    'semester'=>2,

                    'academic_year'=>'2026/2027',

                    'assignment_score'=>90,

                    'mid_score'=>90,

                    'final_score'=>90,

                ]
            );



        $response->assertRedirect(
            route('tutor.grades.index')
        );



        $this->assertDatabaseHas(
            'grades',
            [
                'id'=>$grade->id,

                'final_grade'=>90,
            ]
        );
    }





    /**
     * Tutor dapat menghapus nilai
     */
    public function test_tutor_can_delete_grade()
    {
        $tutor = $this->createTutor();

        $student = $this->createStudent();

        $subject = $this->createSubject();



        $grade = Grade::create([

            'student_id'=>$student->id,

            'subject_id'=>$subject->id,

            'tutor_id'=>$tutor->id,

            'semester'=>1,

            'academic_year'=>'2026/2027',

            'assignment_score'=>80,

            'mid_score'=>80,

            'final_score'=>80,

            'final_grade'=>80,

        ]);



        $response = $this
            ->actingAs($tutor->user)
            ->delete(
                route('tutor.grades.destroy',$grade)
            );



        $response->assertRedirect(
            route('tutor.grades.index')
        );



        $this->assertDatabaseMissing(
            'grades',
            [
                'id'=>$grade->id
            ]
        );
    }

}