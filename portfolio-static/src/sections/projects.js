import { icons } from '../lib/icons.js';

export default function renderProjects(data) {
  const { projects } = data;
  const cards = projects
    .map((p) => {
      const statusBadge =
        p.status === 'live'
          ? '<span class="inline-flex items-center gap-1.5 text-xs font-mono text-brand-emerald"><span class="w-1.5 h-1.5 rounded-full bg-brand-emerald"></span>Live</span>'
          : '<span class="inline-flex items-center gap-1.5 text-xs font-mono text-ink-muted"><span class="w-1.5 h-1.5 rounded-full bg-ink-muted"></span>Legacy</span>';

      const link = p.link
        ? `<a href="${p.link}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm text-brand-cyan hover:underline">${icons.externalLink}<span>${p.linkLabel}</span></a>`
        : `<span class="text-sm text-ink-muted font-mono">No public link</span>`;

      return `
        <article class="card card-hover reveal flex flex-col h-full">
          <div class="flex items-start justify-between gap-4">
            <h3 class="text-xl font-semibold text-ink-primary">${p.name}</h3>
            ${statusBadge}
          </div>
          <p class="mt-3 text-ink-secondary leading-relaxed flex-1">${p.tagline}</p>
          <ul class="mt-4 flex flex-wrap gap-2">
            ${p.tech.map((t) => `<li class="tech-tag">${t}</li>`).join('')}
          </ul>
          <div class="mt-5 pt-4 border-t border-surface-border">${link}</div>
        </article>`;
    })
    .join('');

  return `
    <section id="projects" class="py-24 border-t border-surface-border/40">
      <div class="max-w-content mx-auto px-6">
        <div class="reveal">
          <p class="section-label">03. Featured Projects</p>
          <h2 class="mt-2 section-title">Apps I&rsquo;ve shipped</h2>
        </div>
        <div class="mt-10 grid md:grid-cols-2 gap-5">
          ${cards}
        </div>
      </div>
    </section>
  `;
}
