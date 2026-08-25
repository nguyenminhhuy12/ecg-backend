<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EcgImage;
use App\Models\CaseModel;
use Illuminate\Support\Facades\Storage;

class EcgImageController extends Controller
{
    /**
     * GET /api/ecg-images?case_id=1
     */
    public function index(Request $request)
    {
        $query = EcgImage::query();

        if ($request->has('case_id')) {
            $query->where('case_id', $request->case_id);
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    /**
     * POST /api/ecg-images
     * Upload ảnh ECG
     */
    public function store(Request $request)
    {
        $request->validate([
            'case_id' => 'required|exists:cases,id',
            'image'   => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $file = $request->file('image');

        $path = $file->store('ecg_images', 'public');

        $ecgImage = EcgImage::create([
            'case_id'   => $request->case_id,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'ECG image uploaded successfully',
            'data' => $ecgImage
        ], 201);
    }

    /**
     * GET /api/ecg-images/{id}
     */
    public function show($id)
    {
        // return response()->json([
        //     'success' => true,
        //     'data' => $ecgImage
        // ]);
        $case = CaseModel::with(['patient', 'ecgImages', 'prediction'])
        ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $case
        ]);
    }

    /**
     * DELETE /api/ecg-images/{id}
     */
    public function destroy(EcgImage $ecgImage)
    {
        if (Storage::disk('public')->exists($ecgImage->file_path)) {
            Storage::disk('public')->delete($ecgImage->file_path);
        }

        $ecgImage->delete();

        return response()->json([
            'success' => true,
            'message' => 'ECG image deleted successfully'
        ]);
    }
}
