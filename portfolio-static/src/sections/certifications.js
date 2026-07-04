import { icons } from '../lib/icons.js';

export default function renderCertifications(data) {
  const { certifications } = data;
  const items = certifications
    .map(
      (c) => `
      <div class="card card-hover reveal">
        <div class="flex items-start gap-3">
          <div class="text-brand-cyan mt-0.5">${icons.award}</div>
          <div class="flex-1">
            <p class="font-mono text-xs uppercase tracking-widest text-ink-muted">${c.type}</p>
            <h3 class="mt-1 text-lg font-semibold text-ink-primary">${c.name}</h3>
            <p class="mt-1 text-ink-secondary">${c.issuer}</p>
          </div>
        </div>
      </div>`
    )
    .join('');

  return `
    <section id="certifications" class="py-24 bg-bg-alt/40 border-t border-surface-border/40">
      <div class="max-w-content mx-auto px-6">
        <div class="reveal">
          <p class="section-label">06. Certifications</p>
          <h2 class="mt-2 section-title">Credentials</h2>
        </div>
        <div class="mt-10 grid md:grid-cols-2 gap-5 max-w-3xl">
          ${items}
        </div>
      </div>
    </section>
  `;
}
