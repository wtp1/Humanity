<div class = "map_tools_container">
    <?php // Кисти ?>
    <div class = "map_tools_brush_container">
        <div id = "map_tools_brush_1" onclick="map_tools_click(this, 'map_tools_brush', 1)" class = "map_tools map_tools_brush map_tools_selected">
            <img class = "map_tools_img1" src="<?php echo $this->webroot; ?>img/map_editor/brush_1.png" />
        </div>
        <div id = "map_tools_brush_7" onclick="map_tools_click(this, 'map_tools_brush', 7)" class = "map_tools map_tools_brush">
            <img class = "map_tools_img2" src="<?php echo $this->webroot; ?>img/map_editor/brush_7.png" />
        </div>
        <div id = "map_tools_brush_19" onclick="map_tools_click(this, 'map_tools_brush', 19)" class = "map_tools map_tools_brush">
            <img class = "map_tools_img2" src="<?php echo $this->webroot; ?>img/map_editor/brush_19.png" />
        </div>
        <input name = "brush" id = "map_tools_brush_value" type = "hidden" class = "map_tools_selected_value" value = "1" />
    </div>

    <?php // Словари с типами рельефа, почвенного покрова и т.д. ?>
    <?php foreach ($dictionaries as $dict_name => $dictionary) { ?>
    <div class = "map_tools_<?php echo $dict_name; ?>_container">
        <?php
            $map_tools_selected = ' map_tools_selected';
            $table_name = 'd_'.$dict_name.'s';
            foreach ($dictionary as $dict_value) {
                ?>
                <div name = "<?php echo $dict_name; ?>"
                    id = "map_tools_<?php echo $dict_name."_".$dict_value[$table_name]['id']; ?>"
                    onclick="map_tools_click(this, 'map_tools_<?php echo $dict_name; ?>', <?php echo $dict_value[$table_name]['id']; ?>)"
                    class = "map_tools map_tools_<?php echo $dict_name.$map_tools_selected; ?>">
                    <img title="<?php echo $dict_value[$table_name]['name']; ?>" class = "map_tools_img1" src="<?php echo $this->webroot; ?><?php echo $dict_value[$table_name]['texture_name']; ?>" />
                </div>
                <?php
                $map_tools_selected = '';
            }
        ?>
        <input name = "<?php echo $table_name; ?>" id = "map_tools_<?php echo $dict_name; ?>_value" type = "hidden" class = "map_tools_selected_value" value = "<?php echo $dictionary[0][$table_name]['id']; ?>" />
    </div>
    <?php } ?>
</div>

<script>
    function map_tools_click(map_tools_object, map_tools_class, map_tools_object_value) {
        $("."+map_tools_class).removeClass("map_tools_selected");
        $("#"+map_tools_object.id).addClass("map_tools_selected");
        $("#"+map_tools_class+"_value").val(map_tools_object_value);
    };
</script>
