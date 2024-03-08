<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_car_details.js"></script>';    
?>
<div class="logocontainer container">
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
            <table class="table table-strip spec-table">
                <tbody>
                    <tr class="vfule-div">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/fuel.svg" alt="Fuel Type"><span> Fuel Type </span></div></td>
                        <td class="vfuel"></td>
                    </tr>
                    <tr class="vmodal_year-div">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/calendar.svg" alt="Model"><span> Model </span></div></td>
                        <td class="vmodel"></td>
                    </tr>
                    <tr class="vtransmision-div">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/transmission.svg" alt="Transmision"><span> Transmision </span></div></td>
                        <td class="vtransmision"></td>
                    </tr>
                    <tr class="vengin-div">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/engine.svg" alt="Engine Size"><span> Engine Size </span></div></td>
                        <td class="vengin"></td>
                    </tr>
                    <tr class="vmileage-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/mileage.svg" alt="Mileage"><span> Mileage </span></div></td>
                        <td class="vmileage"></td>
                    </tr>
                    <tr class="vground-clearance-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/ground-clearance.svg" alt="Ground Clearance"><span> Ground Clearance (mm) </span></div></td>
                        <td class="vground-clearance"></td>
                    </tr>
                    <tr class="vwarranty-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/warranty.svg" alt="Warranty"><span> Warranty </span></div></td>
                        <td class="vwarranty"></td>
                    </tr>
                    <tr class="vseater-div">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/seated.svg" alt="Seating Capacity"><span> Seating Capacity </span></div></td>
                        <td class="vseater"></td>
                    </tr>
                    <tr class="vdimension-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/dimension.svg" alt="Size"><span> Size </span></div></td>
                        <td class="vdimension"></td>
                    </tr>
                    <tr class="vfuel-tank-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/fuel-tank-capacity.svg" alt="Fuel Tank"><span> Fuel Tank </span></div></td>
                        <td class="vfuel-tank"></td>
                    </tr>
                    <tr class="vdriveing-range-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/driving-range.svg" alt="Driving Range (km)"><span> Driving Range (km) </span></div></td>
                        <td class="vdriveing-range"></td>
                    </tr>
                    <tr class="vncap-rating-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/safety-rating.svg" alt="NCAP Rating"><span> NCAP Rating (Best - 5 Star) </span></div></td>
                        <td class="vncap-rating"></td>
                    </tr>
                    <tr class="vbattery-warranty-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/battery-warranty.svg" alt="Battery Warranty"><span> Battery Warranty </span></div></td>
                        <td class="vbattery-warranty"></td>
                    </tr>
                    <tr class="vbattery-capacity-div d-none">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/battery-size.svg" alt="Battery Capacity"><span> Battery Capacity </span></div></td>
                        <td class="vbattery-capacity"></td>
                    </tr>
                    <tr class="vtype-div">
                        <td><div class="spec-title"><img src="<?php echo ROOT_URL; ?>assets/img/car-type.svg" alt="Car Type"><span> Car Type </span></div></td>
                        <td class="vtype"></td>
                    </tr>
                </tbody>
            </table>
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