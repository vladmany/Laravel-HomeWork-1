<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index() {
        $user = auth()->user();
        $books = Book::all()->where('publisher_id', $user->id);
        $genres = [];
        foreach ($books->groupBy('genre_name') as $book)
        {
            if ($book[0]->genre_name != 'Без жанра')
                array_push($genres, $book[0]->genre_name);
        }

        $avatar = $user->avatar_path;
        return view('library.userpanel.profile', compact(['user','books', 'genres', 'avatar']));
    }

    public function avatarUpload(Request $request) {
        $user = auth()->user();
        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('users/'. $user->id .'/avatar' , ['disk' => 'public']);
            $user->update(['avatar_path' => $avatarPath]);
            return redirect()->route('userpanel.profile');
        }
    }
}
