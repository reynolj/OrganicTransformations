<?php
require("structure/top.php"); //Include the sidebar HTML

try {
  //Create connection
  $con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

  //Authenticate user
  $stmt = $con->prepare("SELECT plan_id, plan_name FROM plans WHERE UPPER(plan_name) = 'PERSONAL'");
  $stmt->execute();
  $premium_data = $stmt->fetch();

  if(!$premium_data){
    die("Something went wrong. Couldn't get plan information");
  }
} catch(PDOException $e) {
  die("Sorry, something went wrong. Try again later.");
  // die( "Failed to add break - " . $e->getMessage());
}
?>

<head>
  <script type="text/javascript">
      function hideModal(){
          $("#modal-danger").removeClass("in");
          $(".modal-backdrop").remove();
          $("#modal-danger").hide();
      }
  </script>

  <html>
    <div class="modal fade show" id="modal-danger" aria-modal="true" style="padding-right: 17px; display: block;">
      <div class="modal-dialog">
        <div class="modal-content bg-danger">
          <div class="modal-header">
            <h4 class="modal-title">Cannot access page</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span>Upgrade your plan to "<?php echo $premium_data['plan_name']?>" to access this page.</span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal" onclick = window.location.replace("my_plan.php")>Ok</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </html>
</head>



