import { icons } from '../lib/icons.js';

export default function renderEducation(data) {
  const { education } = data;
  const items = education
    .map(
      (e) => `
      <div class="card card-hover reveal">
        <div class="flex items-start gap-3">
          <div class="text-brand-cyan mt-0.5">${icons.graduation}</div>
          <div class="flex-1">
            <h3 class="text-lg font-semibold text-ink-primary">${e.school}</h3>
            <p class="text-ink-secondary">${e.degree}</p>
            <p class="mt-2 font-mono text-xs text-ink-muted tracking-wide">${e.period} · ${e.location}</p>
          </div>
        </div>
      </div>`
    )
    .join('');

  return `
    <section id="education" class="py-24 border-t border-surface-border/40">
      <div class="max-w-content mx-auto px-6">
        <div class="reveal">
          <p class="section-label">05. Education</p>
          <h2 class="mt-2 section-title">Where I studied</h2>
        </div>
        <div class="mt-10 grid md:grid-cols-3 gap-5">
          ${items}
        </div>
      </div>
    </section>
  `;
}
