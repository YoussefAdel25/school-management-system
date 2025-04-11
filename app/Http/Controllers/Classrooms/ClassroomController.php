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
        $classrooms = Classroom::all();
        $grades = Grade::all();
        return view('pages.classrooms.classrooms', compact('classrooms', 'grades'));
    }


    public function create() {}

    public function store(Request $request)
{
    $validated = $request->validate([
        'classrooms' => 'required|array',
        'classrooms.*.name_ar' => 'required|string|max:255',
        'classrooms.*.name_en' => 'required|string|max:255',
        'classrooms.*.gradeId' => 'required|exists:grades,id',
    ]);

    foreach ($request->classrooms as $classroom) {
        Classroom::create([
            'name' => [
                'ar' => $classroom['name_ar'],
                'en' => $classroom['name_en']
            ],
            'gradeId' => $classroom['gradeId'],
        ]);
    }

    toastr()->success(trans('messages.success'));
    return redirect()->route('classrooms.index');
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


    public function update(Request $request, $id)
{
    // dd("وصلنا هنا",$request->all());


    $classroom = Classroom::findOrFail($id);
    $classroom->setTranslation('name', 'ar', $request->name_ar);
    $classroom->setTranslation('name', 'en', $request->name_en);
    $classroom->gradeId = $request->gradeId;
    $classroom->save();

    return redirect()->route('classrooms.index')->with('success', 'تم التعديل بنجاح');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        try {
            Classroom::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.delete'),'  ');
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


     public function deleteAll(Request $request){
         $classId = explode(',', $request->deleteAllId);


         Classroom::whereIn('id',$classId)->delete();
         toastr()->success('messages.delete');
         return redirect(route('classrooms.index'));


     }

      public function filter(Request $request){


        $grades = Grade::all();
                $classrooms = Classroom::all();


        $filterClasses = Classroom::select('*')->where('gradeId',$request->gradeId)->get();
        return view('pages.classrooms.classrooms',compact('filterClasses','grades','classrooms'));


      }


      public function getClassesByGrade($gradeId)
{
    $classes = Classroom::where('gradeId', $gradeId)->pluck('name', 'id');
    return response()->json($classes);
}

}
