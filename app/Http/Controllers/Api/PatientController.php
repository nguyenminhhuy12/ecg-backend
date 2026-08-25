<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    // GET /api/patients
    public function index()
    {
        return response()->json(Patient::all());
    }

    // POST /api/patients
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:patients,code',
            'name' => 'required|string',
            'birth_year' => 'nullable|integer',
            'gender' => 'nullable|in:male,female,other',
            'note' => 'nullable|string',
        ]);

        $patient = Patient::create($data);

        return response()->json($patient, 201);
    }

    // GET /api/patients/{id}
    public function show($id)
    {
        return response()->json(
            Patient::findOrFail($id)
        );
    }

    // PUT /api/patients/{id}
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $data = $request->validate([
            'code' => 'sometimes|string|unique:patients,code,' . $patient->id,
            'name' => 'sometimes|string',
            'birth_year' => 'nullable|integer',
            'gender' => 'nullable|in:male,female,other',
            'note' => 'nullable|string',
        ]);

        $patient->update($data);

        return response()->json($patient);
    }

    // DELETE /api/patients/{id}
    public function destroy($id)
    {
        Patient::destroy($id);

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}

