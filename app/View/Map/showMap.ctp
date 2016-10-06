<?php
foreach ($squares['x_coord'] as $x_coord => $y_coord_squares_list) {
    ?>
    <div class="map_line map_x_coord<?php echo $x_coord; ?>" >
    <?php
    // style="border:1px solid black"
    // border:1px solid black
    foreach ($y_coord_squares_list['y_coord'] as $y_coord => $square) {
        // pr($square);
        ?>
        <div class="map_square" style="display:inline-block;">
            <?php
            foreach ($cell_list['square_id'][$square['id']]['cells'] as $cell_id => $cell) {
                ?>
                <div class="map_hex">
                    <img class="map_img_hex map_dirt_type" title="<?php echo $cell_id+1; ?>" src='<?php echo $this->webroot.$cell["d_dirt_types"]["texture_name"]; ?>'>
                    <?php
                    if ($cell['d_relief_types']['texture_name']<>'') { ?>
                        <img class="map_img_hex map_relief_type" title="<?php echo $cell_id+1; ?>" src='<?php echo $this->webroot.$cell["d_relief_types"]["texture_name"]; ?>'>
                    <?php } ?>
                    <div class="map_hex-inner-1">
                        <div class="map_hex-inner-2">
                        </div>
                    </div>
                </div>
            <?php
            }
        // echo $square['id'];
        ?>
        </div>
        <?php
    }
    ?>
    </div>
    <?php
}
?>

<script>
// var wr = document.getElementById('wrapper'),
//     tmpl = wr.innerHTML,
//     str = tmpl;
// for (var i = 21; i--; ) {
//     str += tmpl;
// }
// wr.innerHTML = str;
</script>
