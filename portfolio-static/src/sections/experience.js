import { icons } from '../lib/icons.js';

export default function renderExperience(data) {
  const { experience } = data;
  const entries = experience
    .map((e) => {
      const badge = e.current
        ? '<span class="inline-flex items-center gap-1.5 text-xs font-mono text-brand-emerald"><span class="w-1.5 h-1.5 rounded-full bg-brand-emerald animate-pulse"></span>Present</span>'
        : '';
      return `
        <article class="relative pl-8 pb-10 border-l border-surface-border last:pb-0 reveal">
          <span class="absolute -left-[7px] top-1.5 w-3.5 h-3.5 rounded-full bg-bg-base border-2 border-brand-cyan"></span>
          <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
            <h3 class="text-lg font-semibold text-ink-primary">${e.role}</h3>
            <span class="text-brand-cyan">@ ${e.company}</span>
            ${badge}
          </div>
          <p class="mt-1 font-mono text-xs text-ink-muted tracking-wide">${e.period} · ${e.location}</p>
          <ul class="mt-3 space-y-2 text-ink-secondary leading-relaxed">
            ${e.bullets
              .map(
                (b) => `
              <li class="flex gap-2">
                <span class="text-brand-cyan mt-1.5 flex-shrink-0">▸</span>
                <span>${b}</span>
              </li>`
              )
              .join('')}
          </ul>
        </article>`;
    })
    .join('');

  return `
    <section id="experience" class="py-24 bg-bg-alt/40 border-t border-surface-border/40">
      <div class="max-w-content mx-auto px-6">
        <div class="reveal">
          <p class="section-label">04. Experience</p>
          <h2 class="mt-2 section-title">Where I&rsquo;ve worked</h2>
        </div>
        <div class="mt-10 max-w-3xl">
          ${entries}
        </div>
      </div>
    </section>
  `;
}
