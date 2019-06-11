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

    $output.= '<div class="enfi-admin-input-list"><div class="sortableList">';

    for($i = 0; $i < $lenght; $i++) {

        $output.= '<div class="field sortable">';
            $output.= '<a class="move"><i class="fas fa-arrows-alt-v"></i></a>';
            $output.= '<a class="'.$cssRemoveButton.'"><i class="fas fa-trash-alt"></i></a>';
            $output.= '<input type="text" class="enfi-admin-input" id="'.$name.'-'.$i.'"  name="'.$name.'['.$i.']"  placeholder="'.$placeholder.'" value="'.$value[$i].'" />';
        $output.= '</div>';
    }

    $output.= '</div><a class="add" data-input="list" data-field="'.$name.'" data-placeholder="'.$placeholder.' "><i class="fas fa-plus"></i> '.__('LIST_ADD_NEW_FIELD', 'ef').'</a></div>';


?>