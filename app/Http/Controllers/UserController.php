<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Log;

use App\Http\Requests;

class UserController extends Controller
{
    public function postUpdateUser(Requests\UserRequest $request){
        $notes = Customer::where('id', $request->get('customer_id'))->first()->notes;
        if($notes != $request->get('notes')){
            $request['notes_updated'] = date("Y-m-d h:i");
        }
        Customer::where('id', $request->get('customer_id'))->update($request->except(['_token', 'customer_id']));
        return back()->with('message', 'User profile has been edited!');
    }

    public function getAddUser(){
        $users = User::where('admin', 0)->get();
        return view('admin.addUser.usersList', compact('users'));
    }

    public function deleteUserAdmin($id){
        $user = User::whereRaw("id = ? AND admin = ?", [$id, 0])->first();
        if($user){
            $user->delete();
            return redirect("/cpanel/users")->with('message', "User deleted Successfully");
        }else{
            return redirect("/cpanel/users")->withErrors("User Not Found");
        }
    }

    public function createAdminUser(){
        return view('admin.addUser.createAdminUser');
    }

    public function newAdminUser(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'phone' => 'required|min:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:5|same:password'
        ]);
        User::create(['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'admin' => 0, 'password' => bcrypt($request->password)]);
        return redirect("/cpanel/users")->with('message',"User Created Successfully");
    }

    public function editUserAdmin($id){
        $user = User::find($id);
        if($user){
            return view('admin.addUser.editAdminUser', compact('user'));
        }else{
            /*$users = User::where('admin', 0)->get();
            return view('admin.addUser.usersList', compact('users'));*/
            return redirect("/cpanel/users")->withErrors("User Not Found");
        }    
    }

    public function updateAdminUser(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'min:6',
            'password_confirmation' => 'same:password',
            'phone' => 'required|min:10'
        ]);
        $saveUser = User::find(Input::get('id'));
        if($saveUser){
            $saveUser->name = Input::get('name');
            $saveUser->email = Input::get('email');
            $saveUser->password = bcrypt(Input::get('password'));
            $saveUser->phone = Input::get('phone');
            $saveUser->update();
            $users = User::where('admin', 0)->get();
            return redirect("/cpanel/users")->with('message',"User Updated Successfully");
        }else{
            return redirect("/cpanel/users")->withErrors("User Not Found");
        }    
    }

    public function getDeleteUser($id) {

        Customer::find($id)->delete();

        return back()->with('message', 'User has been deleted!');
    }
}
