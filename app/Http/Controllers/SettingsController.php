<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Traits\DefaultController;

class SettingsController extends Controller
{
  use DefaultController {
    DefaultController::__construct as private __dfConstruct;
  }

  public function __construct(){
    $this->__dfConstruct();

    $this->_model           = 'App\Setting';
    $this->_title           = __('adminlte.settings');
    $this->_icon            = '<i class="fa fa-cog"></i>';
    $this->_route_link      = '/admin/settings';
    $this->_permission      = 'settings';
    $this->_allow_read      = false;
    $this->_view            = 'settings';

    $config_array = [
      'default_package'       => __('adminlte.default_package'),
      'email'                 => __('adminlte.email'),
      'logo'                  => __('adminlte.logo'),
      'invitation_message'    => __('adminlte.invitation_message'),
      'promoted_view_price'   => __('adminlte.promoted_view_price'),
      'promoted_press_price'  => __('adminlte.promoted_press_price'),
      'promoted_follow_price' => __('adminlte.promoted_follow_price'),
      'usd_price_sar'         => __('adminlte.usd_price_sar'),
      'testing_package_length'=> __('adminlte.testing_package_length'),
    ];

    $this->_columns         = [
      'id'        => [
        'label'   => '#'
      ],
      'key' => [
        'label'   => __('adminlte.settings'),
        'value'   => '$config_array[$row->key]'
      ],
      'value' => [
        'label'   => __('adminlte.value'),
      ],
      /* 'created_at'=> [
        'label'   => __('adminlte.created_at'),
        'value'   => '$row->created_at->format("Y-m-d h:i:s a")',
      ]*/
    ];

    $this->_fields = [
      'key'   => [
        'label'       => __('adminlte.settings'),
        'type'        => 'select',
        'select_data' => $config_array,
        'attributes'  => ['required'],
      ],
      'value'       => [
        'label'       => __('adminlte.value'),
        'attributes'  => ['id' => 'value_input'],
        'class'       => 'set_hidden'
      ],
      'default_package' => [
        'label' => __('adminlte.default_package'),
        'type'  => 'select',
        'value' => '(isset($row))? $row->value : null',
        'select_data' => \App\Package::where(['for_test' => 0])->pluck('name_en', 'id'),
        'class' => 'set_hidden set_default_package'
      ],
      'logo' => [
        'label' => __('adminlte.logo'),
        'type'  => 'file',
        'class' => 'set_hidden set_logo'
      ],
      'invitation_message' => [
        'label' => __('adminlte.invitation_message'),
        'type'  => 'textarea',
        'value' => '(isset($row))? $row->value : null',
        'attributes'  => ['placeholder' => __('adminlte.invitation_name')],
        'class' => 'set_hidden set_invitation_message'
      ],
      'testing_package_length' => [
        'label' => __('adminlte.testing_package_length'),
        'type'  => 'number',
        'value' => '(isset($row))? $row->value : null',
        'class' => 'set_hidden set_testing_package_length'
      ],
    ];

    $this->_variables_index = [
      'fields' => $this->_fields,
      'update_path' => $this->_upload_path,
      'config_array' => $config_array
    ];

    $this->_show_fields = [
      'created_at'  => [
        'label'     => __('adminlte.created_at'),
        'value'   => '$row->created_at->format("Y-m-d h:i:s a")',
      ]
    ];

    $this->_rules = [
      'key'=> 'required|unique:settings',
    ];
    $this->_edit_rules = [
      'key'=> 'required|unique:settings,key,$id',
    ];
  }

  public function store(Request $request)
  {
    if(!$this->_allow_create)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_rules)){
      $validation = $this->validate($request, $this->_rules);
    }

    $fields = [
      'key'   => $request->key,
      'value' => $request->value
    ];

    if($request->hasFile('value')){
      $image = $request->file('value');
      $img_name = 'val_'.time().'.'.$image->getClientOriginalExtension();
      if($image->move(public_path($this->_upload_path), $img_name))
        $fields['value'] = $img_name;
    }

    if(is_array($request->value))
      $fields['is_array'] = 1;

    $row = $this->_model::create($fields);

    Session::flash('success', __('adminlte.created_success'));
    return redirect($this->_route_link);
  }

  public function update(Request $request, $id)
  {
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

    $fields = [
      'key'   => $request->key,
      'value' => $request->value
    ];

    if($request->hasFile('value')){
      $image = $request->file('value');
      $img_name = 'val_'.time().'.'.$image->getClientOriginalExtension();
      if($image->move(public_path($this->_upload_path), $img_name))
        $fields['value'] = $img_name;
    }

    if(is_array($request->value))
      $fields['is_array'] = 1;
    else
      $fields['is_array'] = 0;

    $row->update($fields);

    Session::flash('success', __('adminlte.modified_success'));
    return redirect($this->_route_link.'/'.$id.'/edit');
  }
}
