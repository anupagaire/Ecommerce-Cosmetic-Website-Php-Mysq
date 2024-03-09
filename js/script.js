let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});

// for google signin
function onSignIn(googleUser) {
   var profile = googleUser.getBasicProfile();
   // console ma nadekhekhaune so console wala just hatako
   // console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
   // console.log('Name: ' + profile.getName());
   // console.log('Image URL: ' + profile.getImageUrl());
   // console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
   $("#name").text(profile.getName());
   $("#email").text(profile.getEmail());
   $("#image").attr('src', profile.getImageUrl());
   $(".data").css("display", "block");
   $(".g-signin2").css("display", "none");
}

function signOut() {
   var auth2 = gapi.auth2.getAuthInstance();
   auth2.signOut().then(function () {
      // console.log('User signed out.');
      alert("You have signed out succesfully");
      $(".g-signin2").css("display", "block");
      $(".data").css("display", "none");
      
   });
}


// notification toast variables
const notificationToast = document.querySelector('[data-toast]');
const toastCloseBtn = document.querySelector('[data-toast-close]');

// notification toast eventListener
toastCloseBtn.addEventListener('click', function () {
  notificationToast.classList.add('closed');
});
