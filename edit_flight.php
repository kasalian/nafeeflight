<?php 

	require_once 'db.php';
	$db = new Database();

if (isset($_GET['id'])) {
  	$edit_id = $_GET['id'];
}

	$select_query = "SELECT * FROM reservation WHERE id = $edit_id";
	$select_query_result = $db->selectQuery($select_query);

	while ($row = mysqli_fetch_assoc($select_query_result)) {
		$id = $row['id'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$address = $row['address'];
		$email = $row['email'];
		$gender = $row['gender'];
		$flying_from = $row['flying_from'];
		$flying_to = $row['flying_to'];
		$amount = $row['amount'];
		$date = $row['date'];
        $ticket = $row['ticket'];
        $contact_firstname = $row['contact_firstname'];
        $contact_lastname = $row['contact_lastname'];
        $contact_number = $row['contact_number'];
        $contact_email = $row['contact_email'];
	}

if (isset($_POST['change_flight'])) {
    $ticket = $_POST['ticket'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $changed_amnt = 0;
    $db_amount = 0;
    $date = $_POST['date'];
    $contact_firstname = $_POST['contact_firstname'];
    $contact_lastname = $_POST['contact_lastname'];
    $contact_number = $_POST['contact_number'];
    $contact_email = $_POST['contact_email'];
    
    /*Securing against SQL injection*/
    $ticket = $db->secureSQL($ticket);
    $firstname = $db->secureSQL($firstname);
    $lastname = $db->secureSQL($lastname);
    $address = $db->secureSQL($address);
    $email = $db->secureSQL($email);
    
    $contact_firstname = $db->secureSQL($contact_firstname);
    $contact_lastname = $db->secureSQL($contact_lastname);
    $contact_number = $db->secureSQL($contact_number);
    $contact_email = $db->secureSQL($contact_email);

    /*Triming, removing backslahes and HTML special characters*/      
    $ticket = $db->secureInput($ticket);
    $firstname = $db->secureInput($firstname);
    $lastname = $db->secureInput($lastname);
    $email = $db->secureInput($email);

    $contact_firstname = $db->secureInput($contact_firstname);
    $contact_lastname = $db->secureInput($contact_lastname);
    $contact_number = $db->secureInput($contact_number);
    $contact_email = $db->secureInput($contact_email);

    foreach ($_POST as $key => $value) {
      if (empty($_POST[$key])) {
        $error = "All fields are required";
        echo "<script type='text/javascript'>alert('$error');</script>";
        break;
      }
    }

    if (!isset($error)) {
      if (empty($_POST['gender'])) {
          $error = "All fields are required";
          echo "<script type='text/javascript'>alert('$error');</script>";
      }
    }
    
    if (!isset($error)) {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error = "Invalid email format";
          echo "<script type='text/javascript'>alert('$error');</script>";
      }
    }

    if (!isset($error)) {
      if ($flying_from == "Choose" || $flying_to == "Choose") {
        $error = "Please Select Departure and Arrival Port";
        echo "<script type='text/javascript'>alert('$error');</script>";
      }
    } 

  if (!isset($error)) {
    if ($flying_from == $flying_to) {
      $error = "Departure and Arrival Ports cannot be the same";
      echo "<script type='text/javascript'>alert('$error');</script>";
    }else{

      if (($flying_from == "Abuja" && $flying_to == "Lagos") || ($flying_from == "Lagos" && $flying_to == "Abuja") ) {
				$changed_amnt = 4000000;
				$db_amount = 40000;
			}

	if (($flying_from == "Abuja" && $flying_to == "Bauchi") || ($flying_from == "Bauchi" && $flying_to == "Abuja") ) {
		$changed_amnt = 2800000;
		$db_amount = 28000;
	}

	if (($flying_from == "Abuja" && $flying_to == "Jos") || ($flying_from == "Jos" && $flying_to == "Abuja") ) {
		$changed_amnt = 2500000;
		$db_amount = 25000;
	}

	if (($flying_from == "Abuja" && $flying_to == "Gombe") || ($flying_from == "Gombe" && $flying_to == "Abuja") ) {
		$changed_amnt = 2700000;
		$db_amount = 27000;
	}

	if (($flying_from == "Bauchi" && $flying_to == "Lagos") || ($flying_from == "Lagos" && $flying_to == "Bauchi") ) {
		$changed_amnt = 3400000;
		$db_amount = 34000;
	}

	if (($flying_from == "Bauchi" && $flying_to == "Jos") || ($flying_from == "Jos" && $flying_to == "Bauchi") ) {
		$changed_amnt = 1500000;
		$db_amount = 15000;
	}
	

	if (($flying_from == "Bauchi" && $flying_to == "Gombe") || ($flying_from == "Gombe" && $flying_to == "Bauchi") ) {
		$changed_amnt = 1500000;
		$db_amount = 15000;
	}

	if (($flying_from == "Gombe" && $flying_to == "Jos") || ($flying_from == "Jos" && $flying_to == "Gombe") ) {
		$changed_amnt = 1700000;
		$db_amount = 17000;
	}

	if (($flying_from == "Gombe" && $flying_to == "Lagos") || ($flying_from == "Lagos" && $flying_to == "Gombe") ) {
		$changed_amnt = 3000000;
		$db_amount = 30000;
	}

	if (($flying_from == "Jos" && $flying_to == "Lagos") || ($flying_from == "Lagos" && $flying_to == "Jos") ) {
		$changed_amnt = 2500000;
		$db_amount = 25000;
	}
    }
  }

  /*Validate contact email*/
  if (!isset($error)) {
    if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
      $error = "Contact: Invalid Email Format";
      echo "<script type='text/javascript'>alert('$error');</script>";
    }
  }

  /*Validating if Contact Phonenumber is a number*/
  if (!isset($error)) {
    if (!is_numeric($contact_number)) {
      $error = "Contact: Entry must be a Number ";
      echo "<script type='text/javascript'>alert('$error');</script>";
    }
  }

  /*Validate Contact Phone Number*/
  if (!isset($error)) {
    if (strlen($contact_number) < 11 || strlen($contact_number) > 11) {
      $error = "Contact: Invalid Phone Format (Should be 11 Digits)";
      echo "<script type='text/javascript'>alert('$error');</script>";
    }
  }

    if (!isset($error)) {
      $update_query = "UPDATE reservation SET ";
      $update_query.= "firstname = '{$firstname}', ";
      $update_query.= "lastname = '{$lastname}', ";
      $update_query.= "address = '{$address}', ";
      $update_query.= "email = '{$email}', ";
      $update_query.= "gender = '{$_POST['gender']}', ";
      $update_query.= "flying_from = '{$flying_from}', ";
      $update_query.= "flying_to = '{$flying_to}', ";
      $update_query.= "amount = '{$db_amount}', ";
      $update_query.= "date = '{$date}', ";
      $update_query.= "contact_firstname = '{$contact_firstname}', ";
      $update_query.= "contact_lastname = '{$contact_lastname}', ";
      $update_query.= "contact_number = '{$contact_number}', ";
      $update_query.= "contact_email = '{$contact_email}' ";
      $update_query.= "WHERE id = $edit_id";

      $update_query_result = $db->selectQuery($update_query);
      $success = "Your Booking has been rescheduled. Check your mail for flight details";
      
      echo "<script type='text/javascript'>alert('$success');</script>";
      header("Refresh:0;url=flights.php");
      
        /*Sending mail*/
        $to = $email;
        $subject = "Rescheduled - NaFee Air Reservation Ticket";
        $mail_message = "Name: " . $firstname . " " . $lastname . "\n$email: " . $email . " \nDeparture Port: " . $flying_from . "\nArrival Port:" . $flying_to ."\nAmount NGN".$db_amount. "\nDate: " . $date . "\nTicket Number is: " . $ticket . "";
        
        $from = "eniola@uplift.ng";
        $header = "From: " . $from . "\r\n" ;

        mail($to, $subject, $mail_message, $header);
    }
}

?>


 <!--            <div id="flight" class="col-lg-8 portfolio-item">
            <div class="card h-70">
            
            <div class="card-body">

                <h4 class="card-title">
                  Reschedule Flight
                </h4>
                <p class="card-text">
                  <form action="" method="post">
                    <div class="form-group">                      
                      <p>Ticket<input class="form-control" style="cursor:not-allowed;" type="text" name="ticket" readonly value="<?php if(isset($ticket)) echo $ticket;?>"></p>
                    </div>
                    <div class="form-group">                      
                      <p>Firstname<input class="form-control" type="text" name="firstname" value="<?php if(isset($firstname)) echo $firstname;?>"></p>
                    </div>
                    <div class="form-group">                      
                      <p>Lastname<input class="form-control" type="text" name="lastname" value="<?php if(isset($lastname)) echo $lastname; ?>"></p>
                    </div>
                    
                    <div class="form-group">                      
                      <p>Contact Address<input class="form-control" type="text" name="address" value="<?php if(isset($address)) echo $address; ?>"></p>
                    </div>

                    <div class="form-group">                      
                      <p>Email<input class="form-control" type="text" name="email" value="<?php if(isset($email)) echo $email; ?>"></p>
                    </div>
                         <div class="form-group">
                      <p>Gender<br>
                      <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="Male") {?>checked <?php }?> value="Male">Male

                      <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="Female"){?> checked <?php } ?> value="Female">Female</p>
                    </div>
                    <div class="form-group">                      
                      <p>Departure Date: <input type="date" name="date" value="<?php if(isset($date)) echo $date;?>">
                          Flying From:
                          <select name="flying_from">
                            <option selected>Choose</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Abuja">Abuja</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Jos">Jos</option>
                          </select>
                          Flying To:
                          <select name="flying_to">
                            <option selected>Choose</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Abuja">Abuja</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Jos">Jos</option>
                          </select>
                      </p>
                    </div>
                    <div class="form-group">
                      <p><input class="btn btn-primary" type="submit" name="change_flight" value="CHANGE FLIGHT">
                      </p>
                    </div>
                  </form>
                  
                </p>
              </div>
            </div>
          </div>
  -->

        <div class="container">
        <div class="row">
            <div class="col-lg-10 portfolio-item">
              <div class="card">
                <div class="card-header">
                  <strong>Passenger Information</strong>
                </div>
                <div class="card-body">
                  <h4 class="book card-title">Book Flight Ticket</h4>
              
                    <form action="" method="post">
                      <!-- <?php 
                      // echo htmlspecialchars($_SERVER["PHP_SELF"]);
                      ?> -->
                      <div class="form-group">
                        <label for="ticket">Ticket Number</label>
                        <input class="form-control" type="text" name="ticket" value="<?php if (isset($ticket)) echo $ticket;?>" readonly>
                      </div>
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
                        <div class="form-group col-md-6">
                          <label for="gender">Gender *</label> <br>
                          <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="Male"){?>checked <?php } ?>value="Male"> Male
                          <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="Female"){?> checked <?php } ?> value="Female"> Female
                        </div>
                      </div>
<!--                         <input type="submit" name="book_flight" class="btn btn-primary"> -->
                </div>
              </div>              
            </div> <!-- col-lg-10 --> 
        </div> <!--Class-Row   -->   

        <div class="row">
            <div class="col-lg-10 portfolio-item">
              <div class="card">
                <div class="card-header">
                  <strong>Contact Information</strong>
                </div>
                <div class="card-body">
                  <p class="card-title contact"><i>You have to fill contact information correctly, just in case of communicating with you in necessary situation</i></p>
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
                        <input type="submit" name="change_flight" value="CHANGE FLIGHT" class="btn btn-primary">
                    </form>
                </div>
              </div>              
            </div> <!-- col-lg-10 --> 
        </div> <!--Class-Row   -->           
      </div>
