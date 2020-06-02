
<?php
$header = "Blog"; 
    include 'inc/header.php';
    include 'inc/checklogin.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php
                flashMessage();
            ?>
            <div class="page-title">
              <div class="title_left">               
                <h3>Blog</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Blogs</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="addblog" class="btn btn-primary">Add Blog</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: justify;">
                        <thead >
                          <th style="text-align: justify;">S.N</th>
                          <th style="text-align: center">Blog Title</th>
                          <th style="text-align: center">Content</th>
                          <th style="text-align: center">Featured</th>
                          <th style="text-align: center">Category</th>
                          <th style="text-align: center">View</th>
                          <th style="text-align: center">Image</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Blog = new blog();
                          $blogs = $Blog->getAllBlog();
                          // debugger($blogs);
                          if ($blogs) {
                            foreach ($blogs as $key => $blog) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $blog->title;?></td>
                            <td><?php echo html_entity_decode($blog->content);?></td>
                            <td><?php echo $blog->featured;?></td>
                            <td><?php echo $blog->category;?></td>
                            <td><?php echo (isset($blog->view) && !empty($blog->view))?  6ybhuimko,lp.;[/']|
                            $blog->view:"0";?></td>
                            <?php
                                if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH."blog/".$blog->image)){
                                  $thumbnail = UPLOAD_URL.'blog/'.$blog->image;
                                }else{
                                  $thumbnail = UPLOAD_URL.'noimg.png';
                                }
                            ?>
                            <td><img src="<?php echo($thumbnail) ?>"alt="" style="width: 300px; height: auto"></td>
                            
                            <td>
                              <a href="addblog?id=<?php echo($blog->id)?>&amp;act=<?php echo substr(md5("Edit-Blog-".$blog->id.$_SESSION['token']), 3,15) ?>" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/blog?id=<?php echo($blog->id)?>&amp;act=<?php echo substr(md5("Delete-Blog-".$blog->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?');">
                                <i class="fa fa-trash"></i>
                              </a>
                              <a href="javascript:;" class="btn btn-default" onclick="editHistory()">
                                <i class="fa fa-history" id="his"></i>
                              </a>
                            </td>
                          </tr>           
                          <?php
                            }
                          }
                          ?>
                        </tbody>
                      </table>                     
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php 
    include 'inc/footer.php';
?>

<script src="assets/js/datatable.js"></script>

  