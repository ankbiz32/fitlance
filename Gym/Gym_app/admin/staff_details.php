<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
</style>
  <div class="table-responsive">
  <h4 class="hed">Staff Details</h4>
  <div class="col-sm-12" style="padding-bottom: 15px;"><form method="post" action="export_staff.php"><input type="submit" name="export" class="btn btn-sm btn-danger pull-right" value="Export To Excel" /></form><a href="?vis=staff_entry" class="btn btn-sm btn-info pull-right">Add Staff</a></div>
  <hr />
  <table class="table table-bordered datatable" id="table-1">
    <thead>
      <tr>
        <th>S.No.</th>
        <th>Name / Staff ID</th>
        <th>Email / Join Date </th>
        <th>Address / Contact</th>
        <th>Designation </th>
        <th>Insert By</th>
        <th style="width: 200px !important;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query  = "select * from staff_data where is_active='1' ORDER BY id DESC";
      $result = mysqli_query($con, $query);
      $sno    = 1;
      if (mysqli_affected_rows($con) != 0) {
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $id = $row['insert_by'];

            $query2 = "select * from auth_user WHERE id='$id'";
            $result2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_assoc($result2);

            $idd = $row['designation'];
            $query3 = "select * from designation WHERE id='$idd'";
            $result3 = mysqli_query($con, $query3);
            $row3 = mysqli_fetch_assoc($result3);

            $stafid = $row['staffid'];
            $date1 = date('d-m-Y',strtotime( $row['date'] ));
            
              echo "<tr><td>" . $sno . "</td>";
              echo "<td>" . $row['name'] . " / " . $stafid . "</td>";
              echo "<td>" . $row['email'] . " / " . $date1 . "</td>";
              echo "<td>" . $row['address'] . " / " . $row['mobile'] . "</td>";
              echo "<td>" . $row3['name'] ."</td>";
              echo "<td>" . $row2['name'] . "</td>";
              
              echo "<td><form action='index.php?vis=read_staff' method='post'><input type='hidden' name='name' value='" . $stafid . "'/><input type='submit' value='View History ' class='btn btn-info btn-sm pull-left'/></form><form action='index.php?vis=edit_staff' method='post'><input type='hidden' name='name' value='" . $stafid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form><form action='del_staff.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $stafid . "'/><input type='submit' value='Delete ' class='btn btn-danger btn-sm pull-left'/></form></td></tr>";
            $sno++;
            $stafid = 0;
          }
      }
      ?>									
    </tbody>
  </table>
  </div>
  <script type="text/javascript">
  jQuery(document).ready(function($)
  {
  $("#table-1").dataTable({
  "sPaginationType": "bootstrap",
  "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
  "bStateSave": true
  });
  $(".dataTables_wrapper select").select2({
  minimumResultsForSearch: -1
  });
  });
  </script>
  <link rel="stylesheet" href="../../vishnu/js/select2/select2-bootstrap.css"  id="style-resource-1">
  <link rel="stylesheet" href="../../vishnu/js/select2/select2.css"  id="style-resource-2">
  <script src="../../vishnu/js/jquery.dataTables.min.js" id="script-resource-7"></script>
  <script src="../../vishnu/js/dataTables.bootstrap.js" id="script-resource-8"></script>
  <script src="../../vishnu/js/select2/select2.min.js" id="script-resource-9"></script>
