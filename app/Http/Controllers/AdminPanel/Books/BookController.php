<?php

namespace App\Http\Controllers\AdminPanel\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Requests\Book\UploadRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $books = Book::paginate(15);

        return view('library.adminpanel.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $genres = Genre::all();
        foreach($genres as $genre)
        {
            $selectGenreFields[$genre->name] = $genre->name;
        }

        return view('library.adminpanel.books.create', compact('selectGenreFields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadRequest $request
     * @return RedirectResponse
     */
    public function store(UploadRequest $request)
    {
        $bookId = Book::max('id') + 1;
        if($request->hasFile('preview')) {
            $preview = $request->file('preview');
            $previewPath = $preview->store('books/'.$bookId.'/preview' , ['disk' => 'public']);
        }
        if($request->hasFile('body')) {
            $body = $request->file('body');
            $bodyPath = $body->store('books/'.$bookId.'/body' , ['disk' => 'public']);
        }

        $data = $request->only(['title', 'annotation', 'author', 'genre_name', 'year']);
        $data['preview_path'] = $previewPath;
        $data['body_path'] = $bodyPath;
        $data['publisher_id'] = Auth::user()->id;

        Book::create($data);

        return redirect()->route('adminpanel.books.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return Factory|View
     */
    public function edit(Book $book)
    {
        $genres = Genre::all();
        foreach($genres as $genre)
        {
            $selectGenreFields[$genre->name] = $genre->name;
        }

        return view('library.adminpanel.books.edit', compact(['selectGenreFields', 'book']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Book $book)
    {
        if($request->hasFile('preview')) {
            $preview = $request->file('preview');
            Storage::disk('public')->delete($book->preview_path);
            $previewPath = $preview->store('books/'.$book->id.'/preview' , ['disk' => 'public']);
        }
        if($request->hasFile('body')) {
            $body = $request->file('body');
            Storage::disk('public')->delete($book->body_path);
            $bodyPath = $body->store('books/'.$book->id.'/body' , ['disk' => 'public']);
        }

        $data = $request->only(['title', 'annotation', 'author', 'genre_name', 'year']);

        if (isset($previewPath))
            $data['preview_path'] = $previewPath;
        if (isset($bodyPath))
            $data['body_path'] = $bodyPath;

        $book->update($data);

        return redirect()->route('adminpanel.books.index');
    }
}
