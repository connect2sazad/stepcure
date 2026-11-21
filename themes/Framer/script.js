const scrollContent = document.querySelector('.scroll-content');
const sections = document.querySelectorAll('.section');
const scrollThumb = document.querySelector('.scroll-thumb');
const scrollLabel = document.querySelector('.scroll-label');

// Snap scrolling
let isScrolling = false;
scrollContent.addEventListener('wheel', e => {
  if (isScrolling) return;
  e.preventDefault();

  const delta = e.deltaY;
  const currentScroll = scrollContent.scrollTop;
  const sectionHeight = scrollContent.clientHeight;

  let index = [...sections].findIndex(section =>
    currentScroll < section.offsetTop + section.offsetHeight / 2
  );

  if (delta > 0 && index < sections.length - 1) index++;
  else if (delta < 0 && index > 0) index--;

  const target = sections[index];
  isScrolling = true;
  scrollContent.scrollTo({ top: target.offsetTop, behavior: 'smooth' });

  setTimeout(() => isScrolling = false, 800);
});

// Update scroll label & thumb
function updateScrollEffects() {
  const scrollTop = scrollContent.scrollTop;
  const maxScroll = scrollContent.scrollHeight - scrollContent.clientHeight;
  const percent = scrollTop / maxScroll;
  const thumbTop = percent * (scrollContent.clientHeight - scrollThumb.clientHeight);
  scrollThumb.style.top = `${thumbTop}px`;

  let currentSection = sections[0].dataset.title;
  sections.forEach(section => {
    if (scrollTop >= section.offsetTop - section.offsetHeight / 2) {
      currentSection = section.dataset.title;
    }
  });
  scrollLabel.textContent = currentSection;

  requestAnimationFrame(updateScrollEffects);
}
requestAnimationFrame(updateScrollEffects);

// Trigger animation on scroll
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    const cols = entry.target.querySelectorAll('.cube-col');
    cols.forEach(col => {
      if (entry.isIntersecting) {
        col.classList.add('animate');
      } else {
        col.classList.remove('animate');
      }
    });
  });
}, {
  root: scrollContent,
  threshold: 0.3
});

sections.forEach(section => observer.observe(section));
