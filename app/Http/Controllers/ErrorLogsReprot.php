<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorLogsReprot extends Controller
{
  /*
  created by : Ahyad Essam
  on 26-3-2018

  for get sort one line error log
  in (report) function in file :
  app/Exceptions/Handler.php

  - comment this line : parent::report($exception);
  - put this line instead of above :
  if(!empty($exception->getMessage()))
  \Log::error('['.$exception->getCode().'] "'.$exception->getMessage().'" on line '.$exception->getLine().' of file '.$exception->getFile());

  Thanks
  */

  public function index(){
    $this->_checkPerm('error_logs');

    $logs = [];
    
    if(!file_exists(storage_path('logs'.DIRECTORY_SEPARATOR.'laravel.log'))){
      file_put_contents(storage_path('logs'.DIRECTORY_SEPARATOR.'laravel.log'), '');
    }
    
    $has_file = true;
    $logs = file_get_contents(storage_path('logs'.DIRECTORY_SEPARATOR.'laravel.log'));
    $logs_array = explode("\n", $logs);
    $cleared = array_filter($logs_array);
    $logs = array_reverse($cleared);

    return view('error_logs.index', compact(['has_file', 'logs']));
  }

  public function delete(Request $request){
    $del = file_put_contents(storage_path('logs'.DIRECTORY_SEPARATOR.'laravel.log'), '');
    return redirect(url('admin'.DIRECTORY_SEPARATOR.'error_logs'));
  }
}
