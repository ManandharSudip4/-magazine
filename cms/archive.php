
<?php
$header = "Archive"; 
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
                <h3>Archive</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Archives</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class="btn btn-primary" onclick="addArchive()">Add Archive</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                        <thead >
                          <th style="text-align: center">S.N</th>
                          <th style="text-align: center">Archive Name</th>
                          <th style="text-align: center">Year</th>
                          <th style="text-align: center">Month</th>
                          <th style="text-align: center">Day</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Archive = new archive();
                          $archives = $Archive->getAllArchive();
                          // debugger($archives);
                          if ($archives) {
                            foreach ($archives as $key => $archive) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo date("M d, Y",strtotime($archive->date));?></td>
                            <td><?php echo date("Y",strtotime($archive->date));?></td>
                            <td><?php echo date("M",strtotime($archive->date));?></td>
                            <td><?php echo date("d",strtotime($archive->date));?></td>
                            <td>
                              <a href="javascript:;" class="btn btn-info" onclick="editArchive(this);" data-archive_info='<?php echo(json_encode($archive))?>'>
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/archive?id=<?php echo($archive->id)?>&amp;act=<?php echo substr(md5("Delete-Archive-".$archive->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this archive?');">
                                <i class="fa fa-trash"></i>
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
                              <h4 class="modal-title" id="title">Add Archive</h4>
                            </div>
                            <form action="process/archive.php" method="post" id="formy">
                              <div class="modal-body">
                                <div class="form-group" id="#ed">
                                    <label for="">Archive Date</label>
                                    <input type="date" class="form-control" name="date" id="date" placeholder="date" required="">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" id="id" name="id">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="sumbit" class="btn btn-primary">Save changes</button>
                              </div>                
                            </form>
        
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

  function addArchive(){
    $('#ed').addClass('form-group');
    $('#title').html('Add Archive');
    $('#date').val("");
    $('#id').removeAttr('value');
    showModal();
  }

  function editArchive(element){
    var archive_info = $(element).data('archive_info');
    if (typeof(archive_info) != 'object'){
      archive_info = JSON.parse(archive_info);
    }
    // console.log(archive_info);

    $('#title').html('Edit Archive');
    $('#date').val(archive_info.date);
    $('#id').val(archive_info.id)
    showModal();  
  }

  function showModal(){
    $('.modal').modal();
  }

</script>