function StickyHeader(el) {
  return (function Follow() {
    el.className += ' js-sticky';
    el.style.position = 'absolute';
    el.style.top = '0px';
    document.body.style.paddingTop = el.offsetHeight + 'px';

    var prevY = 0;
    var height = 0;
    var fixed = true;

    function moveFollow(scrollY) {
      // Math
      var delta = prevY - scrollY;
      prevY = scrollY;
      height = Math.max(0, Math.min(el.offsetHeight, height - delta));
      // Scrolling down
      if (delta < 0) {
        // Manually tune scrolling position
        el.style.position = 'absolute';
        el.style.top = (prevY - height) + 'px';
        fixed = false;
      // Scrolling up
      } else if (!fixed && height < delta) {
        // Should we pin to top?
        el.style.position = 'fixed';
        el.style.top = '0px';
        fixed = true;
      }
    }

    var last_known_scroll_position = 0;
    var ticking = 0;
    window.addEventListener('scroll', function(e) {
      last_known_scroll_position = window.scrollY < 0 ? 0 : window.scrollY;
      if (!ticking) {
        window.requestAnimationFrame(function() {
          moveFollow(last_known_scroll_position);
          ticking = false;
        });
      }
      ticking = true;
    }, { passive: true });
  }());
}

$(document).ready(function() {
  StickyHeader(document.querySelector('header'));
});
