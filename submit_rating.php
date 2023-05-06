<?php
$connect = new PDO("mysql:host=localhost;dbname=fyp", "root", "");
session_start();
if(isset($_POST["rating_data"]))
{

   $data = array(
      ':user_name'      =>   $_POST["user_name"],
      ':user_rating'      =>   $_POST["rating_data"],
      ':user_review'      =>   $_POST["user_review"],
      ':user_id'      =>   $_POST["user_id"],
      ':datetime'         =>   time(),
      /*':user_id'         =>   $_POST['userID']*/
   );

   $query = "
   INSERT INTO review_table 
   (user_name, user_rating, user_review, datetime, userID) 
   VALUES (:user_name, :user_rating, :user_review, :datetime, :user_id)
   ";

   $statement = $connect->prepare($query);

   $statement->execute($data);

   if(isset($_POST['appointmentID'])){
      $query2 = "
      UPDATE appointment SET
      review_status = '1'
      WHERE appointmentID = '".$_POST['appointmentID']."'
      ";

      $statement2 = $connect->prepare($query2);
      $statement2->execute();
   }

   echo "Your Review & Rating Successfully Submitted";
}

if(isset($_POST["action"]))
{
   $average_rating = 0;
   $total_review = 0;
   $five_star_review = 0;
   $four_star_review = 0;
   $three_star_review = 0;
   $two_star_review = 0;
   $one_star_review = 0;
   $total_user_rating = 0;
   $review_content = array();

   $query = "
   SELECT rt.*,us.fullname FROM review_table rt
   INNER JOIN user us ON us.username = rt.user_name
   ORDER BY rt.datetime DESC
   ";

   $result = $connect->query($query, PDO::FETCH_ASSOC);

   foreach($result as $row)
   {
      $review_content[] = array(
         'user_name'      =>   $row["fullname"],
         'user_review'   =>   $row["user_review"],
         'rating'      =>   $row["user_rating"],
         'datetime'      =>   date('l jS, F Y h:i:s A', $row["datetime"]),
         'user_id'       =>  $row['userID']
      );

      if($row["user_rating"] == '5')
      {
         $five_star_review++;
      }

      if($row["user_rating"] == '4')
      {
         $four_star_review++;
      }

      if($row["user_rating"] == '3')
      {
         $three_star_review++;
      }

      if($row["user_rating"] == '2')
      {
         $two_star_review++;
      }

      if($row["user_rating"] == '1')
      {
         $one_star_review++;
      }

      $total_review++;

      $total_user_rating = $total_user_rating + $row["user_rating"];

   }

   $average_rating = $total_user_rating / $total_review;

   $output = array(
      'average_rating'   =>   number_format($average_rating, 1),
      'total_review'      =>   $total_review,
      'five_star_review'   =>   $five_star_review,
      'four_star_review'   =>   $four_star_review,
      'three_star_review'   =>   $three_star_review,
      'two_star_review'   =>   $two_star_review,
      'one_star_review'   =>   $one_star_review,
      'review_data'      =>   $review_content
   );

   echo json_encode($output);

}

if(isset($_POST["reviewCheck"])){

   $query = "SELECT appointmentID FROM appointment WHERE userID = '".$_POST['doctorID']."' AND patientID = '".$_SESSION['userID']."' AND status = 'expired' AND (review_status is null or review_status = '') ORDER BY appointmentID LIMIT 1 ";
   $result = mysqli_query(mysqli_connect('localhost', 'root','','fyp'), $query);
   $val = mysqli_fetch_assoc($result);

   echo (isset($val['appointmentID']) ? $val['appointmentID']: '');
}


?>