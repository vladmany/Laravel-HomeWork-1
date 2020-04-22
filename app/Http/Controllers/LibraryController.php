<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use DOMDocument;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use SimpleXMLElement;
use Transliterator;

class LibraryController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request) {
        $genres = Genre::all();
        $books = (($request->input('genre') == 'all') or (!$request->input('genre'))) ? Book::all() : Book::all()->where('genre_name', $request->input('genre'));
        $books = $books->sortByDesc('id');
        $data = [
            'genres' => $genres,
            'books' => $books,
            'selGenre' => $request->input('genre')
        ];
        return view('library.index', compact('data'));
    }

    /**
     * @param Book $book
     * @return Factory|View
     */
    public function show(Book $book) {

        return view('library.show', compact('book'));
    }

    /**
     * @param Book $book
     * @return Factory|View
     * @throws FileNotFoundException
     */
    public function read(Book $book) {
        $bookFile = Storage::disk('public')->get($book->body_path);

        $start = strpos($bookFile, '<body>');
        $end = strpos($bookFile, '</body>');

        $bookBody = substr($bookFile, $start, ($end-$start));
        $bookBody = strip_tags($bookBody, '<p></p><title></title><strong></strong>');
        $bookBody = str_replace('title', 'h3',$bookBody);
        $bookBody = explode("\n", $bookBody);
        $bookBody = $this->paginate($bookBody, 100, null, ['path' => '/books/'.$book->id.'/read']);

        return view('library.read', compact(['bookBody','book']));
    }

    /**
     * @param Book $book
     * @return mixed
     */
    public function download(Book $book) {
        $fileName = str_replace(["'", " "], ["", "_"], Str::of($book->title)->ascii());
        return Storage::disk('public')->download($book->body_path, $fileName.'.fb2');
    }

    /**
     * @param $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 100, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
