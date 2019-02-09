<?php // ob_start();

session_start();
require_once 'db.php';
$db = new Database();

if (isset($_POST['search_ticket_number'])) {

	$ticket_number = $db->secureSQL($_POST['ticket_number']);

	$ticket_number = $db->secureInput($ticket_number);
	
	
	if (empty($ticket_number)) {
		$error = "Please provide Ticket Number ";
	}

	if (!isset($error)) {
		/*check if ticket is in database already exist*/
		$query = "SELECT * FROM reservation WHERE ticket='{$ticket_number}' ";
		$result=$db->selectQuery($query);
		$db_ticket = "";
			while ($row = mysqli_fetch_array($result)) {
				$db_ticket = $row['ticket'];
			}

			if (!$ticket_number == $db_ticket) {
				$error = "Ticket Number not found";
			}elseif ($ticket_number == $db_ticket) {
				$_SESSION['ticket'] = $db_ticket;
				header("Location:flights.php");
			}else{
				$error = "Invalid Ticket Number";
			}		
	}
}

?>
<?php ob_flush(); ?>
