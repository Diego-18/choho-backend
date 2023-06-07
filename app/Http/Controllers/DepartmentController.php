<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    public function getAllDepartments(): Response {
        try {
            $departments = Department::all();

             return Response()->json(
                [
                    'data' => $departments,
                    'message' => 'All Departments.',
                    'status' => 200,
                ],
                500
            );

        } catch (\Exception $error) {
            return Response()->json(
                [
                    'message' => $error->getMessage(),
                    'line' => $error->getLine(),
                    'file' => $error->getFile(),
                ],
                500
            );
        }
    }
}
