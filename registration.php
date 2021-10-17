<?php include 'head.php'; ?>
<!-- <div class="toast" data-autohide="false">
			<div class="toast-header">
						<strong class="mr-auto text-primary">Toast Header</strong>
						<small class="text-muted">5 mins ago</small>
						<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
			</div>
			<div class="toast-body">
						Some text inside the toast body
			</div>
		</div> -->
		<?php if (isset($_COOKIE['uid'])) {
			echo "<script>window.location.replace('dashboard.php')</script>";
		}?>
		<img src="images/lof.jpg" width="100%">
		<div class="container">
			<div class="w3_mail_grids dp-2 card shadow mb-5 pb-5 " style="border: none;">
				<ul class="nav nav-tabs shadow p-3">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#home">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#menu1">SignUp</a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content" style="border: none;">
					<div class="tab-pane active container" id="home" style="border: none;">
						<form>
							<div class="container">
								<div class="row">
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-5 mt-4">
										<input class="input__field input__field--jiro" type="email" name="email" placeholder="Your Email Address" required="" id="email" />
										<label class="input__label input__label--jiro">
											<span class="input__label-content input__label-content--jiro">Your Email</span>
										</label>
									</div>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2">
										<input class="input__field input__field--jiro" type="password" name="pass3" placeholder="Phone Number" required="" id="pass3" />
										<label class="input__label input__label--jiro">
											<span class="input__label-content input__label-content--jiro">Password</span>
										</label>
									</div>
								</div>
							</div>
							<input type="submit" value="Submit" onclick="log();return false">
						</form>
					</div>
					<div class="tab-pane container" id="menu1" style="border: none;">
						<form>
							<div class="container flex-row">
								<div class="row">
									<div class="col-11 col-sm-11 col-md-6 col-lg-6 m-3">
										<input class="input__field input__field--jiro" type="text" name="name" placeholder="Your Name" id="name" />
										<label class="input__label input__label--jiro">
											<span class="input__label-content input__label-content--jiro">Your Name</span>
										</label>
									</div>
									<div class="col-11 col-sm-11 col-md-5 col-lg-5 m-3">
										<input class="input__field input__field--jiro" type="text" name="phone" placeholder="Your Name" id="phone"/>
										<label class="input__label input__label--jiro">
											<span class="input__label-content input__label-content--jiro">Your Phone</span>
										</label>
									</div>
									<div class="col-11 col-sm-11 col-md-6 col-lg-6 m-3">
										<input class="input__field input__field--jiro" type="email" name="email" placeholder="Your Email Address" id="email1" />
										<label class="input__label input__label--jiro">
											<span class="input__label-content input__label-content--jiro">Your Email</span>
										</label>
									</div>
									<div class="col-11 col-sm-11 col-md-6 col-lg-5 m-3">
										<input class="input__field input__field--jiro" type="text" name="text" placeholder="Enter referrer ID" id="ref" />
										<label class="input__label input__label--jiro">
											<span class="input__label-content input__label-content--jiro">Referrer ID(optional)</span>
										</label>
									</div>
									<div class="col-11 col-sm-11 col-md-11 col-lg-11 m-3">
										<input class="input__field input__field--jiro" type="password" name="pass1" placeholder="Enter Password" id="pass1" />
										<label class="input__label input__label--jiro">
											<span class="input__label-content input__label-content--jiro">Password</span>
										</label>
									</div>
									<div class="col-11 col-sm-11 col-md-11 col-lg-11 m-3">
										<input class="input__field input__field--jiro" type="password" name="pass2" placeholder="Enter password again" id="pass2" />
										<label class="input__label input__label--jiro">
											<span class="input__label-content input__label-content--jiro">Confirm Password</span>
										</label>
									</div>
								</div>
							</div>
							<input type="submit" value="Submit" onclick="sign();return false;">
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php include 'footer.php'; ?>