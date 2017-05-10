<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\User;
use App\Http\Requests\user as UserRequest;
use Illuminate\Support\Facades\Input;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(Config('app.record_limit'));

        return view('admin.users.index', ['users' => $users]);

    }
    
    
    public function add()
    {
        return view('admin.users.add');
    }
    
    public function postAdd(UserRequest $request)
    {
        
        $data = array();
        $data = $request->all();

        $user_data["name"] = $data["name"];
        $user_data["email"] = $data["email"];
        $user_data["password"] = bcrypt($data["password"]);

        $user =  User::create($user_data);

        if ($user) {

            return redirect('admin/add-user')->with('success', 'User created successfully.');
        } else {
            return redirect('admin/add-user')->with('fail', 'Sorry, User not created.');
        }    
        
    }
    
    
    public function edit(Request $request)
    {
        $user = User::where('id',$request->id)->first();

        return view('admin.users.edit', ['user' => $user]);
    }
    
    public function postEdit(UserRequest $request)
    {
        $data = array();
        $data = $request->all();
        $user_data["name"] = $data["name"];
        $user_data["email"] = $data["email"];
        if(Input::has('password') && Input::get('password'))
            $user_data["password"] = bcrypt($data["password"]);

        $user =  User::where('id', $request->id)->update($user_data);

        if ($user) {
            return redirect()->route('admin/edit-user', ['id'=>$request->id])->with('success', 'User updated successfully.');
        } else {
            return redirect()->route('admin/edit-user', ['id'=>$request->id])->with('success', 'Sorry, User not updated.');
        }    
    }
    
    public function delete(Request $request)
    {
        $user =  User::where('id', $request->id)->delete();

        if ($user) {
            return redirect()->route('admin/users')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('admin/users')->with('success', 'Sorry, User not deleted.');
        }    
    }
}
