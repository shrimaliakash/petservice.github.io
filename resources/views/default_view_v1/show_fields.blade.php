<div class="row crud-row">
  @if(count($fields))
    <?php
    foreach($fields As $key=>$val){
      $input_label      = $key;
      $input_attributes = [];
      $input_class      = 'form-control ';
      $input_type       = 'text';
      $input_data       = '';
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
      if(isset($val['value']))
        $input_value = $val['value'];


      if($input_type == 'hidden'){
        continue;
      }else{
        if(isset($val['new_line']) && $val['new_line'] == true){
          echo '</div><div class="row crud-row">';
        }

        echo '<div id="'.$key.'" class="col-sm-6 col-xs-12 input-'.$input_type.'">';
        echo Form::label($key, ucfirst($input_label).' :');

        echo '<span>';
        if($input_value){
          eval($input_value);
        }else if($input_type == 'select'){
          if(isset($input_data[$row->{$key}]))
            echo $input_data[$row->{$key}];
          else
            echo $row->{$key};
        }else if($input_type == 'file' && $row->{$key}){
            echo '<img src="'.url($update_path.'/'.$row->{$key}).'" class="img-responsive img-thumbnail" />';
        }else{
          echo $row->{$key};
        }

        echo '</span></div>';
      }
    }
    ?>
  @endif
</div>
