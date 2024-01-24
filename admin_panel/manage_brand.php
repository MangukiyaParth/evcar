
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div id="formDiv" style="display: none;">
                                <form id="manage_brand_form" class="needs-validation" method="POST" novalidate>
                                    <input type="hidden" id="id">
                                    <input type="hidden" id="formevent" name ="formevent"value="submit">
                                    <div class="row">
                                        <div class="mb-3 col-sm-6">
                                            <label class="form-label" for="brand">Brand</label>
                                            <input type="text" id="brand" name="brand" class="form-control" placeholder="Enter Brand" required />
                                            <div class="invalid-feedback"> Please enter Brand. </div>
                                        </div>
                                        <div class="mb-3 col-sm-6">
                                            <label class="form-label" for="disp_order">File</label>
                                            <div class="dropzone" id="brand_logo" data-plugin="dropzone" data-previews-container="" data-upload-preview-template="#uploadPreviewTemplate" data-page="brand" acceptedFiles="image/*" is-multipe="false">
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
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-sm-3 d-none">
                                            <label class="form-label" for="button">Button Text</label>
                                            <input type="text" id="button" name="button" class="form-control" placeholder="Enter Button Text" value="Buy Now" required />
                                            <div class="invalid-feedback"> Please enter Button Text. </div>
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
                                            <th>Logo</th>
                                            <th>Brand </th>
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