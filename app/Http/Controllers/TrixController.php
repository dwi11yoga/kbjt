<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrixController extends Controller
{
    //simpan gambar
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:1024' // Maksimal 1MB
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        return response()->json(['url' => Storage::url($path)]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        // Parse the file path from the URL
        $filePath = str_replace('/storage/', '', parse_url($request->url, PHP_URL_PATH));

        // Delete the file from storage
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'File not found'], 404);
    }
}
