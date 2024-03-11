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
    private $totalSize;
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
            'type' => $this->getType($request->file_name),
            'size' => $this->formatSizeUnits($request->file_name->getSize())
        );

        if ($request->parent_id == 0) {
            $this->fileName = $request->file_name->getClientOriginalName();
        } else {
            $this->getFileName($request->parent_id);
            $this->fileName = $this->fileName  . $request->file_name->getClientOriginalName();
        }
        $data['path'] = $this->fileName;
        $isUploaded = Storage::disk('ftp')->put($this->fileName, file_get_contents($request->file_name));
        if ($isUploaded) {
            Document::create($data);
        }
    }

    public function getFileSize($citizen_id)
    {
        $imageDocuments = Document::where('citizen_id', $citizen_id)->where('type', 'Image')->get();
        $videoDocuments = Document::where('citizen_id', $citizen_id)->where('type', 'Video')->get();
        $applicationDocuments = Document::where('citizen_id', $citizen_id)->whereIn('type', ['Application', 'Text'])->get();

        return [
            'image' => $this->getTotalSize($imageDocuments),
            'document' =>  $this->getTotalSize($applicationDocuments),
            'video' =>  $this->getTotalSize($videoDocuments),
            'total' => $this->formatSizeUnits($this->totalSize),
            'average' => $this->getAverage()
        ];
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

    private function getTotalSize($files)
    {
        $totalSize = 0;
        foreach ($files as $file) {
            list($value, $unit) = explode(' ', $file->size);
            switch (strtolower($unit)) {
                case 'bytes':
                    $totalSize += $value;
                    break;
                case 'kb':
                    $totalSize += $value * 1024;
                    break;
                case 'mb':
                    $totalSize += $value * 1024 * 1024;
                    break;
                case 'gb':
                    $totalSize += $value * 1024 * 1024 * 1024;
                    break;
                default:

                    break;
            }
        }
        $this->totalSize = $this->totalSize + $totalSize;
        return $this->formatSizeUnits($totalSize);
    }
    private function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    private function getAverage()
    {
        list($value, $unit) = explode(' ', $this->formatSizeUnits($this->totalSize));
        switch (strtolower($unit)) {
            case 'bytes':
                return $value / pow(1024, 3);
            case 'kb':
                return $value / pow(1024, 2);
            case 'mb':
                return $value / 1024;
            case 'gb':
                return ($value / 5) * 100;
            default:
                break;
        }
    }
}
