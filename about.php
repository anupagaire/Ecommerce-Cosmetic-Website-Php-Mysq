<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
  .center {
    margin: auto;
    width: 50%;
    padding: 10px;
    text-align: center;
  }
.center hr {
    position: relative;
    border: none;
    height: 5px;
    background: black;
    width: 100%;
}
 .center .large{
    font-family:  Times, serif;
    font-size :70px;
}
 .center .medium{
    font-family: 'Times New Roman', Times, serif;
    font-size :30px;
} 
 .center .small{
    font-family: 'Times New Roman';
    font-size :20px;
} 
.heading{
    font-family:'Times New Roman';
    font-size :27px;
}
.name{
    font-family:'Times New Roman', Times, serif;
    font-size :20px;
}
.photo img{
    width: 300px;
    }
    .row
{
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  margin-bottom: 80px;
}

.space{
   height:10vh;
}


 
</style>


</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="space" ></div>
<main>
  <div class="center">
  <strong class="large"> COOL COSMETICS</strong> <br>
    <strong class="medium">COSMETICS SHOPPING CENTER </strong><br>
    <strong class="small">Beauty and beauty products</strong> <br>
    <hr>
</div>


<hr>
<div class="center heading">
   <strong> My Teams </strong>
</div>
<div class="row">

    <div class="name list pic">
        <div class="heading">Member</div><br>
        <img src="images\770304.jpg" alt="Team(Anupa Gaire)"><br>
       <h2> Anupa Gaire</h2>
    </div>
    <div class="name list pic">
        <div class="heading">Member</div><br>
        <img src="images\770332.jpg" alt="Team(Rohisha Shrestha)"><br>
        <h2>Rohisha Shrestha</h2>
    </div>

    <div class="name list pic">
        <div class="heading">Member</div><br>
        <img src="images\770334.jpg" alt="Team(Rosha Prajapati)"><br>
       <h2> Rosha Prajapati</h2>
    </div>

    <div class="name list pic">
        <div class="heading">Member</div><br>
        <img src="images\770343.jpg" alt="Team(Shristi Yakami)"><br>
       <h2> Shristi Yakami</h2>
    </div>
</div>
<hr>

 

</main>



<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>Our Mission</h3>
         <p >Our Mission Is To Provide Our Customers With A Seamless And Convenient Shopping Experience For Beauty and beauty Products, While Saving Them Time In The Process. We Aim To Achieve This Mission By Offering A User-Friendly Website That Allows Customers To Easily Browse And Purchase Cosmetic Product, As Well As Providing Efficient And Reliable Delivery Options.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>