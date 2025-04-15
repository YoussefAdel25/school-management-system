<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  protected $Teacher;

     public function __construct(TeacherRepositoryInterface $Teacher){
        $this->Teacher = $Teacher;
     }


    public function index()
    {
      $Teachers = $this->Teacher->getAllTeachers();

       return view('pages.teachers.teachers',compact('Teachers'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->Teacher->getSpecializations();
        $genders = $this->Teacher->getGenders();
        return view('pages.teachers.create',compact('specializations','genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         return $this->Teacher->storeTeachers($request);
        // return redirect()->route('teachers.create');

    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $Teachers= $this->Teacher->editTeachers($id);
        $specializations = $this->Teacher->getSpecializations();
        $genders = $this->Teacher->getGenders();


        return view('pages.teachers.edit',compact('Teachers','genders','specializations'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    return $this->Teacher->updateTeacher($request);


}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request)
    {
         return $this->Teacher->deleteTeacher($request);
    }
}
