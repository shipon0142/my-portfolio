import { icons } from '../lib/icons.js';

export default function renderNav(data) {
  const { profile, nav } = data;
  const links = nav
    .map(
      (item) => `
      <a href="#${item.id}" class="nav-link">
        <span class="text-brand-cyan/70 mr-1">${item.num}.</span>${item.label}
      </a>`
    )
    .join('');

  const mobileLinks = nav
    .map(
      (item) => `
      <a href="#${item.id}" class="nav-link block py-3 border-b border-surface-border" data-mobile-link>
        <span class="text-brand-cyan/70 mr-2">${item.num}.</span>${item.label}
      </a>`
    )
    .join('');

  return `
    <header class="fixed top-0 inset-x-0 z-40 bg-bg-base/70 backdrop-blur border-b border-surface-border/50">
      <nav class="max-w-content mx-auto px-6 h-16 flex items-center justify-between" aria-label="Primary">
        <a href="#top" class="font-mono font-bold text-brand-cyan tracking-widest" aria-label="${profile.name} — home">
          &lt;${profile.initials}/&gt;
        </a>
        <div class="hidden md:flex items-center gap-7">
          ${links}
          <a href="${profile.cvUrl}" download class="ml-2 inline-flex items-center gap-2 font-mono text-sm text-brand-cyan border border-brand-cyan/40 hover:bg-brand-cyan/10 rounded px-3 py-1.5 transition-colors">
            ${icons.download}
            <span>Resume</span>
          </a>
        </div>
        <button type="button" class="md:hidden text-ink-primary" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu" data-menu-toggle>
          ${icons.menu}
        </button>
      </nav>
      <div id="mobile-menu" class="md:hidden hidden bg-bg-base border-t border-surface-border" data-mobile-menu>
        <div class="px-6 py-4">
          ${mobileLinks}
          <a href="${profile.cvUrl}" download class="mt-4 inline-flex items-center gap-2 font-mono text-sm text-brand-cyan border border-brand-cyan/40 rounded px-3 py-2">
            ${icons.download}
            <span>Download Resume</span>
          </a>
        </div>
      </div>
    </header>
    <div id="top"></div>
  `;
}
