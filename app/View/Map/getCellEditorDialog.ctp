<table>
    <?php
        foreach ($dictionaries as $dict_name => $dictionary) {
    ?>
    <tr>
        <td><?php echo $dictionary['name']; ?></td>
        <td>
            <?php
            echo "<select id='".$dict_name."_field'>";
            foreach ($dictionary['values'] as $dict_inner) {
                $dict_inner_id = $dict_inner[$dict_name]['id'];
                $dict_inner_name = $dict_inner[$dict_name]['name'];
                echo "<option ";
                if ($cell_info[0]['s_cells'][$dict_name.'_id']==$dict_inner_id) {
                    echo "selected";
                }
                echo " value='".$dict_inner_id."'>".$dict_inner_name."</option>";
            }
            echo "</select>";
            echo "<input class='checking_field' id='".$dict_name."' name='".$dict_name."' type='hidden' value='".$cell_info[0]['s_cells'][$dict_name.'_id']."'/>";
            ?>
        </td>
    </tr>
    <?php } ?>
</table>

<hr>
<div>
  	<span id='ch_close' onclick='dialog_cell_editor_cancel()' style='margin:5px;width:100px;float:right;' class='button'>Закрыть</span>
  	<span onclick='save_cell_changes(<?php echo $cell_info[0]['s_cells']['id']; ?>)' style='margin:5px;width:100px;float:right;' class='button'>Сохранить</span>
</div>
