<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_news_list.js"></script>';    
?> 

<!-- blogsection -->
<div class="blogsection news-area">
    <div class="logocontainer container">
        <div class="homeproduct">
            <img src="<?php echo ROOT_URL; ?>assets/img/home.png" alt="home">
            <a href="<?php echo ROOT_URL; ?>home">Home</a><img src="<?php echo ROOT_URL; ?>assets/img/angle-right.svg" class="arrow width-28">
            <a href="javascript:void(0)" class="gernexon">News</a>
        </div>
        <div class="vaildityall">
            <div class="vaildiflex full-width" id="news_list">
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?> 