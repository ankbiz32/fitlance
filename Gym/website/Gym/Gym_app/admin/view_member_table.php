<h2>View Member Schedule</h2>
<hr />
<h3>Members Exercise Details for  :- <?php $mem_id = $_POST['name']; echo $_POST['full_name']; ?></h3>
<hr />
<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Membership ID</th>
            <th>Name</th>
            <th>Details</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
        <tbody>
        <?php
            $query  = "select * from time_table WHERE mem_id ='$mem_id' ORDER BY date DESC";
            //echo $query;
            $result = mysqli_query($con, $query);
            $sno    = 1;

            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    
                    echo "<td>" . $sno . "</td>";
                    echo "<td>" . $row['mem_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['details'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    $sno++;
                    echo "<td><form action='del_member_table.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $mem_id . "'/><input type='submit' value='Delete Schedule' class='btn btn-danger'/></form><form action='print_member_table.php' method='post'><input type='hidden' name='name' value='" . $mem_id . "'/><input type='hidden' name='full_name' value='" . $row['name'] . "'/><input type='hidden' name='details' value='" . $row['details'] . "'/><input type='hidden' name='date' value='" . $row['date'] . "'/><input type='submit' value='Print Schedule' class='btn btn-info'/></form></td></tr>";
                    $msgid = 0;
                }
            }

        ?>										
        </tbody>
</table>