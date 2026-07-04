# Portfolio Static — Design Spec

**Date:** 2026-07-05
**Owner:** Shipon Sarder
**Status:** Approved, ready for implementation plan

## Goal

Build a professional single-page portfolio website for Shipon Sarder (Mobile Application Developer). Content is sourced from his CV and lives as static data in JavaScript — no backend, no CMS, no database. The site is a standalone Vite + Tailwind subproject that coexists inside the existing Laravel repo but is fully independent of it.

## Non-Goals

- No Laravel integration (routes, controllers, blade views) — the static portfolio does not touch existing Laravel code
- No contact form backend — contact is display-only (email, phone, socials)
- No CMS or admin panel — content is edited by hand in `src/data.js`
- No blog, no dynamic content, no i18n
- No animation library (framer-motion, GSAP) — plain CSS transitions + IntersectionObserver only

## Architecture

### Location
Standalone subfolder at `C:\laragon\www\my-portfolio\portfolio-static\`.

### Tech Stack
- **Vite 5** — dev server + production build
- **Tailwind CSS 3** — utility styling, with `@tailwindcss/typography` for prose sections
- **PostCSS + Autoprefixer** — CSS pipeline
- **Vanilla JS (ES modules)** — no framework; sections are pure functions returning HTML strings
- **@fontsource/inter** + **@fontsource/jetbrains-mono** — self-hosted fonts (no runtime Google Fonts fetch)

### Runtime Model
1. `index.html` loads `/src/main.js`
2. `main.js` imports `data.js` + each section module
3. Each section exports `render(data): string` — returns an HTML string
4. `main.js` concatenates section HTML into a root container
5. After mount, `main.js` initializes `scroll-spy.js` and `reveal.js`

### Build & Deploy
- `npm run dev` → Vite dev server on `localhost:5173`
- `npm run build` → outputs static `dist/` folder
- Deployable as-is to Netlify, Vercel, GitHub Pages, or copied into Laravel's `public/portfolio-v2/`

## File Structure

```
portfolio-static/
├── package.json
├── vite.config.js
├── tailwind.config.js
├── postcss.config.js
├── .gitignore
├── index.html
├── public/
│   └── favicon.svg
└── src/
    ├── main.js
    ├── data.js
    ├── style.css
    ├── sections/
    │   ├── nav.js
    │   ├── hero.js
    │   ├── about.js
    │   ├── skills.js
    │   ├── projects.js
    │   ├── experience.js
    │   ├── education.js
    │   ├── certifications.js
    │   ├── contact.js
    │   └── footer.js
    └── lib/
        ├── scroll-spy.js
        └── reveal.js
```

### Module Contracts

**`data.js`** — exports one object `portfolioData` with keys: `profile`, `about`, `skills`, `projects`, `experience`, `education`, `certifications`, `contact`, `nav`.

**Section modules** (`sections/*.js`) — each exports a default function `render(data): string`. Pure functions, no side effects, no DOM access.

**`scroll-spy.js`** — exports `initScrollSpy(navSelector, sectionsSelector)`. Uses `IntersectionObserver` to toggle an `.active` class on nav links matching the currently visible section.

**`reveal.js`** — exports `initReveal(selector)`. Uses `IntersectionObserver` to add `.revealed` class to elements with `.reveal` when they enter viewport. Respects `prefers-reduced-motion`.

**`main.js`** — imports data + sections, renders into `#app`, calls `initScrollSpy` and `initReveal`, wires up mobile menu toggle.

## Content (from CV)

### Profile
- Name: Shipon Sarder
- Title: Mobile Application Developer
- Location: Dhaka, 1216 Bangladesh
- Email: shipon0142@gmail.com
- Phone: +8801925727000
- GitHub: github.com/shipon0142
- LinkedIn: linkedin.com/in/shipon-sarder-900727102

### Hero
- Headline: "Shipon Sarder"
- Subheadline: "Mobile Application Developer"
- Tagline: "5+ years building performant, maintainable Android & Flutter apps used by 100K+ people."
- CTAs: "View Projects" (scroll to #projects), "Download CV" (link to `/Shipon_Sarder_CV.pdf` — placed in `public/`), social icons.

### About
Two-paragraph rewrite of CV summary. Stats row: `5+ Years Experience`, `100K+ Installs Shipped`, `4 Companies`, `9-Person Team Led`.

### Skills (4 grouped cards)
- **Languages:** Java, Kotlin, Dart, C, C++
- **Mobile & UI:** Flutter, Jetpack Compose, XML, Firebase
- **Architecture & Patterns:** MVVM, MVP, Clean Architecture, BLoC, Provider, Riverpod
- **Other:** RESTful APIs, CI/CD, Problem Solving, Competitive Programming

### Featured Projects (4 cards)
1. **MoveOn Global** — cross-border eCommerce, 100K+ installs · Flutter, BLoC, Clean Architecture, CI/CD · https://play.google.com/store/apps/details?id=com.moveon.global
2. **EduTune** — e-learning app, live streaming classes, LMS, book reader · Java, Zoom SDK, Firebase, OneSignal · https://play.google.com/store/apps/details?id=com.aitl.edutune
3. **Mojaru** — school management app · Kotlin, Firebase Realtime DB, OneSignal · https://play.google.com/store/apps/details?id=com.aitl.mojaru
4. **Ali2BD** — shopping app with web scraping · Java, XML, Jsoup · No public link (marked "legacy")

Each card: name, tagline, tech tag list, Play Store link (or "legacy" badge).

### Experience (4 entries, vertical timeline)
1. **Envobyte Ltd** — Senior Software Engineer · Khulna, Bangladesh · Jan 2026–Present
   - Serving as Team Lead, managing a cross-functional team of 9
   - Working with Cloud Vision, ML Kit, image processing
2. **Moveon Technologies Ltd.** — Senior Software Engineer · Dhaka, Bangladesh · Dec 2023–Dec 2025
   - Developed cross-border eCommerce app, 100K+ installs in 3 months
   - Maximum device support for iOS + Android
   - Mentored juniors, code reviews, doc comment standards
   - Applied Clean Architecture with BLoC
   - CI/CD pipelines with Discord + Sentry error notifications
3. **Amreen Info Tech Ltd.** — Software Engineer · Khulna, Bangladesh · Mar 2021–Nov 2023
   - E-learning mobile app in Java (live streaming, LMS, book reader)
   - School management app in Kotlin
   - Zoom SDK customization for live classes
   - Firebase Realtime DB + OneSignal push notifications
4. **Ali2BD** — Junior Software Engineer · Dhaka, Bangladesh · Mar 2019–Dec 2020
   - Developed/maintained Ali2BD app (Java, XML)
   - Jsoup web scraping for real-time product data
   - Performance and UI optimization

### Education
- Daffodil International University, Dhaka — BSc in CSE (Dec 2015–Dec 2019)
- Govt. MM City College, Khulna — HSC (Jan 2011–Jan 2013)
- Bajua Union High School, Khulna — SSC (Jan 2006–Jan 2011)

### Certifications
- BITM — Professional Certification in Android Application Development

### Contact
- Email: shipon0142@gmail.com (mailto link)
- Phone: +8801925727000 (tel link)
- Location: Dhaka, 1216 Bangladesh
- GitHub, LinkedIn (icon links)
- Copy note: "Open to remote and Dhaka-based mobile engineering roles."

## Visual System

### Colors
- Background base: `#0a0e1a`
- Section variant background: `#0f172a`
- Card surface: `#111827`
- Card border: `#1f2937`
- Text primary: `#e5e7eb`
- Text secondary: `#94a3b8`
- Text muted: `#64748b`
- Accent (primary): `#22d3ee` (cyan-400) — links, icons, highlights, active nav
- Accent (secondary): `#10b981` (emerald-500) — "Present" badge, success cues

### Typography
- Body font: Inter (400/500/600/700)
- Heading font: Inter (700/800), tight tracking
- Mono accent: JetBrains Mono — section labels (`01. About`), tech tags, code

### Layout
- Container: `max-w-6xl mx-auto px-6`
- Section vertical padding: `py-24` desktop, `py-16` mobile
- Sticky top nav with `backdrop-blur` when scrolled
- Mobile hamburger menu below `md` breakpoint

### Interactions
- IntersectionObserver fade-up: `.reveal` → `.revealed` toggles `opacity` and `translate-y`
- Scroll-spy: current section id → matching nav link gets `.active`
- Smooth scroll on nav anchor clicks
- Card hover: `-translate-y-1` + border color shifts to accent cyan
- `prefers-reduced-motion` disables reveal + smooth scroll

### Accessibility
- Semantic HTML: `<nav>`, `<main>`, `<section>`, `<article>`, `<header>`, `<footer>`
- Skip-to-content link
- Visible focus rings on all interactive elements
- All text meets WCAG AA contrast against dark background
- `aria-current="page"` on active nav link
- `alt` text on all images

## Testing / Verification

Manual verification before marking done:
1. `npm run dev` starts successfully
2. All 8 sections render
3. Nav scroll-spy highlights correct section on scroll
4. Nav anchor clicks smooth-scroll to sections
5. Mobile menu toggles at `< md` viewport
6. All external links (GitHub, LinkedIn, Play Store, mailto, tel) work
7. `npm run build` produces `dist/` with no errors
8. Built `dist/` opens correctly when served with `npx serve dist`
9. Lighthouse: Performance ≥ 95, Accessibility ≥ 95 on desktop
10. Manual check: `prefers-reduced-motion` disables animations (Chrome DevTools rendering panel)

## Out of Scope (deferred)

- Blog / articles
- Contact form (would need backend)
- Analytics
- Dark/light mode toggle
- Localization (English only)
- SEO meta beyond basic `<title>` and `<meta description>`
- Sitemap / robots.txt
