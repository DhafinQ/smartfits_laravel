<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    public function index(Request $request){
        $users = User::with('customer');
        if($request->name){
            $users = $users->where('name','like','%'.$request->name.'%');
        }
        $users = $users->get()->except(Auth::user()->id);
        return view('admin-users.index',compact('users'));
    }

    public function create(){
        return view('admin-users.edit');
    }

    public function store(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'password' => ['required', Password::default(), 'confirmed'],
            'email' => ['required', Rule::unique('users','email')],
            'tgl_lahir' => ['required_if:role,client', 'date','nullable'],
            'jekel' => ['required_if:role,client', Rule::in('Laki-Laki','Perempuan'),'nullable'],
            'tipe_aktivitas' => ['required_if:role,client', Rule::in('Aktif','Sangat Aktif','Sedikit Aktif'),'nullable'],
            'role' => ['required',Rule::in('admin','client')],
        ]);
        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
            'role' => $validate['role']
        ]);

        if($validate['role'] == 'client'){
            $client = Customer::create([
                'user_id' => $user->id,
                'tgl_lahir' => Carbon::parse($validate['tgl_lahir']),
                'jekel' => $validate['jekel'],
                'tipe_aktivitas' => $validate['tipe_aktivitas'],
            ]);
        }

        return Redirect::route('users.create')->with('status', 'user-created');
    }

    public function show(User $user)
    {
        return view('admin-users.show',compact('user'));
    }

    public function edit(User $user)
    {
        $L_user = $user;
        return view('admin-users.edit',compact('L_user'));
    }

    public function update(Request $request, User $user){
        $validate = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users','email')->ignore($user->_id,'_id')],
            'tgl_lahir' => ['required_if:role,client', 'date','nullable'],
            'jekel' => ['required_if:role,client', Rule::in('Laki-Laki','Perempuan'),'nullable'],
            'tipe_aktivitas' => ['required_if:role,client', Rule::in('Aktif','Sangat Aktif','Sedikit Aktif'),'nullable'],
            'role' => ['required',Rule::in('admin','client')],
        ]);

        if($validate['role'] == 'admin' && $user->role == 'client'){
            $notes = $user->customer->foodnotes ?? 0;
            if($notes){
                foreach($notes as $note){
                    $note->delete();
                }
            }
            $customer = $user->customer;
            $customer->delete();
        }else if($validate['role'] == 'client' && $user->role == 'admin'){
            $client = Customer::create([
                'user_id' => $user->id,
                'tgl_lahir' => Carbon::parse($validate['tgl_lahir']),
                'jekel' => $validate['jekel'],
                'tipe_aktivitas' => $validate['tipe_aktivitas'],
            ]);
        }else if($user->role == 'client' && $validate['role'] == 'client'){
            $customer = $user->customer;
            $customer->update([
                'tgl_lahir' => Carbon::parse($validate['tgl_lahir']),
                'jekel' => $validate['jekel'],
                'tipe_aktivitas' => $validate['tipe_aktivitas'],
            ]);
        }

        $user->update([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'role' => $validate['role'],
       ]);

        return Redirect::route('users.edit',['user' => $user->id])->with('status', 'user-updated');
    }

    public function destroy(User $user){
        if($user){
            $foodNotes = $user->customer->foodnotes ?? 0;
            $customer = $user->customer;
            if($user->delete() && $customer->delete()){
                if($foodNotes){
                    foreach($foodNotes as $note){
                        $note->delete();
                    }
                }
                return Redirect::route('users.index')->with('status', 'user-deleted');
            }
        }
        return Redirect::route('users.index')->with('status', 'user-delete-error');
    }
}
