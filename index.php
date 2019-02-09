<?php ob_start(); ?>
<?php include 'includes/index_header.php';?>
<?php include 'process/index_process.php';



?>

    <!-- Navigation -->
      <?php include 'includes/index_navigation.php';?>
                      
<div class=".container-fluid">
  <?php if (!empty($error)) {?>
    <div class="errorr"><?php if (isset($error)) echo"<script type='text/javascript'>alert('$error');</script>" ;?>
    </div>  
  <?php } ?>

        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="images/plane2.jpg" alt="First slide" height="615px">
            </div>
            <div class="carousel-caption d-none d-md-block">
              <p><a href="#flight" class="btn btn-danger btn-lg" role="button">Book Flight <i class="fa  fa-angle-double-down"></i></a></p>
            </div>            
            <div class="carousel-item">
              <img class="d-block w-100" src="images/plane1.jpg" alt="Second slide" height="615px">
            <div class="carousel-caption d-none d-md-block">
              <p><a href="#flight" class="btn btn-danger btn-lg" role="button">Book Flight <i class="fa  fa-angle-double-down"></i></a></p>
            </div>                          
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/plane3.jpg" alt="Third slide" height="615px">
            </div>
            <div class="carousel-caption d-none d-md-block">
              
              <p><a href="#flight" class="btn btn-danger btn-lg" role="button">Book Flight <i class="fa  fa-angle-double-down"></i></a></p>
            </div>            
          </div>
          <!-- Controls the previous and next control -->
          <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a> -->
        </div>
</div> <!-- end of container fluid -->
<!-- another row here -->
<div id="flight">
  <div  class="container.fluid book_flight">
        <br> <br> <br>
      <div class="container">
        <div class="row">
            <div class="col-lg-10 portfolio-item">
              <div class="card">
                <div class="card-header">
                  <strong>Passenger Information</strong>
                </div>
                <div class="card-body">
                  <h4 class="book card-title">Book Flight Ticket</h4>
              
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="Firstname">Firstname *</label>
                          <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php if(isset($firstname)) echo $firstname;?>">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="lastname">Lastname *</label>
                          <input type="text" class="form-control" name="lastname" placeholder="Lastname"  value="<?php if(isset($lastname)) echo $lastname;?>">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="Email">Email *</label>
                          <input type="text" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email;?>">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="Address">Address *</label>
                          <input type="text" class="form-control" name="address" placeholder="Address" value="<?php if(isset($address)) echo $address;?>">
                        </div>
                        </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputState">Flying From *</label>
                          <select id="inputState" name="flying_from" class="form-control">
                            <option selected>Choose</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Abuja">Abuja</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Jos">Jos</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputState">Flying To *</label>
                          <select id="inputState" name="flying_to" class="form-control">
                            <option selected>Choose</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Abuja">Abuja</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Jos">Jos</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="Address">Departure Date *</label>
                          <input type="date" class="form-control" name="date" value="<?php if(isset($date)) echo $date;?>">
                        </div>                  
                        
                        <div class="form-group col-md-4">
                          <label for="Address">Phone Number *</label>
                          <input type="text" class="form-control" name="number" value="<?php if(isset($number)) echo $number;?>" placeholder="Phone Number">
                        </div>                  

                        <div class="form-group col-md-2">
                          <label for="gender">Gender *</label> <br>
                          <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="Male"){?>checked <?php } ?>value="Male"> Male
                          <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="Female"){?> checked <?php } ?> value="Female"> Female
                        </div>
                      </div>
                </div>
              </div>              
            </div> <!-- col-lg-10 --> 
        </div> <!--Class-Row   -->   

        <div class="row">
            <div class="col-lg-10 portfolio-item">
              <div class="card">
                <div class="card-header">
                  <strong>Next of Kin Information</strong>
                </div>
                <div class="card-body">
                  <p class="card-title contact"><i>You have to fill Next of Kin information correctly, just in case of communicating with you in necessary situation</i></p>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="contact_firstname">Firstname *</label>
                          <input type="text" class="form-control" name="contact_firstname" placeholder="Firstname" value="<?php if(isset($contact_firstname)) echo $contact_firstname;?>">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="contact_lastname">Lastname *</label>
                          <input type="text" class="form-control" name="contact_lastname" placeholder="Lastname"  value="<?php if(isset($contact_lastname)) echo $contact_lastname;?>">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="Email">Phone Number *</label>
                          <input type="text" class="form-control" name="contact_number" placeholder="Phone Number" value="<?php if(isset($contact_number)) echo $contact_number;?>">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="Address">Email *</label>
                          <input type="text" class="form-control" name="contact_email" placeholder="Email" value="<?php if(isset($contact_email)) echo $contact_email;?>">
                        </div>
                        </div>
                        <input type="submit" name="book_flight" value="BOOK FLIGHT" class="btn btn-primary">
                    </form>
                </div>
              </div>              
            </div> <!-- col-lg-10 --> 
        </div> <!--Class-Row   -->           
      </div>
  </div>
</div> <!-- For id=flight -->

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
