<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Mockery\Exception;

class EmployeeController extends Controller
{
    protected $employee;

    public function __construct()
    {
        $this->employee = new Employee();
    }

    public function index()
    {
        try {
            return response()->json($this->employee->all(), 200);
        } catch (\Exception  $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $employee = $this->employee->create($request->all());
            return response()->json($employee, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }


    public function show(string $id)
    {
        try {
            $employee = $this->employee->find($id);
            if (!$employee) {
                return response()->json(['error' => 'Employee not found'],404);
            }
            return response()->json($employee, 200);
        }catch (\Exception $e){
            return response()->json(['error' => $e] , 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $employee = $this->employee->find($id);
            if (!$employee){
                return response()->json(['error' => 'Employee not found'] , 404);
            }
            $employee->update($request->all());
            return response()->json($employee,200);
        }
        catch (\Exception $e){
            return response()->json(['error' => $e],500);
        }
    }


    public function destroy(string $id)
    {
        try {
            $employee = $this->employee->find($id);
            if (!$employee){
                return response()->json(['error' => 'Employee not found'],404);
            }
            $employee->delete();
            return response()->json(['message' => 'Employee deleted successfully'],200);
        }
        catch (\Exception $e){
            return response()->json(['error' => $e] , 500);
        }
    }
}
