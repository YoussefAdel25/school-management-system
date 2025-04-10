<?php

namespace App\Http\Controllers\Grades;

use App\cr;


use App\Models\Grade;
use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradesStore;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $grades = Grade::all();
    if ($grades->isEmpty()) {
        // يمكنك إما إعادة توجيه أو إظهار رسالة خاصة
        return view('pages.grades.grades', ['grades' => []]);
    }
    return view('pages.grades.grades', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradesStore $request)
    {
        try {
            $grades = new Grade();
            $validated = $request->validated();

            $isExits = Grade::where('name->ar', $validated['name_ar'])
                ->orWhere('name->en', $validated['name_en'])
                ->exists();


            if ($isExits) {
                return redirect()->back()->withErrors(trans('grades.error'));
            }

            // $translations =[
            //     'en'=>$validated->name_en,
            //     'ar'=>$validated->name_ar
            // ];
            // $grades->setTranslations('name',$translations);


            // $grades->name = ['en'=>$validated->name_en,'ar'=>$validated->name_ar];

            $grades->name = [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ];
            $grades->notes = $validated['notes'];
            $grades->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('grades.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {


        $grades = grade::find($request->id);
        $grades->name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];
        $grades->notes = $request->notes;

        $grades->save();
        toastr()->success(trans('messages.update'));

        return redirect(route('grades.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        try {
            $grade = Grade::find($request->id); // محاولة العثور على السجل

            if ($grade) {
                $grade->delete(); // إذا كان السجل موجودًا، قم بحذفه
                toastr()->success(trans('messages.delete'));
                return redirect(route('grades.index'));
            } else {
                return redirect()->back()->with('error', 'Grade not found!');


            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
