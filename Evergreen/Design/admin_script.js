let nav_bar = document.querySelector('.header .flex .nav_bar');

document.querySelector('#menu-btn').onclick = () =>{
    nav_bar.classList.toggle('active');
    profile.classList.remove('active');
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    nav_bar.classList.remove('active');
}

window.onscroll = () =>{
    profile.classList.remove('active');
    nav_bar.classList.remove('active');
}