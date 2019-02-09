<?php 

session_start();
include 'includes/flight_header.php';?>

    <!-- Navigation -->
      <?php include 'includes/flight_navigation.php';?>
        

    
<div class="container">
	<h1 class="my-4">NaFee |
        <small>Reschedule Flight</small>
        <hr>

<?php //session_start(); ?>
 <?php // $db_ticket = $_SESSION['ticket']?? '' ;
 if(!empty($_SESSION['ticket'])){
    $db_ticket = $_SESSION['ticket'] ;
 }else{
    $db_ticket = '' ;
 }



 if (!isset($db_ticket)) {
   header("Location:index.php");
 }else{

 }
// echo $db_ticket;

 ?>

    </h1>
  <div class="row">
            
   <div class="col-lg-12 portfolio-item">
   		<?php 
        if (isset($_GET['source'])) {
          $source = $_GET['source'];
        }else{
          $source = '';
        } 

   			switch ($source) {
   				case 'edit_flight':
   					include "edit_flight.php";
   					break;
   				
   				default:
   					include "all_flight.php";
   					break;
   			}

   		 ?>

			     
   </div> 
  </div> <!--Class-Row -->      
</div> <!-- end of container fluid -->

    <!-- Footer -->
   <?php include 'includes/footer.php'; ?>




