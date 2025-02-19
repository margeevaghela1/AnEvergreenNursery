let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');
let header = document.querySelector('.header-3');
let scrollTop = document.querySelector('.scroll-top');

menu.addEventListener('click',() =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});

window.onscroll = () =>{

    menu.classList.remove('fa-times');
    navbar.classList.remove('active');

    if(window.scrollY > 250){
        header.classList.add('active');
    }else{
        header.classList.remove('active');
    }

    if(window.scrollY > 250){
        scrollTop.style.display = 'initial';
    }else{
        scrollTop.style.display = 'none';
    }

}

var swiper = new Swiper(".home-slider", {
    pagination: {
      el: ".swiper-pagination",
      dynamicBullets: true,
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      loop: true,
  });

  var profileBtn = document.getElementById('profileBtn');
  var popup = document.getElementById('popup');
  
  profileBtn.addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent the event from bubbling up to the document
    if (popup.style.display === 'none') {
      popup.style.display = 'block';
      document.addEventListener('click', closePopupOutside);
    } else {
      popup.style.display = 'none';
      document.removeEventListener('click', closePopupOutside);
    }
  });
  
  function closePopupOutside(event) {
    if (!popup.contains(event.target) && event.target !== profileBtn) {
      popup.style.display = 'none';
      document.removeEventListener('click', closePopupOutside);
    }
  }
  