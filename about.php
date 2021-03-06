<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$bread = 'About Us';
	include 'inc/header.php';
?>
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="section-row">
							<p>We try to provide 100% authentic news ASAP. Here we provide recent news of Europe's Top 5 Leagues. From the player's transfer rumors to contract renewal, pre match analysis to post match analysis, we try to share everything.</p>
							<figure class="figure-img">
								<img class="img-responsive" src="./assets/img/bundes.jpg" alt="">
							</figure>
							<p>We try to provide 100% authentic news ASAP. Here we provide recent news of Europe's Top 5 Leagues. From the player's transfer rumors to contract renewal, pre match analysis to post match analysis, we try to share everything.</p>
						</div>
						<div class="row section-row">
							<div class="col-md-6">
								<figure class="figure-img">
									<img class="img-responsive" src="./assets/img/about-2.jpg" alt="">
								</figure>
							</div>
							<div class="col-md-6">
								<h3>Our Mission</h3>
								<p></p>
								<ul class="list-style">
									<li><p>Provide 100% authentic news ASAP.</p></li>
									<li><p>Mission 2....</p></li>
									<li><p>Mission 3....</p></li>
								</ul>
							</div>
						</div>
					</div>
					
					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						<?php
							$ADS = new advertisement();
							$ads = $ADS->getAdvertisementbyType('simple');
							//debugger($ads);
							if (isset($ads[0]->image) && !empty($ads[0]->image) && file_exists(UPLOAD_PATH.'advertisement/'.$ads[0]->image)) {
													$thumbnail = UPLOAD_URL.'advertisement/'.$ads[0]->image;
												}else{
													$thumbnail = UPLOAD_URL.'noimg.png';
												}

						?>
						<div class="aside-widget text-center">
							<a class="post-img" href="<?php echo $ads[0]->url ?>" style="display: inline-block;margin: auto;">
								<img  class="img-responsive" src="<?php echo $thumbnail ?>" alt="">
							</a>
							<div class="post-body">
									<h3 class="post-title"><a href="<?php echo $ads[0]->url ?>"><?php echo $ads[0]->caption; ?></a></h3>
							</div>	
						</div>
						<!-- /ad -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
								<?php   
										$popularBlog = $Blog->getAllPopularBlogWithLimit(0,4);
										//debugger($popularBlog);	
										if ($popularBlog) {
											foreach ($popularBlog as $key => $blog) {
												if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)) {
													$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
												}else{
													$thumbnail = UPLOAD_URL.'noimg.png';
												}
								?>
													<div class="post post-widget">
														<a class="post-img" href="blog-post?id=<?php echo $blog->id ;?>"><img src="<?php echo($thumbnail)?>" alt=""></a>
														<div class="post-body">
															<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ;?>"><?php echo $blog->title ;?></a></h3>
														</div>
													</div>
								<?php
											}
										}
								?>

						</div>
						<!-- /post widget -->
						<!-- tags -->
						<div class="aside-widget">
							<div class="tags-widget">
								<ul>
									<?php
										$Category = new category();
										$categories = $Category->getAllCategory();
										if($categories){
											foreach ($categories as $key => $category) {
									?>
												<li><a href="category?id=<?php echo $category->id ?>"><?php echo $category->categoryname?></a></li>
									<?php	
											}
										}
									?>
								</ul>
							</div>
						</div>
						<!-- /tags -->
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<?php include 'inc/footer.php'; ?>
