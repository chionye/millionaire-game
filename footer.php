<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="footer-top">
			<div class="row">
				<div class="col-md-4 amet-sed">
					<div class="footer-title">
						<h3>About Us</h3>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				</div>
				<div class="col-md-4 amet-sed amet-medium">
					<div class="footer-title">
						<h3>Twitter Feed</h3>
					</div>
					<p><a href="#">http://example.com</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt lorem sed velit fermentum eget placerat. </p>
					<p><a href="#">http://mail.com</a> Sed tincidunt lorem sed velit fermentum eget placerat. Lorem ipsum dolor sit, consectetur adipiscing elit. </p>
				</div>
				<div class="col-md-4 amet-sed ">
					<div class="footer-title">
						<h3>Follow Us</h3>
					</div>
					<div class="agileinfo-social-grids">
						<ul>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-rss"></i></a></li>
							<li><a href="#"><i class="fa fa-vk"></i></a></li>
						</ul>
					</div>
					<div class="support">
						<form action="#" method="post">
							<input type="email" placeholder="Enter email...." required="">
							<input type="submit" value="Subscribe" class="botton">
						</form>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!-- //footer -->
<!-- copyright -->
<div class="copyright">
	<div class="container">
		<p class="footer-class">© 2017 Games Hub . All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">Me</a> </p>
	</div>
</div>
<!-- //copyright -->
<script src="js/jarallax.js"></script>
<script src="js/bootstnav.js"></script>
<script src="js/dili.js"></script>
<script src="js/SmoothScroll.min.js"></script>
<script type="text/javascript">
	/* init Jarallax */
	$('.jarallax').jarallax({
		speed: 0.5,
		imgWidth: 1366,
		imgHeight: 768
	})
</script>
<script type="text/javascript">
	$(document).ready(function (ev) {
$('#custom_carousel').on('slide.bs.carousel', function (evt) {
$('#custom_carousel .controls li.active').removeClass('active');
$('#custom_carousel .controls li:eq(' + $(evt.relatedTarget).index() + ')').addClass('active');
})
});
</script>
<script src="js/responsiveslides.min.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!-- here stars scrolling icon -->
<script type="text/javascript">
	$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear'
			};
		*/
							
		$().UItoTop({ easingType: 'easeOutQuart' });
							
		});
</script>
<!-- //here ends scrolling icon -->
<!-- Tabs-JavaScript -->
<script src="js/jquery.filterizr.js"></script>
<script src="js/controls.js"></script>
<script type="text/javascript">
	$(function() {
		$('.filtr-container').filterizr();
	});
</script>
<!-- //Tabs-JavaScript -->
<!-- PopUp-Box-JavaScript -->
<script src="js/jquery.chocolat.js"></script>
<script type="text/javascript">
	$(function() {
		$('.filtr-item a').Chocolat();
	});
</script>
<!-- //PopUp-Box-JavaScript -->
</body>
</html>