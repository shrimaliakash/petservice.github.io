<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Group;
use Hash;

class AdminController extends Controller
{
    public function dashboard(){
      return view('admin.home');
    }

    public function login(){
      if(Auth::check() && Auth::user()->user_type == "admin")
        return redirect('/admin');

      return view('admin.login');
    }

    public function loginAuth(request $request){
      if(Auth::attempt([
        'email'     => $request->email,
        'password'  => $request->password,
        'user_type' => 'admin'
      ])){
        if($request->language)
          Session::put('admin_lang', $request->language);
        else
          Session::put('admin_lang', 'en');

        return redirect('/admin');
      }else{
        return redirect()->route('adminLogin')->withErrors(['login' => 'Incorrect Email or Password']);
      }
    }

    public function index()
    {
      $this->_checkPerm('admins');

      $users = User::whereUserType('admin')->orderBy('id', 'DESC')->with('groups')->get();

      return view('admin.admins.index', compact(['users', 'header_files']));
    }

    public function create()
    {
        $this->_checkPerm('admins');

        $action = 'add';
        $groups_list = $this->get_groups();
        return view('admin.admins.form', compact(['action', 'groups_list']));
    }

    public function store(Request $request)
    {
        $this->_checkPerm('admins');

        $validation = $this->validate($request, [
          'name'      => 'required',
          'email'     => 'required|email|unique:users',
          'password'  => 'required|min:6',
          'group_id'  => 'required',
          'avatar'    => 'image|mimes:jpeg,png,jpg,gif,svg',
        ], $this->messages());

        $avatar = '';
        if($request->hasFile('avatar')){
          $image = $request->file('avatar');
          $img_name = 'admin_'.time().'.'.$image->getClientOriginalExtension();
          $path = public_path('/uploads/users');
          if($image->move($path, $img_name))
            $avatar = $img_name;
        }

        $user = User::create([
          'user_type'   => 'admin',
          'password'    => Hash::make($request->password),
          'name'        => $request->name,
          'email'       => $request->email,
          'group_id'    => $request->group_id,
          'avatar'      => $avatar
        ]);
        Session::flash('success', 'Created adminstrator successfully');
        return redirect('admin/admins');
    }

    public function show($id)
    {
        $this->_checkPerm('admins');

        $user = User::whereUserType('admin')->findOrFail($id);
        return view('admin.admins.show', compact(['user']));
    }

    public function edit($id)
    {
        $this->_checkPerm('admins');

        $user = User::where([
          'user_type' => 'admin'
        ])->findOrFail($id);

        $action = 'edit';
        $groups_list = $this->get_groups();
        return view('admin.admins.form', compact(['user', 'action', 'groups_list']));
    }

    public function update(Request $request, $id)
    {
        $this->_checkPerm('admins');

        $user = User::whereUserType('admin')->findOrFail($id);

        $validation = $this->validate($request, [
          'name'      => 'required',
          'password'  => 'min:6',
          'group_id'  => 'required',
          'avatar'    => 'image|mimes:jpeg,png,jpg,gif',
        ], $this->messages());

        if($request->hasFile('avatar')){
          $image = $request->file('avatar');
          $img_name = 'admin_'.time().'.'.$image->getClientOriginalExtension();
          $path = public_path('/uploads/users');
          if($image->move($path, $img_name))
            $avatar = $img_name;
        }else{
          $avatar = $user->avatar;
        }

        $update = [
          'name'      => $request->name,
          'group_id'  => $request->group_id,
          'avatar'    => $avatar
        ];

        if($request->password)
          $update['password'] = Hash::make($request->password);

        $user->update($update);
        Session::flash('success', 'adminstrator edit successfully');
        return redirect('/admin/admins/'.$id.'/edit');
    }

    public function destroy($id)
    {
        $this->_checkPerm('admins');

        $count = User::whereUserType('admin')->count();
        if($count == 1)
          return redirect('/admin/admins')->withErrors('Sorry... You must have at least one adminstrator');

        $delete = User::findOrFail($id);
        $delete->delete();

        Session::flash('success', 'Delete adminstrator successfully');
        return redirect('/admin/admins');
    }

    public function get_groups(){
      return Group::all();
    }

    public function messages()
    {
      return [
          'group_id.required' => 'Please select the admin group',
      ];
    }
}
