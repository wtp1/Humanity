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

    <?php // Почвенный покров ?>
    <div class = "map_tools_dirt_type_container">
        <?php
            $map_tools_selected = ' map_tools_selected';
            foreach ($d_dirt_types as $d_dirt_type) {
                ?>
                <div name = "dirt_type"
                    id = "map_tools_dirt_type_<?php echo $d_dirt_type['d_dirt_types']['id']; ?>"
                    onclick="map_tools_click(this, 'map_tools_dirt_type', <?php echo $d_dirt_type['d_dirt_types']['id']; ?>)"
                    class = "map_tools map_tools_dirt_type<?php echo $map_tools_selected; ?>">
                    <img title="<?php echo $d_dirt_type['d_dirt_types']['name']; ?>" class = "map_tools_img1" src="<?php echo $this->webroot; ?><?php echo $d_dirt_type['d_dirt_types']['texture_name']; ?>" />
                </div>
                <?php
                $map_tools_selected = '';
            }
        ?>
        <input name = "d_dirt_types" id = "map_tools_dirt_type_value" type = "hidden" class = "map_tools_selected_value" value = "<?php echo $d_dirt_types[0]['d_dirt_types']['id']; ?>" />
    </div>
</div>

<script>
    function map_tools_click(map_tools_object, map_tools_class, map_tools_object_value) {
        $("."+map_tools_class).removeClass("map_tools_selected");
        $("#"+map_tools_object.id).addClass("map_tools_selected");
        $("#"+map_tools_class+"_value").val(map_tools_object_value);
    };
</script>
