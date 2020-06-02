<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	//$bread = 'Contact';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$blog_id = (int)$_GET['id'];
		if($blog_id){
			$Blog = new blog();
			$blog_info = $Blog->getBlogbyId($blog_id);
			if ($blog_info) {
				$blog_info = $blog_info[0];
				$bread = $blog_info->blogname ;
				$data = array(
					'view' => $blog_info->view + 1
				);
				$Blog->updateBlogbyId($data,$blog_id);
			}else{
				redirect('index');
			}
		}else{
			redirect('index');
		}
		}else{redirect('index');
	}
	include 'inc/header.php';
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								<h3> <?php echo $blog_info->title; ?></h3>
								<?php  echo html_entity_decode($blog_info->content);
										if (isset($blog_info->image) && !empty($blog_info->image) && file_exists(UPLOAD_PATH.'blog/'.$blog_info->image)) {
											$thumbnail = UPLOAD_URL.'blog/'.$blog_info->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
										}
								?>
								<figure class="figure-img">
									<img class="img-responsive" src="<?php echo $thumbnail ?>" alt="">
									<figcaption>Caption Here<figcaption>
								</figure>
								<blockquote class="blockquote">
									I’ve heard the argument that “lorem ipsum” is effective in wireframing or design because it helps people focus on the actual layout, or color scheme, or whatever. What kills me here is that we’re talking about creating a user experience that will (whether we like it or not) be DRIVEN by words. The entire structure of the page or app flow is FOR THE WORDS.
								</blockquote>
							</div>
							<div class="post-shares sticky-shares">
								<a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
								<a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>
							</div>
						</div>

						<!-- ad -->
						<div class="section-row text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./assets/img/ad-2.jpg" alt="">
							</a>
						</div>
						<!-- ad -->
						
						<!-- author -->
						<div class="section-row">
							<div class="post-author">
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/author.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h3>John Doe</h3>
										</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										<ul class="author-social">
											<li><a href="#"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- /author -->

						<!-- comments -->
						<div class="section-row">
							<div class="section-title">
								<h2>
									<?php
									$Comment = new comment();
									$Count=$Comment->getNumberCommentByBlog($blog_id);
									echo $Count[0]->total; 
									?>
									Comment
								</h2>
							</div>

							<div class="post-comments">
								<?php  $comments = $Comment->getAllAcceptCommentByBlog($blog_id);
										//debugger($comments);
									if ($comments) {
										foreach ($comments as $key => $comment) {
								?>
											<!-- comment -->
											<div class="media">
												<div class="media-left">
													<img class="media-object" src="./assets/img/avatar.png" alt="">
												</div>
												<div class="media-body">
													<div class="media-heading">
														<h4><?php echo $comment->name ?></h4>
														<span class="time"><?php echo date('M d, Y  h:m a ',strtotime($comment->created_date)); ?></span>
														<a href="#ReplySection" class="reply" onclick="reply(this);" data-commentid="<?php echo $comment->id ?>">Reply</a>
													</div>
													<p><?php echo html_entity_decode($comment->message) ?></p>
													<!-- reply -->
													<?php
															$replies = $Comment->getAllAcceptReplyByBlogByComment($blog_id,$comment->id);
															if($replies){
																foreach ($replies as $key => $reply) {
													?>
														<div class="media">
															<div class="media-left">
																<img class="media-object" src="./assets/img/avatar.png" alt="">
															</div>
															<div class="media-body">
																<div class="media-heading">
																	<h4><?php echo $reply->name ?></h4>
																	<span class="time"><?php echo date('M d, Y  h:m a ',strtotime($reply->created_date)); ?></span>
																	<a href="#ReplySection" class="reply" onclick="reply(this);" data-commentid="<?php echo $comment->id ?>">Reply</a>
																</div>
																<p><?php echo html_entity_decode($reply->message) ?></p>
															</div>
														</div>
														
													<?php
																}
															}
													?>
													<!-- reply -->
												</div>
											</div>
											<!-- /comment -->
								<?php
										}
									}
								?>

							</div>
						</div>
						<!-- /comments -->

						<!-- reply -->
						<div class="section-row" id="ReplySection">
							<div class="section-title">
								<h2>Leave a reply</h2>
								<p>your email address will not be published. required fields are marked *</p>
							</div>
							<form class="post-reply" action="process/comment" method="post">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span>Name *</span>
											<input class="input" type="text" name="name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Email *</span>
											<input class="input" type="email" name="email">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Website</span>
											<input class="input" type="text" name="website">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message"></textarea>
										</div>
										<input type="hidden" name="commentid" id="comment" value="">
										<input type="hidden" name="blogid" value="<?php echo($blog_id) ;?>">
										<button class="primary-button" type="submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./assets/img/ad-1.jpg" alt="">
							</a>
						</div>
						<!-- /ad -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>

							<div class="post post-widget">
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
							</div>
						</div>
						<!-- /post widget -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>
							<div class="post post-thumb">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/post-2.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-3" href="#">Jquery</a>
										<span class="post-date">March 27, 2018</span>
									</div>
									<h3 class="post-title"><a href="blog-post.html">Ask HN: Does Anybody Still Use JQuery?</a></h3>
								</div>
							</div>

							<div class="post post-thumb">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/post-1.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-2" href="#">JavaScript</a>
										<span class="post-date">March 27, 2018</span>
									</div>
									<h3 class="post-title"><a href="blog-post.html">Chrome Extension Protects Against JavaScript-Based CPU Side-Channel Attacks</a></h3>
								</div>
							</div>
						</div>
						<!-- /post widget -->
						
						<!-- catagories -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Catagories</h2>
							</div>
							<div class="category-widget">
								<ul>
									<?php //categories from heade
										if ($categories) {
											// debugger($categories);
											foreach ($categories as $key => $category) {
									?>
									<li><a href="#" class="<?php  echo CAT_COLOR[$category->id%4] ?>"><?php echo $category->categoryname; ?>
									<span><?php
										$Count = $Blog->getNumberBlogByCategory($category->id);
										//debugger($Count);
										 echo $Count[0]->total;
									?></span></a></li>
									<?php
											}
										}
									?>
								</ul>
							</div>
						</div>
						<!-- /catagories -->
						
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
						
						<!-- archive -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Archive</h2>
							</div>
							<div class="archive-widget">
								<ul>
									<li><a href="#">January 2018</a></li>
									<li><a href="#">Febuary 2018</a></li>
									<li><a href="#">March 2018</a></li>
								</ul>
							</div>
						</div>
						<!-- /archive -->
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
	
	function reply(element){
		console.log(element);
		var commentid = $(element).data('commentid');
		console.log(commentid);
		$('#comment').val(commentid);
	}
</script>