<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Http\FileServiceForDocuments;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // METHOD TO REDIRECT TO INDEX PAGE
    public function index()
    {
        return view('admins.documents.index', ['documents' => Document::orderBy('name', 'asc')->get()]);
    }

    // STORE METHOD
    public function store(DocumentRequest $request)
    {
        $path = FileServiceForDocuments::upload($request->file('document'), '/documents');
        $result = Document::create([
            'name' => $request->name,
            'document' => $path
         ]);

        return $result ? to_route('admins.documents.index')->with(['success' => 'Документ успешно добавлен']) :
            to_route('admins.documents.index')->withErrors(['error' => 'Не удалось добавить документ']);
    }

    // UPDATE METHOD
    public function update(Request $request)
    {
        $result = false;
        $document = Document::find($request->id);

        if(Document::where('name', $request->name)->first() != null) {
            if (Document::where('name', $request->name)->first() == $document) {
                $path = FileServiceForDocuments::update('/documents', $document->document, $request->file('document') ?? '');

                if ($path) {
                    $result = $document->update(array_merge(['document' => $path], $request->except(['document'])));
                } else {
                    $result = $document->update($request->except(['document']));
                }
            }
        } else {
            $path = FileServiceForDocuments::update('/documents', $document->document, $request->file('document') ?? '');

            if ($path) {
                $result = $document->update(array_merge(['document' => $path], $request->except(['document'])));
            } else {
                $result = $document->update($request->except(['document']));
            }
        }

        return $result ? to_route('admins.documents.index')->with(['success' => 'Документ был успешно обновлен']) :
            to_route('admins.documents.index')->withErrors(['error' => 'Не удалось обновить документ. Проверьте, что наименование не повторяется']);
    }

    // DELETE METHOD
    public function delete(Request $request)
    {
        $document = Document::find($request->id);
        $result = $document->delete();
        $path = FileServiceForDocuments::delete($document->document);

        return $result ? to_route('admins.documents.index')->with(['success' => 'Документ успешно удален']) :
            to_route('admins.documents.index')->withErrors(['error' => 'Не удалось удалить документ']);
    }
}
