<?php

namespace App\Http\Controllers\Sections;

use App\Models\Section;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;

use function Pest\version;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with(['sections'])->get();
        $teachers = Teacher::all();

        $listGrades = Grade::all();
        return view('pages.sections.sections', compact('grades', 'listGrades', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $section = new Section();

            $section->name = [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ];
            $section->gradeId = $request->gradeId;
            $section->classId = $request->Class_id;
            $section->status = 1;
            $section->save();
            $section->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.success'), ' ');

            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $section = Section::findOrFail($id);

            $section->name = [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ];
            if (isset($request->status)) {
                $section->status = 1;
            } else {
                $section->status = 2;
            }

            $section->classId = $request->Class_id;
            if (isset($request->teacher_id)) {
                $section->teachers()->sync($request->teacher_id);
            } else {
                $section->teachers()->sync(array());
            }
            $section->save();
            toastr()->success(trans('messages.update'), ' ');
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Section::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.delete'), ' ');
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return  redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
