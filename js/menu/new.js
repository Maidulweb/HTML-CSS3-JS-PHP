var nav = document.getElementById('nav');
var open = document.getElementById('open_menu');
var close = document.getElementById('close_menu');

open.addEventListener("click", function() {
    nav.style.left = '0px';
    open.style.display = 'none';
});
close.addEventListener("click", function() {
    nav.style.left = '-250px';
    open.style.display = 'block';
});