<?php

    if(is_array($value)) {
        $lenght = count($value);
        $i = 0;
        if($lenght > 0)
            $cssRemoveButton = 'ef-admin-input-remove-field-disable';
        else 
            $cssRemoveButton = 'ef-admin-input-remove-field';
    } else {
        $lenght = 1;
        $cssRemoveButton = 'ef-admin-input-remove-field-disable';
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
                $output.= '<input type="text" class="ef-admin-input" id="'.$name.'-'.$i.'"  name="'.$name.'['.$i.'][title]"  placeholder="'.$placeholder.'" value="'.$value['title'].'" />';
                
                # content
                $output .= '<br/><textarea class="ef-admin-input" for="'.$name.'-field" rows="10" cols="50" name="'.$name.'['.$i.'][content]" placeholder="'.$placeholder.'" >'.$value['content'].'</textarea>';
               
                $image = wp_get_attachment_url( $value['image'] );

                # image
                $output .= '<div class="ef-admin-input-input-image">';
                    $output .= '<img '.$hidden.' class="ef-admin-input-image-preview" width="300px" src="'.$image.'" />';  
                    $output .= '<a '.$hidden2.' class="ef-admin-input-image-set">Bild festlegen</a>';
                    $output .= '<a class="ef-admin-input-image-remove" '.$hidden.'>Bild löschen</a>';
                    $output .= '<input type="hidden" for="'.$name.'-field" class="ef-admin-input-image-input" name="'.$name.'['.$i.'][image]" value="'.$value['image'].'" />';
                $output .= '</div>';
               
                $output.= '<br/><a class="ef-admin-input-move-field" href="#"><i class="fas fa-arrows-alt-v"></i></a>';
               
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

    $output.= '<a class="ef-admin-input-add-field" data-input="list" data-field="'.$name.'" data-placeholder="'.$placeholder.' "href="#">Feld hinzufügen</a>';


?>