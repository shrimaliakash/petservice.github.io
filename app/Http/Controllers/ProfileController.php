<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Traits\DefaultController;

class ProfileController extends Controller
{
	use DefaultController;

  public function __construct(){
    $this->_model           = 'App\User';
    $this->_title           = __('adminlte.profile');
    $this->_icon            = '<i class="fa fa-user"></i>';
		$this->_route_link      = '/admin/profile';
		$this->_upload_path			= '/uploads/users';
    
		$this->_allow_create = false;
		$this->_allow_delete = false;
		$this->_allow_read 	 = false;

    $this->_columns         = [
    ];

    $this->_fields = [
      'group_id'    => [
				'label'   => __('adminlte.group'),
				'value'		=> '($row->groups)? $row->groups->name_ar : ""',
        'attributes' => ['readonly'],
      ],
      'avatar'    => [
				'label'   => __('adminlte.avatar'),
				'type'		=> 'file',
      ],
      'full_name'    => [
				'label'   => __('adminlte.name'),
				'new_line'	=> true,
      ],
      'email'    => [
        'label'   => __('adminlte.email'),
      ],
      'password'    => [
				'label'   => __('adminlte.password'),
				'type'		=> 'password',
				'attributes' => ['placeholder' => 'Leave it empty if you don\'t need to change the password'],
      ],
    ];

    $this->_show_fields = [
      'created_at'  => [
        'label'     => __('adminlte.created_date'),
        'value'   => '$row->created_at->format("Y-m-d h:i:s a")',
      ]
		];
		
		$this->_edit_rules = [
      'full_name'   => 'required',
      'email'       => 'required|email|unique:users,email,$id',
      // 'mobile'      => 'required|unique:users,mobile,$id'
    ];
	}
	
	public function edit()
  {
		$id = \Auth::user()->id;
    if(!$this->_allow_update)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $row = $this->_model::where($this->_default_where)->findOrFail($id);
    }else{
      $row = $this->_model::findOrFail($id);
    }

    $title        = $this->_title;
    $icon         = $this->_icon;
    $route_link   = $this->_route_link;
    $fields       = $this->_fields;
    $view_name    = $this->_view;
    $update_path  = $this->_upload_path;

    $variables = ['row', 'title', 'icon', 'route_link', 'fields', 'view_name', 'update_path'];
    if(!empty($this->_variables_edit)){
      extract($this->_variables_edit);
      $variables = array_merge($variables, array_keys($this->_variables_edit));
    }

    return view($view_name.'.edit', compact($variables));
	}
	
	public function update(Request $request)
  {
		$id = \Auth::user()->id;
    if(!$this->_allow_update)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $row = $this->_model::where($this->_default_where)->findOrFail($id);
    }else{
      $row = $this->_model::findOrFail($id);
    }

    if(!empty($this->_edit_rules)){
      $validation = $this->validate($request, str_replace(['$id'], [$id], $this->_edit_rules));
    }else if(!empty($this->_rules)){
      $validation = $this->validate($request, $this->_rules);
    }

    $fields = [];

    $img_counter = 1;
    foreach($this->_fields As $key=>$val){
      if(isset($val['type']) && $val['type'] == 'file'){
        $fields[$key] = $row->{$key};
        if($request->hasFile($key)){
          $image = $request->file($key);
          $img_name = substr($key, 0, 3).$img_counter.time().'.'.$image->getClientOriginalExtension();
          if($image->move(public_path($this->_upload_path), $img_name))
            $fields[$key] = $img_name;
        }
      }else if(isset($val['type']) && $val['type'] == 'checkbox'){
        if(!isset($request->{$key}))
          $fields[$key] = 0;
        else
          $fields[$key] = $request->{$key};
      }else if(isset($request->{$key})){
        $fields[$key] = $request->{$key};
      }

      $img_counter++;
    }

		if(isset($fields['password']))
			$row->update([
				'avatar'		=> $fields['avatar'],
				'full_name'	=> $fields['full_name'],
				'email'			=> $fields['email'],
				'password'	=> $fields['password'],
			]);
		else
			$row->update([
				'avatar'		=> $fields['avatar'],
				'full_name'	=> $fields['full_name'],
				'email'			=> $fields['email'],
			]);

    Session::flash('success', __('adminlte.modified_success'));
    return redirect($this->_route_link);
  }
}
