export default function renderAbout(data) {
  const { about } = data;
  const paragraphs = about.paragraphs
    .map((p) => `<p class="text-ink-secondary leading-relaxed">${p}</p>`)
    .join('');
  const stats = about.stats
    .map(
      (s) => `
      <div class="card text-center">
        <div class="text-3xl font-bold text-brand-cyan">${s.value}</div>
        <div class="mt-1 font-mono text-xs text-ink-muted tracking-widest uppercase">${s.label}</div>
      </div>`
    )
    .join('');

  return `
    <section id="about" class="py-24 border-t border-surface-border/40">
      <div class="max-w-content mx-auto px-6">
        <div class="reveal">
          <p class="section-label">01. About Me</p>
          <h2 class="mt-2 section-title">Who I am</h2>
        </div>
        <div class="mt-8 grid md:grid-cols-3 gap-10">
          <div class="md:col-span-2 space-y-5 reveal">
            ${paragraphs}
          </div>
          <div class="grid grid-cols-2 gap-4 self-start reveal">
            ${stats}
          </div>
        </div>
      </div>
    </section>
  `;
}
