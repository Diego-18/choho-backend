<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    //
    public function getAllCities(Request $request): Response {
        try {
            $cities = City::where('department_id', '=', $request->department_id)->get();

            for ($index = 0; $index < count($cities); $index++) {
                $city = City::find($cities[$index]['id']);

                $cityDepartment = $city->department;
                $cities[$index]['department'] = $cityDepartment;
            }

             return Response()->json(
                [
                    'data' => $cities,
                    'message' => 'All Cities.',
                    'status' => 200,
                ],
                200
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
