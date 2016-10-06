                    <img hidden class="map_img_hex map_img_hover" src='<?php echo $this->webroot; ?>img/map_editor/brush_1.png'>
                    <img class="map_img_hex map_dirt_type" title="<?php echo $cell_id; ?>" src='<?php echo $this->webroot.$cell["d_dirt_types"]["texture_name"]; ?>'>
                    <?php
                    if ($cell['d_relief_types']['texture_name']<>'') { ?>
                        <img class="map_img_hex map_relief_type" title="<?php echo $cell_id; ?>" src='<?php echo $this->webroot.$cell["d_relief_types"]["texture_name"]; ?>'>
                    <?php } ?>
