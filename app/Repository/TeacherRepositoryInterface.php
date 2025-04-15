<?php

namespace App\Repository;

interface TeacherRepositoryInterface{

    public function getAllTeachers();

    public function getGenders();

    public function getSpecializations();

    public function storeTeachers($request);

    public function editTeachers($id);

    public function updateTeacher($request);

    public function deleteTeacher($request);
}
?>
