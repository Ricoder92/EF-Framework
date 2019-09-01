<?php

    if(is_array($value)) {
        $lenght = count($value);
        $i = 0;
        if($lenght == 1)
            $cssRemoveButton = 'remove-disable';
        else 
            $cssRemoveButton = 'remove';
    } else {
        $lenght = 1;
        $cssRemoveButton = 'remove-disable';
    } 

    $output.= '<div class="ef-admin-input-list"><div class="sortableList">';

    for($i = 0; $i < $lenght; $i++) {

        $output.= '<div class="input-group">';
            $output.= '<input type="text" class="form-control" aria-label="Recipients username" aria-describedby="basic-addon2" id="'.$name.'-'.$i.'"  name="'.$name.'['.$i.']"  placeholder="'.$placeholder.'" value="'.$value[$i].'">';
            $output.= '<div class="input-group-append">';
                $output.= '<button class="btn btn-outline-secondary" type="button">Hoch</button>';
                $output.= '<button class="btn btn-outline-secondary" type="button">Runter</button>';
                $output.= '<button class="btn btn-outline-secondary" type="button">Löschen</button>';
            $output.= '</div>';
        $output.= '</div>';

    }

    $output.= '</div>';
    
    $output.= '<br/><button type="button" class="add btn btn-success btn-sm" data-input="list" data-field="'.$name.'">'.__('LIST_ADD_NEW_FIELD', 'ef').'</button>';


?>