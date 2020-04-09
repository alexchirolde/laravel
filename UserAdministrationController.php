<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAdministrationController extends Controller {


    private function createUserValidator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', 'string']
        ]);
    }
    public function createUser(Request $request) {

    $this->createUserValidator($request->all())->validate();
    $data = $request->all();
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'status' => $data['status']

    ]);
    // give user status => will be added later
    //give user role
    // check if role matches all roles for input validation
    $user->assignRole($data['role']);

    return back()->withSuccess("The User {$user->name} has been created successfully");

}

    public function editUser(Request $request, $id) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', 'string']
        ]);
        $user = User::find($id);
        $user -> name = $request['name'];
        $user -> email = $request['email'];
        $user -> password = $request['password'];
        $user -> status = $request['status'];
        $user->save();



        return back()->withSuccess("The User {$user->name} has been updated successfully");

    }

    public function displayCreateUsersForm() {
        $allRoles = Role::all()->pluck('name');
        return view('backend.userAdministration.createUsers', ['roles' => $allRoles]);
    }

    public function displayListUsersForm() {
        $allUsers = User::all();
        return view('backend.userAdministration.listUsers', ['users' => $allUsers]);
    }

    public function displayEditUsersForm($id) {
        $currentUser = User::findOrFail($id);
        $allRoles = Role::all()->pluck('name');
        //        We have to consider storing the field Status in a different table(Ex: Like Role) and not as a field of the table User
        //        When we are going to edit a user we have to provide the current value for the Status field and the rest of options
        //        I think it will be better if we have it stored apart. It`s a recommendation. What do you think?
        //        Ps: take a look at editUsers.blade.php template how it`s implemented with the roles field.
        return view('backend.userAdministration.editUsers', ['user' => $currentUser, 'roles'=>$allRoles]);
    }
}
