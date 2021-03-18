<?php
if (isset($_POST['name'])) {
    $id = $_POST['name'];
?>
<h3>Edit Plan Details</h3>
<hr />
    <form action="submit_viewhealth_edit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
    <?php
        $query  = "select * from healthstatus WHERE id='$id'";
        //echo $query;
        $result = mysqli_query($con, $query);
        $sno    = 1;
        if (mysqli_affected_rows($con) == 1) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $id    = $row['id'];
                $name    = $row['name'];
                $date1    = $row['date1'];
                $bodyfat = $row['bodyfat'];
                $water = $row['water'];
                $muscle = $row['muscle'];
                $calorie = $row['calorie'];
                $bone = $row['bone'];
                $remarks = $row['remarks'];
            }
        }
    ?>
        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">ID :</label>					
                <div class="col-sm-5">
                    <input type="text" name="id" value="<?php echo $id; ?>" class="form-control" readonly/>
                </div>
        </div>

        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Name :</label>					
                <div class="col-sm-5">
                    <input type="text" name="name" id="name" class="form-control" value ='<?php echo $name; ?>' placeholder="Name" >
                </div>
        </div>


        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Date :</label>					
                <div class="col-sm-5">
                    <input type="text" name="date1"  id="date1" class="form-control" value ='<?php echo $date1; ?>'  placeholder="Date" readonly>
                </div>
        </div>

        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Body Fat :</label>					
                <div class="col-sm-5">
                    <input type="text" name="bodyfat" id="bodyfat" class="form-control" placeholder="Body Fat" value ='<?php echo $bodyfat; ?>' >
                </div>
        </div>										


        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Water :</label>					
                <div class="col-sm-5">
                    <input type="text" name="water" id="water" class="form-control" placeholder="Water" value ='<?php echo $water; ?>'>
                </div>
        </div>


        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Muscle :</label>					
                <div class="col-sm-5">
                    <input type="text" name="muscle" id="muscle" class="form-control" placeholder="Muscle" value ='<?php echo $muscle; ?>' >
                </div>
        </div>

        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Calorie :</label>					
                <div class="col-sm-5">
                    <input type="text" name="calorie" id="calorie" class="form-control" placeholder="Calorie" value ='<?php echo $calorie; ?>'>
                </div>
        </div>	

        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Bone :</label>					
                <div class="col-sm-5">
                    <input type="text" name="bone" id="bone" class="form-control" placeholder="Bone" value ='<?php echo $bone; ?>' >
                </div>
        </div>																

        <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Remarks :</label>					
                <div class="col-sm-5">
                    <input type="text" name="remarks" id="remarks" class="form-control" placeholder="Remarks" value ='<?php echo $remarks; ?>'>
                </div>
        </div>	


        <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="submit" class="btn btn-primary">Save changes</button>	
                </div>
        </div>	
									
</form>

			

<?php
} else {
    echo "<meta http-equiv='refresh' content='0; url=?vis=view_health'>";
}
?>

