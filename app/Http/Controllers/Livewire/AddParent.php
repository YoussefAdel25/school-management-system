<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Blood;
use App\Models\Image;
use Livewire\Component;
use App\Models\myParent;
use App\Models\Religion;
use App\Models\Nationality;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\MyParent_Attachment;
use Illuminate\Support\Facades\Hash;


class AddParent extends Component
{

    use WithFileUploads;
    public $currentStep = 1;
    public $catchError, $updateMode = false, $photos, $show_table = true, $Parent_id ,$delete_id = null;

    public $Email, $Password, $Name_Father, $Name_Father_en, $Job_Father, $Job_Father_en, $National_ID_Father, $Passport_ID_Father, $Phone_Father, $Nationality_Father_id, $Blood_Type_Father_id, $Religion_Father_id, $Address_Father;
    public $Name_Mother, $Name_Mother_en, $Job_Mother, $Job_Mother_en, $National_ID_Mother, $Passport_ID_Mother, $Phone_Mother, $Nationality_Mother_id, $Blood_Type_Mother_id, $Religion_Mother_id, $Address_Mother;
    public $successMessage = '';




    protected $rules = [
        'Email' => 'required|email',
        'Password' => 'required',
        'Name_Father' => 'required|string',
        'Name_Father_en' => 'required|string',
        'Job_Father' => 'required|string',
        'Job_Father_en' => 'required|string',
        'National_ID_Father' => 'required|integer|min:10|max:14|regex:/^[0-9]{10}$/',
        'Passport_ID_Father' => 'required|integer|min:10|max:14',
        'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'Nationality_Father_id' => 'required|integer',
        'Blood_Type_Father_id' => 'required|integer',
        'Religion_Father_id' => 'required|integer',
        'Address_Father' => 'required|string',



        'Name_Mother' => 'required|string',
        'Name_Mother_en' => 'required|string',
        'Job_Mother' => 'required|string',
        'Job_Mother_en' => 'required|string',
        'National_ID_Mother' => 'required|integer|min:10|max:10|regex:/^[0-9]{10}$/',
        'Passport_ID_Mother' => 'required|integer|min:10|max:10',
        'Phone_Mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'Nationality_Mother_id' => 'required|integer',
        'Blood_Type_Mother_id' => 'required|integer',
        'Religion_Mother_id' => 'required|integer',
        'Address_Mother' => 'required|string',
    ];





    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // الانتقال من خطوة 1 إلى 2
    public function firstStepSubmit()
    {
        $this->validate([
            'Email' => 'required|email|unique:my_parents,email,',
            'Password' => 'required',
            'Name_Father' => 'required|string',
            'Name_Father_en' => 'required|string',
            'Job_Father' => 'required|string',
            'Job_Father_en' => 'required|string',
            'National_ID_Father' => 'required|integer|unique:my_parents,nationalIdFather,',
            'Passport_ID_Father' => 'required|integer|unique:my_parents,passportIdFather,',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required|integer',
            'Blood_Type_Father_id' => 'required|integer',
            'Religion_Father_id' => 'required|integer',
            'Address_Father' => 'required|string'
        ]);

        $this->currentStep = 2;
    }



    // الانتقال من خطوة 2 إلى 3
    public function secondStepSubmit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'National_ID_Mother' => 'required|integer|unique:my_parents,nationalIdMother,',
            'Passport_ID_Mother' => 'required|integer|unique:my_parents,passportIdMother,',
            'Phone_Mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required'

        ]);
        $this->currentStep = 3;
    }



    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationality::all(),
            'Type_Bloods' => Blood::all(),
            'Religions' => Religion::all(),
            'my_parents' => myParent::all(),
        ]);
    }



    public function submitForm()
    {
        try {
            // بداية المعاملة
            DB::beginTransaction();

            $myParents = new MyParent();

            // إدخال بيانات الأب
            $myParents->email = $this->Email;
            $myParents->password = Hash::make($this->Password);
            $myParents->fatherName = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $myParents->nationalIdFather = $this->National_ID_Father;
            $myParents->passportIdFather = $this->Passport_ID_Father;
            $myParents->phoneFather = $this->Phone_Father;
            $myParents->jobFather = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $myParents->nationalityFatherId = $this->Nationality_Father_id;
            $myParents->bloodFatherId = $this->Blood_Type_Father_id;
            $myParents->religionFatherId = $this->Religion_Father_id;
            $myParents->addressFather = $this->Address_Father;

            // إدخال بيانات الأم
            $myParents->nameMother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $myParents->nationalIdMother = $this->National_ID_Mother;
            $myParents->passportIdMother = $this->Passport_ID_Mother;
            $myParents->phoneMother = $this->Phone_Mother;
            $myParents->jobMother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $myParents->nationalityMotherId = $this->Nationality_Mother_id;
            $myParents->bloodMotherId = $this->Blood_Type_Mother_id;
            $myParents->religionMotherId = $this->Religion_Mother_id;
            $myParents->addressMother = $this->Address_Mother;

            // حفظ الأب والأم في قاعدة البيانات
            $myParents->save();

            // التعامل مع الصور إذا كانت موجودة
            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    try {
                        $name = $photo->getClientOriginalName();
                        $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');

                        // إضافة الصورة إلى جدول الصور
                        $image = new Image();
                        $image->filename = $name;
                        $image->imageable_id = $myParents->id;  // تأكد من استخدام id الأب والأم
                        $image->imageable_type = 'App\Models\MyParent';  // التأكد من أنه MyParent وليس Student
                        $image->save();
                    } catch (\Exception $e) {
                        // في حال حدوث خطأ أثناء التعامل مع الصور
                        $this->catchError = $e->getMessage();
                    }
                }
            }

            // تأكيد النجاح
            DB::commit();
            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;

        } catch (\Exception $e) {
            // في حال حدوث خطأ أثناء عملية الإرسال
            DB::rollback();
            $this->catchError = $e->getMessage();
        }
    }


    public function showformadd(){
        $this->show_table = false;
    }




    public function edit($id){
        $this->show_table = false;
        $this->updateMode = true;
        $myParents= myParent::where('id',$id)->first();

       $this->Parent_id = $id;
       $this->Email = $myParents->email;
       $this->Password = $myParents->password;
       $this->Name_Father= $myParents->getTranslation('fatherName','ar');
       $this->Name_Father_en= $myParents->getTranslation('fatherName','en');
       $this->Job_Father= $myParents->getTranslation('jobFather','ar');
       $this->Job_Father_en= $myParents->getTranslation('jobFather','en');
       $this->National_ID_Father= $myParents->nationalIdFather;
       $this->Blood_Type_Father_id= $myParents->bloodFatherId;
       $this->Religion_Father_id = $myParents->religionFatherId;
       $this->Nationality_Father_id = $myParents->nationalityFatherId;
       $this->Address_Father = $myParents->addressFather;
       $this->Phone_Father = $myParents->phoneFather;
       $this->Passport_ID_Father = $myParents->passportIdFather;

       $this->Name_Mother = $myParents->getTranslation('nameMother','ar');
       $this->Name_Mother_en = $myParents->getTranslation('nameMother','en');
       $this->Job_Mother= $myParents->getTranslation('jobMother','ar');
       $this->Job_Mother_en = $myParents->getTranslation('jobMother','en');
       $this->National_ID_Mother =$myParents->nationalIdMother;
       $this->Blood_Type_Mother_id = $myParents->bloodMotherId;
       $this->Religion_Mother_id = $myParents->religionMotherId;
       $this->Nationality_Mother_id = $myParents->nationalityMotherId;
       $this->Address_Mother = $myParents->addressMother;
       $this->Phone_Mother = $myParents->phoneMother;
       $this->Passport_ID_Mother = $myParents->passportIdMother;
    }


    public function firstStepSubmit_edit(){
        $this->updateMode = true;
        $this->currentStep =2 ;
    }

    public function secondStepSubmit_edit(){
        $this->updateMode = true ;
        $this->currentStep = 3;
    }

    public function submitForm_edit(){
       try{
        if($this->Parent_id){
            $parent = myParent::findOrFail($this->Parent_id);
            $parent->update([
                'email' => $this->Email,
                'password' => Hash::make($this->Password),
                'fatherName' => ['en'=>$this->Name_Father_en,'ar'=>$this->Name_Father],
                'jobFather' => ['en'=>$this->Job_Father_en,'ar'=>$this->Job_Father],
                'nationalIdFather' => $this->National_ID_Father,
                'bloodFatherId' => $this->Blood_Type_Father_id,
                'religionFatherId' => $this->Religion_Father_id,
                'nationalityFatherId' => $this->Nationality_Father_id,
                'addressFather' => $this->Address_Father,
                'passportIdFather'=>$this->Passport_ID_Father,
                'phoneFather'=>$this->Phone_Father,

                'nameMother' => ['en'=>$this->Name_Mother_en,'ar'=>$this->Name_Mother],
                'jobMother' => ['en' =>$this->Job_Mother_en,'ar'=>$this->Job_Mother],
                'nationalIdMother'=> $this->National_ID_Mother,
                'bloodMotherId' => $this->Blood_Type_Mother_id,
                'religionMotherId' => $this->Religion_Mother_id,
                'nationalityMotherId' => $this->Nationality_Mother_id,
                'addressMother'=> $this->Address_Mother,
                'phoneMother'=>$this->Phone_Mother,
                'passportIdMother'=>$this->Passport_ID_Mother

            ]);
        }

    toastr()->success(trans('messages.update'),' ');
            return redirect()->route('addParent');

       }catch(\Exception $e){

        $this->catchError = $e->getMessage();
       }
    }


    public function clearForm()
    {


        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';

        $this->Name_Mother = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mother_id = '';
    }

    public function confirmDelete($id)
    {
        $this->delete_id = $id;
    }

    public $deleted = false;

    public function deleteConfirmed()
    {
        MyParent::findOrFail($this->delete_id)->delete();
        $this->deleted = true;
        session()->flash('successMessage', 'تم الحذف بنجاح');
    }

    public function updatedDeleted($value)
{
    if ($value) {
        $this->deleted = false; // Reset it for next time
    }
}

    // العودة إلى خطوة معينة
    public function back($step)
    {
        $this->currentStep = $step;
    }


}
