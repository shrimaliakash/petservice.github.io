<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  protected $fillable = ['key', 'value', 'is_array'];

  public function setValueAttribute($value){
    if(is_array($value))
        $this->attributes['value'] = implode(',', $value);
    else
        $this->attributes['value'] = $value;
  }
}
