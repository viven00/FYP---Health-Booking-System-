<?php

include_once("Patient.php");

    session_start();

    $query = "SELECT * FROM doctor WHERE userID = '".$_GET['name']."'";
    $result = mysqli_query(mysqli_connect('localhost', 'root','','fyp'), $query);
    $doctor = mysqli_fetch_assoc($result);

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Doctor Review & Rating</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div class="container" style="max-width:1300px;margin-left:215px;overflow:hidden;">
        <div class='w3-content' style='background-color:#ebf5fb;max-width:1300px;height:800px;margin-top:87px;overflow-y:scroll;'>
            <div class='w3-container w3-content w3-padding-32' style='max-width:1300px;margin-left:10px;margin-top:-50px;'>

       <h1 class="mt-5 mb-5"></h1>
       <div style=margin-top:30px;>
       <button type='button' class='btn btn-primary' style=background-color:dodgerblue; onclick='history.back()'>Back</button>
        </div><br>
       <!--<h1><a href = "/searchdoctorUI.php"><button type="button" class="btn btn-danger">Back</button></a></h1>-->
       <div class="card">
          <div class="card-header">Reviews & Ratings for <b><?=$doctor['name']?></b></div>
          <div class="card-body">
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
                   <h3><span id="total_review">0</span> Review(s)</h3>
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
                <div class="col-sm-4 text-center">
                   <h3 class="mt-4 mb-3">Write Review Here</h3>
                   <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                </div>
             </div>
          </div>
       </div>

       <div class="mt-5" id="review_content" ></div>
    </div>
</body>
</html>

<div id="review_modal" class="modal" tabindex="-1" role="dialog" >
     <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Submit Review</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <h4 class="text-center mt-2 mb-4">
                 <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
              </h4>

              <div class="form-group">
                 <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
              </div>
              <div class="form-group text-center mt-4">
                 <button type="button" class="btn btn-primary" id="save_review">Submit</button>
              </div>
            </div>
       </div>
     </div>
</div>
</div>
</div>
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
   $(document).ready(function(){
    var appointmentID = "";
    reviewCheck();
    //when click review the rating will be shown
    var rating_data = 0;

    $('#add_review').click(function(){
        reviewCheck();

        //Not allowed to make review.
        if(appointmentID == ""){
            alert('You are not allowed to make review.');
            return;
        }

        //only the user who's userProfile is 1 can make review
        if("<?=$_SESSION['state']?>" != "1"){ 
            alert('You are not allowed to make review.');
            return;
        }else if("<?=$_SESSION['state']?>" == "1"){
            $('#review_modal').modal('show');
        }else{
            //not logged in
            location.href = "/LoginUi";
        }
        
        $('#review_modal').modal('show');
    });

    $(document).on('mouseenter', '.submit_star', function(){

    var rating = $(this).data('rating');

    reset_background();

    for(var count = 1; count <= rating; count++)
    {

        $('#submit_star_'+count).addClass('text-warning');

    }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

    reset_background();

    for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

    rating_data = $(this).data('rating');

    });
    $('#save_review').click(function(){

    reviewCheck();
    var user_name = "<?=$_SESSION['name']?>";

    var user_review = $('#user_review').val();
    var user_id = "<?=$_GET['name']?>";

    if(appointmentID == ""){
        alert('You are not allowed to make review.');
        return;
        history.back();
    }
    
    if(user_name == '' || user_review == '')
    {
        alert("Please Fill Both Field");
        return false;
    }
    else
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{
                rating_data:rating_data, 
                user_name:user_name, 
                user_review:user_review,
                user_id:user_id,
                appointmentID:appointmentID},
            success:function(data)
            {
                
                $('#review_modal').modal('hide'); 
                $('#user_review').val('');
                //location.reload();

                load_rating_data();
                
                //alert(data);
            }
        })
    }

    });

    load_rating_data();

    function getParameter(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    var name = getParameter("name");
    
    function reviewCheck(){
        appointmentID = "";
        $.ajax({
            url:"submit_rating.php",
            async:false,
            method:"POST",
            data:{
                reviewCheck:'true',
                doctor:"<?=$doctor['name']?>",
                doctorID : "<?=$_GET['name']?>"
                },
            dataType:"html",
            success:function(data)
            {
                appointmentID = data;
            },error : function (jqXHR, textStatus, errorThrown){
                console.log(jqXHR);  //replying message
                console.log(textStatus); //"error"
                console.log(errorThrown);
            }
        });
    }
    
    function load_rating_data()
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{
                action:'load_data',
                userID:"<?=$_GET['name']?>"
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
                        if(data.review_data[count].user_id == name){

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
                console.log(jqXHR);  //replying message
                console.log(textStatus); //"error"
                console.log(errorThrown);
            }
        })
   }
});
</script>