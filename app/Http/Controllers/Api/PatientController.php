<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;

class PatientController extends Controller
{

    public function index()
    {
        $patients = Patient::latest()->paginate(5);

        //return collection of posts as a resource
        return new PatientResource(true, 'Patient Data List', $patients);
    }

    public function store(Request $request)
    {
        $patient = Patient::create($request->all());
        return response()->json($patient);
    }

    public function show($id)
    {
        $patients = Patient::find($id);

        //return single post as a resource
        return new PatientResource(true, 
        'Patient Data Details', 
        $patients);

        
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        // Validate the request if needed
        $request->validate([
            'name' => 'required|string|max:255',
            'birth' => 'required|date',
            'gender' => 'required|in:male,female',
            // Add other validations as needed
        ]);

        // Update patient data
        $patient->update($request->all());

        return response()->json($patient);
    }
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(['message' => 'Patient deleted successfully']);
    }
}