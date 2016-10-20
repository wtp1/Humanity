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



    <div class="panel-group" id="accordion">

        <div class="panel panel-default"> <!-- Аккордеон -->
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Рельеф
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">

                    <div> <!-- Табы -->
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
                    </div> <!-- Табы -->

                </div>
            </div>
        </div> <!-- Аккордеон -->

        <div class="panel panel-default"> <!-- Аккордеон -->
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Ресурсы
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">

                    <div> <!-- Табы -->
                        <?php // Словарь с категориями ресурсов ?>
                        <?php foreach ($resources as $dict_name => $dictionary) {
                            if ($dict_name=="resource_group") {
                        ?>
                        <div class = "map_tools_<?php echo $dict_name; ?>_container">
                            <ul id="myTab" class="nav nav-tabs">
                            <?php
                                $map_tools_selected = ' map_tools_selected';
                                $table_name = 'd_'.$dict_name.'s';
                                $li_active = 'class="active"';
                                foreach ($dictionary as $dict_value) {
                                    ?>
                                    <li <?php echo $li_active; ?> >
                                        <a href="#resource_group_id_<?php echo $dict_value[$table_name]['id']; ?>" data-toggle="tab">
                                            <div name = "<?php echo $dict_name; ?>"
                                                id = "map_tools_<?php echo $dict_name."_".$dict_value[$table_name]['id']; ?>"
                                                onclick="map_tools_click(this, 'map_tools_<?php echo $dict_name; ?>', <?php echo $dict_value[$table_name]['id']; ?>)"
                                                class = "map_tools map_tools_<?php echo $dict_name.$map_tools_selected; ?>">
                                                <img title="<?php echo $dict_value[$table_name]['name']; ?>" class = "map_tools_img1" src="<?php echo $this->webroot; ?><?php echo $dict_value[$table_name]['texture_name']; ?>" />
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                    $map_tools_selected = '';
                                    $li_active = '';
                                }
                            ?>
                            </ul>
                            <input name = "<?php echo $table_name; ?>" id = "map_tools_<?php echo $dict_name; ?>_value" type = "hidden" class = "map_tools_selected_value" value = "<?php echo $dictionary[0][$table_name]['id']; ?>" />
                        </div>
                        <?php }} ?>
                    </div> <!-- Табы -->

                    <div> <!-- Табы -->
                        <?php // Словарь ресурсов ?>
                        <?php foreach ($resources as $dict_name => $dictionary) {
                            if ($dict_name=="resource") {
                        ?>
                        <div class = "map_tools_<?php echo $dict_name; ?>_container">
                            <div class="tab-content"> <!-- Tab panes -->
                            <?php
                                $table_name = 'd_'.$dict_name.'s';
                                $tab_pane_active = 'active';
                                foreach ($dictionary as $d_resource_groups_id => $dict_values) {
                                    $map_tools_selected = ' map_tools_selected';
                                    ?>
                                    <div class="tab-pane <?php echo $tab_pane_active; ?>" id="resource_group_id_<?php echo $d_resource_groups_id; ?>">
                                    <?php
                                    foreach ($dict_values as $dict_value) {
                                        ?>
                                        <div name = "<?php echo $dict_name; ?>"
                                            id = "map_tools_<?php echo $dict_name."_".$dict_value['id']; ?>"
                                            onclick="map_tools_click(this, 'map_tools_<?php echo $dict_name; ?>', <?php echo $dict_value['id']; ?>)"
                                            class = "map_tools map_tools_<?php echo $dict_name.$map_tools_selected; ?>">
                                            <img title="<?php echo $dict_value['name']; ?>" class = "map_tools_img1" src="<?php echo $this->webroot; ?><?php echo $dict_value['texture_name']; ?>" />
                                        </div>
                                    <?php
                                        $map_tools_selected = '';
                                    }
                                    ?>
                                    </div>
                                    <?php
                                    $tab_pane_active = '';
                                }
                            ?>
                            </div> <!-- Tab panes -->
                            <input name = "<?php echo $table_name; ?>" id = "map_tools_<?php echo $dict_name; ?>_value" type = "hidden" class = "map_tools_selected_value" value = "<?php echo $dictionary[1][0]['id']; ?>" />
                        </div>
                        <?php }} ?>
                    </div> <!-- Табы -->

                </div>
            </div>
        </div> <!-- Аккордеон -->
    </div>

</div>

<script>
    function map_tools_click(map_tools_object, map_tools_class, map_tools_object_value) {
        $("."+map_tools_class).removeClass("map_tools_selected");
        $("#"+map_tools_object.id).addClass("map_tools_selected");
        $("#"+map_tools_class+"_value").val(map_tools_object_value);
    };
</script>
