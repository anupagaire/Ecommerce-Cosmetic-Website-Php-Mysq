<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Check if user_id is set before executing the query
if ($user_id !== null) {
    $get_notifications = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY timestamp DESC");
    $get_notifications->execute([$user_id]);
    $notifications = $get_notifications->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Handle case when user_id is not set
    $notifications = [];
}
?>

<style>
.notification-dropdown {
 position: absolute;
 top: 60px;
 right: 0;
 width: 250px;
 height: 300px;
 background-color: #fff;
 border: 1px solid #ccc;
 box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
 z-index: 1000;
 padding: 10px;
 overflow: auto;
}
#notification-indicator {
background-color: red; 
font-size: 10px; 
color: white; 
height: 10px; width:10px; 
display:inline-block; 
border-radius: 10px; 
position:absolute; 
margin-left: -13px;
margin-top: 4px;
display: none;
}
#notification-list {
 list-style-type: none;
 padding: 0;
 margin: 0;
}
#notification-list p {
font-size: 14px; 
font-weight:bold; 
border-bottom: 1px solid black; 
padding-bottom: 5px; 
cursor: default;
margin: 0;
}

#notification-list li {
 padding: 5px;
 border-bottom: 1px solid #ccc;
 font-size: 16px;
 font-weight: bold;
}

#notification-list li:last-child {
 border-bottom: none;
}
#notification-list li:hover {
 background-color: #black; /* Change background color on hover */
 cursor: pointer; /* Show pointer cursor on hover */
}
.hidden {
 display: none;
}

</style>

<header class="header">

   <section class="flex">   
      <a href="home.php" class="logo">Cool Cosmetics<span>.</span></a>
      
      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="orders.php">Orders</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         
         <span id="notification-icon" class="notification-icon" onclick="toggleNotifications()">
            <i class="fas fa-bell" ></i>
            <!-- Unread Indicator (Initially hidden) -->
            <span id="notification-indicator" class="notification-indicator hidden"></span>
          </span>

          <div id="notification-dropdown" class="notification-dropdown hidden">
            <ul id="notification-list">
               <p>Notification</p>
               <?php foreach ($notifications as $notification): ?>
                     <li><a href="quick_view.php?pid=<?= $notification['product_id']; ?>"><?= $notification['message']; ?></a></li>
               <?php endforeach; ?>
            </ul>
         </div>
         
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          

            
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var notificationIcon = document.getElementById("notification-icon");
    var notificationDropdown = document.getElementById("notification-dropdown");
    var notificationIndicator = document.getElementById("notification-indicator");

    // Function to check if an element is a descendant of another element
    function isDescendant(parent, child) {
        var node = child.parentNode;
        while (node != null) {
            if (node === parent) {
                return true;
            }
            node = node.parentNode;
        }
        return false;
    }

    // Toggle visibility of notification dropdown when bell icon is clicked
    notificationIcon.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent click event from propagating to document
        notificationDropdown.classList.toggle("hidden");
        // Hide the notification indicator when the bell icon is clicked
        // notificationIndicator.classList.add("hidden");
        notificationIndicator.style.display = "none"; 

    });

    // Hide notification dropdown when clicked outside the dropdown or bell icon
    document.addEventListener("click", function(event) {
        if (!isDescendant(notificationDropdown, event.target) && event.target !== notificationIcon) {
            notificationDropdown.classList.add("hidden");
        }
    });

    
});
// Function to update notification indicator
function updateNotificationIndicator() {
    // Fetch notifications via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_notifications.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var notifications = JSON.parse(xhr.responseText);
                // Toggle notification indicator visibility based on unread notifications
                if (notifications.length > 0) {
                    notificationIndicator.style.display = "inline-block"; // Show the indicator
                } else {
                    notificationIndicator.style.display = "none"; // Hide the indicator
                }
            } else {
                console.error("Failed to fetch notifications");
            }
        }
    };
    xhr.send();
}

// Fetch notifications and update indicator when the page loads
document.addEventListener("DOMContentLoaded", function() {
    updateNotificationIndicator();
});

// Periodically update notification indicator (every 60 seconds)
setInterval(updateNotificationIndicator, 60000);

</script>