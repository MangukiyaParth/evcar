<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_car_details.js"></script>';    
?>
<div class="logocontainer">
    <div class="homeproduct">
        <img src="<?php echo ROOT_URL; ?>assets/img/home.png" alt="home">
        <a href="<?php echo ROOT_URL; ?>">Home</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
        <a href="<?php echo ROOT_URL; ?>">EV Cars</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
        <a href="<?php echo ROOT_URL; ?>">Tata</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
        <a href="javascript:void(0)" class="gernexon">Nexon</a>
    </div>

    <div class="prdousctflex">
        <div class="productpicture productcarslide">
            <img src="<?php echo ROOT_URL; ?>assets/img/pdpcar.png" alt="productimage">
            <img src="<?php echo ROOT_URL; ?>assets/img/pdpcar.png" alt="productimage">
            <img src="<?php echo ROOT_URL; ?>assets/img/pdpcar.png" alt="productimage">
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
            <h4 class="nexontitle">Tata Nexon EV/Petrol/Desel</h4>
            <p class="fivesets">SUV * 5 Seater</p>
            <p class="pdprice">₹ 9.44 L - ₹ 17.65 L</p>
            <p class="pdcontain">The Tata Nexon is available in 50 variants in the price range of Rs. 9.44 lakhs to 17.65 lakhs. We can deliver this car between 6 days to 1 months depending on the availability and stocks.</p>

            <p class="specific">Specifications</p>
            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd1.png" alt="petrol">
                </div>
                <div class="spefixflex2">
                    <p class="petrols">Patrol | Diesel</p>
                </div>
            </div>
            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd2.png" alt="petro2">
                </div>
                <div class="spefixflex2">
                    <p class="petrols">1199CC | 1497CC</p>
                </div>
            </div>

            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd3.png" alt="petro3">
                </div>
                <div class="spefixflex2">
                    <p class="petrols">2023 Model</p>
                </div>
            </div>

            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd4.png" alt="5seater">
                </div>
                <div class="spefixflex2">
                    <p class="petrols">5 Seater</p>
                </div>
            </div>

            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd5.png" alt="madal">
                </div>
                <div class="spefixflex2">
                    <p class="petrols">Automatic | Mandal</p>
                </div>
            </div>

            <div class="specficflex">
                <div class="specfixflex1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/prd6.png" alt="SUV">
                </div>
                <div class="spefixflex2">
                    <p class="petrols">SUV</p>
                </div>
            </div>
            <p><a href="#" class="readnexon">Read more about Tata Nexon</a></p>

        </div>
    </div>

    <!-- 2nd part -->

    <div class="produtabs">
        <ul class="customtabs">
            <li class="productcartab-link pdcarcurrent">Red</li>
            <li class="productcartab-link">Black</li>
            <li class="productcartab-link">Blue</li>
        </ul>
    </div>

    <!-- tabbing part -->
    <div class="producttab">
        <div class="productflex">
            <div class="productflex75">
                <ul class="producttabs">
                    <li class="productreview prdtabblock" data-tab="pdtab1">Description</li>
                    <!-- <li class="productreview" data-tab="pdtab2">Reviews</li> -->
                </ul>

                <div class="productdiscrip">
                    <div class="prdsubpart prdsubactive" id="pdtab1">
                        <div class="pdcarsol">
                            <p class="pddiscription">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                ad minim veniam, Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </p>
                        </div>
                        <table class="table productable">
                            <thead>
                                <tbody>
                                    <tr>
                                        <td>Model</td>
                                        <td>#8786867</td>
                                    </tr>
                                    <tr>
                                        <td>Style</td>
                                        <td>Classic style</td>
                                    </tr>
                                    <tr>
                                        <td>Certificate</td>
                                        <td>ISO-898921212</td>
                                    </tr>
                                    <tr>
                                        <td>Size</td>
                                        <td>34mm x 450mm x 19mm</td>
                                    </tr>
                                    <tr>
                                        <td>Memory</td>
                                        <td>36GB RAM</td>
                                    </tr>
                                </tbody>
                            </thead>
                        </table>
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

    <div class="nexonblock">
        <h2 class="nexonvarianttitle">Tata Nexon Variants</h2>
        <div class="nexoncontain">
            <div class="productflex75">
                <div class="nextewlve">
                    <div class="newflexreviw">
                        <div class="newflexed">
                            <div class="nexflex1">
                                <h3 class="nxtweltitle">NEXON 1.2 XE
                                    <span>Petrol | Manual</span></h3>
                            </div>
                            <div class="nexflex2">
                                <ul class="variandown">
                                    <li class="varainround variantroundactive clblack" data-tab="round1">1</li>
                                    <li class="varainround clwhite" data-tab="round2">2</li>
                                    <li class="varainround clgrey" data-tab="round3">3</li>
                                    <li class="varainround clred" data-tab="round4">4</li>
                                </ul>
                            </div>
                        </div>


                        <div class="compareflex">
                            <div class="nexflex1">
                                <h5 class="carprice">Rs. 6.00 Lakh</h5>
                                <p class="showroomtitle">Avg. Ex-Showroom price</p>
                            </div>
                            <div class="nexflex2">
                                <p class="compareprice"><a href="#">+ COMPARE </a></p>
                            </div>
                        </div>
                        <div class="details">
                            <p class="detailbutton"><a href="#">See Details</a></p>
                        </div>
                    </div>

                    <div class="newflexreviw">
                        <div class="newflexed">
                            <div class="nexflex1">
                                <h3 class="nxtweltitle">NEXON 1.2 XE
                                    <span>Petrol | Manual</span></h3>
                            </div>
                            <div class="nexflex2">
                                <ul class="variandown">
                                    <li class="varainround variantroundactive clblack" data-tab="round1">1</li>
                                    <li class="varainround clwhite" data-tab="round2">2</li>
                                    <li class="varainround clgrey" data-tab="round3">3</li>
                                    <li class="varainround clred" data-tab="round4">4</li>
                                </ul>
                            </div>
                        </div>


                        <div class="compareflex">
                            <div class="nexflex1">
                                <h5 class="carprice">Rs. 6.00 Lakh</h5>
                                <p class="showroomtitle">Avg. Ex-Showroom price</p>
                            </div>
                            <div class="nexflex2">
                                <p class="compareprice"><a href="#">+ COMPARE </a></p>
                            </div>
                        </div>
                        <div class="details">
                            <p class="detailbutton"><a href="#">See Details</a></p>
                        </div>

                    </div>

                    <div class="newflexreviw">
                        <div class="newflexed">
                            <div class="nexflex1">
                                <h3 class="nxtweltitle">NEXON 1.2 XE
                                    <span>Petrol | Manual</span></h3>
                            </div>
                            <div class="nexflex2">
                                <ul class="variandown">
                                    <li class="varainround variantroundactive clblack" data-tab="round1">1</li>
                                    <li class="varainround clwhite" data-tab="round2">2</li>
                                    <li class="varainround clgrey" data-tab="round3">3</li>
                                    <li class="varainround clred" data-tab="round4">4</li>
                                </ul>
                            </div>
                        </div>


                        <div class="compareflex">
                            <div class="nexflex1">
                                <h5 class="carprice">Rs. 6.00 Lakh</h5>
                                <p class="showroomtitle">Avg. Ex-Showroom price</p>
                            </div>
                            <div class="nexflex2">
                                <p class="compareprice"><a href="#">+ COMPARE </a></p>
                            </div>
                        </div>
                        <div class="details">
                            <p class="detailbutton"><a href="#">See Details</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="productflex25 ad">
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>