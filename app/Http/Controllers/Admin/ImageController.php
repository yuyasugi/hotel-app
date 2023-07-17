<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlanImage;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class ImageController extends BaseController
{

    public function destroy($id)
{
    $image = PlanImage::findOrFail($id);
    $filename = $image->filename;

    // Delete the image from the database
    $image->delete();

    // Delete the image file from the server
    Storage::disk('public')->delete('images/' . $filename);

    return response()->json([
        'message' => 'Image has been deleted successfully!'
    ]);
}
}
