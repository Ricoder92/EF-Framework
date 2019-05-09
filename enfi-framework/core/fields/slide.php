<?php

    if(is_array($value)) {
        $lenght = count($value);
        $i = 0;
        if($lenght > 0)
            $cssRemoveButton = 'enfi-settings-remove-field-disable';
        else 
            $cssRemoveButton = 'enfi-settings-remove-field';
    } else {
        $lenght = 1;
        $cssRemoveButton = 'enfi-settings-remove-field-disable';
    } 

    $output.= '<div class="sortableList">';

    for($i = 0; $i < $lenght; $i++) {

        if(isset($value[$i]))
            $value = $value[$i];
        else if(isset($value) && !is_array($value))
            $value = $value;
        else   
            $value = "";


        if($value['image'] != '') {
            $hidden = '';
            $hidden2 = 'style="display:none;"';
        } else {
            $hidden = 'style="display:none;"';
            $hidden2 = '';
        }

        $output.= '<div class="field sortable">';

                # title
                $output.= '<input type="text" class="enfi-admin-input" id="'.$name.'-'.$i.'"  name="'.$name.'['.$i.'][title]"  placeholder="'.$placeholder.'" value="'.$value['title'].'" />';
                
                # content
                $output .= '<br/><textarea class="enfi-admin-input" for="'.$name.'-field" rows="10" cols="50" name="'.$name.'['.$i.'][content]" placeholder="'.$placeholder.'" >'.$value['content'].'</textarea>';
               
                $image = wp_get_attachment_url( $value['image'] );

                # image
                $output .= '<div class="enfi-settings-input-image">';
                    $output .= '<img '.$hidden.' class="enfi-settings-image-preview" width="300px" src="'.$image.'" />';  
                    $output .= '<a '.$hidden2.' class="enfi-settings-image-set">Bild festlegen</a>';
                    $output .= '<a class="enfi-settings-image-remove" '.$hidden.'>Bild löschen</a>';
                    $output .= '<input type="hidden" for="'.$name.'-field" class="enfi-settings-image-input" name="'.$name.'['.$i.'][image]" value="'.$value['image'].'" />';
                $output .= '</div>';
               
                $output.= '<br/><a class="enfi-settings-move-field" href="#"><i class="fas fa-arrows-alt-v"></i></a>';
               
                $output.= '<a class="'.$cssRemoveButton.'" href="#"><i class="fas fa-trash-alt"></i></a>';
             
        


           
        $output.= '</div>';

        if($value != '') {
            $hidden = '';
            $hidden2 = 'style="display:none;"';
        } else {
            $hidden = 'style="display:none;"';
            $hidden2 = '';
        }
        
        $image = wp_get_attachment_url( $value );
       
        
    }

    $output.= '</div>';

    $output.= '<a class="enfi-settings-add-field" data-input="list" data-field="'.$name.'" data-placeholder="'.$placeholder.' "href="#">Feld hinzufügen</a>';


?>