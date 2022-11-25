<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Session;

class GroupsController extends Controller
{
    public function __construct(){
      $this->_permArray = [
        'admins' => [
          'en'  => 'Adminstrators',
          'ar'  => 'المديرون'
        ],
        'groups' => [
          'en'  => 'Groups',
          'ar'  => 'المجموعات'
        ],
        'settings' => [
          'en'  => 'Settings',
          'ar'  => 'الإعدادات'
        ],
        'error_logs' => [
          'en'  => 'Error Logs',
          'ar'  => 'سجلات الأخطاء'
        ],
      ];
    }

    public function index()
    {
      $this->_checkPerm('groups');
      $groups = Group::all();
      return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        $this->_checkPerm('groups');
        $perm = $this->_permArray;
        $action = 'add';
        return view('admin.groups.form', compact(['perm', 'action']));
    }

    public function store(Request $request)
    {
        $this->_checkPerm('groups');

        $validation = $this->validate($request, [
          'name_en' => 'required',
          'name_ar' => 'required'
        ], $this->messages());

        $group = Group::create($request->all());
        Session::flash('success', 'Created group successfully');
        return redirect('admin/groups');
    }

    public function show($id)
    {
        $this->_checkPerm('groups');
        $group = Group::find($id);
        $users = Group::find($id)->users;
        $perm = $this->_permArray;
        return view('admin.groups.show', compact(['group', 'perm', 'users']));
    }

    public function edit($id)
    {
        $this->_checkPerm('groups');

        $group = Group::findOrFail($id);
        $perm = $this->_permArray;
        $action = 'edit';
        if($group)
          $row_perm = $group->permissions;
        else
          $row_perm = [];
        return view('admin.groups.form', compact(['group', 'perm', 'action', 'row_perm']));
    }

    public function update(Request $request, $id)
    {
        $this->_checkPerm('groups');

        $group = Group::findOrFail($id);

        $validation = $this->validate($request, [
          'name_en' => 'required',
          'name_ar' => 'required'
        ], $this->messages());

        $group->update($request->all());
        Session::flash('success', 'Group edit successfully');
        return redirect('/admin/groups/'.$id.'/edit');
    }

    public function destroy($id)
    {
        $this->_checkPerm('groups');

        $count = Group::count();
        if($count == 1)
          return redirect('/admin/groups')->withErrors('Sorry... You must have at least one group');

        $delete = Group::findOrFail($id);
        $delete->delete();

        Session::flash('success', 'Delete Group successfully');
        return redirect('/admin/groups');
    }

    public function messages()
    {
      return [
          'name_en.required' => 'Please enter the English name',
          'name_ar.required' => 'Please enter the Arabic name',
      ];
    }
}
