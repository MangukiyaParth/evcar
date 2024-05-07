<style>
    .select2-results__option[aria-disabled="true"] {
      display: none;
    }
</style>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div>
                                <form id="manage_home_form" class="needs-validation" method="POST" novalidate>
                                    <input type="hidden" id="id">
                                    <input type="hidden" id="formevent" name ="formevent"value="submit">
                                    <div class="row">
                                        <div class="mb-3 offset-2 col-sm-8">
                                            <label class="form-label" for="list_type">List Type</label>
                                            <select class="form-select select2" id="list_type" name="list_type">
                                                <option value="1">Best EV Cars</option>
                                                <option value="2">Best HYBRID Cars</option>
                                                <option value="3">Best FUEL Cars</option>
                                                <option value="4">Treading Cars</option>
                                                <option value="5">Upcoming Cars</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 offset-2 col-sm-7">
                                            <label class="form-label" for="cars">Cars</label>
                                            <select class="form-select select2 js-states" id="cars" name="cars" data-live-search="2">
                                            </select>
                                        </div>
                                        <div class="mb-3 col-sm-1 mt-3">
                                            <button class="btn btn-primary add-right-btn" type="button" onclick="addCar()">Add</button>
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
                                        <div class="col-sm-8 offset-2">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="80%">Car</th>
                                                        <th width="20%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="car-list"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-primary offset-sm-3 add-right-btn" type="submit">Submit</button>
                                        </div>
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