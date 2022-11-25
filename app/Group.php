<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  protected $fillable = ['name_en', 'name_ar', 'permissions'];

  public function setPermissionsAttribute($value){
    $this->attributes['permissions'] = json_encode($value);
  }

  public function getPermissionsAttribute($value){
    return $this->attributes['permissions'] = json_decode($value, true);
  }

  public function users(){
    return $this->hasMany('App\user', 'group_id');
  }
}
