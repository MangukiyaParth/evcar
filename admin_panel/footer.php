<?php
$include_javscript_at_bottom = '<script src="' . $gh->auto_version(ADMIN_PANEL_URL.'js/common.js') . '"></script>' . $include_javscript_at_bottom;
$include_javscript_at_bottom = str_replace('<script ', '<script defer ', $include_javscript_at_bottom);
include 'theme_settings.php';
?>
<!-- file preview template -->
<div class="d-none" id="uploadPreviewTemplate">
	<div class="card mt-1 mb-0 shadow-none border">
		<div class="p-2">
			<div class="row align-items-center dz-div">
				<div class="col-auto dz-img-div">
					<img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
				</div>
				<div class="col ps-0 dz-detail-div">
					<a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
					<p class="mb-0" data-dz-size></p>
				</div>
				<div class="col-auto dz-remove-btn-div">
					<!-- Button -->
					<a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
						<i class="ri-close-line"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<footer class="footer <?php if ($current_page == 'login') {
							echo 'footer-alt';
						} ?>">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 <?php if ($current_page != 'login') {
										echo 'text-md-end';
									} ?> footer-links d-none d-md-block">
				<script>
					document.write(new Date().getFullYear())
				</script> © Admin
			</div>
		</div>
	</div>
</footer>
<div id="comman_ListModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title comman_list_model_header" id="multiple-twoModalLabel"></h4>
                <button type="button" class="btn-close" data-bs-target="#priceModal" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="accordion accordion-flush" id="comman_list_model_div">

                </div><!-- /.accordion -->

            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="csvModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="multiple-twoModalLabel">
                    Upload CSV
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="offset-3 col-6">
                        <input type="file" name="file" class="form-control mb-2" id="csv_file" />
                    </div>
                </div>
            </div><!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="upload_csv()">Upload</button>
            </div><!-- /.modal-footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="delete_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-body p-4">
				<div class="text-center">
					<i class="ri-alert-line h1 text-warning"></i>
					<h4 class="mt-2">Are you sure?</h4>
					<p class="mt-3">you want to delete data?</p>
					<button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal" onclick="delete_current_record()">Continue</button>
					<button type="button" class="btn btn-default my-2" data-bs-dismiss="modal" onclick="PRIMARY_ID = 0;">close</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<div id="approve_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-body p-4">
				<div class="text-center">
					<i class="ri-alert-line h1 text-warning"></i>
					<input type="hidden" id="paymentid">
					<input type="hidden" id="paid">
					<input type="hidden" id="roleid">
					<h4 class="mt-2">Are you sure?</h4>
					<p class="mt-3">you want to Approve Payment?</p>
					<button type="button" class="btn btn-warning my-2 approvepayment" data-bs-dismiss="modal" >Continue</button>
					<button type="button" class="btn btn-default my-2" data-bs-dismiss="modal" >close</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div id="reject_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title comman_list_model_header" id="multiple-twoModalLabel">Add Reject Reason</h4>
                <button type="button" class="btn-close" data-bs-target="#priceModal" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="accordion accordion-flush" id="comman_list_model_div">
					<form id="rejectpayment_form" class="needs-validation" method="POST" novalidate>
						<input type="hidden" id="paymentid">
						<input type="hidden" id="paid">
						<input type="hidden" id="roleid">
						<div class="row">
							<div class="mb-3 col-sm-12">
								<label class="form-label" for="rejectreason">Reject Reason</label>
								<textarea class="form-control" name="rejectreason" id="rejectreason"></textarea>                                            
								<div class="invalid-feedback"> Please enter Description </div>
							</div>
						</div>	

						<div class="row">
							<div class="col-sm-12 text-end">
								<button class="btn btn-primary offset-sm-3" type="submit">Submit</button>
							</div>
						</div>
					</form>
                </div><!-- /.accordion -->

            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="resetpass_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title " id="multiple-twoModalLabel">Reset password</h4>
                <button type="button" class="btn-close" data-bs-target="#priceModal" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="accordion accordion-flush" id="comman_list_model_div">
                    <form id="resetpass" class="needs-validation" novalidate method="POST"  >
                        <input type="hidden" class="form-control" name="userid" id="userid" >
                        <div class="mb-3">
                        <label for="" class="form-label">User Name : </label>
                        <span id="helpId " class="usernamesp"></span>
                        </div>
                        <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="text" class="form-control" name="mdpassword" id="mdpassword" aria-describedby="helpId" placeholder="Enter Password">
                        </div>
                        <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="text" class="form-control" name="confirmPassword" id="confirmPassword" aria-describedby="helpId" placeholder="Enter Confirm Password">
                        <p id="passwordError" style="color: red;"></p>
                        </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div><!-- /.accordion -->

            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/vendor.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/jquery-ui.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/handlebars.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/typeahead.bundle.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/nprogress.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/jstz.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/moment.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/daterangepicker.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/pnotify.custom.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/jquery.dataTables.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/dataTables.bootstrap5.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/select2.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/ckeditor.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/MyUploadAdapter.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/jquery.caret.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/jquery.tag-editor.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/validate.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/app.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/highlight.pack.min.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/hyper-syntax.js"></script>
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/printThis.js"></script>
<!-- fileupload js -->
<script defer src="<?php echo ADMIN_PANEL_URL; ?>assets/js/dropzone.min.js"></script>

<?php

$include_javscript_library_before_custom_script_at_bottom = str_replace('<script ', '<script defer ', $include_javscript_library_before_custom_script_at_bottom);

echo $include_javscript_library_before_custom_script_at_bottom;
echo $include_javscript_at_bottom;
?>
<script defer>
	function UrlExists(url)
	{
		var http = new XMLHttpRequest();
		http.open('HEAD', url, false);
		http.send();
		return http.status==200;
	}
	function openPage(pageName=""){
		$("#main_page_data").html(`<div id="preloader">
						<div id="status">
							<div class="bouncing-loader"><div ></div><div ></div><div ></div></div>
						</div>
					</div>`);
		var newPage = (pageName!="") ? pageName : CURRENT_PAGE;
		var Urights = <?php echo $Urights; ?>;
		var Urole = '<?php echo ($userObj) ? $userObj['userroleid'] : ''; ?>';
		var adminRole = '<?php echo $admin_role_id; ?>';
		var isAdmin = (Urole.toLocaleLowerCase().indexOf(adminRole) != -1) ? true : false;
		var rightIndex = Urights.findIndex(x => x.pagename == newPage);
		if(UrlExists(notify_panel_url+newPage+'.php')){
			$("#main_page_data").removeClass('page-not-found');
			$.get(notify_panel_url+newPage+'.php', function(pageData) {
				history.replaceState({}, "title", newPage);
				var splitPath = window.location.pathname.split('/'); 
				CURRENT_PAGE = splitPath[splitPath.length-1];
				var delay = 0;
				$('#status').fadeOut();
				$('#preloader').delay(delay).fadeOut('slow');
				setTimeout(() => {
				
					$("#main_page_data").html(pageData);
					if(rightIndex != -1 && !isAdmin){
						editright = Urights[rightIndex].editright;
						deleteright = Urights[rightIndex].deleteright;
						addright = Urights[rightIndex].addright;
						if(Urights[rightIndex].addright != 1){
							$("#addBtn").remove();
						}
					}

					var page_name = CURRENT_PAGE.replace("_"," ").replace("manage"," ").replace(/(?:^|\s)\w/g, function(match) {
						return match.toUpperCase();
					});
					$('title').html('Admin Panel: '+page_name);
					$(".page-name").html(page_name);
					FORMNAME = CURRENT_PAGE+'_form';
					CURRENT_DATA = [];
					editor = [];
					myDropzone = [];
					if($.inArray(newPage, load_pages) === -1)
					{
						load_pages.push(newPage);
					}

					changeView('details');
					$("[scripttype='pageScript']").remove();
					var script = document.createElement('script');
					var prior = document.getElementsByTagName('script')[0];
					script.async = 1;

					script.onload = script.onreadystatechange = function( _, isAbort ) {
						if(isAbort || !script.readyState || /loaded|complete/.test(script.readyState) ) {
							script.onload = script.onreadystatechange = null;
							script = undefined;
							// if(!isAbort && callback) setTimeout(callback, 0);
						}
					};

					script.src = notify_panel_url+'js/'+newPage+'.js';
					script.setAttribute('scripttype',"pageScript");
					prior.parentNode.insertBefore(script, prior);
					apply_after_page_load();
					
					if(newPage == 'manage_dashboard' || newPage == 'manage_setting'){
						$(".topbar-menu .action-btn").addClass('d-none');
					}else{
						$(".topbar-menu .action-btn").removeClass('d-none');
					}
					$(".side-nav a").each(function () {
						$(this).removeClass("active");
						$(this).parent().removeClass("menuitem-active");
						$(this).parent().parent().parent().removeClass("show");
						$(this).parent().parent().parent().parent().removeClass("menuitem-active"); // add active to li of the current link

						var firstLevelParent = $(this).parent().parent().parent().parent().parent().parent();
						if (firstLevelParent.attr('id') !== 'sidebar-menu') firstLevelParent.removeClass("show");

						$(this).parent().parent().parent().parent().parent().parent().parent().removeClass("menuitem-active");

						var secondLevelParent = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent();
						if (secondLevelParent.attr('id') !== 'wrapper') secondLevelParent.removeClass("show");

						var upperLevelParent = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent();
						if (!upperLevelParent.is('body')) upperLevelParent.removeClass("menuitem-active");
					});

					$(".side-nav a[data-name='"+newPage+"']").addClass("active");
					$(".side-nav a[data-name='"+newPage+"']").parent().addClass("menuitem-active");
					$(".side-nav a[data-name='"+newPage+"']").parent().parent().parent().addClass("show");
					$(".side-nav a[data-name='"+newPage+"']").parent().parent().parent().parent().addClass("menuitem-active"); // add active to li of the current link

					var firstLevelParent = $(".side-nav a[data-name='"+newPage+"']").parent().parent().parent().parent().parent().parent();
					if (firstLevelParent.attr('id') !== 'sidebar-menu') firstLevelParent.addClass("show");

					$(".side-nav a[data-name='"+newPage+"']").parent().parent().parent().parent().parent().parent().parent().addClass("menuitem-active");

					var secondLevelParent = $(".side-nav a[data-name='"+newPage+"']").parent().parent().parent().parent().parent().parent().parent().parent().parent();
					if (secondLevelParent.attr('id') !== 'wrapper') secondLevelParent.addClass("show");

					var upperLevelParent = $(".side-nav a[data-name='"+newPage+"']").parent().parent().parent().parent().parent().parent().parent().parent().parent().parent();
					if (!upperLevelParent.is('body')) upperLevelParent.addClass("menuitem-active");
				}, delay);
			}, 'text');
		}
		else{
			$("#main_page_data").html('<image src="'+notify_panel_url+'assets/images/not_found.png" />');
			$("#main_page_data").addClass('page-not-found');
			// $("#main_page_data").html('<div class="page-not-found"><h1 class="page-not-found-header">Page Not Found!</h1></div>');
		}
	}
</script>
</div>
</body>

</html>