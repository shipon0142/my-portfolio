import { icons } from '../lib/icons.js';

export default function renderContact(data) {
  const { profile, contact } = data;
  return `
    <section id="contact" class="py-24 border-t border-surface-border/40">
      <div class="max-w-content mx-auto px-6">
        <div class="max-w-2xl mx-auto text-center reveal">
          <p class="section-label">07. Contact</p>
          <h2 class="mt-3 section-title">${contact.heading}</h2>
          <p class="mt-4 text-ink-secondary leading-relaxed">${contact.body}</p>
          <a href="mailto:${profile.email}" class="mt-8 inline-flex items-center gap-2 font-mono text-sm bg-brand-cyan text-bg-base rounded px-6 py-3 font-medium hover:bg-brand-cyan/90 transition-colors">
            ${icons.mail}
            ${contact.ctaLabel}
          </a>
        </div>
        <div class="mt-14 grid sm:grid-cols-3 gap-5 max-w-3xl mx-auto">
          <a href="mailto:${profile.email}" class="card card-hover flex items-center gap-3 reveal">
            <span class="text-brand-cyan">${icons.mail}</span>
            <span class="text-sm text-ink-secondary truncate">${profile.email}</span>
          </a>
          <a href="tel:${profile.phone.replace(/\s+/g, '')}" class="card card-hover flex items-center gap-3 reveal">
            <span class="text-brand-cyan">${icons.phone}</span>
            <span class="text-sm text-ink-secondary">${profile.phone}</span>
          </a>
          <div class="card flex items-center gap-3 reveal">
            <span class="text-brand-cyan">${icons.mapPin}</span>
            <span class="text-sm text-ink-secondary">${profile.location}</span>
          </div>
        </div>
      </div>
    </section>
  `;
}
