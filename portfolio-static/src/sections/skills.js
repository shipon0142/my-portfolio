import { icons } from '../lib/icons.js';

export default function renderSkills(data) {
  const { skills } = data;
  const groups = skills
    .map(
      (g) => `
      <div class="card card-hover reveal">
        <div class="flex items-center gap-2 text-brand-cyan mb-4">
          ${icons.code}
          <h3 class="font-mono text-sm tracking-widest uppercase">${g.group}</h3>
        </div>
        <ul class="flex flex-wrap gap-2">
          ${g.items.map((item) => `<li class="tech-tag">${item}</li>`).join('')}
        </ul>
      </div>`
    )
    .join('');

  return `
    <section id="skills" class="py-24 bg-bg-alt/40 border-t border-surface-border/40">
      <div class="max-w-content mx-auto px-6">
        <div class="reveal">
          <p class="section-label">02. Skills</p>
          <h2 class="mt-2 section-title">What I work with</h2>
        </div>
        <div class="mt-10 grid sm:grid-cols-2 gap-5">
          ${groups}
        </div>
      </div>
    </section>
  `;
}
