<?php include 'includes/reschedule_flight_header.php'; ?>
<?php include 'process/reschedule_flight_process.php'; ?>


<?php 

 ?>





    <!-- Navigation -->
    <?php include 'includes/reschedule_flight_navigation.php'; ?>
    
    <!-- Page Content -->
    <div class="container ">

      <!-- Page Heading -->
      <h1 class="my-4">NaFee |
        <small>Reschedule Flight</small>
        <hr>
      </h1>
      <div class="row">
        <div class="col-lg-12 portfolio-item">
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 portfolio-item">
          <!-- <div class="card h-100">
            
            <div class="card-body">
              <h4 class="card-title">
                
              </h4>
              <p class="card-text">
 
                   
            </p>
            </div>
          </div> -->
        </div>


        <div class="col-lg-4 portfolio-item">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title title">
                Reschedule Flight
              </h4>
           
              <p class="card-text">
                <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="padding:10px 10px 30px 10px">

                    <?php if (!empty($error)) {?>
                      <div class="error"><?php if (isset($error)) echo $error; ?></div>
                    <?php } ?>

                    <div class="form-group"> 
                      <p>Provide Ticket Number <input class="form-control" type="text" name="ticket_number" placeholder="Ticket Number"></p>
                    </div>
                      <input class="btn btn-primary form-control" type="submit" name="search_ticket_number" value="SEARCH TICKET">
                </form>
                      
              </p>
            </div>
            </div>
          </div>
          <div class="col-lg-4 portfolio-item">
          </div>



        </div>    <!-- row -->
        <div class="container">
        		<div class="row"><div class="col-lg-12 portfolio-item"> <br></div></div>
        	
        </div>
</div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>