<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shipon Sarder — Senior mobile engineer shipping Android and Flutter apps that scale. 100K+ installs, 5 years in production.">
    <title>Shipon Sarder — Senior Mobile Engineer</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <script>
        (function () {
            try {
                var stored = localStorage.getItem('theme');
                var theme = stored === 'dark' || stored === 'light'
                    ? stored
                    : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                document.documentElement.dataset.theme = theme;
            } catch (e) {
                document.documentElement.dataset.theme = 'dark';
            }
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
            if (!window.location.hash) {
                window.scrollTo(0, 0);
            }
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: ['selector', '[data-theme="dark"]'],
            theme: {
                extend: {
                    colors: {
                        base: 'var(--bg-base)',
                        surface: 'var(--bg-surface)',
                        elevated: 'var(--bg-elevated)',
                        border: 'var(--border)',
                        'border-strong': 'var(--border-strong)',
                        ink: {
                            primary: 'var(--ink-primary)',
                            secondary: 'var(--ink-secondary)',
                            muted: 'var(--ink-muted)',
                        },
                        accent: {
                            DEFAULT: 'var(--accent)',
                            soft: 'var(--accent-soft)',
                            faint: 'var(--accent-faint)',
                        },
                    },
                    fontFamily: {
                        sans: ['Geist', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                    },
                    maxWidth: { content: '76rem' },
                    boxShadow: {
                        glow: '0 0 60px -12px rgb(0 217 255 / 0.25)',
                        card: '0 1px 0 0 var(--border), 0 0 0 1px var(--border)',
                    },
                },
            },
        };
    </script>

    <style>
        :root, [data-theme='light'] {
            --bg-base: #FAFAF9;
            --bg-surface: #FFFFFF;
            --bg-elevated: #F5F5F4;
            --border: #E7E5E4;
            --border-strong: #D6D3D1;
            --ink-primary: #0A0A0A;
            --ink-secondary: #52525B;
            --ink-muted: #78716C;
            --accent: #0891B2;
            --accent-soft: #06B6D4;
            --accent-faint: rgba(8, 145, 178, 0.08);
            --grid-line: rgba(0, 0, 0, 0.045);
            --spot-color: rgba(8, 145, 178, 0.10);
        }
        [data-theme='dark'] {
            --bg-base: #08080A;
            --bg-surface: #0F0F11;
            --bg-elevated: #131316;
            --border: #1F1F23;
            --border-strong: #2A2A30;
            --ink-primary: #FAFAFA;
            --ink-secondary: #A1A1AA;
            --ink-muted: #71717A;
            --accent: #22D3EE;
            --accent-soft: #67E8F9;
            --accent-faint: rgba(34, 211, 238, 0.10);
            --grid-line: rgba(255, 255, 255, 0.035);
            --spot-color: rgba(34, 211, 238, 0.12);
        }

        html, body {
            background: var(--bg-base);
            color: var(--ink-primary);
        }
        body {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            min-height: 100vh;
            transition: background-color 300ms ease, color 300ms ease;
            -webkit-font-smoothing: antialiased;
            font-feature-settings: 'ss01', 'cv11';
        }
        :focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
            border-radius: 4px;
        }

        .display-sans {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            font-weight: 600;
            letter-spacing: -0.035em;
            line-height: 0.95;
        }
        .display-sans-light {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            font-weight: 500;
            letter-spacing: -0.03em;
            line-height: 1.02;
        }
        .section-title {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            font-weight: 600;
            letter-spacing: -0.025em;
            font-size: clamp(2rem, 3.5vw, 2.75rem);
            line-height: 1.1;
            color: var(--ink-primary);
        }
        .label-mono {
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--ink-muted);
        }

        .link-underline { position: relative; display: inline-block; }
        .link-underline::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            height: 1px;
            width: 0%;
            background: currentColor;
            transition: width 300ms cubic-bezier(0.16, 1, 0.3, 1);
        }
        .link-underline:hover::after,
        .link-underline:focus-visible::after { width: 100%; }

        .chip {
            display: inline-flex;
            align-items: center;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.7rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.28rem 0.65rem;
            border: 1px solid var(--border);
            color: var(--ink-secondary);
            border-radius: 6px;
            background: var(--bg-elevated);
            transition: border-color 200ms ease, color 200ms ease, background 200ms ease;
        }
        .chip:hover {
            border-color: var(--border-strong);
            color: var(--ink-primary);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.85rem;
            border: 1px solid var(--border);
            border-radius: 999px;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--ink-secondary);
            background: var(--bg-surface);
        }

        /* Hero backdrop: grid pattern + cursor spotlight */
        .hero-backdrop {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(to right, var(--grid-line) 1px, transparent 1px),
                linear-gradient(to bottom, var(--grid-line) 1px, transparent 1px);
            background-size: 56px 56px;
            mask-image: radial-gradient(ellipse 90% 60% at 50% 40%, black 20%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse 90% 60% at 50% 40%, black 20%, transparent 80%);
        }
        .hero-spotlight {
            position: absolute;
            inset: 0;
            background: radial-gradient(600px circle at var(--x, 50%) var(--y, 30%), var(--spot-color), transparent 45%);
            transition: background 100ms ease;
        }

        /* Card polish */
        .card-surface {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            transition: border-color 250ms ease, transform 250ms ease, background 250ms ease;
        }
        .card-surface:hover {
            border-color: var(--border-strong);
            transform: translateY(-2px);
        }
        .card-surface .arrow-shift {
            transition: transform 250ms ease;
        }
        .card-surface:hover .arrow-shift {
            transform: translate(2px, -2px);
        }

        /* Timeline */
        .timeline-marker {
            position: absolute;
            left: 0;
            top: 0.4rem;
            width: 9px;
            height: 9px;
            border-radius: 999px;
            background: var(--ink-muted);
            box-shadow: 0 0 0 3px var(--bg-base);
        }
        .timeline-marker.current {
            background: var(--accent);
            box-shadow: 0 0 0 3px var(--bg-base), 0 0 12px 0 var(--accent);
        }

        .reveal {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        html.js-loaded .reveal:not(.revealed) {
            opacity: 0;
            transform: translateY(0.75rem);
        }
        .reveal.revealed { opacity: 1; transform: translateY(0); }

        .pulse-dot { animation: pulse-dot 2.4s ease-in-out infinite; }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.45; transform: scale(1.35); }
        }

        .nav-scrolled {
            background: color-mix(in srgb, var(--bg-base) 78%, transparent);
            border-bottom-color: var(--border);
        }

        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1; transform: none; transition: none; }
            .pulse-dot { animation: none; }
            .hero-spotlight { display: none; }
            html { scroll-behavior: auto; }
            .card-surface, .card-surface:hover { transform: none; }
        }
    </style>
</head>
<body class="antialiased">

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:bg-accent focus:text-base focus:px-3 focus:py-2 focus:rounded font-mono text-xs">Skip to content</a>

@php
    $nav = [
        ['id' => 'work',         'label' => 'Work'],
        ['id' => 'journey',      'label' => 'Experience'],
        ['id' => 'skills',       'label' => 'Stack'],
        ['id' => 'about',        'label' => 'About'],
        ['id' => 'credentials',  'label' => 'Credentials'],
        ['id' => 'contact',      'label' => 'Contact'],
    ];

    $featured = [
        [
            'name'      => 'MoveOn Global',
            'tagline'   => 'Cross-border eCommerce app for South-Asian shoppers. Shipped to 100K+ installs in the first three months. Led architecture, release pipeline, and monitoring.',
            'metric'    => '100K+ installs · 3 months',
            'tech'      => ['Flutter', 'BLoC', 'Clean Architecture', 'CI/CD', 'Sentry'],
            'link'      => 'https://play.google.com/store/apps/details?id=com.moveon.global',
            'linkLabel' => 'View on Play Store',
            'size'      => 'large',
        ],
        [
            'name'      => 'EduTune',
            'tagline'   => 'Live-class e-learning platform with LMS and an online reader.',
            'metric'    => 'Education · Java',
            'tech'      => ['Java', 'Zoom SDK', 'Firebase', 'OneSignal'],
            'link'      => 'https://play.google.com/store/apps/details?id=com.aitl.edutune',
            'linkLabel' => 'View on Play Store',
            'size'      => 'small',
        ],
        [
            'name'      => 'Mojaru',
            'tagline'   => 'School operations app for staff, teachers, and students.',
            'metric'    => 'K-12 · Kotlin',
            'tech'      => ['Kotlin', 'Firebase RTDB', 'OneSignal'],
            'link'      => 'https://play.google.com/store/apps/details?id=com.aitl.mojaru',
            'linkLabel' => 'View on Play Store',
            'size'      => 'small',
        ],
    ];

    $experience = [
        [
            'company'  => 'Envobyte Ltd',
            'role'     => 'Senior Software Engineer · Team Lead',
            'location' => 'Khulna, BD',
            'period'   => 'Jan 2026 — Present',
            'current'  => true,
            'bullets'  => [
                'Lead a cross-functional team of nine engineers.',
                'Build on Cloud Vision, ML Kit, and image-processing pipelines.',
            ],
        ],
        [
            'company'  => 'MoveOn Technologies Ltd.',
            'role'     => 'Senior Software Engineer',
            'location' => 'Dhaka, BD',
            'period'   => 'Dec 2023 — Dec 2025',
            'current'  => false,
            'bullets'  => [
                'Shipped a cross-border eCommerce app to 100K+ installs in three months.',
                'Optimized for wide device coverage on iOS and Android.',
                'Introduced Clean Architecture with BLoC for maintainable UI-logic separation.',
                'Built CI/CD for automated Play Store and App Store releases; Sentry + Discord alerting.',
                'Mentored junior engineers and ran code reviews.',
            ],
        ],
        [
            'company'  => 'Amreen Info Tech Ltd.',
            'role'     => 'Software Engineer',
            'location' => 'Khulna, BD',
            'period'   => 'Mar 2021 — Nov 2023',
            'current'  => false,
            'bullets'  => [
                'Built EduTune (Java) — live classes, LMS, online reader.',
                'Shipped Mojaru (Kotlin) for school administration workflows.',
                'Integrated a customized Zoom SDK for live classroom sessions.',
                'Wired Firebase Realtime DB for messaging and OneSignal for push.',
            ],
        ],
        [
            'company'  => 'Ali2BD',
            'role'     => 'Junior Software Engineer',
            'location' => 'Dhaka, BD',
            'period'   => 'Mar 2019 — Dec 2020',
            'current'  => false,
            'bullets'  => [
                'Built the Ali2BD shopping app in Java and XML.',
                'Scraped real-time product data via Jsoup.',
                'Tuned performance and UI responsiveness.',
            ],
        ],
    ];

    $skills = [
        ['group' => 'Languages',      'items' => ['Java', 'Kotlin', 'Dart', 'C', 'C++']],
        ['group' => 'Mobile & UI',    'items' => ['Flutter', 'Jetpack Compose', 'XML', 'Firebase']],
        ['group' => 'Architecture',   'items' => ['MVVM', 'MVP', 'Clean Architecture', 'BLoC', 'Provider', 'Riverpod']],
        ['group' => 'Workflow',       'items' => ['REST APIs', 'CI/CD', 'Code Review', 'Competitive Programming']],
    ];

    $education = [
        ['school' => 'Daffodil International University', 'location' => 'Dhaka',  'degree' => 'BSc, Computer Science & Engineering', 'period' => '2015 — 2019'],
        ['school' => 'Govt. MM City College',             'location' => 'Khulna', 'degree' => 'Higher Secondary Certificate',        'period' => '2011 — 2013'],
        ['school' => 'Bajua Union High School',           'location' => 'Khulna', 'degree' => 'Secondary School Certificate',        'period' => '2006 — 2011'],
    ];

    $certifications = [
        ['name' => 'Android Application Development', 'issuer' => 'BITM · Bangladesh Institute of Management', 'type' => 'Professional Certification'],
    ];

    $stats = [
        ['value' => '5+',    'label' => 'Years shipping'],
        ['value' => '100K+', 'label' => 'App installs'],
        ['value' => '9',     'label' => 'Engineers led'],
        ['value' => '4',     'label' => 'Companies'],
    ];
@endphp

<header id="site-header" class="fixed top-0 inset-x-0 z-40 border-b border-transparent transition-colors duration-300" style="backdrop-filter: saturate(140%) blur(10px); -webkit-backdrop-filter: saturate(140%) blur(10px);">
    <nav class="max-w-content mx-auto px-6 h-16 flex items-center justify-between" aria-label="Primary">
        <a href="#top" class="flex items-center gap-3" aria-label="Shipon Sarder — home">
            <img src="/avatar.jpg" alt="" width="30" height="30" class="w-[30px] h-[30px] rounded-full object-cover border border-border">
            <span class="hidden sm:inline text-[13.5px] font-medium tracking-tight text-ink-primary">Shipon Sarder</span>
        </a>
        <div class="hidden md:flex items-center gap-1">
            @foreach ($nav as $item)
                <a href="#{{ $item['id'] }}" class="nav-link px-3 py-1.5 rounded-md text-[13px] text-ink-secondary hover:text-ink-primary hover:bg-elevated transition-colors">{{ $item['label'] }}</a>
            @endforeach
            <span class="mx-2 h-5 w-px bg-border" aria-hidden="true"></span>
            <a href="/Shipon_Sarder_CV.pdf" download class="px-3 py-1.5 rounded-md text-[13px] text-ink-primary border border-border hover:border-border-strong transition-colors">
                CV
            </a>
            <button type="button" class="ml-1 p-2 text-ink-secondary hover:text-accent transition-colors" data-theme-toggle aria-label="Switch theme">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M4.93 4.93l1.41 1.41"/><path d="M17.66 17.66l1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="M6.34 17.66l-1.41 1.41"/><path d="M19.07 4.93l-1.41 1.41"/></svg>
            </button>
        </div>
        <button type="button" class="md:hidden p-2 text-ink-primary" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu" data-menu-toggle>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><path d="M3 6h18"/><path d="M3 12h18"/><path d="M3 18h18"/></svg>
        </button>
    </nav>
    <div id="mobile-menu" class="md:hidden hidden bg-base border-t border-border" data-mobile-menu>
        <div class="px-6 py-4">
            @foreach ($nav as $item)
                <a href="#{{ $item['id'] }}" class="block py-3 border-b border-border text-ink-secondary" data-mobile-link>{{ $item['label'] }}</a>
            @endforeach
            <div class="mt-4 flex items-center justify-between">
                <a href="/Shipon_Sarder_CV.pdf" download class="inline-flex items-center gap-2 font-mono text-xs text-ink-primary border border-border rounded-md px-3 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><path d="M7 10l5 5 5-5"/><path d="M12 15V3"/></svg>
                    <span>Download CV</span>
                </a>
                <button type="button" class="p-2 text-ink-secondary" data-theme-toggle aria-label="Switch theme">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/></svg>
                </button>
            </div>
        </div>
    </div>
</header>
<div id="top"></div>

<main id="main">

    {{-- Hero --}}
    <section id="hero" class="relative min-h-[100svh] flex items-center pt-28 pb-16">
        <div class="hero-backdrop" aria-hidden="true">
            <div class="hero-grid"></div>
            <div class="hero-spotlight" data-hero-spotlight></div>
        </div>

        <div class="relative max-w-content mx-auto px-6 w-full">
            <div class="flex items-center gap-3 mb-8">
                <span class="status-pill">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent pulse-dot" aria-hidden="true"></span>
                    Available for new work
                </span>
                <span class="hidden sm:inline label-mono">Dhaka · Bangladesh</span>
            </div>

            <h1 class="display-sans text-ink-primary" style="font-size: clamp(3rem, 9vw, 6.5rem);">
                Shipon Sarder<span class="text-accent">.</span>
            </h1>

            <p class="mt-8 max-w-2xl text-[19px] md:text-[21px] text-ink-secondary leading-[1.55]">
                Senior mobile engineer building Android and Flutter apps that scale — shipped to 100K+ installs, currently leading nine engineers at Envobyte.
            </p>

            <div class="mt-10 flex flex-wrap items-center gap-3">
                <a href="#work" class="inline-flex items-center gap-2 text-sm font-medium hover:opacity-90 transition-opacity rounded-md px-5 py-2.5" style="background: var(--ink-primary); color: var(--bg-base);">
                    View selected work
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                </a>
                <a href="/Shipon_Sarder_CV.pdf" download class="inline-flex items-center gap-2 text-sm font-medium text-ink-primary border border-border hover:border-border-strong transition-colors rounded-md px-5 py-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><path d="M7 10l5 5 5-5"/><path d="M12 15V3"/></svg>
                    Download CV
                </a>
                <a href="mailto:shipon0142@gmail.com" class="link-underline inline-flex items-center gap-2 text-sm text-ink-secondary hover:text-ink-primary transition-colors ml-1">
                    shipon0142@gmail.com
                </a>
            </div>

            <div class="mt-20 pt-8 border-t border-border grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-10 max-w-4xl">
                <div>
                    <p class="label-mono">Currently</p>
                    <p class="mt-2 text-sm text-ink-primary">Senior Software Engineer</p>
                    <p class="text-sm text-ink-secondary">Envobyte, Khulna</p>
                </div>
                <div>
                    <p class="label-mono">Experience</p>
                    <p class="mt-2 text-sm text-ink-primary">5+ years shipping</p>
                    <p class="text-sm text-ink-secondary">Android · Flutter</p>
                </div>
                <div>
                    <p class="label-mono">Scale</p>
                    <p class="mt-2 text-sm text-ink-primary">100K+ installs</p>
                    <p class="text-sm text-ink-secondary">Play Store, in production</p>
                </div>
                <div>
                    <p class="label-mono">Team</p>
                    <p class="mt-2 text-sm text-ink-primary">Leading 9 engineers</p>
                    <p class="text-sm text-ink-secondary">Cross-functional</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Selected Work --}}
    <section id="work" class="py-24 md:py-32 border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-14">
                <div class="max-w-2xl">
                    <p class="label-mono">Selected Work · 01</p>
                    <h2 class="mt-4 section-title">Apps in production.</h2>
                </div>
                <p class="text-ink-secondary max-w-md text-[15px] leading-relaxed">
                    A short shortlist. Each app is live on the Play Store — built or led end-to-end from architecture to release pipeline.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 md:gap-5 auto-rows-fr">
                @foreach ($featured as $i => $p)
                    @php $span = $p['size'] === 'large' ? 'md:col-span-4 md:row-span-2' : 'md:col-span-2'; @endphp
                    <article class="card-surface reveal flex flex-col p-6 md:p-8 {{ $span }}">
                        <div class="flex items-start justify-between gap-4">
                            <p class="label-mono text-ink-secondary">{{ $p['metric'] }}</p>
                            <span class="text-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 arrow-shift" aria-hidden="true"><path d="M7 17L17 7"/><path d="M8 7h9v9"/></svg>
                            </span>
                        </div>

                        <h3 class="mt-6 display-sans-light text-ink-primary {{ $p['size'] === 'large' ? 'text-4xl md:text-6xl' : 'text-3xl md:text-4xl' }}">
                            {{ $p['name'] }}
                        </h3>

                        <p class="mt-4 text-ink-secondary text-[15px] leading-relaxed {{ $p['size'] === 'large' ? 'max-w-xl' : '' }}">
                            {{ $p['tagline'] }}
                        </p>

                        <div class="mt-auto pt-8 flex flex-wrap items-center gap-x-2 gap-y-2">
                            @foreach ($p['tech'] as $j => $t)
                                <span class="font-mono text-[11px] text-ink-muted">{{ $t }}</span>
                                @if ($j < count($p['tech']) - 1)
                                    <span class="text-ink-muted" style="opacity: 0.5;" aria-hidden="true">·</span>
                                @endif
                            @endforeach
                        </div>

                        <div class="mt-5">
                            <a href="{{ $p['link'] }}" target="_blank" rel="noopener noreferrer" class="link-underline inline-flex items-center gap-2 text-sm text-accent">
                                <span>{{ $p['linkLabel'] }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5" aria-hidden="true"><path d="M7 17L17 7"/><path d="M8 7h9v9"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Experience --}}
    <section id="journey" class="py-24 md:py-32 bg-surface border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl mb-14">
                <p class="label-mono">Experience · 02</p>
                <h2 class="mt-4 section-title">Where I've been.</h2>
            </div>

            <div class="space-y-14 md:space-y-16">
                @foreach ($experience as $e)
                    <article class="reveal grid md:grid-cols-12 gap-6 md:gap-10 pb-14 md:pb-16 border-b border-border last:border-b-0 last:pb-0">
                        <div class="md:col-span-3">
                            <p class="label-mono text-ink-secondary">{{ $e['period'] }}</p>
                            <p class="mt-2 text-sm text-ink-muted">{{ $e['location'] }}</p>
                            @if ($e['current'])
                                <span class="mt-3 inline-flex items-center gap-2 font-mono text-[11px] uppercase tracking-widest text-accent">
                                    <span class="w-1.5 h-1.5 rounded-full bg-accent pulse-dot" aria-hidden="true"></span>
                                    Current
                                </span>
                            @endif
                        </div>
                        <div class="md:col-span-9">
                            <h3 class="display-sans-light text-2xl md:text-[28px] text-ink-primary">{{ $e['company'] }}</h3>
                            <p class="mt-1 text-ink-secondary text-[15px]">{{ $e['role'] }}</p>
                            <ul class="mt-6 space-y-3 text-ink-secondary text-[15px] leading-relaxed max-w-2xl">
                                @foreach ($e['bullets'] as $b)
                                    <li class="flex gap-3">
                                        <span class="text-ink-muted mt-2 flex-shrink-0 w-1 h-1 rounded-full bg-current" aria-hidden="true"></span>
                                        <span>{{ $b }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Stack --}}
    <section id="skills" class="py-24 md:py-32 border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl mb-14">
                <p class="label-mono">Stack · 03</p>
                <h2 class="mt-4 section-title">Tools I reach for.</h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
                @foreach ($skills as $g)
                    <div class="reveal">
                        <p class="label-mono">{{ $g['group'] }}</p>
                        <ul class="mt-5 space-y-2.5">
                            @foreach ($g['items'] as $item)
                                <li class="text-[15px] text-ink-primary flex items-center gap-2.5">
                                    <span class="w-1 h-1 rounded-full bg-ink-muted flex-shrink-0" aria-hidden="true"></span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- About --}}
    <section id="about" class="py-24 md:py-32 bg-surface border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl mb-14">
                <p class="label-mono">About · 04</p>
                <h2 class="mt-4 section-title">A bit about me.</h2>
            </div>

            <div class="grid md:grid-cols-12 gap-10 md:gap-14 items-start">
                <div class="md:col-span-4 lg:col-span-3 reveal">
                    <div class="relative">
                        <img src="/avatar.jpg" alt="Shipon Sarder" width="280" height="280" class="w-56 h-56 md:w-full md:h-auto md:aspect-square rounded-2xl object-cover border border-border">
                        <div class="absolute -bottom-3 -right-3 hidden md:flex items-center gap-2 px-3 py-2 rounded-lg bg-base border border-border font-mono text-[11px] text-ink-secondary uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent pulse-dot" aria-hidden="true"></span>
                            Dhaka, BD
                        </div>
                    </div>
                </div>

                <div class="md:col-span-8 lg:col-span-9 reveal">
                    <div class="space-y-5 text-[17px] leading-[1.7] text-ink-secondary">
                        <p>
                            I build mobile apps that people rely on daily. Five years in, my work spans eCommerce, education, and productivity — always with a focus on performance, clean architecture, and code the next engineer can maintain.
                        </p>
                        <p>
                            At Envobyte I lead a team of nine engineers building on Cloud Vision and ML Kit. Before that, I shipped MoveOn Global — a cross-border eCommerce app that reached 100K+ installs in three months. What I care about: mentorship, thorough code review, and CI/CD that catches issues before users do.
                        </p>
                        <p>
                            Outside of work I stay sharp with competitive programming and I'm quietly interested in on-device ML for mobile.
                        </p>
                    </div>

                    <dl class="mt-12 pt-10 border-t border-border grid grid-cols-2 md:grid-cols-4 gap-8">
                        @foreach ($stats as $s)
                            <div>
                                <dt class="label-mono">{{ $s['label'] }}</dt>
                                <dd class="mt-2 display-sans-light text-3xl md:text-4xl text-ink-primary">{{ $s['value'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </section>

    {{-- Credentials --}}
    <section id="credentials" class="py-24 md:py-32 border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl mb-14">
                <p class="label-mono">Credentials · 05</p>
                <h2 class="mt-4 section-title">Education & Certifications.</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-12 md:gap-16">
                <div class="reveal">
                    <p class="label-mono mb-6">Education</p>
                    <div class="space-y-6">
                        @foreach ($education as $ed)
                            <article class="pb-6 border-b border-border last:border-b-0 last:pb-0">
                                <div class="flex items-baseline justify-between gap-4">
                                    <h3 class="text-[17px] text-ink-primary font-medium">{{ $ed['school'] }}</h3>
                                    <span class="label-mono flex-shrink-0">{{ $ed['period'] }}</span>
                                </div>
                                <p class="mt-1 text-ink-secondary text-[15px]">{{ $ed['degree'] }}</p>
                                <p class="mt-1 text-sm text-ink-muted">{{ $ed['location'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="reveal">
                    <p class="label-mono mb-6">Certifications</p>
                    <div class="space-y-6">
                        @foreach ($certifications as $c)
                            <article class="pb-6 border-b border-border last:border-b-0 last:pb-0">
                                <h3 class="text-[17px] text-ink-primary font-medium">{{ $c['name'] }}</h3>
                                <p class="mt-1 text-ink-secondary text-[15px]">{{ $c['issuer'] }}</p>
                                <p class="mt-1 label-mono">{{ $c['type'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section id="contact" class="py-24 md:py-32 bg-surface border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="max-w-3xl reveal">
                <p class="label-mono">Contact · 06</p>
                <h2 class="mt-4 display-sans text-ink-primary" style="font-size: clamp(2.5rem, 6vw, 4.5rem);">
                    Let's talk<span class="text-accent">.</span>
                </h2>
                <p class="mt-8 text-[17px] md:text-[19px] text-ink-secondary leading-[1.6] max-w-2xl">
                    Currently open to remote or Dhaka-based senior mobile roles. Email is fastest — I reply within a day.
                </p>

                <a href="mailto:shipon0142@gmail.com" class="link-underline mt-10 inline-flex display-sans-light text-2xl md:text-4xl text-accent">
                    shipon0142@gmail.com
                </a>

                <div class="mt-12 pt-8 border-t border-border flex flex-wrap items-center gap-6 md:gap-8 text-ink-secondary">
                    <a href="https://github.com/shipon0142" target="_blank" rel="noopener noreferrer" class="link-underline inline-flex items-center gap-2 text-sm hover:text-ink-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M12 .5C5.65.5.5 5.65.5 12c0 5.09 3.29 9.4 7.86 10.93.58.11.79-.25.79-.55 0-.27-.01-1.16-.02-2.11-3.19.69-3.87-1.36-3.87-1.36-.52-1.33-1.28-1.69-1.28-1.69-1.05-.71.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.7 1.26 3.36.96.1-.74.4-1.26.72-1.55-2.55-.29-5.23-1.28-5.23-5.68 0-1.25.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18a11.1 11.1 0 0 1 2.9-.39c.98 0 1.97.13 2.9.39 2.21-1.49 3.18-1.18 3.18-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.84 1.19 3.09 0 4.41-2.69 5.38-5.25 5.66.41.36.78 1.06.78 2.14 0 1.54-.01 2.79-.01 3.16 0 .3.21.67.8.55C20.21 21.4 23.5 17.09 23.5 12 23.5 5.65 18.35.5 12 .5z"/></svg>
                        GitHub
                    </a>
                    <a href="https://linkedin.com/in/shipon-sarder-900727102" target="_blank" rel="noopener noreferrer" class="link-underline inline-flex items-center gap-2 text-sm hover:text-ink-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM19 19h-3v-4.74c0-1.13-.02-2.58-1.57-2.58-1.57 0-1.81 1.23-1.81 2.5V19h-3v-9h2.88v1.23h.04a3.16 3.16 0 012.85-1.56c3.05 0 3.61 2 3.61 4.61z"/></svg>
                        LinkedIn
                    </a>
                    <a href="tel:+8801925727000" class="link-underline inline-flex items-center gap-2 text-sm hover:text-ink-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.37 1.9.72 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0122 16.92z"/></svg>
                        WhatsApp
                    </a>
                    <a href="mailto:shipon0142@gmail.com" class="link-underline inline-flex items-center gap-2 text-sm hover:text-ink-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                        Email
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="border-t border-border py-10">
    <div class="max-w-content mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="font-mono text-xs text-ink-muted">© {{ date('Y') }} Shipon Sarder — built in Dhaka.</p>
        <p class="font-mono text-xs text-ink-muted">Laravel · Tailwind · Geist</p>
        <div class="flex items-center gap-2">
            <button type="button" class="p-2 text-ink-secondary hover:text-accent transition-colors" data-theme-toggle aria-label="Switch theme">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/></svg>
            </button>
            <a href="#top" class="p-2 text-ink-secondary hover:text-accent transition-colors" aria-label="Back to top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]" aria-hidden="true"><path d="M12 19V5"/><path d="M5 12l7-7 7 7"/></svg>
            </a>
        </div>
    </div>
</footer>

<script>
    // Theme toggle
    (function () {
        var SUN = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M4.93 4.93l1.41 1.41"/><path d="M17.66 17.66l1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="M6.34 17.66l-1.41 1.41"/><path d="M19.07 4.93l-1.41 1.41"/></svg>';
        var MOON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>';

        function currentTheme() {
            return document.documentElement.dataset.theme
                || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        }
        function refreshIcons() {
            var t = currentTheme();
            var iconHtml = t === 'dark' ? SUN : MOON;
            document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
                btn.innerHTML = iconHtml;
                var next = t === 'dark' ? 'light' : 'dark';
                btn.setAttribute('aria-label', 'Switch to ' + next + ' theme');
            });
        }
        refreshIcons();
        new MutationObserver(refreshIcons).observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
            try { if (localStorage.getItem('theme')) return; } catch (err) { /* ignore */ }
            document.documentElement.dataset.theme = e.matches ? 'dark' : 'light';
        });

        document.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-theme-toggle]');
            if (!btn) return;
            var next = currentTheme() === 'dark' ? 'light' : 'dark';
            document.documentElement.dataset.theme = next;
            try { localStorage.setItem('theme', next); } catch (err) { /* ignore */ }
        });
    })();

    // Mobile menu
    (function () {
        var btn = document.querySelector('[data-menu-toggle]');
        var menu = document.querySelector('[data-mobile-menu]');
        if (!btn || !menu) return;
        function setOpen(open) {
            menu.classList.toggle('hidden', !open);
            btn.setAttribute('aria-expanded', String(open));
            btn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        }
        btn.addEventListener('click', function () { setOpen(menu.classList.contains('hidden')); });
        document.querySelectorAll('[data-mobile-link]').forEach(function (link) {
            link.addEventListener('click', function () { setOpen(false); });
        });
    })();

    // Reveal on scroll
    (function () {
        var els = document.querySelectorAll('.reveal');
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduced || !('IntersectionObserver' in window)) {
            els.forEach(function (el) { el.classList.add('revealed'); });
            return;
        }
        var vh = window.innerHeight;
        els.forEach(function (el) {
            var rect = el.getBoundingClientRect();
            if (rect.top < vh) el.classList.add('revealed');
        });
        document.documentElement.classList.add('js-loaded');
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        els.forEach(function (el) {
            if (!el.classList.contains('revealed')) io.observe(el);
        });
        setTimeout(function () {
            document.querySelectorAll('.reveal:not(.revealed)').forEach(function (el) {
                el.classList.add('revealed');
            });
        }, 2000);
    })();

    // Scroll spy
    (function () {
        var links = document.querySelectorAll('header nav a[href^="#"]');
        var sections = document.querySelectorAll('main > section[id]');
        if (!links.length || !sections.length || !('IntersectionObserver' in window)) return;
        var linkById = new Map();
        links.forEach(function (l) {
            var id = (l.getAttribute('href') || '').replace('#', '');
            if (id) linkById.set(id, l);
        });
        function setActive(id) {
            links.forEach(function (l) {
                l.classList.remove('text-ink-primary');
                l.classList.remove('bg-elevated');
                l.removeAttribute('aria-current');
            });
            var a = linkById.get(id);
            if (a) {
                a.classList.add('text-ink-primary');
                a.classList.add('bg-elevated');
                a.setAttribute('aria-current', 'true');
            }
        }
        var io = new IntersectionObserver(function (entries) {
            var visible = entries.filter(function (e) { return e.isIntersecting; })
                .sort(function (a, b) { return b.intersectionRatio - a.intersectionRatio; });
            if (visible[0]) setActive(visible[0].target.id);
        }, { threshold: [0.25, 0.5, 0.75], rootMargin: '-80px 0px -40% 0px' });
        sections.forEach(function (s) { io.observe(s); });
    })();

    // Hero cursor spotlight
    (function () {
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduced) return;
        var hero = document.getElementById('hero');
        var spot = hero && hero.querySelector('[data-hero-spotlight]');
        if (!hero || !spot) return;
        hero.addEventListener('pointermove', function (e) {
            var rect = hero.getBoundingClientRect();
            var x = ((e.clientX - rect.left) / rect.width) * 100;
            var y = ((e.clientY - rect.top) / rect.height) * 100;
            spot.style.setProperty('--x', x + '%');
            spot.style.setProperty('--y', y + '%');
        });
    })();

    // Nav scroll state
    (function () {
        var header = document.getElementById('site-header');
        if (!header) return;
        function onScroll() {
            if (window.scrollY > 8) header.classList.add('nav-scrolled');
            else header.classList.remove('nav-scrolled');
        }
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    })();
</script>

</body>
</html>