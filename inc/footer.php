<!-- Footer -->
		<footer id="footer">
			<!-- container -->
			
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="index" class="logo" style="width:70px"><img src="./assets/img/wlogo.png" alt=""></a>
							</div>
							<ul class="footer-nav">
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Advertisement</a></li>
							</ul>
							<div class="footer-copyright">
								<span>&copy; <script>document.write(new Date().getFullYear());</script>. All rights reserved. </span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">About Us</h3>
									<ul class="footer-links">
										<li><a href="about">About Us</a></li>
										<!-- <li><a href="blank">Join Us</a></li> -->
										<li><a href="contact">Contacts</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">Catagories</h3>
									<ul class="footer-links">
										<?php 
											$Category = new category();
											$categories = $Category->getAllCategory();
											//debugger($categories);
											foreach ($categories as $key => $category) {
										?>
										<li><a href="category?id=<?php echo $category->id ?>"><?php echo $category->categoryname; ?></a></li>
										<?php
											}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Join our Newsletter</h3>
							<div class="footer-newsletter">
								<form>
									<input class="input" type="email" name="newsletter" placeholder="Enter your email">
									<button class="newsletter-btn"><i class="fa fa-paper-plane"></i></button>
								</form>
							</div>
									<?php
									//debugger($followuss);
										if ($followuss) {
											foreach ($followuss as $key => $followus) {
									?>				
										<a href="<?php echo $followus->url ?>"><i class="<?php echo $followus->iconname ?>" style="width: 20px"></i></a>
									<?php			
											}
										}
									?>
								
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /Footer -->

		<!-- jQuery Plugins -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script type="text/javascript">
			$('#load').click(function(){	
				$('#loadedcontent').removeClass('hidden');
				$('#load').removeClass('primary-button').removeClass('center-block').addClass('hidden');
			});
		</script>

	</body>
</html>