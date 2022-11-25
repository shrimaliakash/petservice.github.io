<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-hover">
        <tr>
        @if(count($fields))
        <?php
        $td = 1;
        foreach($fields As $key=>$val){
          $input_label      = $key;
          $input_attributes = [];
          $input_class      = ' ';
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


          if($input_type == 'hidden' || $input_type == 'password'){
            continue;
          }else{
            if(isset($val['new_line']) && $val['new_line'] == true && 0){
              echo '</div><div class="row crud-row">';
            }

            echo '<th id="'.$key.'" class="input-'.$input_type.'">';
            echo Form::label($key, ucfirst($input_label).' :');
            echo '</th>';

            echo '<td>';
            if($input_value){
              eval("echo ".$input_value.";");
            }else if($input_type == 'select'){
              if(is_array($row->{$key})){
                foreach($row->{$key} As $mSelect){
                  if(isset($input_data[$mSelect]))
                    echo $input_data[$mSelect].', ';
                  else
                    echo $mSelect.', ';
                }
              }else{
                if(isset($input_data[$row->{$key}]))
                  echo $input_data[$row->{$key}];
                else
                  echo $row->{$key};
              }
            }else if($input_type == 'file' && $row->{$key}){
              if(filter_var($row->{$key}, FILTER_VALIDATE_URL))
                $data_img = $row->{$key};
              else
                $data_img = url($update_path.'/'.$row->{$key});

              echo '<img src="'.$data_img.'" class="img-responsive img-thumbnail" />';
            }else if($input_type == 'checkbox'){
              if($row->{$key}){
                echo '<i class="fa fa-check-circle-o"></i>';
              }else{
                echo '<i class="fa fa-times-circle-o"></i>';
              }
            }else{
              echo $row->{$key};
            }

            echo '</td>';

            if($td % 2 == 0){
              ?></tr><tr><?php
            }
          }
          $td++;
        }
        ?>
        @endif
        </tr>
      </table>
    </div>
  </div>
</div>
