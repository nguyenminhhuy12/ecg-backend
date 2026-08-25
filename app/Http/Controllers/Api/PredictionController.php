<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prediction;
use App\Models\CaseModel;

class PredictionController extends Controller
{
    /**
     * GET /api/predictions?case_id=1
     */
    public function index(Request $request)
    {
        $query = Prediction::query();

        if ($request->has('case_id')) {
            $query->where('case_id', $request->case_id);
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    /**
     * POST /api/predictions
     * Tạo kết quả AI prediction
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'case_id'    => 'required|exists:cases,id',
            'label'      => 'required|in:MI,non-MI,uncertain',
            'confidence' => 'required|numeric|min:0|max:1',
        ]);

        $prediction = Prediction::updateOrCreate(
            ['case_id' => $validated['case_id']],
            [
                'label'      => $validated['label'],
                'confidence' => $validated['confidence'],
                'user_id'    => auth('api')->user()->id,
            ]
        );

        CaseModel::where('id', $validated['case_id'])
            ->update(['status' => 'predicted']);

        return response()->json([
            'success' => true,
            'message' => 'Prediction saved successfully',
            'data'    => $prediction
        ], 201);
    }


    /**
     * GET /api/predictions/{id}
     */
    public function show(Prediction $prediction)
    {
        return response()->json([
            'success' => true,
            'data' => $prediction
        ]);
    }

    /**
     * PUT/PATCH /api/predictions/{id}
     */
    public function update(Request $request, Prediction $prediction)
    {
        $validated = $request->validate([
            'label'      => 'required|in:MI,non-MI,uncertain',
            'confidence' => 'required|numeric|min:0|max:1',
        ]);

        $prediction->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Prediction updated successfully',
            'data' => $prediction
        ]);
    }

    /**
     * DELETE /api/predictions/{id}
     */
    public function destroy(Prediction $prediction)
    {
        $prediction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Prediction deleted successfully'
        ]);
    }
}
