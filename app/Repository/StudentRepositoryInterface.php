<?php

namespace App\Repository;

interface StudentRepositoryInterface
{



    public function createStudents();
    public function storeStudents($request);

    public function editStudents($id);

    public function updateStudents($request);

    public function deleteStudents($request);

    public function getClassrooms($id);


    public function getSections($id);
}


?>
