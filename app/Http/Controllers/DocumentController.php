<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $types = DocumentType::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $documents = Document::query()
            ->with('type')
            ->when(
                $request->filled('type'),
                fn($query) => $query->where(
                    'document_type_id',
                    $request->input('type')
                )
            )
            ->when(
                $request->filled('year'),
                fn($query) => $query->whereYear(
                    'document_date',
                    $request->integer('year')
                )
            )
            ->latest('document_date')
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        $years = Document::query()
            ->whereNotNull('document_date')
            ->selectRaw('EXTRACT(YEAR FROM document_date)::integer AS year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('pages.documents.index', [
            'documents' => $documents,
            'types' => $types,
            'years' => $years,
        ]);
    }
}
