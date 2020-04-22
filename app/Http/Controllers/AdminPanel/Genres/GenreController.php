<?php

namespace App\Http\Controllers\AdminPanel\Genres;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $genres = Genre::paginate(15);

        return view('library.adminpanel.genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {

        return view('library.adminpanel.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->only(['name']);

        $request->validate([
            'name' => 'required'
        ],
        [
            'required' => 'Поле обязательное для заполнения'
        ]);

        Genre::create($data);

        return redirect()->route('adminpanel.genres.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Genre $genre
     * @return Factory|View
     */
    public function edit(Genre $genre)
    {
        return view('library.adminpanel.genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Genre $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Genre $genre)
    {
        $data = $request->only(['name']);

        $request->validate([
            'name' => 'required'
        ],
        [
                'required' => 'Поле обязательное для заполнения'
        ]);

        $books = Book::all()->where('genre_name', $genre->name);
        $booksWithGenre = [];


        if($books->count() > 0)
        {
            foreach ($books as $book) {
                $book->update(['genre_name' => 'Без жанра']);
                array_push($booksWithGenre, $book);
            }
            $genre->update($data);
            foreach ($booksWithGenre as $book) {
                $book->update(['genre_name' => $data['name']]);
            }
        } else {
            $genre->update($data);
        }

        return redirect()->route('adminpanel.genres.index');
    }
}
