function toggleMenu() {
    document.getElementById('siteNav').classList.toggle('show');
  }
  

window.addEventListener('scroll', function () {
    const header = document.querySelector('header');
    header.classList.toggle('scrolled', window.scrollY > 0);
});
