/**
 * Stats block: ProgressBar.js circles with count-up animation.
 * Animates when each stats circle scrolls into view (Intersection Observer).
 * - If data-percentage="true": circle fills to value% and text counts 0 → value (with %).
 * - Otherwise: circle fills fully and text counts 0 → value.
 */
import ProgressBar from 'progressbar.js';

function animateStatsCircle(wrapper) {
  const value = parseInt(wrapper.getAttribute('data-value'), 10);
  const isPercentage = wrapper.getAttribute('data-percentage') === 'true';
  if (isNaN(value) || value < 0) return;

  const circleEl = wrapper.querySelector('.stats-circle-container');
  const textEl = wrapper.querySelector('.stats-circle-value');
  if (!circleEl) return;

  const progressToAnimate = isPercentage ? value / 100 : 1;
  const maxDisplay = isPercentage ? 100 : value;
  const suffix = isPercentage ? '%' : '';

  const bar = new ProgressBar.Circle(circleEl, {
    color: 'var(--color-primary)',
    trailColor: 'var(--color-light)',
    trailWidth: 4,
    strokeWidth: 6,
    duration: 1600,
    easing: 'easeInOut',
    step: (state, circle) => {
      const v = circle.value();
      const display = Math.round(v * maxDisplay);
      if (textEl) textEl.textContent = display + suffix;
    },
  });

  bar.set(0);
  if (textEl) textEl.textContent = '0' + suffix;

  bar.animate(progressToAnimate, {
    duration: 1600,
    easing: 'easeInOut',
    step: (state, circle) => {
      const v = circle.value();
      const display = Math.round(v * maxDisplay);
      if (textEl) textEl.textContent = display + suffix;
    },
  });
}

function initStatsCircles() {
  const containers = document.querySelectorAll('.stats-block [data-stats-circle]');
  if (!containers.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const wrapper = entry.target;
        if (wrapper.hasAttribute('data-stats-animated')) return;
        wrapper.setAttribute('data-stats-animated', 'true');
        observer.unobserve(wrapper);
        animateStatsCircle(wrapper);
      });
    },
    {
      root: null,
      rootMargin: '0px 0px -40px 0px',
      threshold: 0.1,
    }
  );

  containers.forEach((wrapper) => observer.observe(wrapper));
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initStatsCircles);
} else {
  initStatsCircles();
}
