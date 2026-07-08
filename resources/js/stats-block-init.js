/**
 * Stats block: ProgressBar.js circles with count-up animation.
 * Requires progressbar.js to be loaded first (sets window.ProgressBar).
 * Animates when each stats circle scrolls into view (Intersection Observer).
 * - If data-percentage="true": circle fills to value% and text counts 0 → value (with %).
 * - Otherwise: circle fills fully and text counts 0 → value.
 */
(function () {
  function animateStatsCircle(wrapper) {
    if (typeof window.ProgressBar === 'undefined') return;

    var value = parseInt(wrapper.getAttribute('data-value'), 10);
    var isPercentage = wrapper.getAttribute('data-percentage') === 'true';
    if (isNaN(value) || value < 0) return;

    var circleEl = wrapper.querySelector('.stats-circle-container');
    var textEl = wrapper.querySelector('.stats-circle-value');
    if (!circleEl) return;

    var progressToAnimate = isPercentage ? value / 100 : 1;
    var maxDisplay = isPercentage ? 100 : value;
    var suffix = isPercentage ? '%' : '';

    var bar = new window.ProgressBar.Circle(circleEl, {
      color: 'var(--color-primary)',
      trailColor: 'var(--color-dark)',
      trailWidth: 4,
      strokeWidth: 10,
      duration: 1600,
      easing: 'easeInOut',
      step: function (state, circle) {
        var v = circle.value();
        var display = Math.round(v * maxDisplay);
        if (textEl) textEl.textContent = display + suffix;
      },
    });

    bar.set(0);
    if (textEl) textEl.textContent = '0' + suffix;

    bar.animate(progressToAnimate, {
      duration: 1600,
      easing: 'easeInOut',
      step: function (state, circle) {
        var v = circle.value();
        var display = Math.round(v * maxDisplay);
        if (textEl) textEl.textContent = display + suffix;
      },
    });
  }

  function initStatsCircles() {
    var containers = document.querySelectorAll('.stats-block [data-stats-circle]');
    if (!containers.length) return;

    var hasBeenOutOfView = new WeakSet();
    var inViewOnLoad = [];

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          var wrapper = entry.target;
          if (wrapper.hasAttribute('data-stats-animated')) return;

          if (!entry.isIntersecting) {
            hasBeenOutOfView.add(wrapper);
            return;
          }

          // Animate only when element has *scrolled into* view (was out, now in).
          // If it's already in view on first check, record it and animate after a delay below.
          if (hasBeenOutOfView.has(wrapper)) {
            wrapper.setAttribute('data-stats-animated', 'true');
            observer.unobserve(wrapper);
            animateStatsCircle(wrapper);
          } else {
            inViewOnLoad.push(wrapper);
          }
        });
      },
      {
        root: null,
        rootMargin: '0px',
        threshold: 0.1,
      }
    );

    containers.forEach(function (wrapper) {
      observer.observe(wrapper);
    });

    // Elements already in view on load: animate after a short delay so we don't run before paint.
    setTimeout(function () {
      inViewOnLoad.forEach(function (wrapper) {
        if (wrapper.hasAttribute('data-stats-animated')) return;
        wrapper.setAttribute('data-stats-animated', 'true');
        observer.unobserve(wrapper);
        animateStatsCircle(wrapper);
      });
    }, 100);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initStatsCircles);
  } else {
    initStatsCircles();
  }
})();
