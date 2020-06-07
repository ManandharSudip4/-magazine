<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$bread = 'Blank';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$archive_id = (int)$_GET['id'];
		if($archive_id){
			$Archive = new archive();
			$archive_info = $Archive->getArchivebyId($archive_id);
			//debugger($archive_info);
			if ($archive_info) {
				$archive_info = $archive_info[0];
			}else{
				redirect('index');
			}
		}else{
			redirect('index');
		}
		}else{redirect('index');
	}
	$header = "Archive";
	include 'inc/header.php';
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- aside -->
					<div class="col-md-8">
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2><?php echo date("M d, Y",strtotime($archive_info->date)) ?></h2>
							</div>
							<?php
								$Blog = new blog;
								$blogs=$Blog->getBlogbyDate($archive_info->date);
								if ($blogs) {
									foreach ($blogs as $key => $blog) {
								//debugger($blog);
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
								}	
							?>
						</div>
						<!-- /post widget -->
						<!-- ad -->
						<?php
							$ADS = new advertisement();
							$ads = $ADS->getAdvertisementbyType('wide');
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
					</div>
					<div class="col-md-4">
						<!-- ad -->
						<?php
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
								<img class="img-responsive" src="<?php echo $thumbnail ?>" alt="">
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
									<li><a href="#">Add</a></li>
								</ul>
							</div>
						</div>
						<!-- /tags -->
					</div>
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
						


		<?php include 'inc/footer.php'; ?>
