<?php

namespace App\Http\Controllers\Sections;

use App\Models\Section;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function Pest\version;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with(['sections'])->get();

        $listGrades = Grade::all();
        return view('pages.sections.sections',compact('grades','listGrades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     try{
        $section = new Section();

        $section->name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];
        $section->gradeId = $request->gradeId;
        $section->classId = $request->Class_id;
        $section->status = 1 ;
        $section->save();
        toastr()->success(trans('messages.success'));

        return redirect()->route('sections.index');
     }catch(\Exception $e){
        return redirect()->back()->withErrors(['error',$e->getMessage()]);
     }



    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try{
            $section = Section::findOrFail($id);

            $section->name = [
                'en'=>$request->name_en,
                'ar'=>$request->name_ar,
            ];
            $section->status = $request->status;
            $section->classId = $request->Class_id;
            $section->save();
            toastr()->success(trans('messages.update'),' ');
            return redirect()->route('sections.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
         try{
            Section::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.delete'),' ');
            return redirect()->route('sections.index');
         }catch(\Exception $e){
            return  redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
         }
    }
}
