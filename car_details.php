<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_car_details.js"></script>';    
?>
<div class="logocontainer">
    <div class="homeproduct">
        <img src="<?php echo ROOT_URL; ?>assets/img/home.png" alt="home">
        <a href="<?php echo ROOT_URL; ?>home">Home</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
        <a href="<?php echo ROOT_URL; ?>" class="brand_url">Tata</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
        <a href="javascript:void(0)" class="gernexon vname">Nexon</a>
    </div>

    <div class="prdousctflex">
        <div class="productpicture productcarslide" id="color_img">
        </div>
        <div class="productpera">
            <p class="starrating d-none">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <span class="productrates">4.7 Star Rating</span>
                <span class="userfeedback">(21,671 User feedback)</span>
            </p>
            <h4 class="nexontitle vname"></h4>
            <!-- <p class="fivesets">SUV * 5 Seater</p> -->
            <p class="pdprice vprice">₹</p>
            <p class="pdcontain vshort_desc"></p>

            <p class="specific">Specifications</p>
            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd1.png" alt="petrol">
                </div>
                <div class="spefixflex2">
                    <p class="petrols vfuel"></p>
                </div>
            </div>
            <div class="specficflex vengin-div">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd2.png" alt="petro2">
                </div>
                <div class="spefixflex2">
                    <p class="petrols vengin"></p>
                </div>
            </div>

            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd3.png" alt="petro3">
                </div>
                <div class="spefixflex2">
                    <p class="petrols vmodel"></p>
                </div>
            </div>

            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd4.png" alt="5seater">
                </div>
                <div class="spefixflex2">
                    <p class="petrols vseater"></p>
                </div>
            </div>

            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd5.png" alt="madal">
                </div>
                <div class="spefixflex2">
                    <p class="petrols vtransmision"></p>
                </div>
            </div>

            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd6.png" alt="SUV">
                </div>
                <div class="spefixflex2">
                    <p class="petrols vtype"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2nd part -->

    <div class="produtabs">
        <ul class="customtabs" id="color_list">
        </ul>
    </div>

    <!-- tabbing part -->
    <div class="producttab mb-3">
        <div class="productflex">
            <div class="productflex75">
                <ul class="producttabs">
                    <li class="productreview prdtabblock" data-tab="pdtab1">Description</li>
                    <!-- <li class="productreview" data-tab="pdtab2">Reviews</li> -->
                </ul>

                <div class="productdiscrip">
                    <div class="prdsubpart prdsubactive vdesc" id="pdtab1">
                        
                    </div>


                    <!-- <div class="prdsubpart" id="pdtab2">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore doloremque ipsum pariatur rerum, debitis id commodi quae! Quos quidem architecto excepturi. Dicta dolid="pdtab2"oremque optio corrupti voluptates eaque similique
                            nemo rem!</p>
                    </div> -->

                </div>


            </div>
            <div class="productflex25 ad">
            </div>
        </div>
    </div>

    <div class="nexonblock varient-section">
        <h2 class="nexonvarianttitle"><span class="vname"></span> Variants</h2>
        <div class="nexoncontain">
            <div class="productflex75">
                <div class="nextewlve" id="verient_list">
                    
                </div>
            </div>
            <div class="productflex25 ad">
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>