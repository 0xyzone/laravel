<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\NewUser;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlename = 'Users';
        $users = User::where('role', 0)->orWhere('role', 2)->paginate(10, ['*'], 'users');
        $payments = Payment::with('getUser')->get();
        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }
        return view('dashboard.users', compact('titlename', 'users', 'payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show registration form
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        // Register a user
        $formFields = $request->validate([
            'name' => 'required',
            'username' => ['required', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'required'
        ]);
        
        $username = $formFields['username'];
        $password = $formFields['password'];
        $email = $formFields['email'];
        Mail::to($email)->send(new NewUser($username, $password));
        
        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['role'] = 0;
        User::create($formFields);
        return redirect(route('users'))->with('success', 'User registered successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $id)
    {
        $titlename = $id['name'];
        return view('dashboard.singleUser', compact('titlename', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $id)
    {
        $titlename = 'Edit User';
        if (Auth::guest()) {
            return redirect(route('viewLogin'));
        }
        return view('users.edit', compact('titlename', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);
        if(isset($request['password'])){
            $formFields['password'] = bcrypt($request['password']);
        };
        $user->update($formFields);
        return redirect(route('users'))->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $orders = Order::where('user_id', $user->id)->get();
        dd($orders);
        $user->delete();
        return redirect(route('users'))->with('success', 'User deleted successfully.');
    }
}
