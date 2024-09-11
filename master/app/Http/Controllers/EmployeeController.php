<?php

namespace App\Http\Controllers;

use App\Models\SubSalon;
use App\Models\Employee;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $sub_salons = SubSalon::all();
        $employees = Employee::all();
        return view('dashboard.employee.index', ['employees' => $employees, 'sub_salons' => $sub_salons]);
    }

    public function create()
    {
        $sub_salons = SubSalon::all();
        return view('dashboard.employee.create', ['sub_salons' => $sub_salons]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:8|confirmed',
            // 'sub_salons_id' => 'required|exists:sub_salons,id',
        ]);
    
        $employee = new Employee();
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        $employee->password = $request->input('password'); 
        // $employee->sub_salons_id = $request->input('sub_salon_id');
    
        $employee->save();
     
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    



    public function edit(Employee $employee)
    {
        $sub_salons = SubSalon::all();
        return view('dashboard.employee.edit', ['employee' => $employee, 'sub_salons' => $sub_salons]);
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'password' => 'nullable|string|min:8|confirmed',
            'sub_salon_id' => 'required|exists:sub_salons,id',
        ]);

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        
       
        
        $employee->sub_salon_id = $request->input('sub_salon_id');

       

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
      

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
