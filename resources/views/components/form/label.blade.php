@props(['name'])

<?php
    //change the lable name in the front-end
    if($name == 'maintenance_id'){
        $name = 'maintenance_time';
    }
?>

<label class="form-label">{{
    
    // First String replace is used to find underscore and replace it with space
    // Second String replace is used to replace id with Name, for better UX
    // Third Ucwords is used to make all words capital
    // Forth string replace is used to replace the lookup to empty string

    ucwords(str_replace('lookup', '',str_replace('id', 'Name', str_replace('_', ' ', $name)))) 

}}</label>
