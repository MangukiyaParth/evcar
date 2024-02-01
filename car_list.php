<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_car_list.js"></script>';    
?>
<script>
    var list_type = '<?php echo $_REQUEST['list_type']; ?>';
</script>
<section class="logocontainer container ev-area">
    <div class="cartitle">
        <h2 class="carfont page-heading"></h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="disflexcars" id="car_list">
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php' ?>