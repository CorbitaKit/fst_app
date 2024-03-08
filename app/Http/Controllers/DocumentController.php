<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    private $fileName;
    public function index()
    {
        return Inertia::render('document/index');
    }

    public function getCitizenDocument($citizen_id)
    {
        $documents = Document::with('children')->where('citizen_id', $citizen_id)->where('parent_id', 0)->get();

        return response(json_encode($documents), 200);
    }

    public function getDocumentChildren($parent_id)
    {
        $documents = Document::where('parent_id', $parent_id)->get();

        return response(json_encode($documents), 200);
    }

    public function store(Request $request)
    {

        $data = array(
            'file_name' =>  $request->file_name->getClientOriginalName(),
            'citizen_id' => $request->citizen_id,
            'user_id' => Auth::user()->id,
            'parent_id' => $request->parent_id,
            'type' => $this->getType($request->file_name)
        );
        if ($request->parent_id == 0) {
            $this->fileName = $request->file_name->getClientOriginalName();
        } else {
            $this->getFileName($request->parent_id);
            $this->fileName = $this->fileName  . $request->file_name->getClientOriginalName();
        }

        $isUploaded = Storage::disk('ftp')->put($this->fileName, file_get_contents($request->file_name));
        if ($isUploaded) {
            Document::create($data);
        }
    }

    private function getType($file)
    {
        $fileType = explode('/', $file->getMimeType());
        return ucfirst($fileType[0]);
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
