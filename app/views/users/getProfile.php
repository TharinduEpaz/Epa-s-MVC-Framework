<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>

    <div class="container">
        
        <div class="poster_advertisements">
            
            <div class="form-display">
                <div class="top_details">
                    <div class="profile_img">
                        <img src="<?php echo URLROOT . '/public/img/DSC_0863.jpg';?>" alt="Profile Picture">
                    </div>
                    <div class="other_details_profile">
                        <p class="full_name"><?php echo $data['user']->first_name.' '.$data['user']->second_name; ?></p>
                        <div class="stars_date">
                            <div class="stars">
                                <img src="<?php echo URLROOT . '/public/img/stars.png';?>" alt="Profile Picture">
                            </div>
                            <div class="date">
                                <p>Joined : <?php echo date('Y-m-d',strtotime($data['user']->registered_date));; ?></p>
                            </div>
                        </div>
                        <div class="likes_dislikes">
                            <div class="likes">
                            <i class="fas fa-thumbs-up" aria-hidden="true"> : 10</i>
                            </div>
                            <div class="dislikes">
                            <i class="fas fa-thumbs-down"> : 0</i>
                            </div>
                            <div class="flags">
                            <i class="fa-sharp fa-solid fa-flag"> : 0</i>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-data-area">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $data['user']->first_name; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="second_name">Second Name:</label>
                    <input type="text" name="second_name" value="<?php echo $data['user']->second_name; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="<?php echo $data['user']->email; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="address1">Address Line 1:</label>
                    <input type="text" name="address1" value="<?php echo $data['user']->address1; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="address2">Address Line 1:</label>
                    <input type="text" name="address2" value="<?php echo $data['user']->address2; ?>" disabled>
                </div>
                <div class="form-data-area">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo $data['user']->phone_number; ?>" disabled>
                </div>  
            </div> 
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>