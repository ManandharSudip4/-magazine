<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$bread = 'Blank';
	include 'inc/header.php';
?>
	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<?php 
						//debugger($_POST); 
						if (isset($_POST) && !empty($_POST)){
							$data = array(
								'search' => sanitize(htmlentities($_POST['search']))
							);
						$search = $_POST['search'];
						//debugger($search);
						}else{
							redirect('index','success','No Results Found');
						}
					?>
						<h3>Showing Search Result</h3>
						<form class="search-form" method="post" action="search">
								<input class="search-input" type="text" name="search" value="<?php  echo isset($search)?$search:"" ?>">
								<button class="search-close" type="submit"><i class="fa fa-search"></i></button>
						</form>
					<?php
						$count = 0;
						$Blog = new blog();
						$blogscount = $Blog->getBlogCountbySearch($search);
						// debugger($blogscount);
					?>
					<div>
						<h4><?php echo $blogscount[0]->total ?> results for <?php echo isset($search)?$search:""; ?></h4>
					</div>
					<?php
					function show($search,$o,$n){
						$Blog = new blog();    
						$blogs = $Blog->getBlogbySearch($search,$o,$n);
						//debugger($blogs);
						if (isset($search) && !empty($search)) {
							if (isset($blogs) && !empty($blogs)){
								foreach ($blogs as $key => $blog) {
									if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)) {
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
										}
					?>
						<div class="post post-widget">
							<a class="post-img" href="blog-post?id=<?php echo $blog->id ;?>"><img src="<?php echo $thumbnail ?>" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ;?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>
					<?php
								}
							}else{
								echo "";
							}
							}else{
						redirect('search');	
						}
					}
						show($search,0,5);
					?>
					<span class="hidden" id="loadedcontent">
						<?php show($search,5,5); ?>
					</span>
					<div class="col-md-12">
						<div class="section-row">
							<button class="primary-button center-block" id="load" ><a href="#loadedcontent" style="color: white"> Show More</a></button>
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
						<!-- <div class="section-title">
							<h2>Most Read</h2>
						</div> -->

						<!-- <div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-1.jpg" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
							</div>
						</div>

						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-2.jpg" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post.html">Pagedraw UI Builder Turns Your Website Design Mockup Into Code Automatically</a></h3>
							</div>
						</div>

						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-3.jpg" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post.html">Why Node.js Is The Coolest Kid On The Backend Development Block!</a></h3>
							</div>
						</div>

						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-4.jpg" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
							</div>
						</div> -->
					</div>
					<!-- /post widget -->
				</div>
				<!-- /aside -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->


		<?php include 'inc/footer.php'; ?>
