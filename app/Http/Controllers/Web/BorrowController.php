<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;

class BorrowController extends Controller
{
    public function borrow(Book $book)
    {
        if ($book->copies <= 0) {
            return back()->withErrors(['borrow' => 'Book Currently Unavailable']);
        }

        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);

        $book->decrement('copies');

        return redirect()->route('my-borrows')->with('success', 'Borrow successful');
    }

    public function myBorrows()
    {
        $borrows = Borrow::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('borrows.index', compact('borrows'));
    }
}