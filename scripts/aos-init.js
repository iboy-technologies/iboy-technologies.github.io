// Initialize AOS and add optional 3D interactions
// Usage:
// - Add `data-aos-3d` to any element you want to receive the 3D effect (in addition to the existing `data-aos` attribute).
// - Example: <div data-aos="fade-up" data-aos-3d>...</div>

document.addEventListener('DOMContentLoaded', function () {
  if (typeof AOS === 'undefined') {
    console.warn('AOS not found — ensure AOS script is loaded before aos-init.js');
    return;
  }

  AOS.init({
    duration: 800,
    easing: 'cubic-bezier(.22,.9,.27,1)',
    once: true,
    mirror: false
  });

  // Mark elements with the data attribute so CSS can target them
  document.querySelectorAll('[data-aos-3d]').forEach(function (el) {
    el.classList.add('aos-3d');
  });

  // Subtle interactive tilt while the element is hovered — only for desktop-ish pointer devices
  function isPointerFine() {
    return window.matchMedia && window.matchMedia('(pointer:fine)').matches;
  }

  if (isPointerFine()) {
    document.querySelectorAll('.aos-3d').forEach(function (el) {
      // Ensure the element has transform-style set via CSS, but set a fallback here
      el.style.transformStyle = el.style.transformStyle || 'preserve-3d';

      var handleMouse = function (e) {
        var rect = el.getBoundingClientRect();
        var x = (e.clientX - rect.left) / rect.width;
        var y = (e.clientY - rect.top) / rect.height;
        var rotateY = (x - 0.5) * 10; // range approx -5..5
        var rotateX = (0.5 - y) * 10;
        // Only apply subtle transform while element is visible (AOS will add .aos-animate)
        if (el.classList.contains('aos-animate')) {
          el.style.transform = 'perspective(900px) translateZ(0) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg)';
        }
      };

      var handleLeave = function () {
        el.style.transform = '';
      };

      el.addEventListener('mousemove', handleMouse);
      el.addEventListener('mouseleave', handleLeave);

      // When AOS triggers the element into view, ensure any inline transform is reset so the CSS animation can run
      el.addEventListener('aos:in', function () {
        el.style.transform = '';
      });
    });
  }

  // Optional: add a listener so newly added elements with the attribute (e.g., via SPA routing) get the class
  var mo = new MutationObserver(function (mutations) {
    mutations.forEach(function (m) {
      m.addedNodes.forEach(function (n) {
        if (n.nodeType === 1 && n.hasAttribute && n.hasAttribute('data-aos-3d')) {
          n.classList.add('aos-3d');
        }
        if (n.querySelectorAll) {
          n.querySelectorAll('[data-aos-3d]').forEach(function (el) { el.classList.add('aos-3d'); });
        }
      });
    });
  });
  mo.observe(document.body, { childList: true, subtree: true });
});
