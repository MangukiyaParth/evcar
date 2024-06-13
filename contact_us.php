<?php include 'header.php'; ?> 
<style>
    .contact_form input,
    .contact_form textarea{
        border-radius: 20px;
    }
    .contact_form input::placeholder,
    .contact_form textarea::placeholder {
        color: #BBBBBBff;
    }
</style>
<!-- blogsection -->
<section class="logocontainer container">
    <div class="homeproduct">
        <img src="<?php echo ROOT_URL; ?>assets/img/home.png" alt="home">
        <a href="<?php echo ROOT_URL; ?>home">Home</a> <i class="fa fa-angle-right" aria-hidden="true"></i>
        <a href="javascript:void(0)" class="gernexon">Contact Us</a>
    </div>
    <div class="row">

            <!--Grid column-->
            <div class="col-sm-12 mb-4 col-md-5">
                <!--Form with header-->
                <div class="card">
                    <div class="card-header p-0">
                        <div class="bg-primary text-white text-center py-2">
                            <h3><i class="fa fa-envelope"></i> Write to us:</h3>
                            <p class="m-0">We’ll write rarely, but only the best content.</p>
                        </div>
                    </div>
                    <div class="card-body contact_form p-3">

                        <div class="form-group">
                            <label class="mb-2"> Your name </label>
                            <div class="input-group">
                                <input value="" type="text" name="data[name]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Your name">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="mb-2">Your email</label>
                            <div class="input-group mb-2 mb-sm-0">
                                <input type="email" value="" name="data[email]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="mb-2">Subject</label>
                            <div class="input-group mb-2 mb-sm-0">
                                <input type="text" name="data[subject]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="mb-2">Message</label>
                            <div class="input-group mb-2 mb-sm-0">
                                <textarea class="form-control" rows="4" name="mesg"></textarea>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <input type="submit" name="submit" value="submit" class="btn btn-primary btn-block border-0 py-2 px-4">
                        </div>

                    </div>

                </div>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-sm-12 col-md-7">
                <!--Google map-->
                <div class="mb-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7438.779303815816!2d72.8795775873664!3d21.216391873600926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f702fed9157%3A0x71b6670fb906503d!2sYogi%20Chowk%20Ground%2C%20Chikuwadi%2C%20Nana%20Varachha%2C%20Surat%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1715083964229!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!--Buttons-->
                <div class="row text-center">
                    <div class="col-md-4">
                        <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="fa fa-map-marker"></i></a>
                        <p> Surat, Gujarat </p>
                    </div>
                    <div class="col-md-4">
                        <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="fa fa-phone"></i></a>
                        <p>+91- 90000000</p>
                    </div>
                    <div class="col-md-4">
                        <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="fa fa-envelope"></i></a>
                        <p>contact@evcarsinfo.in</p>
                    </div>
                </div>
            </div>
            <!--Grid column-->
        </div>
</section>

<?php include 'footer.php' ?> 