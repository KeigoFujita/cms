<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $roles = ['admin', 'writer'];


    public function index()
    {

        return view('users.index')->with('users', User::all());
    }

    public function view(User $user)
    {
        return view('users.view', [
            'roles' => $this->roles,
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required|max:50|min:5',
                'email' => 'required|email',
                'avatar' => 'image|max:2048'
            ]
        );

        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($user->image);
            $new_image = $request->file('avatar')->store('avatar', 'public');
            $user->image = $new_image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if (in_array($request->role, $this->roles)) {
            $user->role = $request->role;
        }

        $user->save();
        session()->flash('success', 'Updated Information Successfully.');
        return redirect(route('users.view', $user));
    }


    public function makeAdmin(User $user)
    {

        $user->role = 'admin';
        $user->save();
        session()->flash('success', 'Changed to Admin Successfully.');
        return redirect(route('users.index'));
    }
}