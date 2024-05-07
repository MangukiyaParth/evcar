<!-- content -->
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div id="">
                            <form id="manage_userrights_form" class="needs-validation" method="POST" novalidate>
                                <input type="hidden" id="id">
                                <div class="row">
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="roleid">Role</label>
                                        <select class="form-select form-select-md" name="roleid" id="roleid">
                                        </select>
                                        <div class="invalid-feedback"> Please enter Role. </div>
                                    </div>
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="personid">User</label>
                                        <select class="form-select form-select-md" name="personid" id="personid">
                                        </select>
                                        <div class="invalid-feedback"> Please enter User. </div>
                                    </div>
                                    <div class="col-sm-3 mt-4 text-end">
                                        <button class="btn btn-primary offset-sm-3 add-right-btn" type="submit">Submit</button>
                                    </div>
                                </div>
                                <div class="table-responsive mt-3 "> 
                                    <table class="table table-striped dt-responsive nowrap w-100"  id="table1">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th>Page Name</th>
                                                <th>Select All</th>
                                                <th>View Rights</th>
                                                <th>Add Rights</th>
                                                <th>Edit Rights</th>
                                                <th>Delete Rights</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addtable" style="text-align: center;" >
                                        </tbody>
                                    </table>
                                </div>
                            </form>
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