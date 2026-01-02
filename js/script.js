let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}

// Function to update cart count on page load
function updateCartCountOnLoad() {
   const xhr = new XMLHttpRequest();
   xhr.open('GET', 'ajax_action.php?action=get_cart_count', true);
   
   xhr.onload = function () {
      if (xhr.status === 200) {
         try {
            const response = JSON.parse(xhr.responseText);
            const cartCountElements = document.querySelectorAll('.cart-count');
            cartCountElements.forEach(element => {
               element.textContent = response.count;
            });
         } catch (e) {
            console.error('Error updating cart count on load:', e);
         }
      }
   };
   
   xhr.send();
}

// Update cart count when page loads
document.addEventListener('DOMContentLoaded', function() {
   updateCartCountOnLoad();
});