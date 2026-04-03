<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        $borrowLimit = 5;
        $currentBorrowCount = Borrow::where('user_id', $user->id)->count();
        $status = $currentBorrowCount < $borrowLimit ? 'Allowed to borrow' : 'Borrowing limit reached';

        $borrows = Borrow::with('book')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('member.profile', compact('user', 'borrowLimit', 'currentBorrowCount', 'status', 'borrows'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('member.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('member.profile')->with('success', 'Profile updated successfully');
    }
}