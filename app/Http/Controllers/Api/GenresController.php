<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $genres = Genre::all();

        return response()->json($genres);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $genre = Genre::all()->where('id', $id)->first();
        $books = Book::all()->where('genre_name', $genre->name);


        if ($books->count() > 0)
        {
            $booksIds = [];
            foreach ($books as $book)
            {
                array_push($booksIds, $book->id);
            }

            return response()->json([
                'status' => 2,
                'books' => $booksIds,
                'genre' => $genre->id
            ]);
        } else {
            $genre->delete();
            return response()->json(['status' => 1]);
        }
    }

    public function destroyWithBooks(Request $request)
    {
        $booksIds = $request->booksIds;
        $genreId = $request->genreId;
        foreach ($booksIds as $bookId)
        {
            Book::all()->where('id', $bookId)->first()->delete();
        }

        Genre::all()->where('id', $genreId)->first()->delete();

        return response()->json(['status' => '3']);
    }

    public function destroyOnlyGenre(Request $request)
    {
        $booksIds = $request->booksIds;
        $genreId = $request->genreId;
        foreach ($booksIds as $bookId)
        {
            Book::all()->where('id', $bookId)->first()->update(['genre_name' => 'Без жанра']);
        }

        Genre::all()->where('id', $genreId)->first()->delete();

        return response()->json(['status' => '3']);
    }
}
