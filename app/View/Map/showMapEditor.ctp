<div class="contextMenu" id="myMenu1">
    <ul>
        <li id="edit_dialog"><img src="<?php echo $this->webroot; ?>img/tmp/folder.png" /> Редактировать</li>
        <li id="use_brush"><img src="<?php echo $this->webroot; ?>img/tmp/email.png" /> Применить кисть</li>
        <li id="save"><img src="<?php echo $this->webroot; ?>img/tmp/disk.png" /> Save</li>
        <li id="close"><img src="<?php echo $this->webroot; ?>img/tmp/cross.png" /> Close</li>
    </ul>
</div>

<!-- <div style='display:none;' id="dialog_cell_editor"> -->
<div id="dialog_cell_editor">
    <div id='dialog_cell_editor_context'></div>
</div>

<div id="dialog_tools">
    <div id='dialog_tools_context'></div>
</div>

<div class="map">
<?php
foreach ($squares['x_coord'] as $x_coord => $y_coord_squares_list) {
    ?>
    <div class="map_line map_x_coord_<?php echo $x_coord; ?>" >
    <?php
        foreach ($y_coord_squares_list['y_coord'] as $y_coord => $square) {
        ?>
            <div class="map_square map_square_x_coord_<?php echo $x_coord; ?> map_square_y_coord_<?php echo $y_coord; ?>" style="display:inline-block;">
                <?php
                foreach ($cell_list['square_id'][$square['id']]['rows'] as $row_id => $columns) {
                    ?>
                    <div class="map_square_row" id="map_square_row_<?php echo $row_id; ?>">
                    <?php
                    foreach ($columns['cells'] as $cell) {
                        $cell_id = $cell["s_cells"]["id"];
                        ?>
                        <div onmouseover="hover_hex(<?php echo $cell_id; ?>)" class="map_hex map_square_column_<?php echo $cell['s_cells']['column_number']; ?>" id = "<?php echo $cell_id; ?>" onclick="map_tools_use_brush()">
                            <img hidden class="map_img_hex map_img_hover" src='<?php echo $this->webroot; ?>img/map_editor/brush_1.png'>
                            <img class="map_img_hex map_dirt_type" title="<?php echo $cell_id; ?>" src='<?php echo $this->webroot.$cell["d_dirt_types"]["texture_name"]; ?>'>
                            <?php
                            if ( ($cell['d_relief_types']['texture_name']<>'') AND ($cell['d_relief_types']['show_on_map']==1) ) { ?>
                                <img class="map_img_hex map_relief_type" title="<?php echo $cell_id; ?>" src='<?php echo $this->webroot.$cell["d_relief_types"]["texture_name"]; ?>'>
                            <?php } ?>
                            <!-- <div class="map_hex-inner-1">
                                <div class="map_hex-inner-2">
                                </div>
                            </div> -->
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
}
?>
</div>

<script>
    function activate_context_menu() {
        $('.map_hex').contextMenu('myMenu1', {
          bindings: {
            'edit_dialog': function(t) {
                open_cell_editor_dialog(t.id);
            },
            'use_brush': function(t) {
                map_tools_use_brush(t.id);
            },
            'save': function(t) {
                alert('Trigger was '+t.id+'\nAction was Save');
            },
            'delete': function(t) {
                alert('Trigger was '+t.id+'\nAction was Delete');
            }
          }
        });
    }

    <?php //Разбор имени класса и поиск номера с отсечением по маске ?>
    function parse_class_name(class_str, mask) {
        var classes = class_str.split(" ");
        var className = "";

        for (var i = 0; i < classes.length; i++) {
            if (classes[i].indexOf(mask) !== -1) {
                className = classes[i].replace(mask, "");
                return className;
            }
        }
    }

    <?php //Показать выделение клеток при наведении ?>
    function hover_hex(hex_id) {
        $('.map_img_hover').hide();
        $('.hex_selected').removeClass('hex_selected');
        var brush = $('#map_tools_brush_value').val();

        if (brush==1) {
            $('#'+hex_id+' .map_img_hover').show();
            $('#'+hex_id).addClass('hex_selected');
        } else {
            var map_square_row_id = $('#'+hex_id).parent().attr("id");
            var map_square_class_list = $('#'+hex_id).parent().parent().attr("class");
            // console.log('hex_id = '+hex_id);
            // console.log(map_square_row_id);

            var map_square_x_coord = parse_class_name(map_square_class_list, "map_square_x_coord_");
            // console.log('map_square_x_coord = ' + map_square_x_coord);

            var map_square_y_coord = parse_class_name(map_square_class_list, "map_square_y_coord_");
            // console.log('map_square_y_coord = ' + map_square_y_coord);

            var map_square_row_id = parse_class_name(map_square_row_id, "map_square_row_");
            // console.log('map_square_row_id = ' + map_square_row_id);

            var parent_class = $('#'+hex_id).attr("class");
            // console.log(parent_class);
            var map_square_column_id = parse_class_name(parent_class, "map_square_column_");
            // console.log('map_square_column_id = ' + map_square_column_id);

            var map_square_x_coord_max = <?php echo $map_square_x_coord_max; ?>;
            var map_square_y_coord_max = <?php echo $map_square_y_coord_max; ?>;

            var cells_around_click = [];
        }
        if (brush==7) {
            map_square_column_id = parseInt(map_square_column_id);
            map_square_row_id = parseInt(map_square_row_id);
            map_square_x_coord = parseInt(map_square_x_coord);
            map_square_y_coord = parseInt(map_square_y_coord);

            // выбран нечетный стоблец в квадрате
            if ( (map_square_column_id % 2) == 1 ) {
                if ((map_square_column_id - 1) >= 1) {
                    // console.log('left down');
                    cells_around_click.push(hex_id - 1);

                    // console.log('right up');
                    if ((map_square_row_id - 1) >= 1) {
                        cells_around_click.push(hex_id - 11);
                    } else {
                        // верхняя граница квадрата
                        if ( (map_square_x_coord - 1) >= 1 ) {
                            hex_id_tmp = $('.map_square_x_coord_' + (map_square_x_coord - 1) + '.map_square_y_coord_' + map_square_y_coord + ' #map_square_row_' + 10 + ' .map_square_column_' + map_square_column_id).attr("id");
                            cells_around_click.push(parseInt(hex_id_tmp) - 1); // left up
                            cells_around_click.push(parseInt(hex_id_tmp) + 1); // right up
                        }
                    }
                }
                if ((map_square_column_id + 1) <= 10) {
                    // console.log('right down');
                    cells_around_click.push(hex_id + 1);
                    // console.log('left up');
                    if ((map_square_row_id - 1) >= 1) {
                        cells_around_click.push(hex_id - 9);
                    } else {
                        // верхняя граница квадрата
                        if ( (map_square_x_coord - 1) >= 1 ) {
                            hex_id_tmp = $('.map_square_x_coord_' + (map_square_x_coord - 1) + '.map_square_y_coord_' + map_square_y_coord + ' #map_square_row_' + 10 + ' .map_square_column_' + map_square_column_id).attr("id");
                            if ((map_square_row_id - 1) >= 1) {
                                cells_around_click.push(parseInt(hex_id_tmp) - 1); // left up
                            }
                            cells_around_click.push(parseInt(hex_id_tmp) + 1); // right up
                        }
                    }
                }
            } else {
                if ((map_square_column_id - 1) >= 1) {
                    // console.log('left up');
                    cells_around_click.push(hex_id - 1);
                    if ((map_square_row_id + 1) <= 10) {
                        // console.log('left down');
                        cells_around_click.push(hex_id + 9);
                    } else {
                        // нижняя граница квадрата
                        if ( (map_square_x_coord + 1) <= map_square_x_coord_max ) {
                            hex_id_tmp = $('.map_square_x_coord_' + (map_square_x_coord + 1) + '.map_square_y_coord_' + map_square_y_coord + ' #map_square_row_' + 1 + ' .map_square_column_' + map_square_column_id).attr("id");
                            cells_around_click.push(parseInt(hex_id_tmp) - 1); // left down
                            if ((map_square_row_id + 1) <= 10) {
                                cells_around_click.push(parseInt(hex_id_tmp) + 1); // right down
                            }
                        }
                    }
                }
                if ((map_square_column_id + 1) <= 10) {
                    // console.log('right up');
                    cells_around_click.push(hex_id + 1);
                    if ((map_square_row_id + 1) <= 10) {
                        // console.log('right down');
                        cells_around_click.push(hex_id + 11);
                    } else {
                        // нижняя граница квадрата
                        if ( (map_square_x_coord + 1) <= map_square_x_coord_max ) {
                            hex_id_tmp = $('.map_square_x_coord_' + (map_square_x_coord + 1) + '.map_square_y_coord_' + map_square_y_coord + ' #map_square_row_' + 1 + ' .map_square_column_' + map_square_column_id).attr("id");
                            cells_around_click.push(parseInt(hex_id_tmp) - 1); // left down
                            cells_around_click.push(parseInt(hex_id_tmp) + 1); // right down
                        }
                    }
                }
            }

            if ((map_square_row_id - 1) >= 1) {
                // console.log('up');
                cells_around_click.push(hex_id - 10);
            } else {
                // верхняя граница квадрата
                if ( (map_square_x_coord - 1) >= 1 ) {
                    hex_id_tmp = $('.map_square_x_coord_' + (map_square_x_coord - 1) + '.map_square_y_coord_' + map_square_y_coord + ' #map_square_row_' + 10 + ' .map_square_column_' + map_square_column_id).attr("id");
                    cells_around_click.push(parseInt(hex_id_tmp));
                }
            }

            if ((map_square_row_id + 1) <= 10) {
                // console.log('down');
                cells_around_click.push(hex_id + 10);
            } else {
                // нижняя граница квадрата
                if ( (map_square_x_coord + 1) <= map_square_x_coord_max ) {
                    hex_id_tmp = $('.map_square_x_coord_' + (map_square_x_coord + 1) + '.map_square_y_coord_' + map_square_y_coord + ' #map_square_row_' + 1 + ' .map_square_column_' + map_square_column_id).attr("id");
                    cells_around_click.push(parseInt(hex_id_tmp));
                }
            }

            cells_around_click.push(hex_id);
            // console.log(cells_around_click);
            cells_around_click.forEach(function(hex_id_tmp, i, cells_around_click) {
                $('#'+hex_id_tmp).addClass('hex_selected');
                $('#'+hex_id_tmp+' .map_img_hover').show();
            });
        }
        if (brush==19) {

        }
    }

    <?php //Открыть окно редактирования клетки ?>
    function open_cell_editor_dialog(cell_id) {
        $.post("<?php echo $this->webroot;?>Map/getCellEditorDialog/"+cell_id,{
        },
       	function(data){
            $("#dialog_cell_editor").dialog({
                modal: true,
                width: 700,
            });
            $('#dialog_cell_editor_context').html(data);
        });
    }

    <?php //Открыть окно инструментов ?>
    function open_tools_dialog() {
        $.post("<?php echo $this->webroot;?>Map/toolsDialog/",{
        },
       	function(data){
            $("#dialog_tools").dialog({
                // modal: true,
                width: 400,
            });
            $('#dialog_tools_context').html(data);
        });
    }

    <?php //Нажатие кистью на ячейку ?>
    function map_tools_use_brush(hex_object_id) {
        var field_list1 = {};
        $.each($(".map_tools_selected_value"), function(index, object1) {
            // console.log(object1);
            // console.log(object1.id);
            // console.log(object1.name);
            // console.log(object1.value);
            field_list1[object1.name] = object1.value;
        });
        // console.log(field_list1);
        field_list2 = JSON.stringify(field_list1);
        // console.log(field_list2);

        $.each($(".hex_selected"), function(index, object1) {
            save_cell_changes(object1.id, field_list1);
        });
    }

    $( document ).ready(function() {
        open_tools_dialog();
        activate_context_menu();
    });

    <?php //Закрыть ?>
    function dialog_cell_editor_cancel() {
        $('#dialog_cell_editor').dialog('close');
    }

    <?php //Обновить ячейку карты после изменения ее параметров ?>
    function refresh_cell(cell__id) {
        $.post("<?php echo $this->webroot;?>Map/refreshCell",{
      cell_id: cell__id
        }, function(data) {
      $("#"+cell__id).html(data);
        });
    }

    <?php //Сохранение изменений ?>
    function save_cell_changes(cell__id, field_list1) {
        field_list1 = field_list1 || 'no';
        // if (field_list1=='no') {
        //     field_list1 = '';
        // }
        $.post("<?php echo $this->webroot;?>Map/saveCellParams",{
            cell_id: cell__id,
            field_list: field_list1
            <?php
            // foreach ($dictionaries as $dict_name => $dictionary) {
                // echo $dict_name.":$('#".$dict_name."_field').val(),
                // ";
            // }
            ?>
        }, function(data) {
            // dialog_cell_editor_cancel();
            refresh_cell(cell__id);
            activate_context_menu();
        });
    }
</script>
