<?php

namespace App\Http\Controllers\AdminPanel\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(15);

        return view('library.adminpanel.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('library.adminpanel.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only(['name', 'password', 'email']);
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = Role::all()->where('name','User')->first()->id;

        User::create($data);

        return redirect()->route('adminpanel.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('library.adminpanel.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->only(['name', 'password', 'email']);
        if (isset($data['password']) && $data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        if (!isset($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('adminpanel.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $books = Book::all()->where('publisher_id', $user->id);

        if ($books->count() > 0)
        {
            return view('library.adminpanel.users.confirmDelete',compact(['user','books']));
        } else {
            $user->delete();

            return redirect()->route('adminpanel.users.index');
        }
    }

    public function destroyWithBooks(User $user, Book $books)
    {

        $books->delete();
        $user->delete();

        return redirect()->route('adminpanel.users.index');
    }

    public function destroyOnlyUser(User $user, Book $books)
    {
        $books->update(['author_id' => null]);
        $user->delete();

        return redirect()->route('adminpanel.users.index');
    }


}
