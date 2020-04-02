<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    function index(Request $request) {
        $genres = Genre::all();
        $books = (($request->input('genre') == 'all') or (!$request->input('genre'))) ? Book::all() : Book::all()->where('genre_name', $request->input('genre'));
        $data = [
            'genres' => $genres,
            'books' => $books,
            'selGenre' => $request->input('genre')
        ];
        return view('library.index', compact('data'));
    }
}
