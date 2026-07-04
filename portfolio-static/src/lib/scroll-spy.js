export function initScrollSpy(navSelector, sectionSelector) {
  const navLinks = document.querySelectorAll(navSelector);
  const sections = document.querySelectorAll(sectionSelector);

  if (!navLinks.length || !sections.length || !('IntersectionObserver' in window)) return;

  const linkById = new Map();
  navLinks.forEach((link) => {
    const href = link.getAttribute('href') || '';
    const id = href.replace('#', '');
    if (id) linkById.set(id, link);
  });

  const setActive = (id) => {
    navLinks.forEach((l) => {
      l.classList.remove('active');
      l.removeAttribute('aria-current');
    });
    const active = linkById.get(id);
    if (active) {
      active.classList.add('active');
      active.setAttribute('aria-current', 'true');
    }
  };

  const observer = new IntersectionObserver(
    (entries) => {
      const visible = entries
        .filter((e) => e.isIntersecting)
        .sort((a, b) => b.intersectionRatio - a.intersectionRatio);
      if (visible[0]) setActive(visible[0].target.id);
    },
    { threshold: [0.25, 0.5, 0.75], rootMargin: '-80px 0px -40% 0px' }
  );

  sections.forEach((s) => observer.observe(s));
}
