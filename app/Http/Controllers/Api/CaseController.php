<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseModel;
use App\Models\Patient;

class CaseController extends Controller
{
    /**
     * GET /api/cases
     * Danh sách ca đo ECG
     */
    public function index()
    {
        $cases = CaseModel::with('patient')
            ->orderBy('measured_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $cases
        ]);
    }

    /**
     * POST /api/cases
     * Tạo ca đo mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'measured_at' => 'required|date',
            'status' => 'in:uploaded,predicted',
        ]);

        $case = CaseModel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Case created successfully',
            'data' => $case
        ], 201);
    }

    /**
     * GET /api/cases/{id}
     * Chi tiết ca đo
     */
    public function show(CaseModel $case)
    {
        $case->load(['patient', 'ecgImages', 'prediction']);

        return response()->json([
            'success' => true,
            'data' => $case
        ]);
    }

    /**
     * PUT/PATCH /api/cases/{id}
     * Cập nhật ca đo
     */
    public function update(Request $request, CaseModel $case)
    {
        $validated = $request->validate([
            'patient_id' => 'exists:patients,id',
            'measured_at' => 'date',
            'status' => 'in:uploaded,predicted',
        ]);

        $case->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Case updated successfully',
            'data' => $case
        ]);
    }

    /**
     * DELETE /api/cases/{id}
     * Xoá ca đo
     */
    public function destroy(CaseModel $case)
    {
        $case->delete();

        return response()->json([
            'success' => true,
            'message' => 'Case deleted successfully'
        ]);
    }
}
