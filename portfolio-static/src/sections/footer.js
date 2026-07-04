import { icons } from '../lib/icons.js';

export default function renderFooter(data) {
  const { profile } = data;
  const year = new Date().getFullYear();
  return `
    <footer class="border-t border-surface-border/40 py-10">
      <div class="max-w-content mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="font-mono text-xs text-ink-muted">
          &copy; ${year} ${profile.name}. Built with Vite &amp; Tailwind.
        </p>
        <div class="flex items-center gap-4 text-ink-secondary">
          <a href="${profile.github}" target="_blank" rel="noopener" aria-label="GitHub" class="hover:text-brand-cyan transition-colors">${icons.github}</a>
          <a href="${profile.linkedin}" target="_blank" rel="noopener" aria-label="LinkedIn" class="hover:text-brand-cyan transition-colors">${icons.linkedin}</a>
          <a href="mailto:${profile.email}" aria-label="Email" class="hover:text-brand-cyan transition-colors">${icons.mail}</a>
        </div>
      </div>
    </footer>
  `;
}
