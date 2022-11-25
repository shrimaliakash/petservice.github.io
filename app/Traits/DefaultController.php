<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Session;

/**
* SIMPLE LARAVEL CRUD
* Created by Ahyad Essam in 6-1-2018 ahyad.essam@gmail.com 
* using larave collective https://laravelcollective.com/docs/master/html#installation
* { HOW TO USE }
* 1- Include my trait in your controller (use App\Traits\DefaultController;).
* 2- Use it inner class (use DefaultController;).
* 3- In your contstructor config what you need.
* 4- Mandatory configurations is ($_model, $_route_link, $_columns, $_fields).
* 5- configuration variables :-
* @param $_model (string) your model path ex. 'App\User';
* @param $_permission (string) permission name
* @param $_default_where (array) default where query will apply to all functions ex. ['user_type' => 'user'].
* if you need to use current login ID in default where just set is as (string) $_auth_id
* @param $_select_raw (string) default value '*', if you need to custom select.
* @param $_order_by (string) by default 'id'.
* @param $_sort (string) by default 'DESC'.
* @param $_use_paginate (boolean) by default 'false', it for if you need pagination or data table.
* @param $_rows_per_page (integer) by default 20, how many rows in page.
* @param $_use_ajax (boolean) by default 'false', it for if you need data table as ajax querys.
* @param $_ajax_url (string) by default 'null', it for if you need to custom ajax request url.
* @param $_is_search_page (boolean) by default 'false', used with ajax page for open on empty data and search.
* @param $_ajax_sorting (boolean) by default 'false', it for allow datatable to sorting data.
* @param $_ajax_sorting_arr (array) by default 'null', columns name for sorting if you have a custom names in _columns array.
* @param $_view (string) view name , default (default_view).
* @param $_index_view (string) custom index view page (page path) , default (null).
* @param $_create_view (string) custom create form page (page path) , default (null).
* @param $_update_view (string) custom update form page (page path) , default (null).
* @param $_show_view (string) custom show (read) view page (page path) , default (null).
* @param $_title (string) title of page.
* @param $_icon (string) "font awesome" icon.
* @param $_route_link (string) resource route link.
* @param $_allow_create (boolean) by default true.
* @param $_allow_read (boolean) by default true.
* @param $_allow_update (boolean) by default true.
* @param $_allow_delete (boolean) by default true.
* @param $_columns (array) key => ['label', 'value'].
* @param $_fields (array) key => ['label', 'attributes' => [], 'class', 'type', value, 'select_data' => [],
* 'datepicker' => {true|false}, 'checkbox_data', 'new_line' => {true|false}].
* @param $_show_fields (array) additional fields you want to display it in show page.
* @param $_rules (array) validation rules.
* @param $_edit_rules (array) if you need to custom edit rules, you can type $id as string and i will replace it as a variable.
* @param $_upload_path (string) path name for upload in public folder, by default '/uploads'.
* @param $_save_file_fullpath (boolean) if you need to save full path in database, by default 'false'.
* @param $_search_columns (array) Columns for search if you used $_use_ajax for index ajax.
* @param $_variables_index (array) for passing variables to index view;
* @param $_variables_create (array) for passing variables to create view;
* @param $_variables_show (array) for passing variables to show view;
* @param $_variables_edit (array) for passing variables to edit view;
* -------- Thanks --------
*/

trait DefaultController {

  protected $_model           = '';
  protected $_permission      = '';
  protected $_default_where   = [];
  protected $_select_raw      = '*';
  protected $_order_by        = 'id';
  protected $_sort            = 'DESC';
  protected $_use_paginate    = false;
  protected $_rows_per_page   = 20;
  protected $_use_ajax        = false;
  protected $_ajax_url        = null;
  protected $_is_search_page  = false;
  protected $_ajax_sorting    = false;
  protected $_ajax_sorting_arr= [];
  protected $_auth_id         = 0;

  protected $_view            = 'default_view';
  protected $_index_view      = null;
  protected $_create_view     = null;
  protected $_update_view     = null;
  protected $_show_view       = null;
  protected $_title           = 'Default';
  protected $_icon            = '<i class="fa fa-dot-circle-o"></i>';
  protected $_route_link      = '';

  protected $_allow_create    = true;
  protected $_allow_read      = true;
  protected $_allow_update    = true;
  protected $_allow_delete    = true;

  protected $_columns         = [];
  protected $_fields          = [];
  protected $_show_fields     = [];
  protected $_rules           = [];
  protected $_edit_rules      = [];
  protected $_upload_path     = '/uploads';
  protected $_save_file_fullpath = false;
  protected $_search_columns  = [];

  protected $_variables_index = [];
  protected $_variables_create= [];
  protected $_variables_show  = [];
  protected $_variables_edit  = [];

  public function __construct(){
    if(Session::has('admin_lang')){
      \App::setLocale(Session::get('admin_lang'));
    }
  }

  public function index(){
		if(!empty($this->_permission))
		  $this->_checkPerm($this->_permission);
  
		$title        = $this->_title;
		$icon         = $this->_icon;
		$route_link   = url($this->_route_link);
		$columns      = $this->_columns;
		$create       = $this->_allow_create;
		$read         = $this->_allow_read;
		$update       = $this->_allow_update;
		$delete       = $this->_allow_delete;
    $rows_per_page = $this->_rows_per_page;
    $update_path  = $this->_upload_path;
    $ajax_url     = $this->_ajax_url;

		$variables = ['rows', 'title', 'icon', 'route_link', 'columns',
			'create', 'read', 'update', 'delete', 'rows_per_page', 'update_path'
		];

		if(!empty($this->_variables_index)){
			extract($this->_variables_index);
			$variables = array_merge($variables, array_keys($this->_variables_index));
		}
  
		if($this->_use_paginate){
		  if(!empty($this->_default_where)){
			 $rows = $this->_model::selectRaw($this->_select_raw)->where($this->getWhereValue($this->_default_where))->orderBy($this->_order_by, $this->_sort)->paginate($this->_rows_per_page);
		  }else{
			 $rows = $this->_model::selectRaw($this->_select_raw)->orderBy($this->_order_by, $this->_sort)->paginate($this->_rows_per_page);
		  }
  
      if($this->_index_view)
        return view($this->_index_view, compact($variables));
      else
		    return view($this->_view.'.paginate', compact($variables));
		}else if($this->_use_ajax){
			$rows 			= [];
			$jsonData 		= ['data' => []];
			$jsonColumns 	= [];

			foreach($columns As $key=>$val){
				$jsonColumns[] = ['data' => $key];
      }
      
      if($this->_allow_update || $this->_allow_delete || $this->_allow_read)
			  $jsonColumns[] = ['data' => 'actions'];

			$jsonColumns = json_encode($jsonColumns);

      $variables[] = 'jsonColumns';
      $variables[] = 'ajax_url';

			if(isset($_GET['draw'])){
				$offset = $_GET['start'];

				//order by 
        if($this->_ajax_sorting == true){
          $sortingArr = $_GET['order'][0]; 

          if(count($this->_ajax_sorting_arr)){
            if(isset($this->_ajax_sorting_arr[$sortingArr['column']])){
              $this->_order_by 	= $this->_ajax_sorting_arr[$sortingArr['column']];
              $this->_sort = $sortingArr['dir'];
            }
          }else{
            $columnsKeys = array_keys($this->_columns);
            if(isset($columnsKeys[$sortingArr['column']])){
              $this->_order_by 	= $columnsKeys[$sortingArr['column']];
              $this->_sort = $sortingArr['dir'];
            }
          }
        }

				if(!empty($_GET['search']['value'])){
					$rows = $this->searchRows($_GET['search']['value'], $offset);
					$jsonData['recordsTotal'] = $jsonData['recordsFiltered'] = $this->searchRows($_GET['search']['value'], 0, true);
				}else{
          if($this->_is_search_page == false){
            if(!empty($this->_default_where)){
              $jsonData['recordsTotal'] = $jsonData['recordsFiltered'] = $this->_model::where($this->getWhereValue($this->_default_where))->count();
              $rows = $this->_model::selectRaw($this->_select_raw)->where($this->getWhereValue($this->_default_where))
              ->orderBy($this->_order_by, $this->_sort)
              ->offset($offset)->limit($this->_rows_per_page)->get();
            }else{
              $jsonData['recordsTotal'] = $jsonData['recordsFiltered'] = $this->_model::count();
              $rows = $this->_model::selectRaw($this->_select_raw)->orderBy($this->_order_by, $this->_sort)
              ->offset($offset)->limit($this->_rows_per_page)->get();
            }
          }
				}

	
				if($rows){
					foreach($rows As $row){
						$rowData = [];
						foreach($this->_columns As $key=>$val){
							if(isset($val['value'])){
								$rowData[$key] = eval("return ".$val['value'].';');
							}else{
                if(isset($val['type']) && $val['type'] == 'file'){
                  if(filter_var($row->{$key}, FILTER_VALIDATE_URL))
                    $data_img = $row->{$key};
                  else
                    $data_img = url($this->_upload_path.'/'.$row->{$key});

                  $rowData[$key] = '<img src="'.$data_img.'" class="img-responsive img-thumbnail" />';
                }else{
                  $rowData[$key]	= $row->{$key};
                }
							}
						}

            if($this->_allow_read || $this->_allow_update || $this->_allow_delete){
              $rowData['actions'] = '';
              if($this->_allow_read)
                $rowData['actions'] .= '<a href="'.$route_link.'/'.$row->id.'" class="ajax-action-a" title="Show Details"><i class="fa fa-id-card-o" aria-hidden="true"></i></a>';
              if($this->_allow_update)
                $rowData['actions'] .= '<a href="'.$route_link.'/'.$row->id.'/edit" class="ajax-action-a" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
              if($this->_allow_delete)
                $rowData['actions'] .= '<a href="javascript:void(0)" title="Delete" class="ajax-action-a" onclick="setDelete(\''.$route_link.'/'.$row->id.'\')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
            }

						$jsonData['data'][] = $rowData;
					}
				}

				return response()->json($jsonData);
			}
   
      if($this->_index_view)
        return view($this->_index_view, compact($variables));
      else
			  return view($this->_view.'.indexAjax', compact($variables));
		}else{
		  if(!empty($this->_default_where)){
       $rows = $this->_model::selectRaw($this->_select_raw)->where($this->getWhereValue($this->_default_where))
       ->orderBy($this->_order_by, $this->_sort)->get();
		  }else{
			  $rows = $this->_model::selectRaw($this->_select_raw)->orderBy($this->_order_by, $this->_sort)->get();
		  }
  
      if($this->_index_view)
        return view($this->_index_view, compact($variables));
      else
		    return view($this->_view.'.index', compact($variables));
		}
  }
  
  public function searchRows($value, $offset=0, $getCount=false){
    $queryRaw = [];

    if(!empty($value) && !empty($this->_search_columns)){
      foreach($this->_search_columns As $search){
        if(isset($search['is_equal']) && $search['is_equal'] == true)
          $queryRaw[] = $search['name']."='$value'";
        else
          $queryRaw[] = $search['name']." LIKE '%$value%'";
      }
    }
		
		if(!empty($this->_default_where)){
      if(!empty($queryRaw)){
        if($getCount == true){
          $rows = $this->_model::where($this->getWhereValue($this->_default_where))->whereRaw('('. implode(' OR ', $queryRaw) .')')
          ->count();
        }else{
          $rows = $this->_model::selectRaw($this->_select_raw)->where($this->getWhereValue($this->_default_where))
          ->whereRaw('('. implode(' OR ', $queryRaw) .')')
          ->orderBy($this->_order_by, $this->_sort)->offset($offset)->limit($this->_rows_per_page)->get();
        }
      }else{
        if($getCount == true){
          $rows = $this->_model::where($this->getWhereValue($this->_default_where))->count();
        }else{
          $rows = $this->_model::selectRaw($this->_select_raw)->where($this->getWhereValue($this->_default_where))
          ->orderBy($this->_order_by, $this->_sort)
          ->offset($offset)->limit($this->_rows_per_page)->get();
        }
      }
		}else{
      if(!empty($queryRaw)){
        if($getCount == true){
          $rows = $this->_model::whereRaw('('. implode(' OR ', $queryRaw) .')')->count();
        }else{
          $rows = $this->_model::selectRaw($this->_select_raw)->whereRaw('('. implode(' OR ', $queryRaw) .')')
          ->orderBy($this->_order_by, $this->_sort)
          ->offset($offset)->limit($this->_rows_per_page)->get();
        }
      }else{
        if($getCount == true){
          $rows = $this->_model::count();
        }else{
          $rows = $this->_model::selectRaw($this->_select_raw)->orderBy($this->_order_by, $this->_sort)
          ->offset($offset)->limit($this->_rows_per_page)->get();
        }
      }
    }
    
    return $rows;
	}

  public function create()
  {
    if(!$this->_allow_create)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    $title        = $this->_title;
    $icon         = $this->_icon;
    $route_link   = url($this->_route_link);
    $fields       = $this->_fields;
    $view_name    = $this->_view;

    $variables = ['title', 'icon', 'route_link', 'fields', 'view_name'];
    if(!empty($this->_variables_create)){
      extract($this->_variables_create);
      $variables = array_merge($variables, array_keys($this->_variables_create));
    }

    if($this->_create_view)
      return view($this->_create_view, compact($variables));
    else
      return view($view_name.'.create', compact($variables));
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

    $fields = [];

    $img_counter = 1;
    foreach($this->_fields As $key=>$val){
      if(isset($val['type']) && $val['type'] == 'file'){
        $fields[$key] = '';
        if($request->hasFile($key)){
          $image = $request->file($key);
          $img_name = substr($key, 0, 3).$img_counter.time().'.'.$image->getClientOriginalExtension();
          if($image->move(public_path($this->_upload_path), $img_name)){
            if($this->_save_file_fullpath == true)
              $fields[$key] = url($this->_upload_path.'/'.$img_name);
            else
              $fields[$key] = $img_name;
          }
        }
      }else if(isset($val['type']) && $val['type'] == 'checkbox'){
        if(!isset($request->{$key}))
          $fields[$key] = 0;
        else
          $fields[$key] = $request->{$key};
      }else if(isset($val['type']) && $val['type'] == 'password'){
        if(isset($request->{$key}) && !empty($request->{$key}))
          $fields[$key] = \Hash::make($request->{$key});
      }else if(isset($request->{$key})){
        $fields[$key] = $request->{$key};
      }
      $img_counter++;
    }

    $row = $this->_model::create($fields);

    Session::flash('success', __('adminlte.created_success'));
    return redirect(url($this->_route_link));
  }

  public function show($id)
  {
    if(!$this->_allow_read)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $row = $this->_model::where($this->getWhereValue($this->_default_where))->findOrFail($id);
    }else{
      $row = $this->_model::findOrFail($id);
    }

    $title        = $this->_title;
    $icon         = $this->_icon;
    $route_link   = url($this->_route_link);
    $fields       = array_merge($this->_fields, $this->_show_fields);
    $view_name    = $this->_view;
    $update_path  = $this->_upload_path;
    $update       = $this->_allow_update;
    $delete       = $this->_allow_delete;

    $variables = ['row', 'title', 'icon', 'route_link', 'fields', 'view_name', 'update_path', 'update', 'delete'];
    if(!empty($this->_variables_show)){
      extract($this->_variables_show);
      $variables = array_merge($variables, array_keys($this->_variables_show));
    }

    if($this->_show_view)
      return view($this->_show_view, compact($variables));
    else
      return view($view_name.'.show', compact($variables));
  }

  public function edit($id)
  {
    if(!$this->_allow_update)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $row = $this->_model::where($this->getWhereValue($this->_default_where))->findOrFail($id);
    }else{
      $row = $this->_model::findOrFail($id);
    }

    $title        = $this->_title;
    $icon         = $this->_icon;
    $route_link   = url($this->_route_link);
    $fields       = $this->_fields;
    $view_name    = $this->_view;
    $update_path  = $this->_upload_path;

    $variables = ['row', 'title', 'icon', 'route_link', 'fields', 'view_name', 'update_path'];
    if(!empty($this->_variables_edit)){
      extract($this->_variables_edit);
      $variables = array_merge($variables, array_keys($this->_variables_edit));
    }

    if($this->_update_view)
      return view($this->_update_view, compact($variables));
    else
      return view($view_name.'.edit', compact($variables));
  }

  public function update(Request $request, $id)
  {
    if(!$this->_allow_update)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $row = $this->_model::where($this->getWhereValue($this->_default_where))->findOrFail($id);
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
          if($image->move(public_path($this->_upload_path), $img_name)){
            if($this->_save_file_fullpath == true)
              $fields[$key] = url($this->_upload_path.'/'.$img_name);
            else
              $fields[$key] = $img_name;
          }
        }
      }else if(isset($val['type']) && $val['type'] == 'checkbox'){
        if(!isset($request->{$key}))
          $fields[$key] = 0;
        else
          $fields[$key] = $request->{$key};
      }else if(isset($val['type']) && $val['type'] == 'password'){
        if(isset($request->{$key}) && !empty($request->{$key}))
          $fields[$key] = \Hash::make($request->{$key});
      }else if(isset($request->{$key})){
        $fields[$key] = $request->{$key};
      }

      $img_counter++;
    }

    $row->update($fields);

    Session::flash('success', __('adminlte.modified_success'));
    return redirect(url($this->_route_link.'/'.$id.'/edit'));
  }

  public function destroy($id)
  {
    if(!$this->_allow_delete)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $delete = $this->_model::where($this->getWhereValue($this->_default_where))->findOrFail($id);
    }else{
      $delete = $this->_model::findOrFail($id);
    }

    $delete->delete();

    Session::flash('success', __('adminlte.del_success'));
    return redirect(url($this->_route_link));
  }

  // for get current login user id 
  public function getWhereValue($where){
    $buffer = [];
    $this->_auth_id = (\Auth::user())? \Auth::user()->id : 0;

    if(count($where)){
      foreach($where As $key=>$val){
        if($val == '$_auth_id')
          $buffer[$key] = $this->_auth_id;
        else
          $buffer[$key] = $val;
      }
    }

    return $buffer;
  }
}
