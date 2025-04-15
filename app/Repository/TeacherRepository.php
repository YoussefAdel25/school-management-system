<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
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




// Store teacher
    public function storeTeachers($request)
    {

        try {
            $teacher = new Teacher();
            $teacher->name = ['en' => $request->nameEn, 'ar' => $request->nameAr];
            $teacher->email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher->address = $request->address;
            $teacher->specializationId = $request->specialization_id;
            $teacher->genderId = $request->gender_id;
            $teacher->joiningDate = $request->joiningDate;
            $teacher->save();

            toastr()->success(trans('messages.success'), ' ');
            return redirect()->route('teachers.create');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }



    //get data by id to update
    public function editTeachers($id)
    {
        return Teacher::findOrFail($id);
    }



    //update Teacher
    public function updateTeacher($request)
    {
        $teacher = Teacher::findOrFail($request->id);
        $data = [
            'email' => $request->email,
            'name' => [
                'en' => $request->nameEn,
                'ar' => $request->nameAr
            ],
            'specializationId' => $request->specializationId,
            'genderId' => $request->genderId,
            'joiningDate' => $request->joiningDate,
            'address' => $request->address
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $teacher->update($data);

        toastr()->success(__('messages.update'), ' ');
        return redirect()->route('teachers.index');

        // }  catch (\Exception $e) {
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }


    public function deleteTeacher($request)
    {

        Teacher::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.delete'), ' ');
        return redirect()->route('teachers.index');
    }
}
