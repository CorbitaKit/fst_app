<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
    private $fileName;
    public function store(Request $request)
    {
        $data = [
            'file_name' => $request->file_name,
            'citizen_id' => $request->citizen_id,
            'user_id' => Auth::user()->id,
            'parent_id' => $request->parent_id,
            'type' => 'Folder'
        ];

        if ($request->parent_id == 0) {
            $this->fileName = $request->file_name->getClientOriginalName();
        } else {
            $this->getFileName($request->parent_id);
            $this->fileName = $this->fileName  . $request->file_name->getClientOriginalName();
        }

        $isCreated = Storage::makeDirectory($this->fileName);
        Document::create($data);
    }

    private function getFileName($parent_id)
    {
        $parent = Document::where('id', $parent_id)->first();

        if ($parent) {
            $this->fileName = $parent->file_name . '/' . $this->fileName;
            $this->getFileName($parent->parent_id);
        }
    }
}
