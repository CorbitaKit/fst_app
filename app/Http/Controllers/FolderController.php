<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'file_name' => $request->file_name,
            'citizen_id' => $request->citizen_id,
            'user_id' => Auth::user()->id,
            'parent_id' => $request->parent_id,
            'type' => 'Folder',
        ];

        Document::create($data);
    }
}
