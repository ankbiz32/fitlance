<div class="row">
  <div class="col-sm-3">			
      <div class="tile-stats tile-red">
          <div class="icon"><i class="entypo-users"></i></div>
              <div class="num" data-postfix="" data-duration="1500" data-delay="0">
              <h2>Paid Income This Month</h2><br>	
              <?php
                  $date  = date('Y-m');
                  $query = "select * from subsciption WHERE  paid_date LIKE '$date%'";

                  //echo $query;
                  $result  = mysqli_query($con, $query);
                  $revenue = 0;
                  if (mysqli_affected_rows($con) != 0) {
                      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                          $revenue = $row['paid'] + $revenue;
                      }
                  }
                  echo $revenue;
                  ?>
              </div>
      </div>
  </div>
  

  <div class="col-sm-3">			
      <div class="tile-stats tile-green">
          <div class="icon"><i class="entypo-chart-bar"></i></div>
              <div class="num" data-postfix="" data-duration="1500" data-delay="0">
              <h2>Total <br>Members</h2><br>	
                  <?php
                  $date  = date('Y-m');
                  $query = "select COUNT(*) from user_data WHERE wait='no'";

                  //echo $query;
                  $result = mysqli_query($con, $query);
                  $i      = 1;
                  if (mysqli_affected_rows($con) != 0) {
                      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                          echo $row['COUNT(*)'];
                      }
                  }
                  $i = 1;
                  ?>
              </div>
      </div>
  </div>	
      
  <div class="col-sm-3">			
      <div class="tile-stats tile-aqua">
          <div class="icon"><i class="entypo-mail"></i></div>
              <div class="num" data-postfix="" data-duration="1500" data-delay="0">
              <h2>Joined This Month</h2><br>	
                  <?php
                  $date  = date('Y-m');
                  $query = "select COUNT(*) from user_data WHERE wait='no'";

                  //echo $query;
                  $result = mysqli_query($con, $query);
                  $i      = 1;
                  if (mysqli_affected_rows($con) != 0) {
                      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                          echo $row['COUNT(*)'];
                      }
                  }
                  $i = 1;
                  ?>
              </div>
      </div>			
  </div>

  <div class="col-sm-3">			
      <div class="tile-stats tile-blue">
          <div class="icon"><i class="entypo-rss"></i></div>
              <div class="num" data-postfix="" data-duration="1500" data-delay="0">
              <h2>Income This Month</h2><br>	
                  <?php
                  $date  = date('Y-m');
                  $query = "select * from subsciption WHERE  paid_date LIKE '$date%'";

                  //echo $query;
                  $result  = mysqli_query($con, $query);
                  $revenue = 0;
                  if (mysqli_affected_rows($con) != 0) {
                      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                          $revenue = $row['total'] + $revenue;
                      }
                  }
                  echo $revenue;
                  ?>
              </div>
      </div>
  </div>
</div>