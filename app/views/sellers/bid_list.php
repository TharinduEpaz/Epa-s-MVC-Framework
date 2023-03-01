<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/bid.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment-timezone-with-data.js';?>"></script>
    <title>Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>

    <div class="container" style="background: none;">
    
        <div class="content">
        <div class="image_likes">
            <div class="image">
                    <div class="grid">
                        <div id="img1" class="img1" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>)">
                        </div>
                        <div class="img2" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>)">    
                            <a style="width: 100%;height:100%; " onclick="change_img1(); return false;" ></a>
                        </div>
                        <div class="img3" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image2;?>)"> 
                            <?php if($data['ad']->image2!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img2(); return false;"></a> 
                            <?php }?>
                        </div>
                        <div class="img4" style="background-image: url(<?php echo URLROOT.'/public/uploads/'.$data['ad']->image3;?>)">   
                            <?php if($data['ad']->image3!=null){?>  
                                <a style="width: 100%;height:100%; " onclick="change_img3(); return false;"></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
        </div>
            <div class="auction_details">
                <h2><?php echo $data['ad']->product_title?></h2>
                <?php
                // $currentTime = date('Y-m-d H:i:s');
                // echo $currentTime;
                ?>
                <!-- <?php
                echo URL().'<br>';
                echo time();
                ?> -->
                <div class="time">
                    <p>Time Left:&nbsp;</p>
                    <p id='remaining_time'></p>
                </div>

                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
                <!-- <?php echo '<pre>'; print_r($data['auctions']); echo '</pre>';?> -->
                <!-- <?php echo $data['auctions'][0]->price;?> -->
                <table>
                    <tr>
                        <th>Place</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Buyer Profile</th>
                    </tr>
                    <?php 
                        if(!empty($data['auctions'])){
                            $i=0;
                            foreach($data['auctions'] as $auction):
                            $i++;
                        
                        echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$data['user'][$i-1]->first_name[0].$data['user'][$i-1]->first_name[1].'****</td>';
                            echo '<td>LKR '.$auction->max_price.'</td>';
                            echo '<td class=\'profile_link\'><a  href=\'' .URLROOT.'/users/getProfile/'.$data['user'][$i-1]->user_id.'\'>Profile</a></td>';
                            if($i<4 && $data['auctions_no_rows']>3 && $auction->is_active==0){
                                if($data['bid_list'][$i-1]!=NULL){
                                    if($data['bid_list'][$i-1]->is_accepted==0 && $data['bid_list'][$i-1]->is_rejected==0){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Email Sent</a></td>';
                                    }else if($data['bid_list'][$i-1]->is_accepted==1){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none ; color:green\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Approved</a></td>';
                                        if($data['bid_list'][$i-1]->feedback_given==0){

                                            echo '<td id=\'feedback\' class=\'feedback\'><a style=\'pointer-events: none ; color:red\' href=\'' .URLROOT.'/sellers/feedback/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Feedback</a></td>';
                                        }
                                        

                                    }else if($data['bid_list'][$i-1]->is_rejected==1){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none; color:red\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Rejected</a></td>';
                                        if($data['bid_list'][$i-1]->feedback_given==0){

                                            echo '<td id=\'feedback\' class=\'feedback\'><a style=\'pointer-events: none ; color:red\' href=\'' .URLROOT.'/sellers/feedback/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Feedback</a></td>';
                                        }

                                    }
                                }else if($data['check']==0){
                                    echo '<td id=\'approve_link\' class=\'aprove\'><a href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$auction->max_price.'/'.$data['user'][$i-1]->first_name.'\'>Approve</a></td>';

                                }else{
                                    echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Approve</a></td>';
                                }
                                
                            }else if($i<3 && $data['auctions_no_rows']=3 && $auction->is_active==0){
                                if($data['bid_list'][$i-1]!=NULL){
                                    if($data['bid_list'][$i-1]->is_accepted==0 && $data['bid_list'][$i-1]->is_rejected==0){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Email Sent</a></td>';
                                    }else if($data['bid_list'][$i-1]->is_accepted==1){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none ; color:green\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Approved</a></td>';
                                        if($data['bid_list'][$i-1]->feedback_given==0){

                                            echo '<td id=\'feedback\' class=\'feedback\'><a style=\'pointer-events: none ; color:red\' href=\'' .URLROOT.'/sellers/feedback/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Feedback</a></td>';
                                        }


                                    }else if($data['bid_list'][$i-1]->is_rejected==1){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none; color:red\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Rejected</a></td>';
                                        if($data['bid_list'][$i-1]->feedback_given==0){

                                            echo '<td id=\'feedback\' class=\'feedback\'><a style=\'pointer-events: none ; color:red\' href=\'' .URLROOT.'/sellers/feedback/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Feedback</a></td>';
                                        }

                                    }
                                }else if($data['check']==0){
                                    echo '<td id=\'approve_link\' class=\'aprove\'><a href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$auction->max_price.'/'.$data['user'][$i-1]->first_name.'\'>Approve</a></td>';

                                }else{
                                    echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Approve</a></td>';
                                }
                                
                            }else if($i<2 && $data['auctions_no_rows']<=2 && $auction->is_active==0){

                                if($data['bid_list'][$i-1]!=NULL ){
                                    echo '<td id=\'approve_link\' class=\'aprove\'>'. date('Y-m-d H:i:s', strtotime($data['bid_list'][$i-1]->time. ' + 5 days')).'</td>';
                                    if($data['bid_list'][$i-1]->is_accepted==0 && $data['bid_list'][$i-1]->is_rejected==0){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Email Sent</a></td>';
                                    }else if($data['bid_list'][$i-1]->is_accepted==1){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none ; color:green\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Approved</a></td>';
                                        if($data['bid_list'][$i-1]->feedback_given==0){

                                            echo '<td id=\'feedback\' class=\'feedback\'><a style=\'pointer-events: none ; color:red\' href=\'' .URLROOT.'/sellers/feedback/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Feedback</a></td>';
                                        }


                                    }else if($data['bid_list'][$i-1]->is_rejected==1){
                                        echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none; color:red\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Rejected</a></td>';
                                        if($data['bid_list'][$i-1]->feedback_given==0){

                                            echo '<td id=\'feedback\' class=\'feedback\'><a style=\'pointer-events: none ; color:red\' href=\'' .URLROOT.'/sellers/feedback/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Feedback</a></td>';
                                        }


                                    }
                                }else if($data['check']==0){
                                    echo '<td id=\'approve_link\' class=\'aprove\'><a href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$auction->max_price.'/'.$data['user'][$i-1]->first_name.'\'>Approve</a></td>';

                                }else{
                                    echo '<td id=\'approve_link\' class=\'aprove\'><a style=\'pointer-events: none\' href=\'' .URLROOT.'/sellers/aprove_bid/'.$data['ad']->product_id.'/'.$auction->max_bid_id.'/'.$auction->email_buyer.'/'.$data['user'][$i-1]->first_name.'\'>Approve</a></td>';
                                }
                            }
                        echo '</tr>';
                        endforeach;
                        }
                    ?>
                </table>
                <div class="add_bid" >
                    <?php
                        if(!empty($data['email_err']) ){
                            echo '<div class="error">';
                                if(!empty($data['email_err'])){
                                    echo '*'.$data['email_err'].'<br>';
                                }
                            echo '</div>';
                        }

                    ?>
                                    
                    <!-- <h1><?php echo $data['ad']->product_id.'/'.$auction->auction_id.'/'.$data['auctions'][0]->price.'/'.$data['ad']->price;?></h1> -->
                    
                    
                        
                </div>
                <?php 
                    if(isLoggedIn()){
                        if($_SESSION['user_email']!=$data['ad']->email){
                            echo '<div class="message_bid">';
                                echo '<div class="message_seller">';
                                echo '<a href="'.URLROOT.'/users/message" class="btn">Message Seller</a>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
        <div class="description" style="margin-top: -2vh;">
            <h3>Description</h3>
            <p><?php echo $data['ad']->p_description?></p>
        </div>
    </div>
</body>
<!-- Display the countdown timer in an element -->


<script>

function change_img1(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['ad']->image1;?>')";
    }
    function change_img2(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['ad']->image2;?>')";
    }
    function change_img3(){
        document.getElementById('img1').style.backgroundImage = "url('<?php echo URLROOT.'/public/uploads/'.$data['ad']->image3;?>')";
    }
                    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
         // Get today's date and time
      var now = moment().tz("Asia/Colombo");
      var milliseconds = now.format('x');

      var end_date=  <?php echo strtotime($data['auction']->end_date);?>
      // Find the distance between now and the count down date
      var distance = end_date*1000 - milliseconds;
    
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
      // Display the result in the element with id="demo"
      document.getElementById("remaining_time").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
    
      // If the count down is finished, write some text
      if (distance < 0) {
          clearInterval(x);
          document.getElementById("remaining_time").innerHTML = "EXPIRED";
          if(<?php echo $data['auction']->is_finished;?>==0){
              window.location.href = "<?php echo URLROOT.'/users/bid_expired/'.$data['ad']->product_id.'/'.$data['auction']->auction_id?>";

         }
      }
    }, 1000);
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>
<!-- Closing the connection