<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Edit Guide"; //Set the browser title
$highlight = "adm_edit_guide"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>
  
  <script type="text/javascript">
    var guide_id = <?php echo(json_encode($_GET['guide_id'])); ?>;
    var elt;

    $( document ).ready(function() {
      //Load the guide content
      $.ajax({
      type: "POST",
      url: 'api/admin/guides/get_guide.php',
      data: {
        guide_id: guide_id
      },
      dataType: 'JSON',
      success: function(data) {
        if (data.result == "SUCCESS") {
          $('#guide_name').val(data.guide_data.guide_name);
          $('#subscription_level').val(data.guide_data.subscription_level);
          $('#summernote').summernote(
            'code', data.guide_data.content
          );
        }else{
            Swal.fire({
              title: "Error",
              html: data.message
            });
            return;
        }
      }
      });

      //Get a list of all possible tags
      $.ajax({
          type: "POST",
          url: 'api/admin/guides/get_all_tags.php',
          dataType: 'JSON',
          success: function(data) {
              if (data.result == "SUCCESS") {
                  $.each(data.data, function( index, value ) {
                      $('#existing_tag_selector').append($("<option></option>").attr("value",index).text(value));
                  });
              }else{
                  Swal.fire({
                      title: "Error",
                      html: data.message
                  });
                  return;
              }
            }
        });

        //Get a list of tags associated with this guide
        var elt = $('input');
        $.ajax({
            type: "POST",
            url: 'api/admin/guides/get_tags.php',
            dataType: 'JSON',
            data: {
                guide_id: guide_id
            },
            success: function(data) {
                if (data.result == "SUCCESS") {
                    $.each(data.data, function( index, value ) {
                        $('#tags').tagsinput('add', value);
                    });
                }else{
                    Swal.fire({
                        title: "Error",
                        html: data.message
                    });
                    return;
                }
            }
        });

      //Save guide content
      $( "#saveBtn" ).click(function() {
          //Save guide content
          $.ajax({
              type: "POST",
              url: 'api/admin/guides/edit_guide.php',
              data: {
                  guide_id: guide_id,
                  guide_name: $('#guide_name').val(),
                  subscription_level: $('#subscription_level').val(),
                  content: $('#summernote').summernote('code')
              },
              dataType: 'JSON',
              success: function(data) {
                  if (data.result == "SUCCESS") {
                      Swal.fire({
                          title: "Success",
                          html: data.message
                      });
                  }else{
                      Swal.fire({
                          title: "Error",
                          html: data.message
                      });
                  }
              }
          });
      });

        //Add tag button
        $('#addSelectTagBtn').click(function(){
            $('#tags').tagsinput('add', $('#existing_tag_selector option:selected').text());
        });

        //Save Tags Btn
        $('#saveTagsBtn').click(function(){
            //Save tag list
            $.ajax({
                type: "POST",
                url: 'api/admin/guides/set_tags.php',
                data: {
                    guide_id: guide_id,
                    tags: $("#tags").tagsinput('items')
                },
                dataType: 'JSON',
                success: function(data) {
                    Swal.fire({
                        title: "Success",
                        html: data.message
                    });
                }
            });
        });

     });



  </script>

  <!-- SweetAlert -->
  <link rel="stylesheet" href="AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <script src="AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- summernote -->
  <link rel="stylesheet" href="AdminLTE/plugins/summernote/summernote-bs4.css">
  <!--  bootstrap-tagsinput-->
  <script src="dist/js/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
  <link rel="stylesheet" href="dist/js/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Guide</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Guide</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Edit Guide Content</h5>
              </div>
              <div class="card-body">
                <!-- Place page content here -->

                <div class="form-group">
                    <label>Guide Name</label>
                    <input type="text" class="form-control" id="guide_name" placeholder="Enter Guide Name...">
                </div>

                  <div class="form-group">
                  <label>Select</label>
                  <select id="subscription_level" class="form-control">
                    <option value="WELCOME">WELCOME</option>
                    <option value="BEGINNER">BEGINNER</option>
                    <option value="PERSONAL">PERSONAL</option>
                    <option value="INTERMEDIATE">INTERMEDIATE</option>
                    <option value="ADVANCED">ADVANCED</option>
                  </select>
                </div>

                <label>Guide Content</label>
                <div class="mb-3">
                  <textarea class="textarea" id="summernote" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                  </textarea>
                </div>

                <button type="button" id="saveBtn" class="btn btn-block bg-gradient-info">Save Guide Content</button>




              </div>
            </div>

          <div class="card card-primary card-outline">
              <div class="card-header">
                  <h5 class="m-0">Manage Tags</h5>
              </div>
              <div class="card-body">
                  <div class="form-group">

                      <label>Select Existing Tags</label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <button id="addSelectTagBtn" class="btn btn-info" type="button">Add Tag</button>
                          </div>
                          <select class="custom-select" id="existing_tag_selector">
                          </select>
                      </div>


                      <label>Tag List (Comma Seperated)</label>
                      <div class="form-group">
                          <input type="text" value="" data-role="tagsinput" id="tags">
                      </div>
                  </div>
                  <button type="button" id="saveTagsBtn" class="btn btn-block bg-gradient-info">Save Tags</button>
              </div>
          </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- Summernote -->
<script src="AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<script>
</script>


<?php include('structure/bottom.php'); ?>