<?php ob_start(); ?>
<?php

require_once 'db.php';
require("vendor/autoload.php");
$db = new Database();

$paidReference = 0;

function makePayment($amt, $email, $rnd){
	$paystack = new Yabacon\Paystack('sk_test_6f87521e1e27de29df1d3d79c71f9b5904087771');
    try
    {
      $tranx = $paystack->transaction->initialize([
        'amount'=>$amt,       // in kobo
        'email'=>$email,         // unique to customers
        'reference'=>$rnd, // unique to transactions
      ]);
    } catch(\Yabacon\Paystack\Exception\ApiException $e){
      print_r($e->getResponseObject());
      die($e->getMessage());
    }

    // store transaction reference so we can query in case user never comes back
    // perhaps due to network issue
    // save_last_transaction_reference($tranx->data->reference);

    // redirect to page so User can pay
    header('Location: ' . $tranx->data->authorization_url);
}

function verifyPayment($reference){
	// $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
    // if(!$reference){
    //   die('No reference supplied');
    // }

    // initiate the Library's Paystack Object
    $paystack = new Yabacon\Paystack('sk_test_6f87521e1e27de29df1d3d79c71f9b5904087771');
    try
    {
      // verify using the library
      $tranx = $paystack->transaction->verify([
        'reference'=>$reference, // unique to transactions
      ]);
    } catch(\Yabacon\Paystack\Exception\ApiException $e){
      print_r($e->getResponseObject());
      die($e->getMessage());
    }

    if ('success' === $tranx->data->status) {
      // transaction was successful...
      // please check other things like whether you already gave value for this ref
      // if the email matches the customer who owns the product etc
      // Give value
    	echo "HURRAy";
    }
}
    
if (isset($_GET['trxref'])) {
	$paidReference = $_GET['trxref'];
	echo $paidReference;
}

if (isset($_POST['book_flight'])) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$flying_from = $_POST['flying_from'];
	$flying_to = $_POST['flying_to'];
	$amount = 0;
	$db_amount = 0;
	$payment_status = 0;
	$date = $_POST['date'];
	$number = $_POST['number'];
	
	$contact_firstname = $_POST['contact_firstname'];
	$contact_lastname = $_POST['contact_lastname'];
	$contact_number = $_POST['contact_number'];
	$contact_email = $_POST['contact_email'];

	/*Secure SQL injection*/
	$firstname = $db->secureSQL($firstname);
	$lastname = $db->secureSQL($lastname);
	$email = $db->secureSQL($email);
	$address = $db->secureSQL($address);
	$date = $db->secureSQL($date);

	$contact_firstname = $db->secureSQL($contact_firstname);
	$contact_lastname = $db->secureSQL($contact_lastname);
	$contact_number = $db->secureSQL($contact_number);
	$contact_email = $db->secureSQL($contact_email);
	
	/*Triming, removing backslashes and HTML Special Characters*/	
	$firstname = $db->secureInput($firstname);
	$lastname = $db->secureInput($lastname);
	$email = $db->secureInput($email);
	$number = $db->secureInput($number);
		
	$contact_firstname = $db->secureInput($contact_firstname);
	$contact_lastname = $db->secureInput($contact_lastname);
	$contact_number = $db->secureInput($contact_number);
	$contact_email = $db->secureInput($contact_email);

	foreach ($_POST as $key => $value) {
		if (empty($_POST[$key])) {
			$error = ucwords($key) . " field is required";
			break;
		}
	}

	if (!isset($error)) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = "Passenger: Invalid email format";
		}
		// else{
		// 	$email_query = "SELECT * FROM reservation WHERE email='{$email}' ";
		// 	$email_result=$db->selectQuery($email_query);
		// 	$db_email = "";

		// 	while ($row = mysqli_fetch_array($email_result)) {
		// 		$db_email = $row['email'];
		// 	}

		// 	if ($email == $db_email) {
		// 			$error = "Email already exist";
		// 	}
		// }
	}

	if (!isset($error)) {
		if ($flying_from == "Choose" || $flying_to == "Choose") {
			$error = "Please Select Departure and Arrival Port";
		}
	}	

	if (!isset($error)) {
		if ($flying_from == $flying_to) {
			$error = "Departure and Arrival Ports cannot be the same";
		}else{

			if (($flying_from == "Abuja" && $flying_to == "Lagos") || ($flying_from == "Lagos" && $flying_to == "Abuja") ) {
				$amount = 4000000;
				$db_amount = 40000;
			}

			if (($flying_from == "Abuja" && $flying_to == "Bauchi") || ($flying_from == "Bauchi" && $flying_to == "Abuja") ) {
				$amount = 2800000;
				$db_amount = 28000;
			}

			if (($flying_from == "Abuja" && $flying_to == "Jos") || ($flying_from == "Jos" && $flying_to == "Abuja") ) {
				$amount = 2500000;
				$db_amount = 25000;
			}

			if (($flying_from == "Abuja" && $flying_to == "Gombe") || ($flying_from == "Gombe" && $flying_to == "Abuja") ) {
				$amount = 2700000;
				$db_amount = 27000;
			}

			if (($flying_from == "Bauchi" && $flying_to == "Lagos") || ($flying_from == "Lagos" && $flying_to == "Bauchi") ) {
				$amount = 3400000;
				$db_amount = 34000;
			}

			if (($flying_from == "Bauchi" && $flying_to == "Jos") || ($flying_from == "Jos" && $flying_to == "Bauchi") ) {
				$amount = 1500000;
				$db_amount = 15000;
			}
			

			if (($flying_from == "Bauchi" && $flying_to == "Gombe") || ($flying_from == "Gombe" && $flying_to == "Bauchi") ) {
				$amount = 1500000;
				$db_amount = 15000;
			}

			if (($flying_from == "Gombe" && $flying_to == "Jos") || ($flying_from == "Jos" && $flying_to == "Gombe") ) {
				$amount = 1700000;
				$db_amount = 17000;
			}

			if (($flying_from == "Gombe" && $flying_to == "Lagos") || ($flying_from == "Lagos" && $flying_to == "Gombe") ) {
				$amount = 3000000;
				$db_amount = 30000;
			}

			if (($flying_from == "Jos" && $flying_to == "Lagos") || ($flying_from == "Lagos" && $flying_to == "Jos") ) {
				$amount = 2500000;
				$db_amount = 25000;
			}
		}
	}

	/*Validating if Passenger Phone number is a number*/
	if (!isset($error)) {
		if (!is_numeric($number)) {
			$error = "Passenger: Entry must be a Number ";
		}
	}

	/*Validating Passenger's phone number Length*/
	if (!isset($error)) {
		if (strlen($number) < 11 || strlen($number) > 11) {
			$error = "Passenger: Invalid Phone Format (Should be 11 Digits)";
		}
	}

	/*Validating Contact Email*/
	if (!isset($error)) {
		if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
			$error = "Contact: Invalid email format";
		}
	}

	/*Validating if Contact Phonenumber is a number*/
	if (!isset($error)) {
		if (!is_numeric($contact_number)) {
			$error = "Contact: Entry must be a Number ";
		}
	}

	/*Validate Contact Phone Number's Length*/
	if (!isset($error)) {
	    if (strlen($contact_number) < 11 || strlen($contact_number) > 11) {
	      $error = "Contact: Invalid Phone Format (Should be 11 Digits)";
	    }
	}

	/*Check if randomly generated number already exist*/
	if (!isset($error)) {

		function sendSMS($number, $message){

			define("myusername", "eniola@uplift.ng");
			define("mypassword", "08062462814");
			define("senderID", "FlightInfo");

			//$a=urlencode(myusername); //Note: urlencodemust be added forusername an
			//$b=urlencode(mypassword); // passwordas encryption code for security purpose.
			$c= $message;
			$d=senderID;
			$e=$number;
			$url = "http://portal.bulksmsnigeria.net/api/?username=".myusername."&password=".mypassword."&message=".$c."&sender=".$d."&mobiles=".$e;
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$resp = curl_exec($ch);
// 			echo $resp; // Add double slash or delete “echo”
// 			echo "<br>Thank you for using Bulk SMS Nigeria API"; // Your notification message here
			curl_close($ch);
		}

		function check_rand_number(){
			global $db;
			global $firstname;
			global $lastname;
			global $address;
			global $email;
			global $gender;
			global $flying_from;
			global $flying_to;
			global $amount;
			global $db_amount;
			global $payment_status;
			global $date;
			global $number;
			global $contact_firstname;
			global $contact_lastname;
			global $contact_number;
			global $contact_email;
			
			$ticket = rand(99999,999999);
			
			$ticket_query = "SELECT * FROM reservation WHERE ticket = {$ticket} ";
			$ticket_result =$db->numRows($ticket_query);

			if($ticket_result == 0){
				$query = "INSERT INTO reservation(firstname, lastname, address, number, email, gender, flying_from, flying_to, amount, paymentstatus, ticket, date, contact_firstname, contact_lastname, contact_number, contact_email)";
				$query.= "VALUES ('$firstname', '$lastname', '$address', '$number', '$email', '{$_POST['gender']}', '$flying_from', '$flying_to',  '$db_amount', '$payment_status', '$ticket', '$date', '$contact_firstname', '$contact_lastname', '$contact_number', '$contact_email')";

				$result = $db->insertQuery($query);
				
				$message = "Booking successful! Flight details have been sent to your registered mail. Please proceed to Payment";	
				$display_message = "Booking successful! You will receive an SMS shortly Proceed for Payment";	
					
					echo "<script type='text/javascript'>alert('$display_message');</script>";

				$to = $email;
				$subject = "NaFee Air Reservation Ticket";
				$mail_message = "Name: " . $firstname . " " . $lastname . "\nEmail: " . $email . " \nDeparture Port: " . $flying_from . "\nArrival Port:" . $flying_to ."\nAmount NGN".$db_amount . "\nDate: " . $date . "\nTicket Number is: " . $ticket;
				
				$from = "nafisatabubakat@gmail.com";
				$header = "From: " . $from . "\r\n" . "CC: nafisatabubakat@gmail.com";

				/*Sending message to phone number*/
				// mail($to, $subject, $mail_message, $header);

				/*Sending message to phone number*/

				// sendSMS($number, $message);
				
				$paystack = new Yabacon\Paystack("sk_test_6f87521e1e27de29df1d3d79c71f9b5904087771");
				    try
				    {
				      $tranx = $paystack->transaction->initialize([
				        'amount'=>$amount,       // in kobo
				        'email'=>$email,         // unique to customers
				        'reference'=>$ticket, // unique to transactions
				      ]);
				    } catch(\Yabacon\Paystack\Exception\ApiException $e){
				      print_r($e->getResponseObject());
				      die($e->getMessage());
				    }

				    // store transaction reference so we can query in case user never comes back
				    // perhaps due to network issue
				    // save_last_transaction_reference($tranx->data->reference);

				    // redirect to page so User can pay
				    header('Location: ' . $tranx->data->authorization_url);

 			}else{
				check_rand_number();
			}
		} //end of function check_rand_number


		check_rand_number();	
	}			
}
?>