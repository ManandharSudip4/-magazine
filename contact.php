<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$bread = 'Contact';
	include 'inc/header.php';
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-6">
							<div class="section-row">
								<h3>Developer</h3>
						<div class="col-md-6">
								<a href="#">Manandhar Sudip</a><br>
								<a href="#">Khwopa College Of Engineering</a><br>
								<a>Liwali, Bhaktapur</a><br><br>
						</div>
						<div class="col-md-6" style="align-self: center;">
							<img src="./assets/img/ms-logo-big.jpg" style="width: 70px; align-self:center;" >
						</div>
							</div>

								<!-- <ul class="list-style">
									<br><br><br><br><br><br>
									<li><p><strong>Email:</strong> <a href="#">manandharsudip8@gmail.com</a></p></li>
									<li><p><strong>Phone:</strong> 9812345678</p></li>
									<li><p><strong>Address:</strong> Kwathandau-10, Bhaktapur</p></li>
								</ul> -->
					</div>
					<div class="col-md-5 col-md-offset-1">
						<div class="section-row">
							<h3>Send A Message</h3>
							<form action="process/contact" method="post">
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<span>Email</span>
											<input class="input" type="email" name="email" required="">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message" required=""></textarea>
										</div>
										<button class="primary-button">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		
<?php include 'inc/footer.php'; ?>