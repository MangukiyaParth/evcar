<style>
    .color-img{
        height: 100px;
        margin-right: 5px;
        border-radius: 5px;
        margin-top: 5px;
        box-shadow: 0 0 12px 0px #b3b1b1;
    }
</style>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div id="formDiv" style="display: none;">
                            <form id="manage_cars_form" class="needs-validation" method="POST" novalidate>
                                <input type="hidden" id="id">
                                <input type="hidden" id="formevent" name ="formevent"value="submit">
                                <div class="row">
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required />
                                    </div>
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="brand">Brand</label>
                                        <select class="form-select select2" id="brand" name="brand" data-live-search="2">
                                            <option value="1">test</option>
                                            <option value="2">test2</option>
                                            <option value="3">test3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="price">Price</label>
                                        <input type="text" id="price" name="price" class="form-control desimalnumberField" placeholder="Enter price" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="fule_type">Fule Type</label>
                                        <select class="form-select fule_type select2" id="fule_type" name="fule_type">
                                            <option value="1">test</option>
                                            <option value="2">test2</option>
                                            <option value="3">test3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="engine">Engine Displacement</label>
                                        <input type="text" id="engine" name="engine" class="form-control numbersOnlyField" placeholder="Enter engine displacement" required />
                                    </div>
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="modal_year">Modal Year</label>
                                        <input type="text" id="modal_year" name="modal_year" class="form-control numbersOnlyField" data-provide="date-picker" data-date-min-view-mode="2" placeholder="Enter modal year" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="transmision">Transmision</label>
                                        <select class="form-select transmision select2" id="transmision" name="transmision">
                                            <option value="1">test</option>
                                            <option value="2">test2</option>
                                            <option value="3">test3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="seater">Seater</label>
                                        <input type="text" id="seater" name="seater" class="form-control numbersOnlyField" placeholder="Enter seater" required />
                                    </div>
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="car_type">Car Type</label>
                                        <select class="form-select select2" id="car_type" name="car_type">
                                            <option value="1">test</option>
                                            <option value="2">test2</option>
                                            <option value="3">test3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="disp_order">Image</label>
                                        <div class="dropzone" id="cars_file" data-plugin="dropzone" data-previews-container="" data-upload-preview-template="#uploadPreviewTemplate" data-page="cars" acceptedFiles="image/*" is-multipe="false">
                                            <div class="fallback"><input type="file" name="file" id="file" class="" /></div>
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                                <h3>Drop files here or click to upload.</h3>
                                            </div>
                                            <input type="hidden" name="file_name" id="file_name" class="file_name" />
                                        </div>                                                      
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-sm-12">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter Description" rows="3" required></textarea> 
                                        <div class="invalid-feedback"> Please enter Description. </div>
                                    </div>
                                </div>

                                <!-- Color -->
                                <div class="row mt-2 pt-3" style="border-top: 1px solid rgba(138,150,156,.2)">
                                    <div class="mb-3 offset-2 col-sm-3">
                                        <label class="form-label" for="color">Color</label>
                                        <input type="text" id="color" name="color" class="form-control" placeholder="Enter color Text" />
                                    </div>
                                    <div class="mb-3 col-sm-4">
                                        <label class="form-label" for="disp_order">Image</label>
                                        <div class="dropzone" id="cars_file" data-plugin="dropzone" data-previews-container="" data-upload-preview-template="#uploadPreviewTemplate" data-page="cars" acceptedFiles="image/*" is-multipe="true">
                                            <div class="fallback"><input type="color_file" name="color_file" id="color_file" class="" /></div>
                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                                <h4>Drop files here or click to upload.</h4>
                                            </div>
                                            <input type="hidden" name="color_file_name" id="color_file_name" class="file_name" />
                                        </div>                                                      
                                    </div>
                                    <div class="mb-3 mt-4 col-sm-1">
                                        <button class="btn btn-info" type="button" id="add_color">Add</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-1 col-sm-10">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Color</th>
                                                    <th width="70%">Images</th>
                                                    <th width="10%">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="color_list"></tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- Verient -->
                                <div class="row mt-2 pt-3" style="border-top: 1px solid rgba(138,150,156,.2)">
                                    <div class="mb-3 offset-1 col-sm-3">
                                        <label class="form-label" for="verient_name">Verient Name</label>
                                        <input type="text" id="verient_name" name="verient_name" class="form-control" placeholder="Enter verient name" />
                                    </div>
                                    <div class="mb-3 col-sm-3">
                                        <label class="form-label" for="verient_fule_type">Fule Type</label>
                                        <select class="form-select fule_type select2" id="verient_fule_type" name="verient_fule_type">
                                            <option value="1">test</option>
                                            <option value="2">test2</option>
                                            <option value="3">test3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-sm-3">
                                        <label class="form-label" for="verient_transmision">Transmision</label>
                                        <select class="form-select transmision select2" id="verient_transmision" name="verient_transmision">
                                            <option value="1">test</option>
                                            <option value="2">test2</option>
                                            <option value="3">test3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 offset-1 col-sm-3">
                                        <label class="form-label" for="verient_engine">Engine Displacement</label>
                                        <input type="text" id="verient_engine" name="verient_engine" class="form-control numbersOnlyField" placeholder="Enter engine displacement" required />
                                    </div>
                                    <div class="mb-3 col-sm-3">
                                        <label class="form-label" for="verient_price">Price</label>
                                        <input type="text" id="verient_price" name="verient_price" class="form-control desimalnumberField" placeholder="Enter price" required />
                                    </div>
                                    <div class="my-3 col-sm-1">
                                        <button class="btn btn-info" type="button">Add</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-1 col-sm-10">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="30%">Name</th>
                                                    <th width="15%">Fule Type</th>
                                                    <th width="15%">Transmision</th>
                                                    <th width="15%">Engine</th>
                                                    <th width="15%">Price</th>
                                                    <th width="10%">Delete</th>
                                                </tr>
                                            </thead>
                                        </table>
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
                                        <th>Title </th>
                                        <th>Date </th>
                                        <th>Short Description</th>
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