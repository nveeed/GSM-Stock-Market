<?php 

//echo '<pre>';
//print_r($language);
//exit;

?>

<select class="form-control" name="language" required>
    <?php 
        if($lid > 0){
    ?>
        <option value="<?php echo $lid; ?>"><?php echo $language; ?></option>
    <?php 

        } else{
    ?>
        <option value="276459" selected>English</option>
    <?php        
        }?>
    <?php foreach ($select as $select){?>
        <option value="<?php echo $select->id;?>"><?php echo $select->language;?></option>
    <?php }?>
</select>
