                    <img hidden class="map_img_hex map_img_hover" src='<?php echo $this->webroot; ?>img/map_editor/brush_1.png'>
                    <img class="map_img_hex map_dirt_type" title="<?php echo $cell_id; ?>" src='<?php echo $this->webroot.$cell["d_dirt_types"]["texture_name"]; ?>'>
                    <?php
                    $texture_counter = 0;
                    if ( ($cell['d_relief_types']['texture_name']<>'') AND ($cell['d_relief_types']['show_on_map']==1) ) {
                        $texture_counter++; ?>
                        <img style="top: -<?php echo 66*$texture_counter; ?>px;" class="map_img_hex map_relief_type" title="<?php echo $cell_id; ?>" src='<?php echo $this->webroot.$cell["d_relief_types"]["texture_name"]; ?>'>
                    <?php }
                    if ($cell['d_water_resources_types']['texture_name']<>'') {
                        $texture_counter++; ?>
                        <img style="top: -<?php echo 66*$texture_counter; ?>px;" class="map_img_hex map_water_resources_type" title="<?php echo $cell_id; ?>" src='<?php echo $this->webroot.$cell["d_water_resources_types"]["texture_name"]; ?>'>
                    <?php }
                    if ($cell['d_vegetation_types']['texture_name']<>'') {
                        $texture_counter++; ?>
                        <img style="top: -<?php echo 66*$texture_counter; ?>px;" class="map_img_hex map_vegetation_type" title="<?php echo $cell_id; ?>" src='<?php echo $this->webroot.$cell["d_vegetation_types"]["texture_name"]; ?>'>
                    <?php } ?>
