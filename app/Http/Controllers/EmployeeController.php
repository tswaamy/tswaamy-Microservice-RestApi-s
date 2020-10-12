<?php

namespace App\Http\Controllers;

use DB;
use DateTime;
use Illuminate\Http\Request;
use App\EmployeeDetail;

class EmployeeController extends Controller
{

    /**
     * get all Employee details
     *
     * @author [C.T.Swamy] [<c.thippeswamy@accionlabs.com>]
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function showAllEmployees()
    {
        // Here fecthing employee details 
        $employees      =   EmployeeDetail::all();
        return response()->json(['data'=>$employees], 200);
    }
    /**
     * get selected Employee details
     *
     * @author [C.T.Swamy] [<c.thippeswamy@accionlabs.com>]
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function showOneEmployee($id)
    {
        // Here fecthing the selected employee details 
        $employee       =   EmployeeDetail::find($id);
        return response()->json(['data'=>$employee], 200);
    }
     /**
     * Creating Employee details
     *
     * @author [C.T.Swamy] [<c.thippeswamy@accionlabs.com>]
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $rules = array(
            'name.*'        => 'Required',
            'email.*'       => 'Required| email|unique:EmployeeDetail',
            'emp_id.*'      => 'Required | integer| emp_id|unique:EmployeeDetail',
            'skills.*'      => 'Required',
            'location.*'    => 'Required',
        );
        // Create a validator object
        $validator = Validator($request['data'], $rules);

        try {
            DB::beginTransaction();
            //Check validation failed
            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            } else {

                // Here Creating or updating Employee details 
                foreach ($request->data as $emp_data) {
                    $response = EmployeeDetail::updateorcreate(['id' => $emp_data['id']],[
                                "email" => $emp_data['email'],
                                "name" => $emp_data['name'],
                                "emp_id" => $emp_data['emp_id'],
                                "skills" => $emp_data['skills'],
                                "location" => $emp_data['location'],
                                "status" => $emp_data['status']
                            ]);
                }
               DB::commit();
               return response()->json(["data" => "Created Successfully"], 200);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => "ErrorFails"], 400);
        } catch (\Exception $e) {
            return response()->json(['errors' => "ErrorFails"], 400);
        }
    }

    /**
     * Deleting Employee details
     *
     * @author [C.T.Swamy] [<c.thippeswamy@accionlabs.com>]
     * @param Request $request
     * 
     * @return JsonResponse
     */    
    public function delete($id)
    {   
        // Here Deleting the selected employee details
        $dt             =   new DateTime(); 
        $employee       =   EmployeeDetail::find($id)
                                            ->update(['deleted' => true,'deleted_at'=> $dt]);
        return response()->json(["data" => "Deleted Successfully"], 200);
    }
}
