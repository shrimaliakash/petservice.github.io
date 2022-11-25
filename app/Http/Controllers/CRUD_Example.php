<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use App\Traits\DefaultController;

class CustomerController extends Controller
{
  use DefaultController {
    DefaultController::__construct as private __dfConstruct;
  }

  public function __construct(){
    $this->__dfConstruct();

    $this->_model           = 'App\User';
    $this->_default_where   = ['user_type' => 'user'];
    $this->_title           = 'Users Accounts';
    $this->_icon            = '<i class="fa fa-user"></i>';
    $this->_route_link      = '/admin/customer';
    $this->_permission      = '';

    $this->_columns         = [
      'id'        => [
        'label'   => '#'
      ],
      'full_name' => [
        'label'   => 'Name',
      ],
      'mobile'    => [
        'label'   => 'Mobile',
      ],
      'gender'    => [
        'label'   => 'Gender',
        'value'   => '($row->gender == "m")? "Male" : "Female"',
      ],
      'created_at'=> [
        'label'   => 'Created At',
        'value'   => '$row->created_at->format("Y-m-d h:i:s a")',
      ]
    ];

    $this->_fields = [
      'user_type'   => [
        'type'        => 'hidden',
        'value'       => 'user',
      ],
      'full_name'   => [
        'label'       => 'Name',
        'attributes'  => ['required'],
      ],
      'email'       => [
        'label'       => 'Email',
        'attributes'  => ['required'],
      ],
      'mobile'       => [
        'label'       => 'Mobile',
        'attributes'  => ['required'],
      ],
      'gender'       => [
        'label'       => 'Gender',
        'type'        => 'select',
        'select_data' => [
          'm'   => 'Male',
          'f'   => 'Female'
        ]
      ],
      'avatar'       => [
        'label'       => 'Profile Image',
        'type'        => 'file',
      ],
      'status'       => [
        'label'       => 'Status',
        'type'        => 'select',
        'select_data' => [
          '1'   => 'Active',
          '0'   => 'Inactive'
        ]
      ],
      'forum'       => [
        'label'       => 'Forum',
        'type'        => 'checkbox',
        'class'       => 'switch',
        'attributes'  => ['data-size' => 'small']
      ],
    ];

    $this->_show_fields = [
      'created_at'  => [
        'label'     => __('adminlte.created_date'),
        'value'   => '$row->created_at->format("Y-m-d h:i:s a")',
      ]
    ];

    $this->_rules = [
      'user_type'   => ['required', Rule::in(['user'])],
      'full_name'   => 'required',
      'email'       => 'required|email|unique:users',
      'mobile'      => 'required|unique:users'
    ];

    $this->_edit_rules = [
      'user_type'   => ['required', Rule::in(['user'])],
      'full_name'   => 'required',
      'email'       => 'required|email|unique:users,email,$id',
      'mobile'      => 'required|unique:users,mobile,$id'
    ];
  }
}
