# Portfolio Static Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build a standalone Vite + Tailwind static portfolio site for Shipon Sarder inside `portfolio-static/` — single-page, 8 sections, dark tech theme, all content from CV.

**Architecture:** Vanilla JS (ES modules). Each section is a pure `render(data)` function returning HTML strings. `main.js` concatenates section output into `#app`. IntersectionObserver powers scroll-spy nav and fade-up reveal. Zero framework, zero backend.

**Tech Stack:** Vite 5, Tailwind CSS 3, PostCSS, Autoprefixer, @fontsource/inter, @fontsource/jetbrains-mono, lucide icons (SVG strings inline).

**Spec:** `docs/superpowers/specs/2026-07-05-portfolio-static-design.md`

---

## Task 1: Project Scaffolding

**Files:**
- Create: `portfolio-static/.gitignore`
- Create: `portfolio-static/package.json`
- Create: `portfolio-static/vite.config.js`
- Create: `portfolio-static/postcss.config.js`
- Create: `portfolio-static/tailwind.config.js`
- Create: `portfolio-static/index.html`
- Create: `portfolio-static/src/style.css`
- Create: `portfolio-static/src/main.js`

- [ ] **Step 1: Create `.gitignore`**

```
node_modules
dist
.DS_Store
*.log
.vite
```

- [ ] **Step 2: Create `package.json`**

```json
{
  "name": "portfolio-static",
  "private": true,
  "version": "1.0.0",
  "type": "module",
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  },
  "devDependencies": {
    "autoprefixer": "^10.4.20",
    "postcss": "^8.4.47",
    "tailwindcss": "^3.4.13",
    "vite": "^5.4.8"
  },
  "dependencies": {
    "@fontsource/inter": "^5.1.0",
    "@fontsource/jetbrains-mono": "^5.1.1"
  }
}
```

- [ ] **Step 3: Create `vite.config.js`**

```js
import { defineConfig } from 'vite';

export default defineConfig({
  root: '.',
  base: './',
  build: {
    outDir: 'dist',
    emptyOutDir: true,
  },
  server: {
    port: 5173,
    open: true,
  },
});
```

- [ ] **Step 4: Create `postcss.config.js`**

```js
export default {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
};
```

- [ ] **Step 5: Create `tailwind.config.js`**

```js
/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,html}'],
  theme: {
    extend: {
      colors: {
        bg: {
          base: '#0a0e1a',
          alt: '#0f172a',
        },
        surface: {
          DEFAULT: '#111827',
          border: '#1f2937',
        },
        ink: {
          primary: '#e5e7eb',
          secondary: '#94a3b8',
          muted: '#64748b',
        },
        brand: {
          cyan: '#22d3ee',
          emerald: '#10b981',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
      },
      maxWidth: {
        content: '72rem',
      },
    },
  },
  plugins: [],
};
```

- [ ] **Step 6: Create `index.html`**

```html
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Shipon Sarder — Mobile Application Developer with 5+ years of Android and Flutter experience." />
    <title>Shipon Sarder — Mobile Application Developer</title>
  </head>
  <body class="bg-bg-base text-ink-primary font-sans antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:bg-brand-cyan focus:text-bg-base focus:px-3 focus:py-2 focus:rounded">Skip to content</a>
    <div id="app"></div>
    <script type="module" src="/src/main.js"></script>
  </body>
</html>
```

- [ ] **Step 7: Create `src/style.css`**

```css
@import '@fontsource/inter/400.css';
@import '@fontsource/inter/500.css';
@import '@fontsource/inter/600.css';
@import '@fontsource/inter/700.css';
@import '@fontsource/inter/800.css';
@import '@fontsource/jetbrains-mono/400.css';
@import '@fontsource/jetbrains-mono/500.css';

@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
  html {
    scroll-behavior: smooth;
  }
  body {
    background:
      radial-gradient(circle at 20% 0%, rgba(34, 211, 238, 0.06), transparent 40%),
      radial-gradient(circle at 80% 40%, rgba(16, 185, 129, 0.04), transparent 40%),
      #0a0e1a;
    min-height: 100vh;
  }
  :focus-visible {
    outline: 2px solid #22d3ee;
    outline-offset: 2px;
    border-radius: 4px;
  }
}

@layer components {
  .section-label {
    @apply font-mono text-xs tracking-widest text-brand-cyan uppercase;
  }
  .section-title {
    @apply text-3xl md:text-4xl font-bold text-ink-primary tracking-tight;
  }
  .card {
    @apply bg-surface border border-surface-border rounded-xl p-6 transition-all duration-300;
  }
  .card-hover {
    @apply hover:-translate-y-1 hover:border-brand-cyan/50 hover:shadow-lg hover:shadow-brand-cyan/5;
  }
  .tech-tag {
    @apply inline-block font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary;
  }
  .nav-link {
    @apply font-mono text-sm text-ink-secondary hover:text-brand-cyan transition-colors;
  }
  .nav-link.active {
    @apply text-brand-cyan;
  }
  .reveal {
    opacity: 0;
    transform: translateY(1rem);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
  }
  .reveal.revealed {
    opacity: 1;
    transform: translateY(0);
  }
  @media (prefers-reduced-motion: reduce) {
    .reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }
    html {
      scroll-behavior: auto;
    }
  }
}
```

- [ ] **Step 8: Create stub `src/main.js`**

```js
import './style.css';

const app = document.getElementById('app');
app.innerHTML = '<div class="p-8">Portfolio loading...</div>';
```

- [ ] **Step 9: Install dependencies and verify dev server**

Run: `cd portfolio-static && npm install`
Expected: no errors, node_modules created.

Run: `cd portfolio-static && npm run dev` (start, then Ctrl+C)
Expected: server starts on port 5173, shows "Portfolio loading..." in browser.

- [ ] **Step 10: Commit**

```bash
git add portfolio-static/.gitignore portfolio-static/package.json portfolio-static/package-lock.json portfolio-static/vite.config.js portfolio-static/postcss.config.js portfolio-static/tailwind.config.js portfolio-static/index.html portfolio-static/src/style.css portfolio-static/src/main.js
git commit -m "feat(portfolio-static): scaffold Vite + Tailwind project"
```

---

## Task 2: Content Data Module

**Files:**
- Create: `portfolio-static/src/data.js`

- [ ] **Step 1: Create `src/data.js` with all CV content**

```js
export const portfolioData = {
  profile: {
    name: 'Shipon Sarder',
    title: 'Mobile Application Developer',
    tagline: '5+ years building performant, maintainable Android & Flutter apps used by 100K+ people.',
    location: 'Dhaka, 1216 Bangladesh',
    email: 'shipon0142@gmail.com',
    phone: '+8801925727000',
    github: 'https://github.com/shipon0142',
    linkedin: 'https://linkedin.com/in/shipon-sarder-900727102',
    cvUrl: '/Shipon_Sarder_CV.pdf',
    initials: 'SS',
  },

  nav: [
    { id: 'about', label: 'About', num: '01' },
    { id: 'skills', label: 'Skills', num: '02' },
    { id: 'projects', label: 'Projects', num: '03' },
    { id: 'experience', label: 'Experience', num: '04' },
    { id: 'education', label: 'Education', num: '05' },
    { id: 'certifications', label: 'Certifications', num: '06' },
    { id: 'contact', label: 'Contact', num: '07' },
  ],

  about: {
    paragraphs: [
      'I build mobile applications that people actually use every day. Over the last 5 years I have shipped native Android apps and cross-platform Flutter apps for eCommerce, education, and productivity — with a strong focus on performance, clean architecture, and code that other engineers can maintain long after I ship it.',
      'Most recently I led a cross-functional team of 9 at Envobyte, working with Cloud Vision and ML Kit. Before that, I helped grow a cross-border eCommerce app to 100K+ installs in its first 3 months. I care about mentoring, code reviews, and CI/CD that catches problems before users do.',
    ],
    stats: [
      { value: '5+', label: 'Years Experience' },
      { value: '100K+', label: 'Installs Shipped' },
      { value: '4', label: 'Companies' },
      { value: '9', label: 'Team Members Led' },
    ],
  },

  skills: [
    {
      group: 'Languages',
      items: ['Java', 'Kotlin', 'Dart', 'C', 'C++'],
    },
    {
      group: 'Mobile & UI',
      items: ['Flutter', 'Jetpack Compose', 'XML', 'Firebase'],
    },
    {
      group: 'Architecture & Patterns',
      items: ['MVVM', 'MVP', 'Clean Architecture', 'BLoC', 'Provider', 'Riverpod'],
    },
    {
      group: 'Other',
      items: ['RESTful APIs', 'CI/CD', 'Problem Solving', 'Competitive Programming'],
    },
  ],

  projects: [
    {
      name: 'MoveOn Global',
      tagline: 'Cross-border eCommerce app that reached 100K+ installs in 3 months.',
      tech: ['Flutter', 'BLoC', 'Clean Architecture', 'CI/CD', 'Sentry'],
      link: 'https://play.google.com/store/apps/details?id=com.moveon.global',
      linkLabel: 'Play Store',
      status: 'live',
    },
    {
      name: 'EduTune',
      tagline: 'E-learning platform with live streaming classes, LMS, and an online book reader.',
      tech: ['Java', 'Zoom SDK', 'Firebase', 'OneSignal'],
      link: 'https://play.google.com/store/apps/details?id=com.aitl.edutune',
      linkLabel: 'Play Store',
      status: 'live',
    },
    {
      name: 'Mojaru',
      tagline: 'School management app streamlining tasks for staff, teachers, and students.',
      tech: ['Kotlin', 'Firebase Realtime DB', 'OneSignal'],
      link: 'https://play.google.com/store/apps/details?id=com.aitl.mojaru',
      linkLabel: 'Play Store',
      status: 'live',
    },
    {
      name: 'Ali2BD',
      tagline: 'Shopping app that scraped and displayed real-time product data.',
      tech: ['Java', 'XML', 'Jsoup'],
      link: null,
      linkLabel: null,
      status: 'legacy',
    },
  ],

  experience: [
    {
      company: 'Envobyte Ltd',
      role: 'Senior Software Engineer',
      location: 'Khulna, Bangladesh',
      period: 'Jan 2026 — Present',
      current: true,
      bullets: [
        'Serving as Team Lead, managing and guiding a cross-functional team of 9 members.',
        'Working with Cloud Vision, ML Kit, and image processing technologies.',
      ],
    },
    {
      company: 'Moveon Technologies Ltd.',
      role: 'Senior Software Engineer',
      location: 'Dhaka, Bangladesh',
      period: 'Dec 2023 — Dec 2025',
      current: false,
      bullets: [
        'Developed a cross-border eCommerce app that reached 100K+ installs within 3 months of launch.',
        'Focused on maximum device support for iOS and Android, delivering top performance and user experience.',
        'Mentored juniors, conducted code reviews, improved productivity, and enforced proper doc comments.',
        'Applied Clean Architecture with BLoC to separate UI and business logic for scalable, maintainable code.',
        'Implemented CI/CD pipelines to automate app publishing to the Play Store and App Store, with integrated error notifications via Discord and Sentry.',
      ],
    },
    {
      company: 'Amreen Info Tech Ltd.',
      role: 'Software Engineer',
      location: 'Khulna, Bangladesh',
      period: 'Mar 2021 — Nov 2023',
      current: false,
      bullets: [
        'Developed an e-learning mobile app in Java, featuring live streaming classes, an LMS system, and an online book reader.',
        'Built a school management app in Kotlin, streamlining school tasks for better organization and efficiency.',
        'Integrated Zoom SDK customization for live classes.',
        'Implemented Firebase Realtime Database for real-time messaging and push notifications using Firebase and OneSignal.',
      ],
    },
    {
      company: 'Ali2BD',
      role: 'Junior Software Engineer',
      location: 'Dhaka, Bangladesh',
      period: 'Mar 2019 — Dec 2020',
      current: false,
      bullets: [
        'Developed and maintained the Ali2BD app using Java and XML, providing a seamless shopping experience.',
        'Utilized Jsoup for web scraping to fetch and display real-time product data.',
        'Optimized app performance and UI for a smooth user experience.',
      ],
    },
  ],

  education: [
    {
      school: 'Daffodil International University',
      location: 'Dhaka',
      degree: 'BSc in Computer Science & Engineering',
      period: 'Dec 2015 — Dec 2019',
    },
    {
      school: 'Govt. MM City College',
      location: 'Khulna',
      degree: 'Higher Secondary Certificate (HSC)',
      period: 'Jan 2011 — Jan 2013',
    },
    {
      school: 'Bajua Union High School',
      location: 'Khulna',
      degree: 'Secondary School Certificate (SSC)',
      period: 'Jan 2006 — Jan 2011',
    },
  ],

  certifications: [
    {
      name: 'Android Application Development',
      issuer: 'BITM (Bangladesh Institute of Management)',
      type: 'Professional Certification',
    },
  ],

  contact: {
    heading: 'Get in touch',
    body: 'Open to remote and Dhaka-based mobile engineering roles. The fastest way to reach me is email — I usually reply within a day.',
    ctaLabel: 'Email me',
  },
};
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/data.js
git commit -m "feat(portfolio-static): add CV content data module"
```

---

## Task 3: Reveal & Scroll-Spy Utilities

**Files:**
- Create: `portfolio-static/src/lib/reveal.js`
- Create: `portfolio-static/src/lib/scroll-spy.js`

- [ ] **Step 1: Create `src/lib/reveal.js`**

```js
export function initReveal(selector = '.reveal') {
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const els = document.querySelectorAll(selector);

  if (prefersReduced || !('IntersectionObserver' in window)) {
    els.forEach((el) => el.classList.add('revealed'));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
  );

  els.forEach((el) => observer.observe(el));
}
```

- [ ] **Step 2: Create `src/lib/scroll-spy.js`**

```js
export function initScrollSpy(navSelector, sectionSelector) {
  const navLinks = document.querySelectorAll(navSelector);
  const sections = document.querySelectorAll(sectionSelector);

  if (!navLinks.length || !sections.length || !('IntersectionObserver' in window)) return;

  const linkById = new Map();
  navLinks.forEach((link) => {
    const href = link.getAttribute('href') || '';
    const id = href.replace('#', '');
    if (id) linkById.set(id, link);
  });

  const setActive = (id) => {
    navLinks.forEach((l) => {
      l.classList.remove('active');
      l.removeAttribute('aria-current');
    });
    const active = linkById.get(id);
    if (active) {
      active.classList.add('active');
      active.setAttribute('aria-current', 'true');
    }
  };

  const observer = new IntersectionObserver(
    (entries) => {
      const visible = entries
        .filter((e) => e.isIntersecting)
        .sort((a, b) => b.intersectionRatio - a.intersectionRatio);
      if (visible[0]) setActive(visible[0].target.id);
    },
    { threshold: [0.25, 0.5, 0.75], rootMargin: '-80px 0px -40% 0px' }
  );

  sections.forEach((s) => observer.observe(s));
}
```

- [ ] **Step 3: Commit**

```bash
git add portfolio-static/src/lib/reveal.js portfolio-static/src/lib/scroll-spy.js
git commit -m "feat(portfolio-static): add reveal and scroll-spy utilities"
```

---

## Task 4: Icon Helper

**Files:**
- Create: `portfolio-static/src/lib/icons.js`

- [ ] **Step 1: Create `src/lib/icons.js` with inline SVG strings**

```js
const svg = (path, viewBox = '0 0 24 24') =>
  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="${viewBox}" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true">${path}</svg>`;

export const icons = {
  github: svg(
    '<path d="M12 .5C5.65.5.5 5.65.5 12c0 5.09 3.29 9.4 7.86 10.93.58.11.79-.25.79-.55 0-.27-.01-1.16-.02-2.11-3.19.69-3.87-1.36-3.87-1.36-.52-1.33-1.28-1.69-1.28-1.69-1.05-.71.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.7 1.26 3.36.96.1-.74.4-1.26.72-1.55-2.55-.29-5.23-1.28-5.23-5.68 0-1.25.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18a11.1 11.1 0 0 1 2.9-.39c.98 0 1.97.13 2.9.39 2.21-1.49 3.18-1.18 3.18-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.84 1.19 3.09 0 4.41-2.69 5.38-5.25 5.66.41.36.78 1.06.78 2.14 0 1.54-.01 2.79-.01 3.16 0 .3.21.67.8.55C20.21 21.4 23.5 17.09 23.5 12 23.5 5.65 18.35.5 12 .5z" fill="currentColor" stroke="none"/>'
  ),
  linkedin: svg(
    '<path d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM19 19h-3v-4.74c0-1.13-.02-2.58-1.57-2.58-1.57 0-1.81 1.23-1.81 2.5V19h-3v-9h2.88v1.23h.04a3.16 3.16 0 012.85-1.56c3.05 0 3.61 2 3.61 4.61z" fill="currentColor" stroke="none"/>'
  ),
  mail: svg(
    '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/>'
  ),
  phone: svg(
    '<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.37 1.9.72 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0122 16.92z"/>'
  ),
  mapPin: svg(
    '<path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>'
  ),
  externalLink: svg(
    '<path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><path d="M15 3h6v6"/><path d="M10 14L21 3"/>'
  ),
  download: svg(
    '<path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><path d="M7 10l5 5 5-5"/><path d="M12 15V3"/>'
  ),
  arrowDown: svg(
    '<path d="M12 5v14"/><path d="M19 12l-7 7-7-7"/>'
  ),
  menu: svg(
    '<path d="M3 6h18"/><path d="M3 12h18"/><path d="M3 18h18"/>'
  ),
  close: svg(
    '<path d="M18 6L6 18"/><path d="M6 6l12 12"/>'
  ),
  code: svg(
    '<path d="M16 18l6-6-6-6"/><path d="M8 6l-6 6 6 6"/>'
  ),
  briefcase: svg(
    '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'
  ),
  graduation: svg(
    '<path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.66 3.58 3 8 3s8-1.34 8-3v-5"/>'
  ),
  award: svg(
    '<circle cx="12" cy="8" r="6"/><path d="M15.5 12.5L17 22l-5-3-5 3 1.5-9.5"/>'
  ),
};
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/lib/icons.js
git commit -m "feat(portfolio-static): add inline SVG icon set"
```

---

## Task 5: Nav Section

**Files:**
- Create: `portfolio-static/src/sections/nav.js`

- [ ] **Step 1: Create `src/sections/nav.js`**

```js
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
        <button type="button" class="md:hidden text-ink-primary" aria-label="Open menu" data-menu-toggle>
          ${icons.menu}
        </button>
      </nav>
      <div class="md:hidden hidden bg-bg-base border-t border-surface-border" data-mobile-menu>
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/nav.js
git commit -m "feat(portfolio-static): add sticky nav section"
```

---

## Task 6: Hero Section

**Files:**
- Create: `portfolio-static/src/sections/hero.js`

- [ ] **Step 1: Create `src/sections/hero.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/hero.js
git commit -m "feat(portfolio-static): add hero section"
```

---

## Task 7: About Section

**Files:**
- Create: `portfolio-static/src/sections/about.js`

- [ ] **Step 1: Create `src/sections/about.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/about.js
git commit -m "feat(portfolio-static): add about section"
```

---

## Task 8: Skills Section

**Files:**
- Create: `portfolio-static/src/sections/skills.js`

- [ ] **Step 1: Create `src/sections/skills.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/skills.js
git commit -m "feat(portfolio-static): add skills section"
```

---

## Task 9: Projects Section

**Files:**
- Create: `portfolio-static/src/sections/projects.js`

- [ ] **Step 1: Create `src/sections/projects.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/projects.js
git commit -m "feat(portfolio-static): add featured projects section"
```

---

## Task 10: Experience Section

**Files:**
- Create: `portfolio-static/src/sections/experience.js`

- [ ] **Step 1: Create `src/sections/experience.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/experience.js
git commit -m "feat(portfolio-static): add experience timeline section"
```

---

## Task 11: Education Section

**Files:**
- Create: `portfolio-static/src/sections/education.js`

- [ ] **Step 1: Create `src/sections/education.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/education.js
git commit -m "feat(portfolio-static): add education section"
```

---

## Task 12: Certifications Section

**Files:**
- Create: `portfolio-static/src/sections/certifications.js`

- [ ] **Step 1: Create `src/sections/certifications.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/certifications.js
git commit -m "feat(portfolio-static): add certifications section"
```

---

## Task 13: Contact Section

**Files:**
- Create: `portfolio-static/src/sections/contact.js`

- [ ] **Step 1: Create `src/sections/contact.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/contact.js
git commit -m "feat(portfolio-static): add contact section"
```

---

## Task 14: Footer Section

**Files:**
- Create: `portfolio-static/src/sections/footer.js`

- [ ] **Step 1: Create `src/sections/footer.js`**

```js
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
```

- [ ] **Step 2: Commit**

```bash
git add portfolio-static/src/sections/footer.js
git commit -m "feat(portfolio-static): add footer section"
```

---

## Task 15: Wire Everything In `main.js`

**Files:**
- Modify: `portfolio-static/src/main.js`

- [ ] **Step 1: Replace `src/main.js` with full assembly**

```js
import './style.css';
import { portfolioData } from './data.js';
import renderNav from './sections/nav.js';
import renderHero from './sections/hero.js';
import renderAbout from './sections/about.js';
import renderSkills from './sections/skills.js';
import renderProjects from './sections/projects.js';
import renderExperience from './sections/experience.js';
import renderEducation from './sections/education.js';
import renderCertifications from './sections/certifications.js';
import renderContact from './sections/contact.js';
import renderFooter from './sections/footer.js';
import { initReveal } from './lib/reveal.js';
import { initScrollSpy } from './lib/scroll-spy.js';

const app = document.getElementById('app');

app.innerHTML = [
  renderNav(portfolioData),
  '<main id="main">',
  renderHero(portfolioData),
  renderAbout(portfolioData),
  renderSkills(portfolioData),
  renderProjects(portfolioData),
  renderExperience(portfolioData),
  renderEducation(portfolioData),
  renderCertifications(portfolioData),
  renderContact(portfolioData),
  '</main>',
  renderFooter(portfolioData),
].join('');

initReveal('.reveal');
initScrollSpy('header nav a[href^="#"]', 'main > section[id]');

const toggle = document.querySelector('[data-menu-toggle]');
const menu = document.querySelector('[data-mobile-menu]');
if (toggle && menu) {
  toggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
  document.querySelectorAll('[data-mobile-link]').forEach((link) => {
    link.addEventListener('click', () => menu.classList.add('hidden'));
  });
}
```

- [ ] **Step 2: Run dev server and manually verify**

Run: `cd portfolio-static && npm run dev`
Expected: browser opens localhost:5173. All 8 sections render top-to-bottom. Nav shows 01–07 links.

Manual checks:
- Click each nav link → smooth-scrolls to matching section
- Scroll through page → active nav link changes as sections scroll into view
- Sections fade in as they enter viewport
- Resize to mobile (< 768px) → hamburger appears, click opens menu, click a link closes menu
- Hover a project/skill card → lifts, border turns cyan
- Click GitHub/LinkedIn/mail icons → open correct URLs

Stop dev server with Ctrl+C.

- [ ] **Step 3: Commit**

```bash
git add portfolio-static/src/main.js
git commit -m "feat(portfolio-static): assemble all sections in main entry"
```

---

## Task 16: Favicon & Public Assets

**Files:**
- Create: `portfolio-static/public/favicon.svg`
- Copy: `portfolio-static/public/Shipon_Sarder_CV.pdf` from `C:\Users\shipo\OneDrive\Desktop\Shipon CV New\Shipon_Sarder_Mobile_Developer_CV.pdf`

- [ ] **Step 1: Create `public/favicon.svg`**

```xml
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
  <rect width="64" height="64" rx="12" fill="#0a0e1a"/>
  <text x="50%" y="50%" text-anchor="middle" dominant-baseline="central"
        font-family="Inter, system-ui, sans-serif" font-weight="800" font-size="28" fill="#22d3ee">SS</text>
</svg>
```

- [ ] **Step 2: Copy CV PDF into `public/`**

Run (bash):
```bash
cp "C:/Users/shipo/OneDrive/Desktop/Shipon CV New/Shipon_Sarder_Mobile_Developer_CV.pdf" "C:/laragon/www/my-portfolio/portfolio-static/public/Shipon_Sarder_CV.pdf"
```

Expected: file copied, no errors.

Verify: `ls C:/laragon/www/my-portfolio/portfolio-static/public/` shows both `favicon.svg` and `Shipon_Sarder_CV.pdf`.

- [ ] **Step 3: Test Download CV link**

Run: `cd portfolio-static && npm run dev`
In browser: click "Download CV" in hero → PDF downloads.
Also click favicon URL in nav: browser tab shows the SS favicon.

Stop dev server.

- [ ] **Step 4: Commit**

```bash
git add portfolio-static/public/favicon.svg portfolio-static/public/Shipon_Sarder_CV.pdf
git commit -m "feat(portfolio-static): add favicon and CV PDF asset"
```

---

## Task 17: Production Build Verification

- [ ] **Step 1: Run production build**

Run: `cd portfolio-static && npm run build`
Expected: exits with success, prints "built in Xms", creates `dist/` folder with `index.html`, hashed `assets/*.js`, `assets/*.css`, favicon.svg, PDF.

- [ ] **Step 2: Preview build**

Run: `cd portfolio-static && npm run preview`
Expected: preview server starts, browser opens, full site loads identical to dev.

Manual checks against built site:
- All 8 sections render
- Fonts load (Inter body, JetBrains Mono accents)
- No console errors
- Nav scroll-spy and reveal animations work
- Mobile menu works at narrow width
- CV download works
- All external links open in new tabs

Stop preview with Ctrl+C.

- [ ] **Step 3: Confirm no uncommitted changes**

Run: `git status`
Expected: `working tree clean` for `portfolio-static/` (no leftover build artifacts committed — `dist/` and `node_modules/` are gitignored).

---

## Done Criteria

- `cd portfolio-static && npm run dev` starts server, portfolio renders with all 8 sections
- `cd portfolio-static && npm run build` succeeds with no errors
- All manual checks in Task 15 Step 2 and Task 17 Step 2 pass
- No files touched outside `portfolio-static/` (existing Laravel code untouched)
- Every task ended with a commit; history reads as a clear progression
