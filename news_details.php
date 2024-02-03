<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_news_details.js"></script>';    
?> 

<!-- blogsection -->
<div class="blogsection news-area">
    <div class="logocontainer container">
        <div class="homeproduct">
            <img src="<?php echo ROOT_URL; ?>assets/img/home.png" alt="home">
            <a href="<?php echo ROOT_URL; ?>home">Home</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
            <a href="<?php echo ROOT_URL; ?>news">NEWS</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
            <a href="javascript:void(0)" class="gernexon news_title">Nexon</a>
        </div>
        <div class="vaildityall">
            <div class="vaildiflex full-width" id="news_list">
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?> 