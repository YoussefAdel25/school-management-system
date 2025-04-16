<?php

namespace App\Repository;

use App\Models\Blood;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Section;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\myParent;
use App\Models\Religion;
use App\Models\Classroom;
use App\Models\Nationality;
use App\Models\Specialization;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repository\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{

    ///Get Teachers
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    //Get Genders
    public function getGenders()
    {
        return  Gender::all();
    }


    //Get Specializations
    public function getSpecializations()
    {
        return Specialization::all();
    }


    public function createStudents()
    {
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $data['grades'] = Grade::all();
        $data['parents'] = myParent::all();
        $data['religions'] = Religion::all();

        return view('pages.students.add', $data);
    }


    public function storeStudents($request)
    {

        DB::beginTransaction();
        try {
          $student=   Student::create([
                'name' => ['en' => $request->nameEn, 'ar' => $request->nameAr],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nationalId' => $request->nationalId,
                'genderId' => $request->genderId,
                'nationalityId' => $request->nationalityId,
                'parentId' => $request->parentId,
                'bloodId' => $request->bloodId,
                'gradeId' => $request->gradeId,
                'classId' => $request->classId,
                'sectionId' => $request->sectionId,
                'dateBirth' => $request->dateBirth,
                'academicYear' => $request->academicYear,
                'religionId' => $request->religionId,
            ]);


            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as  $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $student->name, $file->getClientOriginalName(), 'upload_attachments');
                    $image = new Image();
                    $image->filename = $name;
                    $image->imageable_id = $student->id;
                    $image->imageable_type = 'App\Models\Student';
                    $image->save();
                }
            }

            DB::commit();
            toastr()->success(trans('messages.success'), ' ');
            return redirect()->route('students.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }


    public function editStudents($id)
    {
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $data['grades'] = Grade::all();
        $data['parents'] = myParent::all();
        $data['religions'] = Religion::all();
        $data['students'] = Student::findOrFail($id);
        return view('pages.students.edit', $data);
    }


    public function updateStudents($request)
    {
        $student = Student::find($request->id);

        // إذا تم العثور على الطالب، قم بتحديثه
        if ($student) {
            $student->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => ['en' => $request->nameEn, 'ar' => $request->nameAr],
                'dateBirth' => $request->dateBirth,
                'bloodId' => $request->bloodId,
                'parentId' => $request->parentId,
                'nationalId' => $request->nationalId,
                'nationalityId' => $request->nationalityId,
                'genderId' => $request->genderId,
                'sectionId' => $request->sectionId,
                'gradeId' => $request->gradeId,
                'classId' => $request->classId,
                'religionId' => $request->religionId,
                'academicYear' => $request->academicYear,
            ]);

            toastr()->success(trans('messages.update'), ' ');
            return redirect()->route('students.index');
        }
    }


    public function getClassrooms($id)
    {
        return Classroom::where("gradeId", $id)->pluck("name", "id");
    }

    public function getSections($id)
    {
        return Section::where("classId", $id)->pluck("name", "id");
    }




    public function deleteStudents($request)
    {

        Student::destroy($request->id);
        toastr()->success(trans('messages.delete'), ' ');
        return redirect()->route('students.index');
    }
}
