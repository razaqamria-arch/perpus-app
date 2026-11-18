<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    // 1. Menampilkan daftar buku dan fitur pencarian
    public function index(Request $request)
    {
        $books = Book::when($request->filled('search'), function ($query) use ($request) {

            $search = $request->search;

            // Mencari berdasarkan judul atau pengarang
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%");
            });

        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return Inertia::render('Books/Index', [
            'books' => $books,
            'search' => $request->search,
        ]);
    }

    // 2. Menampilkan form tambah buku
    public function create()
    {
        return Inertia::render('Books/Create');
    }

    // 3. Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
        ]);

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // 4. Menampilkan detail buku
    public function show(Book $book)
    {
        return Inertia::render('Books/Show', [
            'book' => $book,
        ]);
    }

    // 5. Menampilkan form edit buku
    public function edit(Book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book,
        ]);
    }

    // 6. Memperbarui data buku
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku,' . $book->id,
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
        ]);

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    // 7. Menghapus data buku
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
