<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Requests\ClassStore;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classroom::all();
        $grades = Grade::all();
        return view('pages.classrooms.classrooms', compact('classes', 'grades'));
    }


    public function create() {}

    public function store(Request $request)
    {
        try {

            // $validated = $request->validated();
            $listClasses = $request['listClasses'];


            foreach ($listClasses as $class) {

                $isExists  = Classroom::where('name->ar', $class['name_ar'])
                ->orWhere('name->en', $class['name_en'])
                ->exists();

                if ($isExists) {
                    return redirect()->back()->withErrors(trans('classes.error'));
                }



                $myClass = new Classroom();
                $myClass->name = ['en' => $class['name_en'], 'ar' => $class['name_ar']];
                $myClass->gradeId = $class['gradeId'];
                $myClass->save();
            }
            toastr()->success(trans('messages.success'));
            return redirect(route('classrooms.index'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy() {}
}
