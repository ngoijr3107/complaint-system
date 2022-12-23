<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        
    }


    public function create()
    {
        
    }


    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required'
        ]);
        $departments = Department::create($request->all());
    }


    public function show($id)
    {
        $departments = Department::find($id);
    }

 
    public function edit($id)
    {
        
    }

 
    public function update(Request $request, $id)
    {
        
    }


    public function destroy($id)
    {
        
    }
}
