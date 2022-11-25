<div class="form-group crud-group">
  @if(count($fields))
    <?php
    foreach($fields As $key=>$val){
      $input_label      = $key;
      $input_attributes = [];
      $input_class      = 'form-control ';
      $input_type       = 'text';
      $input_data       = [];
      $input_value      = null;

      if(isset($val['label']))
        $input_label = $val['label'];
      if(isset($val['attributes']))
        $input_attributes = $val['attributes'];
      if(isset($val['class']))
        $input_class .= $val['class'];
      if(isset($val['type']))
        $input_type = $val['type'];
      if(isset($val['select_data']))
        $input_data = $val['select_data'];
      if(isset($val['checkbox_data']))
        $input_data = $val['checkbox_data'];
      if(isset($val['value']))
        $input_value = eval("return ".$val['value'].";");


      if($input_type == 'hidden'){
        echo Form::{$input_type}($key, $input_value, array_merge(['class' => $input_class], $input_attributes));
      }else{
        if(isset($val['new_line']) && $val['new_line'] == true){
          echo '</div><div class="form-group crud-group">';
        }

        echo '<div class="col-sm-6 col-xs-12 input-'.$input_type.'">';
        echo Form::label($key, ucfirst($input_label).' :');

        if(isset($val['datepicker']) && $val['datepicker'] == true){
          ?>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <?php
            echo Form::{$input_type}($key, $input_value, array_merge(['class' => $input_class.' datepicker', 'autocomplete' => 'off'], $input_attributes));
            ?>
          </div>
          <?php
        }else{
          if($input_type == 'select'){
            if(isset($input_attributes) && in_array('multiple', $input_attributes)){
              $selectData = [];
              if(isset($row) && $row->{$key}){
                if(is_array($row->{$key}))
                  $selectData = $row->{$key};
                else
                  $selectData = explode(',', $row->{$key});
              }

              $attributesText = '';
              foreach($input_attributes As $inputAttrKey=>$inputAttrValue){
                if(is_numeric($inputAttrKey))
                  $attributesText .= ' '.$inputAttrValue;
                else
                  $attributesText .= ' '.$inputAttrKey.'="'.$inputAttrValue.'"';
              }
              ?>
              <select <?= (!isset($input_attributes['name']))? 'name="'.$key.'"' : '' ?> <?= (!isset($input_attributes['id']))? 'id="'.$key.'"' : '' ?> class="form-control" <?= $attributesText ?>>
                <?php 
                if($input_data){
                  foreach($input_data As $ikey=>$ivalue){
                    ?><option value="<?=$ikey?>"  <?php echo (in_array($ikey, $selectData))? 'selected="selected"' : '' ?> ><?=$ivalue?></option><?php
                  }
                }
                ?>
              </select>
              <?php
            }else{
              echo Form::select($key, $input_data, $input_value, array_merge(['class' => $input_class], $input_attributes));
            }
          }else if($input_type == 'file'){
            $data_img = '';
            if(isset($row) && $row->{$key}){
              if(filter_var($row->{$key}, FILTER_VALIDATE_URL))
                $data_img = $row->{$key};
              else
                $data_img = url($update_path.'/'.$row->{$key});
            }
            echo '<input type="file" name="'.$key.'" value="" data-img="'.$data_img.'" />';
          }else if($input_type == 'checkbox'){
            echo Form::checkbox($key, (!empty($input_data))? $input_data : '1', $input_value, array_merge(['class' => $input_class], $input_attributes));
          }else if($input_type == 'password'){
            echo Form::{$input_type}($key, array_merge(['class' => $input_class], $input_attributes));
          }else{
            echo Form::{$input_type}($key, $input_value, array_merge(['class' => $input_class], $input_attributes));
          }
        }

        echo '</div>';
      }
    }
    ?>
  @endif
</div>

<!-- Submit Field -->
<div class="form-group">
  <div class="col-sm-12 text-center">
    {!! Form::submit(__('adminlte.submit'), ['class' => 'btn btn-success']) !!}
  </div>
</div>
