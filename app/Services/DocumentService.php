<?php

namespace App\Services;

use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Requests\Document\StoreImageFolderMapperRequest;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Http\Resources\Document\DocumentCollection;
use App\Http\Resources\Document\DocumentResource;
use App\Models\Document;
use App\Models\DocumentsFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentService
{
    public function store(StoreDocumentRequest $request)
    {

        $validatedData = $request->validatedWithFiles();

        $files = $validatedData['files'];
        if (Auth::check()) {
            $userId = Auth::user()->id;
            \DB::transaction(function () use ($files, $userId) {
                foreach ($files as $key => $file) {

                    $mimeToTypeMap = [
                        'image/jpeg' => 'image',
                        'image/png' => 'image',
                        'image/avif' => 'image',
                        'image/gif' => 'image',
                        'application/pdf' => 'pdf',
                        // Add more mime types and their respective document types as needed
                    ];

                    $mime_type = $file->getMimeType();
                    $document_type = $mimeToTypeMap[$mime_type] ?? 'doc';

                    $uuid = (string) Str::uuid();
                    $name = $uuid.'.'.$file->getClientOriginalExtension();
                    $path = $file->storeAs('documents/'.$userId.'/'.$file->getClientOriginalExtension(), $name, 'public');


                    $document = new Document([
                        'user_id' => $userId,
                        'document_type' => $document_type,
                        'path' => $path,
                        'name' => $name,
                        'original_name' => $file->getClientOriginalName(),
                        'extension' => $file->getClientOriginalExtension(),
                        'mime_type' => $mime_type,
                        'size' => $file->getSize(),
                        // Other fields
                    ]);

                    $document->save();

                }
            });

            return new DocumentCollection(Document::where('user_id', $userId)->get());
        }

        return response()->json(['error' => 'Unauthorized'], 401);

    }

    public function update(UpdateDocumentRequest $request, $id)
    {
        $document = Document::find($id);
        $validatedData = $request->validated();
        //dd($validatedData);
        $document->update($validatedData);

        return new DocumentResource($document);
    }

    public function delete($id)
    {
        $document = Document::find($id);
        if (! $document) {
            return response()->json([
                'data' => [],
                'status' => false,
                'code' => 404,
                'message' => 'Document not found',
            ], 404);
        }
        $path = $document->path;
        $document->delete();
        Storage::delete('public/'.$path);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Document deleted successfully',
        ], 200);
    }

    public function getFile($id)
    {
        $document = Document::find($id);
        $path = $document->path;
        $name = $document->name;
        $mime_type = $document->mime_type;
        $size = $document->size;
        $original_name = $document->original_name;
        $extension = $document->extension;
        $document_type = $document->document_type;
        $content = Storage::get('public/'.$path);
        $response = Response::make($content, 200);
        $response->header('Content-Type', $mime_type);
        $response->header('Content-Disposition', "attachment; filename=$original_name");

        return $response;
    }

    public function show($id)
    {
        $document = Document::find($id);

        return new DocumentResource($document);
    }

    public function userDocuments(Request $request)
    {
        if ($request->has('type')) {
            $type = $request->type;
            $documents = Document::where('user_id', Auth::user()->id)->where('document_type', $type)->get();

            return new DocumentCollection($documents);
        }

        if ($request->has('type') && $request->has('tags')) {
            $type = $request->type;
            $tags = $request->tags;
            //use likes for tags
            $documents = Document::where('user_id', Auth::user()->id)->where('document_type', $type)
                ->where('tags', $tags)->get();

            return new DocumentCollection($documents);
        }

        $documents = Document::with(['documents','folders'])->where('user_id', Auth::user()->id)
            ->orderByRaw('document_type ="folder" DESC,original_name ASC, updated_at DESC')->get();
       // dd($documents);
        //  dd($documents->toSql());
        return new DocumentCollection($documents);
    }
    public function imageToFolder(StoreImageFolderMapperRequest $request)
    {
       $documentFolder = new DocumentsFolder();
       $documentFolder->document_id = $request->document_id;
       $documentFolder->folder_id = $request->folder_id;
        $documentFolder->save();
        return response()->json([
            "status"=>true,
            "message">"Document folder mapped successfully"
        ],201);
    }

}
