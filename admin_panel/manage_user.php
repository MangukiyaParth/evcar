
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div id="formDiv" style="display: none;">
                                <form id="manage_user_form" class="needs-validation" method="POST" novalidate>
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" id="formevent" name ="formevent"value="submit">
                                    <div class="row">
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="roleid">Role</label>
                                            <select class="form-select form-select-md" name="roleid" id="roleid" required>
                                            </select>
                                            <div class="invalid-feedback"> Please enter Role. </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="personname">Person Name</label>
                                            <input type="text" id="personname" name="personname" class="form-control" placeholder="Enter Person Name" required />
                                            <div class="invalid-feedback"> Please enter Person Name. </div>
                                        </div>
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="contact1">Contact 1</label>
                                            <input type="text" id="contact1" name="contact1" class="form-control" placeholder="Enter Contact 1" pattern="[0-9]{10}" maxlength="10" onkeyup="numonly('contact1')" required/>
                                            <div class="invalid-feedback"> Please enter Contact 1. </div>
                                        </div>
                                        <!-- <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="contact2">Contact 2</label>
                                            <input type="text" id="contact2" name="contact2" class="form-control" placeholder="Enter Contact 2" pattern="[0-9]{10}" onkeyup="numonly('contact2')" />
                                            <div class="invalid-feedback"> Please enter Contact 2. </div>
                                        </div> -->
                                    </div>
                                    <div class="row ">
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required />
                                            <div class="invalid-feedback"> Please enter Email. </div>
                                        </div>
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="address">Address</label>
                                            <textarea id="address" name="address" class="form-control"></textarea>
                                            <!-- <div class="invalid-feedback"> Please enter Address </div> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="stateid">State</label>
                                            <select class="form-select form-select-md" name="stateid" id="stateid" required>
                                            </select>
                                            <div class="invalid-feedback"> Please enter State name. </div>
                                        </div>
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="cityid">City</label>
                                            <select class="form-select form-select-md" name="cityid" id="cityid" required>
                                            </select>
                                            <div class="invalid-feedback"> Please enter State name. </div>
                                        </div>
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="pincode">Pincode</label>
                                            <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter Pincode" onkeyup="numonly('pincode')" required />
                                            <div class="invalid-feedback"> Please enter Pincode. </div>
                                        </div>
                                    </div>
                                    <div class="row logindiv d-none">
                                        <div class="mb-3 col-sm-4">
                                            <label class="form-label" for="username">User Name</label>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter User Name" required />
                                            <div class="invalid-feedback"> Please enter User Name. </div>
                                        </div>
                                        <div class="mb-3 col-sm-4 passdiv">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="text" id="password" name="password" class="form-control" placeholder="Enter Password"   />
                                            <!-- <div class="invalid-feedback"> Please enter Contact 1. </div> -->
                                        </div>
                                        <div class="mb-3 col-sm-4 passdiv">
                                            <label class="form-label" for="cn_password">Confirm Password</label>
                                            <input type="text" id="cn_password" name="cn_password" class="form-control" placeholder="Enter Confirm Password" />
                                            <!-- <div class="invalid-feedback"> Please enter Contact 2. </div> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-end">
                                            <button class="btn btn-primary offset-sm-3" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive mt-3" id="detailsDiv">
                                <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id</th>
                                            <th >Role</th>
                                            <th >Person Name</th>
                                            <th >Email</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

        </div>
        <!-- container -->

    </div>
    <!-- content -->