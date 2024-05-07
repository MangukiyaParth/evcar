
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div id="formDiv" style="display: none;">
                                <form id="manage_role_form" class="needs-validation" method="POST" novalidate>
                                    <input type="hidden" id="id">
                                    <input type="hidden" id="formevent" name ="formevent"value="submit">
                                    <div class="row">
                                        <div class="mb-3 col-sm-6">
                                            <label class="form-label" for="role">Role</label>
                                            <input type="text" id="role" name="role" class="form-control" placeholder="Enter role" required />
                                            <div class="invalid-feedback"> Please enter role. </div>
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
                                            <th>Role </th>
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