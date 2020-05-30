
<?php
$header = "Category"; 
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
                <h3>Category</h3>
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
                    <h2>List of Categories</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class="btn btn-primary" onclick="addCategory()">Add Category</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                        <thead >
                          <th style="text-align: center">S.N</th>
                          <th style="text-align: center">Category Name</th>
                          <th style="text-align: center">Description</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Category = new category();
                          $categories = $Category->getAllCategory();
                          // debugger($categories);
                          if ($categories) {
                            foreach ($categories as $key => $category) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $category->categoryname;?></td>
                            <td><?php echo html_entity_decode($category->description);?></td>
                            <td>
                              <a href="javascript:;" class="btn btn-info" onclick="editCategory(this);" data-category_info='<?php echo(json_encode($category))?>'>
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/category?id=<?php echo($category->id)?>&amp;act=<?php echo substr(md5("Delete-Category-".$category->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">
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
                      
                      <div class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h4 class="modal-title" id="title">Add Category</h4>
                            </div>
                            <form action="process/category.php" method="post" id="formy">
                              <div class="modal-body">
                                <div class="form-group" id="#ed">
                                    <label for="">Category Name</label>
                                    <input type="text" class="form-control" name="categoryname" id="categoryname" placeholder="categoryname" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Category Description</label>
                                    <textarea class="form-control" id="description" name="description" required="" cols="30" rows="10"> </textarea>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" id="id" name="id">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="sumbit" class="btn btn-primary">Save changes</button>
                              </div>                
                            </form>
                            <table id="datable" class="table table-striped table-bordered" style="text-align: center">
                              <thead >
                                <th style="text-align: center">S.N</th>
                                <th style="text-align: center">Category Name</th>
                                <th style="text-align: center">Description</th>
                                <th style="text-align: center">Date</th>
                              </thead>
                              <tbody>
                                <?php $Categor = new category();
                                $categories = $Categor->getAllCategory();
                                // debugger($categories);
                                if ($categories) {
                                  foreach ($categories as $key => $category) {
                                ?>
                                <tr>
                                  <td><?php echo $key+1; ?></td>
                                  <td><?php echo $category->categoryname;?></td>
                                  <td><?php echo html_entity_decode($category->description);?></td>
                                  <td><?php echo $category->updated_date; ?></td>
                                </tr>           
                                <?php
                                  }
                                }
                                ?>
                              </tbody>
                            </table>
        
                        </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
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
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
<script src="assets/js/datatable.js"></script>
<script type="text/javascript">

  function addCategory(){
    $('#ed').addClass('form-group');
    $('#title').html('Add Category');
    $('#categoryname').val("");
    $('#id').removeAttr('value');
    document.getElementById('formy').style.display='block';
    document.getElementById('datable').style.display='none';
    showModal();
  }

  function editCategory(element){
    var category_info = $(element).data('category_info');

    if (typeof(category_info) != 'object'){
      category_info = JSON.parse(category_info);
    }
    // console.log(category_info);

    $('#title').html('Edit Category');
    $('#categoryname').val(category_info.categoryname);
    $('#id').val(category_info.id)
    document.getElementById('formy').style.display='block';
    document.getElementById('datable').style.display='none';
    showModal(category_info.description);  
  }

  function editHistory(){
    $('#title').html('Edit History');
    document.getElementById('formy').style.display='none';
    document.getElementById('datable').style.display='block';
    showModal();
  }


  function showModal(data=""){
    ckeditor(data);
    $('.modal').modal();
  }

  function showModal2(){
    $()
  }

  function ckeditor(data=""){
    $('.ck').remove();
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .then( editor => {
        editor.setData(data);
    } )
    .catch( error => {
        console.error( error );
    } );
  }
</script>