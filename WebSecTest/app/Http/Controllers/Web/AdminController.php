<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function rolesPage()
    {
        $roles = [
            'admin' => ['create_librarian', 'view_members', 'manage_books', 'view_roles_permissions'],
            'librarian' => ['view_members', 'manage_books'],
            'member' => ['view_books', 'borrow_books', 'view_my_borrows'],
        ];

        return view('admin.roles', compact('roles'));
    }

    public function createLibrarian()
    {
        return view('admin.create-librarian');
    }

    public function storeLibrarian(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'librarian',
        ]);

        return redirect()->route('librarians.index')->with('success', 'Librarian created successfully');
    }

    public function librarians()
    {
        $librarians = User::where('role', 'librarian')->orderBy('name')->get();
    
        return view('admin.librarians', compact('librarians'));
    }

    public function members()
    {
        $members = User::where('role', 'member')->orderBy('name')->get();
        return view('admin.members', compact('members'));
    }

    public function analysis()
{
    $totalBooks = Book::count();
    $totalMembers = User::where('role', 'member')->count();
    $totalLibrarians = User::where('role', 'librarian')->count();
    $totalBorrows = Borrow::count();

    $availableBooks = Book::where('copies', '>', 0)->count();
    $unavailableBooks = Book::where('copies', '<=', 0)->count();

    return view('admin.analysis', compact(
        'totalBooks',
        'totalMembers',
        'totalLibrarians',
        'totalBorrows',
        'availableBooks',
        'unavailableBooks'
    ));
}
}