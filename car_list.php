<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_car_list.js"></script>';    
?>
<script>
    var list_type = '<?php echo (isset($_REQUEST['list_type'])) ? $_REQUEST['list_type'] : ''; ?>';
</script>
<section class="logocontainer container">
    <div class="homeproduct">
        <img src="<?php echo ROOT_URL; ?>assets/img/home.png" alt="home">
        <a href="<?php echo ROOT_URL; ?>home">Home</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
        <a href="javascript:void(0)" class="gernexon">Cars</a>
    </div>
    <div class="clsoverlay"></div>
    <!-- mobileview start -->
    <div class="mobilegetset">
        <div class="mobilesorfilter">
            <div class="mobilsort50">
                <div class="filmobsort50">
                    <div class="sorticon">
                        <div class="sorflexedsvg">
                            <svg width="20" height="20" viewBox="0 0 256 256">
                                <path fill="none" d="M0 0h256v256H0z"></path>
                                <path fill="none" stroke="#111112" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="12"
                                    d="m144 168 40 40 40-40M184 112v96M48 128h72M48 64h136M48 192h56"></path>
                            </svg>

                        </div>
                        <p class="filtertitle">Sort By</p>
                    </div>

                    <div class="sortcontain">
                        <div class="cortagecntain">
                            <h3 class="sorlist boxtitle">SORT BY</h3>
                            <div class="poularity">
                                <div class="popularityflex">
                                    <div class="pupularflt2">
                                        <div class=" sortround">
                                            <div class="rondpoular">
                                                <p class="sortagetitle showroomtitle">Popularity</p>
                                                <p class="clsvarainround clsvariantroundactive clsblue" onclick="change_sorting(0)" sort-tab="round1">1</p>
                                            </div>
                                            <div class="rondpoular">
                                                <p class="sortagetitle showroomtitle">Price -- Low to High</p>
                                                <p class="clsvarainround clsblue" onclick="change_sorting(1)" sort-tab="round2">2</p>
                                            </div>
                                            <div class="rondpoular">
                                                <p class="sortagetitle showroomtitle">Price -- High to Low</p>
                                                <p class="clsvarainround clsblue" onclick="change_sorting(2)" sort-tab="round3">3</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filmobsort50">
                    <div class="filtemobflex">
                        <div class="sorflexedsvg">
                            <svg width="20" height="20" viewBox="0 0 256 256">
                                <path fill="none" d="M0 0h256v256H0z"></path>
                                <path fill="none" stroke="#111112" stroke-linecap="round" stroke-linejoin="round" stroke-width="12" d="M148 172H40M216 172h-28"></path>
                                <circle cx="168" cy="172" r="20" fill="none" stroke="#111112" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle>
                                <path fill="none" stroke="#111112" stroke-linecap="round" stroke-linejoin="round" stroke-width="12" d="M84 84H40M216 84h-92"></path>
                                <circle cx="104" cy="84" r="20" fill="none" stroke="#111112" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle>
                            </svg>
                        </div>
                        <p class="filtertitle"> Filter </p>
                    </div>


                    <div class="filtersubtitle filtersubtitlemobile">
                        <div class="fafaclose">
                            <i class=" fa fa-times" aria-hidden="true"></i>
                        </div>
                        
                        <div class="mainfilter3 acc__card mt-4">
                            <div class="acc__title brand_acc__title">
                                <h3 class="filtercategary">BRAND</h3>
                            </div>
                            <div class="acc__panel" id="mob_brand_list">
                            </div>
                        </div>

                        <div class="mainfilter5 acc__card mt-4">
                            <div class="acc__title type_acc__title">
                                <h3 class="filtercategary">CAR TYPE</h3>
                            </div>
                            <div class="acc__panel">
                                <p class="customcheck">
                                    <input type="checkbox" id="mob_<?php echo $const->petrol_fule_id; ?>" class="mob_<?php echo $const->petrol_fule_id; ?>" name="mob_filter_car_type" value="<?php echo $const->petrol_fule_id; ?>">
                                    <label for="mob_<?php echo $const->petrol_fule_id; ?>">Petrol</label>
                                </p>
                                <p class="customcheck">
                                    <input type="checkbox" id="mob_<?php echo $const->diesel_fule_id; ?>" class="mob_<?php echo $const->diesel_fule_id; ?>" name="mob_filter_car_type" value="<?php echo $const->diesel_fule_id; ?>">
                                    <label for="mob_<?php echo $const->diesel_fule_id; ?>">Diseal</label>
                                </p>
                                <p class="customcheck">
                                    <input type="checkbox" id="mob_<?php echo $const->ev_fule_id; ?>" class="mob_<?php echo $const->ev_fule_id; ?>" name="mob_filter_car_type" value="<?php echo $const->ev_fule_id; ?>">
                                    <label for="mob_<?php echo $const->ev_fule_id; ?>">EV</label>
                                </p>
                                <p class="customcheck">
                                    <input type="checkbox" id="mob_<?php echo $const->hybrid_fule_id; ?>" class="mob_<?php echo $const->hybrid_fule_id; ?>" name="mob_filter_car_type" value="<?php echo $const->hybrid_fule_id; ?>">
                                    <label for="mob_<?php echo $const->hybrid_fule_id; ?>">Hybrid</label>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobileview end -->
    <div class="filtersection">
        <div class="filterflex">
            <div class="filterflex1">
                <div class="filterfixed">
                    <div class="filtersider">
                        <p class="filtertitle"> Filter </p>
                    </div>
                    <div class="filtersubtitle">
                        <div class="mainfilter1 acc__card mt-4">
                            <div class="acc__title brand_acc__title">
                                <h3 class="filtercategary">BRAND</h3>
                            </div>
                            <div class="acc__panel" id="brand_list">
                                <p class="customcheck">
                                    <input type="checkbox" id="tata_id" class="tata_id" name="filter_brand" value="tata_id">
                                    <label for="tata_id">TATA</label><br>
                                </p>
                            </div>

                        </div>

                        <div class="mainfilter3 acc__card mt-4">
                            <div class="acc__title type_acc__title">
                                <h3 class="filtercategary">CAR TYPE</h3>
                            </div>
                            <div class="acc__panel">
                                <p class="customcheck">
                                    <input type="checkbox" id="<?php echo $const->petrol_fule_id; ?>" class="<?php echo $const->petrol_fule_id; ?>" name="filter_car_type" value="<?php echo $const->petrol_fule_id; ?>">
                                    <label for="<?php echo $const->petrol_fule_id; ?>">Petrol</label>
                                </p>
                                <p class="customcheck">
                                    <input type="checkbox" id="<?php echo $const->diesel_fule_id; ?>" class="<?php echo $const->diesel_fule_id; ?>" name="filter_car_type" value="<?php echo $const->diesel_fule_id; ?>">
                                    <label for="<?php echo $const->diesel_fule_id; ?>">Diseal</label>
                                </p>
                                <p class="customcheck">
                                    <input type="checkbox" id="<?php echo $const->ev_fule_id; ?>" class="<?php echo $const->ev_fule_id; ?>" name="filter_car_type" value="<?php echo $const->ev_fule_id; ?>">
                                    <label for="<?php echo $const->ev_fule_id; ?>">EV</label>
                                </p>
                                <p class="customcheck">
                                    <input type="checkbox" id="<?php echo $const->hybrid_fule_id; ?>" class="<?php echo $const->hybrid_fule_id; ?>" name="filter_car_type" value="<?php echo $const->hybrid_fule_id; ?>">
                                    <label for="<?php echo $const->hybrid_fule_id; ?>">Hybrid</label>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterflex2">
                <div class="filterright" id="car_list">
                    
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php' ?>