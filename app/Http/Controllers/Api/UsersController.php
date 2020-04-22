<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all()->where('role_id', '1');

        return response()->json($users);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::all()->where('id', $id)->first();
        $books = Book::all()->where('publisher_id', $user->id);


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
                'user' => $user->id
            ]);
        } else {
            $user->delete();

            return response()->json(['status' => 1]);
        }
    }

    public function destroyWithBooks(Request $request)
    {
        $booksIds = $request->booksIds;
        $userId = $request->userId;
        foreach ($booksIds as $bookId)
        {
            Book::all()->where('id', $bookId)->first()->delete();
        }

        User::all()->where('id', $userId)->first()->delete();

        return response()->json(['status' => '3']);
    }

    public function destroyOnlyUser(Request $request)
    {
        $booksIds = $request->booksIds;
        $userId = $request->userId;
        foreach ($booksIds as $bookId)
        {
            Book::all()->where('id', $bookId)->first()->update(['publisher_id' => null]);
        }

        User::all()->where('id', $userId)->first()->delete();

        return response()->json(['status' => '3']);
    }
}
