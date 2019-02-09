		<table class="table table-bordered table-hover">
			<thead>
				<th>S/N</th>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Address</th>
				<th>Email</th>
				<th>Gender</th>
				<th>FlightFrom</th>
				<th>FlightTo</th>
				<th>Amount</th>
				<th>Payment status</th>
				<th>Date</th>
				<th>Contact:FirstName</th>
				<th>Contact:LastName</th>
				<th>Contact:Number</th>
				<th>Contact:Email</th>
			</thead>
			<tbody>
			<?php 
				require_once 'db.php';
				$db = new Database();

				$read_query = "SELECT * FROM reservation WHERE ticket = '{$db_ticket}' ";
				$read_query_result = $db->selectQuery($read_query);

				while ($row = mysqli_fetch_assoc($read_query_result)) {
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
					$contact_firstname = $row['contact_firstname'];
					$contact_lastname = $row['contact_lastname'];
					$contact_number = $row['contact_number'];
					$contact_email = $row['contact_email'];
					
					$payment_stat = $row['paymentstatus'];
					$meaning = "";
					if ($payment_stat == 1){
						$meaning = "Paid";
					}else{ $meaning="Not Paid";}

					echo "<tr>";
					echo "<td>{$id}</td>";
					echo "<td>{$firstname}</td>";
					echo "<td>{$lastname}</td>";
					echo "<td>{$address}</td>";
					echo "<td>{$email}</td>";
					echo "<td>{$gender}</td>";
					echo "<td>{$flying_from}</td>";
					echo "<td>{$flying_to}</td>";
					echo "<td>{$amount}</td>";
					echo "<td>{$meaning}</td>";
					echo "<td>{$date}</td>";
					echo "<td>{$contact_firstname}</td>";
					echo "<td>{$contact_lastname}</td>";
					echo "<td>{$contact_number}</td>";
					echo "<td>{$contact_email}</td>";
					echo "<td><a href='flights.php?source=edit_flight&id={$id}'>Edit</a></td>";
					echo "</tr>";
				}
			 ?>
			</tbody>
		</table>