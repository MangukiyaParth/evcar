<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div id="formDiv" style="display: none;">
                            <form id="manage_testimonial_form" class="needs-validation" method="POST" novalidate>
                                <input type="hidden" id="id" name ="id">
                                <input type="hidden" id="formevent" name ="formevent"value="submit">
                                <div class="row">
                                    <div class="mb-3 col-sm-3">
                                        <label class="form-label" for="personname">Person Name</label>
                                        <input type="text" class="form-control" placeholder="Person Name" id="personname" name="personname" require>
                                        <div class="invalid-feedback"> Please enter Person Name. </div>
                                    </div>
                                    <div class="mb-3 col-sm-3">
                                        <label class="form-label" for="orderno">Display Order</label>
                                        <input type="text" class="form-control" placeholder="Display Order" id="orderno" name="orderno" require>
                                        <div class="invalid-feedback"> Please enter Display Order. </div>
                                    </div>
                                    <div class="mb-3 col-sm-3">
                                        <label class="form-label" for="date">Date</label>
                                        <input type="text" id="date" name="date" class="form-control" data-toggle="date-picker" placeholder="Enter Date" required />
                                        <div class="invalid-feedback"> Please enter Date. </div>
                                    </div>
                                    <div class="mb-3 col-sm-3">
                                        <label class="form-label" for="rating">Rating</label>
                                        <select class="form-select" id="example-select">
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                        <div class="invalid-feedback"> Please enter rating. </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="disp_order">File</label>
                                        <div class="dropzone" id="tm_logo" data-plugin="dropzone" data-previews-container="" data-upload-preview-template="#uploadPreviewTemplate" data-page="testimonial" acceptedFiles="image/*" is-multipe="false">
                                            <div class="fallback"><input type="file" name="file" id="file" class="" /></div>
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                            </div>
                                            <input type="hidden" name="file_name" id="file_name" class="file_name" />
                                        </div>
                                        <!-- Preview -->
                                        <div class="dropzone-previews mt-3" id="file-previews"></div>                                                        
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required></textarea> 
                                        <div class="invalid-feedback"> Please enter Description. </div>
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
                                        <th>Person Name </th>
                                        <th>Date </th>
                                        <th>Display Order</th>
                                        <th>Img</th>
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
