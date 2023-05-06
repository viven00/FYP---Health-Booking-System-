<?php
include_once("DoctorViewAccController.php");
include("Doctor.php");

session_start();
if (!isset($_SESSION['userID'])) {
	die(header("location: LoginUI.php"));
}


$conn = @new mysqli('localhost','root','', 'fyp');
$resultset = $conn-> query("select profileName from userprofile");
$user = new DoctorViewAccController();

$sql = "SELECT * FROM doctor  WHERE userID = '".$_SESSION['userID']."' ";
$res = mysqli_query($conn, $sql);
$doctor = mysqli_fetch_assoc($res);


?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Account Details</title>
    <style>
    .progress-label-left
    {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }
    .progress-label-right
    {
        float: right;
        margin-right: 0.3em;
        line-height: 1em;
    }
    .star-light
    {
        color:#e9ecef;
    }
</style>
    <script>
        function load_rating_data()
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{
                    action:'load_data',
                    userID:"<?=$_SESSION['userID']?>"
                    },
                dataType:"JSON",
                success:function(data)
                {

                    console.log(data);
                    var count_star = 0;

                    $('.main_star').each(function(){
                        count_star++;
                        if(Math.ceil(data.average_rating) >= count_star)
                        {
                            $(this).addClass('text-warning');
                            $(this).addClass('star-light');
                        }
                    });
                    console.log(data);

                    var five_star_review = 0;
                    var four_star_review = 0;
                    var three_star_review = 0;
                    var two_star_review = 0;
                    var one_star_review = 0;
                    var total_review = 0;
                    var total_review_val = 0;

                    if(data.review_data.length > 0)/**/ 
                    {
                        var html = '';
                        console.log(data.review_data);
                        for(var count = 0; count < data.review_data.length; count++)
                        {
                            if(data.review_data[count].user_id == "<?=$doctor['userID']?>"){

                                if(data.review_data[count].rating == 5){
                                    five_star_review++;

                                }else if(data.review_data[count].rating == 4){
                                    four_star_review++;

                                }else if(data.review_data[count].rating == 3){
                                    three_star_review++;
                                    
                                }else if(data.review_data[count].rating == 2){
                                    two_star_review++;
                                    
                                }else if(data.review_data[count].rating == 1){
                                    one_star_review++;
                                    
                                }
                                total_review_val += Number(data.review_data[count].rating);
                                total_review++;






                                html += '<div class="row mb-3 item" data-name="'+ data.review_data[count].user_id +'">';

                                html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

                                html += '<div class="col-sm-11">';

                                html += '<div class="card">';

                                html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                                html += '<div class="card-body">';

                                for(var star = 1; star <= 5; star++)
                                {
                                    var class_name = '';


                                    if(data.review_data[count].rating >= star)
                                    {
                                        class_name = 'text-warning';
                                    }
                                    else
                                    {
                                        class_name = 'star-light';
                                    }

                                    html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                                }

                                html += '<br />';

                                    html += data.review_data[count].user_review;

                                    html += '</div>';

                                    html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                                    html += '</div>';

                                    html += '</div>';

                                    html += '</div>';
                                }
                                $('#review_content').html(html);
                            }

                            
                            $('#total_five_star_review').text(five_star_review);
            
                            $('#total_four_star_review').text(four_star_review);
            
                            $('#total_three_star_review').text(three_star_review);
            
                            $('#total_two_star_review').text(two_star_review);
            
                            $('#total_one_star_review').text(one_star_review);
            
                            $('#five_star_progress').css('width', (five_star_review/total_review) * 100 + '%');
            
                            $('#four_star_progress').css('width', (four_star_review/total_review) * 100 + '%');
            
                            $('#three_star_progress').css('width', (three_star_review/total_review) * 100 + '%');
            
                            $('#two_star_progress').css('width', (two_star_review/total_review) * 100 + '%');
            
                            $('#one_star_progress').css('width', (one_star_review/total_review) * 100 + '%');

                    
                            $('#average_rating').text(Math.round((total_review_val / total_review)*10)/10);
                            $('#total_review').text(total_review);
                            star_html ='';
                            for(var star = 1; star <= 5; star++)
                                {
                                    var class_name = '';


                                    if(total_review_val / total_review >= star)
                                    {
                                        class_name = 'text-warning';
                                    }
                                    else
                                    {
                                        class_name = 'star-light';
                                    }

                                    star_html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                                }
                        $(".stars").html(star_html);
                    }


                },error : function (jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);  //replying
                    console.log(textStatus); //"error"
                    console.log(errorThrown);
                }
            })
    }
    $(document).ready(function(){
        load_rating_data();
    });
    </script>
</head>



<div class="w3-content" style="max-width:1300px;margin-top:87px;margin-left:230px;">
    <div class='w3-content' style='background-color:#ebf5fb;max-width:1300px;height:850px;overflow:scroll;'>
    <div class="container1" style = "max-width:1300px;">
    <div class="card">
          <div class="card-body" style="margin-left:180px;margin-top:30px;">
             <div class="row">
                <div class="col-sm-4 text-center">
                   <h1 class="text-warning mt-4 mb-4">
                      <b><span id="average_rating">0.0</span> / 5</b>
                   </h1>
                   <div class="mb-3 stars">
                      <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                   </div>
                   <h3><span id="total_review">0</span> Review</h3>
                </div>
                <div class="col-sm-4">
                   <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
                   <p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
                   <p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
                   <p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
                   <p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
                </div>
             </div>
          </div>
       </div>
       <div class="mt-5" id="review_content" style="margin-left:20px;width:1200px;"></div>
    </div>
</div>	
</div>
</div>
</html>
