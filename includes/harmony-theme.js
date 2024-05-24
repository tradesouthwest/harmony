/* https://codepen.io/completewebco/pen/Powwxbd */
/* begin Back to Top button  */

  function trackScroll() {
    var scrolled = window.scrollY;
    var coords = document.documentElement.clientHeight;

    if (scrolled > coords) {
      goTopBtn.classList.add('back_to_top-show');
    }
    if (scrolled < coords) {
      goTopBtn.classList.remove('back_to_top-show');
    }
  }

  function backToTop() {
    if (window.scrollY > 0) {
      window.scrollBy(0, -80);
      setTimeout(backToTop, 10);
    }
  }
