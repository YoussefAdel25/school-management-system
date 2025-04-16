<?php

namespace App\Http\Controllers\Students;

use App\Models\Blood;
use App\Models\Grade;
use App\Models\Gender;
use App\Models\Student;
use App\Models\myParent;
use App\Models\Classroom;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\StudentRepositoryInterface;

class StudentController extends Controller
{

    protected $Student;

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $data['students'] = Student::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $data['grades'] = Grade::all();
        $data['parents'] = myParent::all();
        return view('pages.students.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */



    public function Get_classrooms($id)
    {
        return $this->Student->getClassrooms($id);
    }


    public function Get_Sections($id)
    {
        return $this->Student->getSections($id);
    }
    public function create()
    {

        return $this->Student->createStudents();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Student->storeStudents($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Student->editStudents($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Student->updateStudents($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Student->deleteStudents($request);
    }
}
