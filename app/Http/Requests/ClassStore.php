<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'listClasses.*.name_en' => 'required',  // تحقق من وجود القيمة وأنها نص
        'listClasses.*.name_ar' => 'required',  //
        'listClasses.*.gradeId' => 'required',  //
        ];
    }

    public function messages(){

        return [

            'name_en.required' => trans('validation.required1'),
            'name_ar.required' => trans('validation.required2'),
            'gradeId.required' => trans('validation.required2'),
        ];
    }
}
