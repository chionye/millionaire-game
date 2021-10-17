<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; DnDChallenge 2019</span>
		</div>
	</div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Are you sure you want to logout?</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="logout.php">Logout</a>
			</div>
		</div>
	</div>
</div>
<?php $img = $user->picture != null ?$user->picture:'images/profile.png';?>
<!-- Bootstrap core JavaScript-->
<script src="x/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script src="js/dili.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/game.js"></script>
<script type="text/javascript">
	var current = document.URL.split('/');
		var len = current.length;
		if(current[len-1] == "profile.php"){
	var el = document.getElementById('resizer-demo');
		var resize = new Croppie(el, {
			viewport: { width: 100, height: 100, type:'circle' },
			boundary: { width: 300, height: 300 },
			showZoomer: true,
			enableResize: true,
			enableOrientation: true,
			mouseWheelZoom: 'ctrl'
		});
		resize.bind({
			url: '<?=$img?>',
		});
		jQuery(document).on('click', '#submitPic', function(event) {
		resize.result({
				type:'blob',
				size:{width:350,height:350},
				format:'png',
				quality:1,
				circle:false
			})
		.then((blob)=>{
			var form = new FormData(document.getElementById('formSub'));
			form.append('image', blob);
			jQuery.ajax({
				url: "upload.php",
				type: "POST",
				data: form,
				contentType: false,
				processData:false,
				beforeSend:function(){$('#submitPic').html('uploading...'); document.getElementById('submitPic').disabled = true;},
				success: function(data){
					if (jQuery.trim(data) == 'ok') {
						swal('Nice!','Picture Updated Successfully', 'success');
						$('#submitPic').html('submit');
						document.getElementById('submitPic').disabled = false;
					}else{
						swal('sorry',data, 'error');
					}
				} 	        
			});
		})
	});
	}
			function showPreview(objFileInput) {
			if (objFileInput.files[0]) {
				var fileReader = new FileReader();
				fileReader.onload = function (e) {
					resize.bind({
						url: e.target.result,
					});
				}
				fileReader.readAsDataURL(objFileInput.files[0]);
			}
		}
		jQuery(document).ready(function($) {
			jQuery(document).on('click', '#checkForImages', function(event) {
				if('<?=$img?>' == null || '<?=$img?>' == '' || '<?=$img?>' == 'images/profile.png'){
					swal('hold your horses!', "Why not put up your picture in your profile first", "error");
				}else{
					window.location.href = "start.php";
				}
			});
		});	 
		</script>
		<script src="x/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Core plugin JavaScript-->
		<script src="x/vendor/jquery-easing/jquery.easing.min.js"></script>
		<!-- Custom scripts for all pages-->
		<script src="x/js/sb-admin-2.min.js"></script>
		<!-- Page level plugins -->
		<script src="x/vendor/chart.js/Chart.min.js"></script>
		<!-- Page level custom scripts -->
		<script src="x/js/demo/chart-area-demo.js"></script>
		<script src="x/js/demo/chart-pie-demo.js"></script>
	</body>
	</html>