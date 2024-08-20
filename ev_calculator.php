<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_ev_calculator.js"></script>';
?>
<style>
    .range_selector_wrap{
        padding: 0 5px;
    }

    .range_selector_wrap .range_body{
        width:calc(100% - 135px);
        margin-top:15px;
        margin-right: 20px;
        position: relative;
        margin-left: 10px;
    }
    .range_selector_wrap .range_body:after, .range_selector_wrap .range_body:before {
        content: '';
        position: absolute;
        top: -4px;
        width: 10px;
        height: 10px;
        border: solid 2px #acaaaa;
        border-radius: 50%;
        background: #acaaaa;
    }
    .range_selector_wrap .range_body:after{left: -9px;}
    .range_selector_wrap .range_body:before{right: -9px;}
    .range_selector_wrap .range_body, .range_selector_wrap .range_head {
        display: inline-block;
        vertical-align: top;
    }
    .range_selector_wrap .range_head{
        width:100px;
        border-radius: 3px;
        border: solid 1px #ebebeb;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        padding: 3px 0;
    }
    .range_selector_wrap .range_head .value{
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        display: inline-block;
        vertical-align: top;
        margin-right: 5px;
    }
    input[type="range"] {
        display: block;
        -webkit-appearance: none;
        background-color: #d2cecf;
        width: 100%;
        height: 3px;
        outline: 0;
        margin:0;
    }
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        background-image: radial-gradient(#40b54d, #40b54d);
        width: 16px;
        height: 16px;
        border-radius: 50%;
        cursor: pointer;
    }
    input[type="range"]::-webkit-slider-thumb:hover {
        box-shadow: none;
    }
    input[type="range"]::-webkit-slider-thumb:active {
        transform: scale(1.2);
        box-shadow: none;
    }
    input:focus-visible {
        outline-offset: 0px;
    }
    label.customSelect {
        position: relative;
        font-size: 16px;
        font-weight: bold;
        width: 100%;
        height: 40px;
        box-sizing: border-box;
        z-index: 0;
    }
    label.customSelect select {
        background: transparent;
    }
    label.customSelect select:focus {
        background: transparent;
    }
    label.customSelect:after {
        content: '';
        background: #ffffff url(https://img.etimg.com/photo/91533658.cms) no-repeat 0 0;
        position: absolute;
        right: 2px;
        top: 5px;
        width: 31px;
        height: 26px;
        background-size: 25px;
        z-index: -1;
    }
</style>

<!-- blogsection -->
<section class="logocontainer container">
    <div class="homeproduct">
        <img src="<?php echo ROOT_URL; ?>assets/img/home.png" alt="home">
        <a href="<?php echo ROOT_URL; ?>home">Home</a><img src="<?php echo ROOT_URL; ?>assets/img/angle-right.svg" class="arrow width-28">
        <a href="javascript:void(0)" class="gernexon">EV Calculator</a>
    </div>
    <div class="pb-5 m-2">
        <div class="row">
            <div class="offset-sm-4 col-sm-4 p-4 card">  
                <h2 class="text-center mb-3">EV Calculator</h2>
                <hr>
                <div class="form-div">
                    <div class="mb-4">
                        <label for="customRange2" class="form-label">Electric Vehicle Range</label>
                        <div class="range_selector_wrap">
                            <div class="range_body"><input type="range" class="form-range" min="10" max="800" value="250" id="customRange2"></div>
                            <div class="range_head"><div class="value">250</div><span class="symbl">Km</span></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="customRange2" class="form-label">Electric Vehicle Range</label>
                        <div class="range_selector_wrap">
                            <div class="range_body"><input type="range" class="form-range" min="10" max="600" value="40" id="customRange2"></div>
                            <div class="range_head"><div class="value">40</div><span class="symbl">Km</span></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="customRange2" class="form-label">Journey Frequency</label>
                        <div class="range_selector_wrap">
                            <label for="jornyFrqcy" class="customSelect">
                                <select class="form-control" id="jornyFrqcy">
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Monthly</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="customRange2" class="form-label">Journey Distance</label>
                        <div class="range_selector_wrap input-group input-group-merge">
                            <input type="text" class="form-control" value="1">
                            <div class="input-group-text">Km</div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="customRange2" class="form-label">Annual Journey Distance </label>
                        <div class="range_selector_wrap input-group input-group-merge">
                            <input type="text" class="form-control" readonly value="1">
                            <div class="input-group-text">Km</div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="customRange2" class="form-label">Charging Cost</label>
                        <div class="range_selector_wrap">
                            <div class="range_body"><input type="range" class="form-range" min="4" max="100" value="10" id="customRange2"></div>
                            <div class="range_head"><span class="symbl">₹</span><div class="value">10</div></div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary">Calculate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php' ?> 