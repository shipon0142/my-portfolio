import { icons } from '../lib/icons.js';

export default function renderHero(data) {
  const { profile } = data;
  return `
    <section id="hero" class="relative pt-32 pb-24 md:pt-40 md:pb-32">
      <div class="max-w-content mx-auto px-6">
        <p class="section-label reveal">Hi, my name is</p>
        <h1 class="mt-4 text-5xl md:text-7xl font-extrabold tracking-tight text-ink-primary reveal">
          ${profile.name}.
        </h1>
        <h2 class="mt-3 text-3xl md:text-5xl font-bold text-ink-secondary tracking-tight reveal">
          I build mobile apps.
        </h2>
        <p class="mt-6 max-w-2xl text-lg text-ink-secondary leading-relaxed reveal">
          I&rsquo;m a <span class="text-brand-cyan">${profile.title}</span> based in
          <span class="text-brand-cyan">${profile.location}</span>. ${profile.tagline}
        </p>
        <div class="mt-10 flex flex-wrap items-center gap-4 reveal">
          <a href="#projects" class="inline-flex items-center gap-2 font-mono text-sm bg-brand-cyan text-bg-base rounded px-5 py-3 font-medium hover:bg-brand-cyan/90 transition-colors">
            View Projects
            ${icons.arrowDown}
          </a>
          <a href="${profile.cvUrl}" download class="inline-flex items-center gap-2 font-mono text-sm text-brand-cyan border border-brand-cyan/40 hover:bg-brand-cyan/10 rounded px-5 py-3 transition-colors">
            ${icons.download}
            Download CV
          </a>
          <div class="flex items-center gap-3 ml-2 text-ink-secondary">
            <a href="${profile.github}" target="_blank" rel="noopener" aria-label="GitHub" class="hover:text-brand-cyan transition-colors">${icons.github}</a>
            <a href="${profile.linkedin}" target="_blank" rel="noopener" aria-label="LinkedIn" class="hover:text-brand-cyan transition-colors">${icons.linkedin}</a>
            <a href="mailto:${profile.email}" aria-label="Email" class="hover:text-brand-cyan transition-colors">${icons.mail}</a>
          </div>
        </div>
      </div>
    </section>
  `;
}
