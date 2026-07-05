<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shipon Sarder — Mobile Application Developer with 5+ years of Android and Flutter experience.">
    <title>Shipon Sarder — Mobile Application Developer</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bg: { base: '#0a0e1a', alt: '#0f172a' },
                        surface: { DEFAULT: '#111827', border: '#1f2937' },
                        ink: { primary: '#e5e7eb', secondary: '#94a3b8', muted: '#64748b' },
                        brand: { cyan: '#22d3ee', emerald: '#10b981' },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                    },
                    maxWidth: { content: '72rem' },
                },
            },
        };
    </script>

    <style>
        body {
            background:
                radial-gradient(circle at 20% 0%, rgba(34, 211, 238, 0.06), transparent 40%),
                radial-gradient(circle at 80% 40%, rgba(16, 185, 129, 0.04), transparent 40%),
                #0a0e1a;
            min-height: 100vh;
            font-family: 'Inter', system-ui, sans-serif;
            color: #e5e7eb;
        }
        :focus-visible { outline: 2px solid #22d3ee; outline-offset: 2px; border-radius: 4px; }
        .reveal { opacity: 0; transform: translateY(1rem); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1; transform: none; transition: none; }
            html { scroll-behavior: auto; }
        }
    </style>
</head>
<body class="antialiased">

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:bg-brand-cyan focus:text-bg-base focus:px-3 focus:py-2 focus:rounded">Skip to content</a>

<!-- Nav -->
<header class="fixed top-0 inset-x-0 z-40 backdrop-blur bg-bg-base/70 border-b border-surface-border">
    <div class="max-w-content mx-auto px-6 h-16 flex items-center justify-between">
        <a href="#hero" class="font-mono text-sm text-brand-cyan tracking-widest">SS<span class="text-ink-secondary">.</span></a>
        <nav class="hidden md:flex items-center gap-8" id="desktopNav">
            <a href="#about" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan transition-colors"><span class="text-brand-cyan/70">01.</span> About</a>
            <a href="#skills" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan transition-colors"><span class="text-brand-cyan/70">02.</span> Skills</a>
            <a href="#projects" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan transition-colors"><span class="text-brand-cyan/70">03.</span> Projects</a>
            <a href="#experience" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan transition-colors"><span class="text-brand-cyan/70">04.</span> Experience</a>
            <a href="#education" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan transition-colors"><span class="text-brand-cyan/70">05.</span> Education</a>
            <a href="#contact" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan transition-colors"><span class="text-brand-cyan/70">06.</span> Contact</a>
            <a href="/Shipon_Sarder_CV.pdf" download class="font-mono text-sm px-3 py-1.5 rounded border border-brand-cyan/60 text-brand-cyan hover:bg-brand-cyan/10 transition-colors">Resume</a>
        </nav>
        <button id="menuBtn" aria-label="Toggle menu" aria-expanded="false" class="md:hidden text-ink-primary p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <nav id="mobileNav" class="md:hidden hidden border-t border-surface-border bg-bg-base/95 backdrop-blur">
        <div class="max-w-content mx-auto px-6 py-4 flex flex-col gap-3">
            <a href="#about" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan"><span class="text-brand-cyan/70">01.</span> About</a>
            <a href="#skills" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan"><span class="text-brand-cyan/70">02.</span> Skills</a>
            <a href="#projects" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan"><span class="text-brand-cyan/70">03.</span> Projects</a>
            <a href="#experience" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan"><span class="text-brand-cyan/70">04.</span> Experience</a>
            <a href="#education" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan"><span class="text-brand-cyan/70">05.</span> Education</a>
            <a href="#contact" class="font-mono text-sm text-ink-secondary hover:text-brand-cyan"><span class="text-brand-cyan/70">06.</span> Contact</a>
            <a href="/Shipon_Sarder_CV.pdf" download class="font-mono text-sm px-3 py-1.5 rounded border border-brand-cyan/60 text-brand-cyan hover:bg-brand-cyan/10 text-center">Resume</a>
        </div>
    </nav>
</header>

<main id="main">

    <!-- Hero -->
    <section id="hero" class="min-h-screen flex items-center px-6 pt-24 pb-16">
        <div class="max-w-content mx-auto w-full grid md:grid-cols-[1fr_auto] gap-12 items-center">
            <div class="reveal">
                <p class="font-mono text-sm text-brand-cyan mb-4">Hi, my name is</p>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-ink-primary leading-none mb-4">Shipon Sarder.</h1>
                <h2 class="text-3xl md:text-5xl font-bold tracking-tight text-ink-secondary leading-tight mb-6">I build mobile apps people use every day.</h2>
                <p class="text-lg text-ink-secondary max-w-2xl mb-8 leading-relaxed">5+ years shipping performant, maintainable Android &amp; Flutter apps used by 100K+ people. Currently leading a team of 9 at Envobyte, working with Cloud Vision and ML Kit.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="mailto:shipon0142@gmail.com" class="inline-flex items-center gap-2 font-mono text-sm px-5 py-3 rounded border border-brand-cyan text-brand-cyan hover:bg-brand-cyan/10 transition-colors">
                        Get in touch
                        <span aria-hidden="true">→</span>
                    </a>
                    <a href="/Shipon_Sarder_CV.pdf" download class="inline-flex items-center gap-2 font-mono text-sm px-5 py-3 rounded border border-surface-border text-ink-secondary hover:border-ink-primary hover:text-ink-primary transition-colors">
                        Download CV
                    </a>
                </div>
            </div>
            <div class="reveal hidden md:flex items-center justify-center">
                <div class="relative">
                    <div class="absolute inset-0 rounded-full bg-brand-cyan/20 blur-2xl"></div>
                    <div class="relative w-56 h-56 rounded-full border-2 border-brand-cyan/40 bg-surface flex items-center justify-center">
                        <span class="font-mono text-6xl font-bold text-brand-cyan">SS</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="px-6 py-24">
        <div class="max-w-content mx-auto reveal">
            <div class="flex items-center gap-4 mb-10">
                <p class="font-mono text-xs tracking-widest text-brand-cyan uppercase">01 &mdash; About</p>
                <span class="h-px flex-1 bg-surface-border"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-ink-primary tracking-tight mb-8">A bit about me</h2>
            <div class="grid md:grid-cols-2 gap-10">
                <div class="space-y-5 text-ink-secondary text-lg leading-relaxed">
                    <p>I build mobile applications that people actually use every day. Over the last 5 years I have shipped native Android apps and cross-platform Flutter apps for eCommerce, education, and productivity &mdash; with a strong focus on performance, clean architecture, and code that other engineers can maintain long after I ship it.</p>
                    <p>Most recently I lead a cross-functional team of 9 at Envobyte, working with Cloud Vision and ML Kit. Before that, I helped grow a cross-border eCommerce app to 100K+ installs in its first 3 months. I care about mentoring, code reviews, and CI/CD that catches problems before users do.</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-surface border border-surface-border rounded-xl p-6">
                        <p class="font-mono text-4xl font-bold text-brand-cyan">5+</p>
                        <p class="text-sm text-ink-secondary mt-2">Years Experience</p>
                    </div>
                    <div class="bg-surface border border-surface-border rounded-xl p-6">
                        <p class="font-mono text-4xl font-bold text-brand-cyan">100K+</p>
                        <p class="text-sm text-ink-secondary mt-2">Installs Shipped</p>
                    </div>
                    <div class="bg-surface border border-surface-border rounded-xl p-6">
                        <p class="font-mono text-4xl font-bold text-brand-cyan">4</p>
                        <p class="text-sm text-ink-secondary mt-2">Companies</p>
                    </div>
                    <div class="bg-surface border border-surface-border rounded-xl p-6">
                        <p class="font-mono text-4xl font-bold text-brand-cyan">9</p>
                        <p class="text-sm text-ink-secondary mt-2">Team Members Led</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills -->
    <section id="skills" class="px-6 py-24">
        <div class="max-w-content mx-auto reveal">
            <div class="flex items-center gap-4 mb-10">
                <p class="font-mono text-xs tracking-widest text-brand-cyan uppercase">02 &mdash; Skills</p>
                <span class="h-px flex-1 bg-surface-border"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-ink-primary tracking-tight mb-8">What I work with</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-surface border border-surface-border rounded-xl p-6">
                    <p class="font-mono text-xs tracking-widest text-brand-emerald uppercase mb-4">Languages</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Java</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Kotlin</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Dart</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">C</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">C++</span>
                    </div>
                </div>
                <div class="bg-surface border border-surface-border rounded-xl p-6">
                    <p class="font-mono text-xs tracking-widest text-brand-emerald uppercase mb-4">Mobile &amp; UI</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Flutter</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Jetpack Compose</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">XML</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Firebase</span>
                    </div>
                </div>
                <div class="bg-surface border border-surface-border rounded-xl p-6">
                    <p class="font-mono text-xs tracking-widest text-brand-emerald uppercase mb-4">Architecture &amp; Patterns</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">MVVM</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">MVP</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Clean Architecture</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">BLoC</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Provider</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Riverpod</span>
                    </div>
                </div>
                <div class="bg-surface border border-surface-border rounded-xl p-6">
                    <p class="font-mono text-xs tracking-widest text-brand-emerald uppercase mb-4">Other</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">RESTful APIs</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">CI/CD</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Problem Solving</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Competitive Programming</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects -->
    <section id="projects" class="px-6 py-24">
        <div class="max-w-content mx-auto reveal">
            <div class="flex items-center gap-4 mb-10">
                <p class="font-mono text-xs tracking-widest text-brand-cyan uppercase">03 &mdash; Projects</p>
                <span class="h-px flex-1 bg-surface-border"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-ink-primary tracking-tight mb-8">Selected work</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <article class="bg-surface border border-surface-border rounded-xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-brand-cyan/50 hover:shadow-lg hover:shadow-brand-cyan/5">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-xl font-bold text-ink-primary">MoveOn Global</h3>
                        <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-brand-emerald/15 text-brand-emerald border border-brand-emerald/30">live</span>
                    </div>
                    <p class="text-ink-secondary mb-4 leading-relaxed">Cross-border eCommerce app that reached 100K+ installs in 3 months.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Flutter</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">BLoC</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Clean Architecture</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">CI/CD</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Sentry</span>
                    </div>
                    <a href="https://play.google.com/store/apps/details?id=com.moveon.global" target="_blank" rel="noopener" class="font-mono text-sm text-brand-cyan hover:text-brand-emerald transition-colors">Play Store &rarr;</a>
                </article>

                <article class="bg-surface border border-surface-border rounded-xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-brand-cyan/50 hover:shadow-lg hover:shadow-brand-cyan/5">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-xl font-bold text-ink-primary">EduTune</h3>
                        <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-brand-emerald/15 text-brand-emerald border border-brand-emerald/30">live</span>
                    </div>
                    <p class="text-ink-secondary mb-4 leading-relaxed">E-learning platform with live streaming classes, LMS, and an online book reader.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Java</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Zoom SDK</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Firebase</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">OneSignal</span>
                    </div>
                    <a href="https://play.google.com/store/apps/details?id=com.aitl.edutune" target="_blank" rel="noopener" class="font-mono text-sm text-brand-cyan hover:text-brand-emerald transition-colors">Play Store &rarr;</a>
                </article>

                <article class="bg-surface border border-surface-border rounded-xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-brand-cyan/50 hover:shadow-lg hover:shadow-brand-cyan/5">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-xl font-bold text-ink-primary">Mojaru</h3>
                        <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-brand-emerald/15 text-brand-emerald border border-brand-emerald/30">live</span>
                    </div>
                    <p class="text-ink-secondary mb-4 leading-relaxed">School management app streamlining tasks for staff, teachers, and students.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Kotlin</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Firebase Realtime DB</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">OneSignal</span>
                    </div>
                    <a href="https://play.google.com/store/apps/details?id=com.aitl.mojaru" target="_blank" rel="noopener" class="font-mono text-sm text-brand-cyan hover:text-brand-emerald transition-colors">Play Store &rarr;</a>
                </article>

                <article class="bg-surface border border-surface-border rounded-xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-brand-cyan/50 hover:shadow-lg hover:shadow-brand-cyan/5">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-xl font-bold text-ink-primary">Ali2BD</h3>
                        <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surface-border text-ink-muted border border-surface-border">legacy</span>
                    </div>
                    <p class="text-ink-secondary mb-4 leading-relaxed">Shopping app that scraped and displayed real-time product data.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Java</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">XML</span>
                        <span class="font-mono text-xs px-2 py-1 rounded bg-bg-alt border border-surface-border text-ink-secondary">Jsoup</span>
                    </div>
                    <span class="font-mono text-sm text-ink-muted">No longer available</span>
                </article>
            </div>
        </div>
    </section>

    <!-- Experience -->
    <section id="experience" class="px-6 py-24">
        <div class="max-w-content mx-auto reveal">
            <div class="flex items-center gap-4 mb-10">
                <p class="font-mono text-xs tracking-widest text-brand-cyan uppercase">04 &mdash; Experience</p>
                <span class="h-px flex-1 bg-surface-border"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-ink-primary tracking-tight mb-8">Where I&rsquo;ve worked</h2>

            <div class="space-y-6">
                <article class="bg-surface border border-surface-border rounded-xl p-6">
                    <div class="flex flex-wrap items-start justify-between gap-3 mb-1">
                        <div>
                            <h3 class="text-xl font-bold text-ink-primary">Senior Software Engineer <span class="text-brand-cyan">@ Envobyte Ltd</span></h3>
                            <p class="text-sm text-ink-muted">Khulna, Bangladesh</p>
                        </div>
                        <p class="font-mono text-xs px-2 py-1 rounded bg-brand-cyan/10 text-brand-cyan border border-brand-cyan/30 whitespace-nowrap">Jan 2026 &mdash; Present</p>
                    </div>
                    <ul class="mt-4 space-y-2 text-ink-secondary">
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Serving as Team Lead, managing and guiding a cross-functional team of 9 members.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Working with Cloud Vision, ML Kit, and image processing technologies.</span></li>
                    </ul>
                </article>

                <article class="bg-surface border border-surface-border rounded-xl p-6">
                    <div class="flex flex-wrap items-start justify-between gap-3 mb-1">
                        <div>
                            <h3 class="text-xl font-bold text-ink-primary">Senior Software Engineer <span class="text-brand-cyan">@ Moveon Technologies Ltd.</span></h3>
                            <p class="text-sm text-ink-muted">Dhaka, Bangladesh</p>
                        </div>
                        <p class="font-mono text-xs px-2 py-1 rounded bg-bg-alt text-ink-secondary border border-surface-border whitespace-nowrap">Dec 2023 &mdash; Dec 2025</p>
                    </div>
                    <ul class="mt-4 space-y-2 text-ink-secondary">
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Developed a cross-border eCommerce app that reached 100K+ installs within 3 months of launch.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Focused on maximum device support for iOS and Android, delivering top performance and user experience.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Mentored juniors, conducted code reviews, improved productivity, and enforced proper doc comments.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Applied Clean Architecture with BLoC to separate UI and business logic for scalable, maintainable code.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Implemented CI/CD pipelines to automate app publishing to the Play Store and App Store, with integrated error notifications via Discord and Sentry.</span></li>
                    </ul>
                </article>

                <article class="bg-surface border border-surface-border rounded-xl p-6">
                    <div class="flex flex-wrap items-start justify-between gap-3 mb-1">
                        <div>
                            <h3 class="text-xl font-bold text-ink-primary">Software Engineer <span class="text-brand-cyan">@ Amreen Info Tech Ltd.</span></h3>
                            <p class="text-sm text-ink-muted">Khulna, Bangladesh</p>
                        </div>
                        <p class="font-mono text-xs px-2 py-1 rounded bg-bg-alt text-ink-secondary border border-surface-border whitespace-nowrap">Mar 2021 &mdash; Nov 2023</p>
                    </div>
                    <ul class="mt-4 space-y-2 text-ink-secondary">
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Developed an e-learning mobile app in Java, featuring live streaming classes, an LMS system, and an online book reader.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Built a school management app in Kotlin, streamlining school tasks for better organization and efficiency.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Integrated Zoom SDK customization for live classes.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Implemented Firebase Realtime Database for real-time messaging and push notifications using Firebase and OneSignal.</span></li>
                    </ul>
                </article>

                <article class="bg-surface border border-surface-border rounded-xl p-6">
                    <div class="flex flex-wrap items-start justify-between gap-3 mb-1">
                        <div>
                            <h3 class="text-xl font-bold text-ink-primary">Junior Software Engineer <span class="text-brand-cyan">@ Ali2BD</span></h3>
                            <p class="text-sm text-ink-muted">Dhaka, Bangladesh</p>
                        </div>
                        <p class="font-mono text-xs px-2 py-1 rounded bg-bg-alt text-ink-secondary border border-surface-border whitespace-nowrap">Mar 2019 &mdash; Dec 2020</p>
                    </div>
                    <ul class="mt-4 space-y-2 text-ink-secondary">
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Developed and maintained the Ali2BD app using Java and XML, providing a seamless shopping experience.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Utilized Jsoup for web scraping to fetch and display real-time product data.</span></li>
                        <li class="flex gap-3"><span class="text-brand-cyan mt-1">▹</span><span>Optimized app performance and UI for a smooth user experience.</span></li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <!-- Education -->
    <section id="education" class="px-6 py-24">
        <div class="max-w-content mx-auto reveal">
            <div class="flex items-center gap-4 mb-10">
                <p class="font-mono text-xs tracking-widest text-brand-cyan uppercase">05 &mdash; Education</p>
                <span class="h-px flex-1 bg-surface-border"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-ink-primary tracking-tight mb-8">Education &amp; certifications</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <article class="bg-surface border border-surface-border rounded-xl p-6">
                    <p class="font-mono text-xs text-brand-cyan mb-2">Dec 2015 &mdash; Dec 2019</p>
                    <h3 class="text-lg font-bold text-ink-primary mb-1">Daffodil International University</h3>
                    <p class="text-sm text-ink-muted mb-2">Dhaka</p>
                    <p class="text-ink-secondary">BSc in Computer Science &amp; Engineering</p>
                </article>
                <article class="bg-surface border border-surface-border rounded-xl p-6">
                    <p class="font-mono text-xs text-brand-cyan mb-2">Jan 2011 &mdash; Jan 2013</p>
                    <h3 class="text-lg font-bold text-ink-primary mb-1">Govt. MM City College</h3>
                    <p class="text-sm text-ink-muted mb-2">Khulna</p>
                    <p class="text-ink-secondary">Higher Secondary Certificate (HSC)</p>
                </article>
                <article class="bg-surface border border-surface-border rounded-xl p-6">
                    <p class="font-mono text-xs text-brand-cyan mb-2">Jan 2006 &mdash; Jan 2011</p>
                    <h3 class="text-lg font-bold text-ink-primary mb-1">Bajua Union High School</h3>
                    <p class="text-sm text-ink-muted mb-2">Khulna</p>
                    <p class="text-ink-secondary">Secondary School Certificate (SSC)</p>
                </article>
            </div>

            <div class="mt-8">
                <article class="bg-surface border border-surface-border rounded-xl p-6 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-mono text-xs tracking-widest text-brand-emerald uppercase mb-2">Professional Certification</p>
                        <h3 class="text-lg font-bold text-ink-primary">Android Application Development</h3>
                        <p class="text-sm text-ink-secondary">BITM &mdash; Bangladesh Institute of Management</p>
                    </div>
                    <span class="font-mono text-xs px-3 py-1 rounded-full bg-brand-emerald/15 text-brand-emerald border border-brand-emerald/30">certified</span>
                </article>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="px-6 py-24">
        <div class="max-w-content mx-auto text-center reveal">
            <p class="font-mono text-xs tracking-widest text-brand-cyan uppercase mb-4">06 &mdash; Contact</p>
            <h2 class="text-4xl md:text-5xl font-bold text-ink-primary tracking-tight mb-6">Get in touch</h2>
            <p class="text-lg text-ink-secondary max-w-2xl mx-auto mb-10 leading-relaxed">Open to remote and Dhaka-based mobile engineering roles. The fastest way to reach me is email &mdash; I usually reply within a day.</p>
            <a href="mailto:shipon0142@gmail.com" class="inline-flex items-center gap-2 font-mono text-base px-8 py-4 rounded border border-brand-cyan text-brand-cyan hover:bg-brand-cyan/10 transition-colors">
                Email me
                <span aria-hidden="true">→</span>
            </a>
            <div class="mt-10 flex items-center justify-center gap-6 text-ink-secondary">
                <a href="mailto:shipon0142@gmail.com" class="hover:text-brand-cyan transition-colors font-mono text-sm">shipon0142@gmail.com</a>
                <span class="text-ink-muted">·</span>
                <a href="tel:+8801925727000" class="hover:text-brand-cyan transition-colors font-mono text-sm">+880 1925 727000</a>
            </div>
        </div>
    </section>

</main>

<footer class="px-6 py-10 border-t border-surface-border">
    <div class="max-w-content mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="font-mono text-xs text-ink-muted">&copy; 2026 Shipon Sarder &mdash; Built with Laravel &amp; Tailwind</p>
        <div class="flex items-center gap-5">
            <a href="https://github.com/shipon0142" target="_blank" rel="noopener" aria-label="GitHub" class="text-ink-secondary hover:text-brand-cyan transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 .5C5.65.5.5 5.65.5 12c0 5.08 3.29 9.39 7.86 10.91.58.11.79-.25.79-.55 0-.27-.01-1.16-.02-2.11-3.2.7-3.87-1.36-3.87-1.36-.53-1.34-1.29-1.7-1.29-1.7-1.05-.72.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.71 1.26 3.37.96.1-.75.4-1.26.73-1.55-2.55-.29-5.24-1.28-5.24-5.7 0-1.26.45-2.29 1.19-3.1-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18a11 11 0 0 1 5.79 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.59.23 2.76.12 3.05.74.81 1.19 1.84 1.19 3.1 0 4.43-2.69 5.4-5.26 5.69.41.35.78 1.05.78 2.12 0 1.53-.01 2.76-.01 3.14 0 .3.21.66.8.55A11.5 11.5 0 0 0 23.5 12C23.5 5.65 18.35.5 12 .5Z"/></svg>
            </a>
            <a href="https://linkedin.com/in/shipon-sarder-900727102" target="_blank" rel="noopener" aria-label="LinkedIn" class="text-ink-secondary hover:text-brand-cyan transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M20.45 20.45h-3.55v-5.57c0-1.33-.02-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.95v5.66H9.36V9h3.41v1.56h.05c.47-.9 1.63-1.85 3.36-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29ZM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12ZM7.12 20.45H3.56V9h3.56v11.45ZM22.22 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.72V1.72C24 .77 23.2 0 22.22 0Z"/></svg>
            </a>
            <a href="mailto:shipon0142@gmail.com" aria-label="Email" class="text-ink-secondary hover:text-brand-cyan transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M22 6l-10 7L2 6"/></svg>
            </a>
        </div>
    </div>
</footer>

<script>
    // Mobile menu
    (function () {
        var btn = document.getElementById('menuBtn');
        var nav = document.getElementById('mobileNav');
        if (!btn || !nav) return;
        btn.addEventListener('click', function () {
            var open = !nav.classList.contains('hidden');
            nav.classList.toggle('hidden');
            btn.setAttribute('aria-expanded', String(!open));
        });
        nav.querySelectorAll('a').forEach(function (a) {
            a.addEventListener('click', function () {
                nav.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            });
        });
    })();

    // Reveal on scroll
    (function () {
        var els = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            els.forEach(function (el) { el.classList.add('revealed'); });
            return;
        }
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    io.unobserve(entry.target);
                }
            });
        }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });
        els.forEach(function (el) { io.observe(el); });
    })();
</script>

</body>
</html>
