<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Shipon Sarder — Software Engineer building mobile-first products that scale. 100K+ installs, 5+ years shipping Android and Flutter.">
    <title>Shipon Sarder — Software Engineer</title>
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
                    maxWidth: { content: '72rem' },
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
            --grid-line: rgba(0, 0, 0, 0.04);
            --spot-color: rgba(8, 145, 178, 0.08);
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
            --grid-line: rgba(255, 255, 255, 0.03);
            --spot-color: rgba(34, 211, 238, 0.10);
        }

        html, body {
            background: var(--bg-base);
            color: var(--ink-primary);
        }
        body {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            min-height: 100vh;
            transition: background-color 200ms ease, color 200ms ease;
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
            letter-spacing: -0.03em;
            line-height: 1;
        }
        .display-sans-light {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            font-weight: 500;
            letter-spacing: -0.025em;
            line-height: 1.05;
        }
        .section-title {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            font-weight: 600;
            letter-spacing: -0.02em;
            font-size: clamp(1.5rem, 2.6vw, 2rem);
            line-height: 1.15;
            color: var(--ink-primary);
        }
        .label-mono {
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.7rem;
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
            width: 0;
            background: currentColor;
            transition: width 250ms cubic-bezier(0.16, 1, 0.3, 1);
        }
        .link-underline:hover::after,
        .link-underline:focus-visible::after { width: 100%; }

        .chip {
            display: inline-flex;
            align-items: center;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.68rem;
            letter-spacing: 0.05em;
            padding: 0.24rem 0.55rem;
            border: 1px solid var(--border);
            color: var(--ink-secondary);
            border-radius: 5px;
            background: var(--bg-surface);
            transition: border-color 200ms ease, color 200ms ease;
        }
        .chip:hover {
            border-color: var(--border-strong);
            color: var(--ink-primary);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem;
            border: 1px solid var(--border);
            border-radius: 999px;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--ink-secondary);
            background: var(--bg-surface);
        }

        /* Hero backdrop: static grid + soft radial */
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
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 80% 55% at 50% 40%, black 20%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse 80% 55% at 50% 40%, black 20%, transparent 80%);
        }
        .hero-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(500px circle at 50% 25%, var(--spot-color), transparent 55%);
        }

        /* Cards */
        .card-surface {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: border-color 200ms ease;
        }
        .card-surface:hover {
            border-color: var(--border-strong);
        }

        .competency-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            transition: border-color 200ms ease;
        }
        .competency-card:hover { border-color: var(--border-strong); }
        .competency-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--accent-faint);
            color: var(--accent);
        }

        .pulse-dot { animation: pulse-dot 2.4s ease-in-out infinite; }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }

        .nav-scrolled {
            background: color-mix(in srgb, var(--bg-base) 82%, transparent);
            border-bottom-color: var(--border);
        }

        @media (prefers-reduced-motion: reduce) {
            .pulse-dot { animation: none; }
            html { scroll-behavior: auto; }
        }
    </style>
</head>
<body class="antialiased">

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:bg-accent focus:text-base focus:px-3 focus:py-2 focus:rounded font-mono text-xs">Skip to content</a>

@php
    $nav = [
        ['id' => 'skills',       'label' => 'Skills'],
        ['id' => 'projects',     'label' => 'Projects'],
        ['id' => 'journey',      'label' => 'Experience'],
        ['id' => 'credentials',  'label' => 'Credentials'],
        ['id' => 'contact',      'label' => 'Contact'],
    ];

    $competencies = [
        [
            'label'   => 'Mobile Development',
            'summary' => 'Android (Kotlin, Java, Compose) & Flutter — production apps for eCommerce, edtech, K-12.',
            'icon'    => 'phone',
        ],
        [
            'label'   => 'Architecture & Patterns',
            'summary' => 'Clean Architecture, MVVM, BLoC, Riverpod — code the next engineer can maintain.',
            'icon'    => 'grid',
        ],
        [
            'label'   => 'Delivery & Tooling',
            'summary' => 'CI/CD to Play & App Store, Firebase, Sentry, ML Kit, Cloud Vision integrations.',
            'icon'    => 'zap',
        ],
        [
            'label'   => 'Leadership',
            'summary' => 'Currently leading nine engineers — code review, mentorship, release engineering.',
            'icon'    => 'users',
        ],
    ];

    $skills = [
        ['group' => 'Languages',    'items' => ['Kotlin', 'Java', 'Dart', 'C', 'C++', 'JavaScript']],
        ['group' => 'Mobile & UI',  'items' => ['Flutter', 'Jetpack Compose', 'Android SDK', 'XML', 'Material 3']],
        ['group' => 'Architecture', 'items' => ['Clean Architecture', 'MVVM', 'MVP', 'BLoC', 'Provider', 'Riverpod']],
        ['group' => 'Backend & Data','items' => ['REST APIs', 'Firebase', 'Firestore', 'Realtime DB', 'Room', 'SQLite']],
        ['group' => 'Delivery',     'items' => ['CI/CD', 'Fastlane', 'GitHub Actions', 'Play Console', 'App Store Connect']],
        ['group' => 'Observability','items' => ['Sentry', 'Firebase Crashlytics', 'Analytics', 'OneSignal']],
    ];

    // Dummy personal projects — replace later
    $personal = [
        [
            'name'    => 'PhotoNex AI',
            'summary' => 'AI-powered photo tools for creators — enhance, edit, and generate imagery on the web.',
            'tech'    => ['Next.js', 'TypeScript', 'AI'],
            'status'  => 'Live',
            'url'     => 'https://www.photonexai.com/',
        ],
        [
            'name'    => 'TaskFlow',
            'summary' => 'Local-first productivity app with offline sync and calendar integration.',
            'tech'    => ['Kotlin', 'Jetpack Compose', 'Room'],
            'status'  => 'In progress',
        ],
        [
            'name'    => 'MindMate',
            'summary' => 'On-device journaling with sentiment insights, no data leaves the phone.',
            'tech'    => ['Flutter', 'TensorFlow Lite'],
            'status'  => 'In progress',
        ],
        [
            'name'    => 'CodeMetrics',
            'summary' => 'CLI that reports code health signals across a git history.',
            'tech'    => ['Go', 'libgit2'],
            'status'  => 'Coming soon',
        ],
        [
            'name'    => 'APIHub',
            'summary' => 'A minimal API workbench for mobile engineers — collections, mocks, share links.',
            'tech'    => ['TypeScript', 'Next.js'],
            'status'  => 'Coming soon',
        ],
    ];

    $experience = [
        [
            'company'  => 'Rovex Labs',
            'role'     => 'Founder',
            'location' => 'rovexlabs.com',
            'period'   => '2026 — Present',
            'current'  => true,
            'bullets'  => [
                'Founded Rovex Labs to build mobile-first products at the edge of AI and everyday workflows.',
                'Set product direction, architecture, and engineering standards from day one.',
            ],
        ],
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

    $education = [
        ['school' => 'Daffodil International University', 'location' => 'Dhaka',  'degree' => 'BSc, Computer Science & Engineering', 'period' => '2015 — 2019'],
        ['school' => 'Govt. MM City College',             'location' => 'Khulna', 'degree' => 'Higher Secondary Certificate',        'period' => '2011 — 2013'],
        ['school' => 'Bajua Union High School',           'location' => 'Khulna', 'degree' => 'Secondary School Certificate',        'period' => '2006 — 2011'],
    ];

    $certifications = [
        ['name' => 'Android Application Development', 'issuer' => 'BITM · Bangladesh Institute of Management', 'type' => 'Professional Certification'],
    ];
@endphp

<header id="site-header" class="fixed top-0 inset-x-0 z-40 border-b border-transparent transition-colors duration-200" style="backdrop-filter: saturate(140%) blur(10px); -webkit-backdrop-filter: saturate(140%) blur(10px);">
    <nav class="max-w-content mx-auto px-6 h-14 flex items-center justify-between" aria-label="Primary">
        <a href="#top" class="flex items-center gap-2.5" aria-label="Shipon Sarder — home">
            <img src="/avatar.jpg" alt="" width="26" height="26" class="w-[26px] h-[26px] rounded-full object-cover border border-border">
            <span class="hidden sm:inline text-[13px] font-medium tracking-tight text-ink-primary">Shipon Sarder</span>
        </a>
        <div class="hidden md:flex items-center gap-0.5">
            @foreach ($nav as $item)
                <a href="#{{ $item['id'] }}" class="nav-link px-2.5 py-1.5 rounded-md text-[12.5px] text-ink-secondary hover:text-ink-primary transition-colors">{{ $item['label'] }}</a>
            @endforeach
            <span class="mx-2 h-4 w-px bg-border" aria-hidden="true"></span>
            <a href="/Shipon_Sarder_CV.pdf" download class="px-2.5 py-1.5 rounded-md text-[12.5px] text-ink-primary border border-border hover:border-border-strong transition-colors">CV</a>
            <button type="button" class="ml-1 p-1.5 text-ink-secondary hover:text-accent transition-colors" data-theme-toggle aria-label="Switch theme">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M4.93 4.93l1.41 1.41"/><path d="M17.66 17.66l1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="M6.34 17.66l-1.41 1.41"/><path d="M19.07 4.93l-1.41 1.41"/></svg>
            </button>
        </div>
        <button type="button" class="md:hidden p-2 text-ink-primary" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu" data-menu-toggle>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><path d="M3 6h18"/><path d="M3 12h18"/><path d="M3 18h18"/></svg>
        </button>
    </nav>
    <div id="mobile-menu" class="md:hidden hidden bg-base border-t border-border" data-mobile-menu>
        <div class="px-6 py-4">
            @foreach ($nav as $item)
                <a href="#{{ $item['id'] }}" class="block py-2.5 border-b border-border text-ink-secondary text-[14px]" data-mobile-link>{{ $item['label'] }}</a>
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
    <section id="hero" class="relative flex items-center pt-24 pb-16 md:pt-28 md:pb-20 min-h-[88svh]">
        <div class="hero-backdrop" aria-hidden="true">
            <div class="hero-grid"></div>
            <div class="hero-glow"></div>
        </div>

        <div class="relative max-w-content mx-auto px-6 w-full">
            <div class="flex flex-wrap items-center gap-3 mb-6">
                <span class="status-pill">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent pulse-dot" aria-hidden="true"></span>
                    Available for new work
                </span>
                <span class="label-mono">Dhaka · Bangladesh</span>
            </div>

            <h1 class="display-sans text-ink-primary" style="font-size: clamp(2.5rem, 5.5vw, 4.25rem);">
                Shipon Sarder<span class="text-accent">.</span>
            </h1>

            <div class="mt-8">
                <div class="grid md:grid-cols-12 gap-8 md:gap-10 items-start">
                    <div class="md:col-span-4 lg:col-span-3 md:order-2">
                        <div class="relative max-w-[220px] md:max-w-none md:ml-auto">
                            <img src="/avatar.jpg" alt="Shipon Sarder" width="240" height="240" class="w-40 h-40 md:w-full md:h-auto md:aspect-square rounded-xl object-cover border border-border">
                        </div>
                    </div>

                    <div class="md:col-span-8 lg:col-span-9 md:order-1">
                        <div class="space-y-4 text-[15px] leading-[1.65] text-ink-secondary max-w-2xl">
                            <p>
                                Shipon Sarder is a Senior Mobile Application Developer with 5+ years of hands-on experience building native Android and cross-platform Flutter applications. He has led cross-functional engineering teams and brings strong technical depth in Clean Architecture, MVVM, MVP, and modern state management (BLoC, Riverpod, Provider).
                            </p>
                            <p>
                                His impact spans the full app lifecycle: architecting a cross-border eCommerce app, implementing CI/CD pipelines with automated Play Store and App Store deployment, and integrating real-time error monitoring via Sentry and Discord. He's also worked at the intersection of mobile and AI, applying Cloud Vision and ML Kit for image processing.
                            </p>
                            <p>
                                A mentor at heart, Shipon has driven team productivity through rigorous code reviews and documentation standards, while consistently delivering apps praised for performance and user experience. He holds a BSc in Computer Science and Engineering and is a certified Android Application Developer.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="#skills" class="inline-flex items-center gap-2 text-[13.5px] font-medium hover:opacity-90 transition-opacity rounded-md px-4 py-2.5" style="background: var(--ink-primary); color: var(--bg-base);">
                    View skills
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5" aria-hidden="true"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                </a>
                <a href="/Shipon_Sarder_CV.pdf" download class="inline-flex items-center gap-2 text-[13.5px] font-medium text-ink-primary border border-border hover:border-border-strong transition-colors rounded-md px-4 py-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><path d="M7 10l5 5 5-5"/><path d="M12 15V3"/></svg>
                    Download CV
                </a>
                <a href="mailto:shipon0142@gmail.com" class="link-underline inline-flex items-center gap-2 text-[13.5px] text-ink-secondary hover:text-ink-primary transition-colors ml-1">
                    shipon0142@gmail.com
                </a>
            </div>

            <div class="mt-14 pt-6 border-t border-border grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 md:gap-8 max-w-3xl">
                <div>
                    <p class="label-mono">Founder</p>
                    <p class="mt-1.5 text-[13.5px] font-semibold tracking-tight text-ink-primary">
                        Rovex<span style="color:#4a86ff;">Labs</span>
                    </p>
                    <a href="https://rovexlabs.com" target="_blank" rel="noopener noreferrer" class="link-underline text-[13px] text-ink-secondary hover:text-ink-primary transition-colors">rovexlabs.com</a>
                </div>
                <div>
                    <p class="label-mono">Currently</p>
                    <p class="mt-1.5 text-[13.5px] text-ink-primary">Senior Software Engineer</p>
                    <p class="text-[13px] text-ink-secondary">Envobyte, Khulna</p>
                </div>
                <div>
                    <p class="label-mono">Experience</p>
                    <p class="mt-1.5 text-[13.5px] text-ink-primary">5+ years shipping</p>
                    <p class="text-[13px] text-ink-secondary">Android · Flutter</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Skills (elevated — the focus) --}}
    <section id="skills" class="py-20 md:py-24 bg-surface border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="max-w-2xl mb-10">
                <p class="label-mono">Skills</p>
                <h2 class="mt-3 section-title">What I build with.</h2>
                <p class="mt-3 text-ink-secondary text-[14.5px] leading-relaxed">
                    Core competencies first, then the full stack. Depth in mobile, patterns, and delivery — with a bias for code that lasts.
                </p>
            </div>

            {{-- Core competencies --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-12">
                @foreach ($competencies as $c)
                    <div class="competency-card">
                        <div class="competency-icon" aria-hidden="true">
                            @switch($c['icon'])
                                @case('phone')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><rect x="5" y="2" width="14" height="20" rx="2.5"/><path d="M11 18h2"/></svg>
                                    @break
                                @case('grid')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                                    @break
                                @case('zap')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                                    @break
                                @case('users')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    @break
                            @endswitch
                        </div>
                        <h3 class="mt-4 text-[14.5px] font-medium text-ink-primary tracking-tight">{{ $c['label'] }}</h3>
                        <p class="mt-1.5 text-[13.5px] text-ink-secondary leading-relaxed">{{ $c['summary'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Full stack grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-8 pt-10 border-t border-border">
                @foreach ($skills as $g)
                    <div>
                        <p class="label-mono">{{ $g['group'] }}</p>
                        <div class="mt-3 flex flex-wrap gap-1.5">
                            @foreach ($g['items'] as $item)
                                <span class="chip">{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Personal Projects (dummy data) --}}
    <section id="projects" class="py-20 md:py-24 border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
                <div class="max-w-2xl">
                    <p class="label-mono">Personal Projects</p>
                    <h2 class="mt-3 section-title">Things I'm building.</h2>
                </div>
                <p class="text-ink-secondary max-w-md text-[14px] leading-relaxed">
                    Side projects and experiments. Placeholder cards for now — real projects landing soon.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($personal as $p)
                    <article class="card-surface flex flex-col p-5">
                        <div class="flex items-center justify-between">
                            <p class="label-mono">{{ $p['status'] }}</p>
                            @if (!empty($p['url']))
                                <a href="{{ $p['url'] }}" target="_blank" rel="noopener noreferrer" class="text-ink-muted hover:text-accent transition-colors" aria-label="Visit {{ $p['name'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><path d="M7 17L17 7"/><path d="M8 7h9v9"/></svg>
                                </a>
                            @else
                                <span class="text-ink-muted" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><path d="M7 17L17 7"/><path d="M8 7h9v9"/></svg>
                                </span>
                            @endif
                        </div>
                        @if (!empty($p['url']))
                            <h3 class="mt-4 text-[16px] font-medium text-ink-primary tracking-tight">
                                <a href="{{ $p['url'] }}" target="_blank" rel="noopener noreferrer" class="link-underline hover:text-accent transition-colors">{{ $p['name'] }}</a>
                            </h3>
                        @else
                            <h3 class="mt-4 text-[16px] font-medium text-ink-primary tracking-tight">{{ $p['name'] }}</h3>
                        @endif
                        <p class="mt-1.5 text-[13.5px] text-ink-secondary leading-relaxed">{{ $p['summary'] }}</p>
                        <div class="mt-auto pt-5 flex flex-wrap gap-x-2 gap-y-1">
                            @foreach ($p['tech'] as $j => $t)
                                <span class="font-mono text-[11px] text-ink-muted">{{ $t }}</span>
                                @if ($j < count($p['tech']) - 1)
                                    <span class="text-ink-muted" style="opacity: 0.4;" aria-hidden="true">·</span>
                                @endif
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Experience --}}
    <section id="journey" class="py-20 md:py-24 bg-surface border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="max-w-2xl mb-10">
                <p class="label-mono">Experience</p>
                <h2 class="mt-3 section-title">Where I've been.</h2>
            </div>

            <div class="space-y-10 md:space-y-12">
                @foreach ($experience as $e)
                    <article class="grid md:grid-cols-12 gap-5 md:gap-10 pb-10 md:pb-12 border-b border-border last:border-b-0 last:pb-0">
                        <div class="md:col-span-3">
                            <p class="label-mono text-ink-secondary">{{ $e['period'] }}</p>
                            <p class="mt-1.5 text-[13px] text-ink-muted">{{ $e['location'] }}</p>
                            @if ($e['current'])
                                <span class="mt-2.5 inline-flex items-center gap-2 font-mono text-[10.5px] uppercase tracking-widest text-accent">
                                    <span class="w-1.5 h-1.5 rounded-full bg-accent pulse-dot" aria-hidden="true"></span>
                                    Current
                                </span>
                            @endif
                        </div>
                        <div class="md:col-span-9">
                            <h3 class="display-sans-light text-xl md:text-[22px] text-ink-primary">{{ $e['company'] }}</h3>
                            <p class="mt-1 text-ink-secondary text-[13.5px]">{{ $e['role'] }}</p>
                            <ul class="mt-4 space-y-2 text-ink-secondary text-[14px] leading-relaxed max-w-2xl">
                                @foreach ($e['bullets'] as $b)
                                    <li class="flex gap-2.5">
                                        <span class="text-ink-muted mt-[9px] flex-shrink-0 w-1 h-1 rounded-full bg-current" aria-hidden="true"></span>
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

    {{-- Credentials --}}
    <section id="credentials" class="py-20 md:py-24 border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="max-w-2xl mb-10">
                <p class="label-mono">Credentials</p>
                <h2 class="mt-3 section-title">Education & Certifications.</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-10 md:gap-14">
                <div>
                    <p class="label-mono mb-5">Education</p>
                    <div class="space-y-5">
                        @foreach ($education as $ed)
                            <article class="pb-5 border-b border-border last:border-b-0 last:pb-0">
                                <div class="flex items-baseline justify-between gap-4">
                                    <h3 class="text-[15px] text-ink-primary font-medium">{{ $ed['school'] }}</h3>
                                    <span class="label-mono flex-shrink-0">{{ $ed['period'] }}</span>
                                </div>
                                <p class="mt-1 text-ink-secondary text-[13.5px]">{{ $ed['degree'] }}</p>
                                <p class="mt-0.5 text-[13px] text-ink-muted">{{ $ed['location'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div>
                    <p class="label-mono mb-5">Certifications</p>
                    <div class="space-y-5">
                        @foreach ($certifications as $c)
                            <article class="pb-5 border-b border-border last:border-b-0 last:pb-0">
                                <h3 class="text-[15px] text-ink-primary font-medium">{{ $c['name'] }}</h3>
                                <p class="mt-1 text-ink-secondary text-[13.5px]">{{ $c['issuer'] }}</p>
                                <p class="mt-0.5 label-mono">{{ $c['type'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section id="contact" class="py-20 md:py-24 bg-surface border-t border-border">
        <div class="max-w-content mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16">
                {{-- Left column: existing content --}}
                <div>
                    <p class="label-mono">Contact</p>
                    <h2 class="mt-3 display-sans text-ink-primary" style="font-size: clamp(1.75rem, 3.5vw, 2.75rem);">
                        Let's talk<span class="text-accent">.</span>
                    </h2>
                    <p class="mt-5 text-[15px] md:text-[16px] text-ink-secondary leading-[1.6] max-w-2xl">
                        Open to remote or Dhaka-based senior software roles. Email is fastest — I reply within a day.
                    </p>

                    <a href="mailto:shipon0142@gmail.com" class="link-underline mt-8 inline-flex display-sans-light text-xl md:text-3xl text-accent">
                        shipon0142@gmail.com
                    </a>

                    <div class="mt-10 pt-6 border-t border-border flex flex-wrap items-center gap-5 md:gap-7 text-ink-secondary">
                        <a href="https://github.com/shipon0142" target="_blank" rel="noopener noreferrer" class="link-underline inline-flex items-center gap-2 text-[13.5px] hover:text-ink-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M12 .5C5.65.5.5 5.65.5 12c0 5.09 3.29 9.4 7.86 10.93.58.11.79-.25.79-.55 0-.27-.01-1.16-.02-2.11-3.19.69-3.87-1.36-3.87-1.36-.52-1.33-1.28-1.69-1.28-1.69-1.05-.71.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.7 1.26 3.36.96.1-.74.4-1.26.72-1.55-2.55-.29-5.23-1.28-5.23-5.68 0-1.25.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18a11.1 11.1 0 0 1 2.9-.39c.98 0 1.97.13 2.9.39 2.21-1.49 3.18-1.18 3.18-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.84 1.19 3.09 0 4.41-2.69 5.38-5.25 5.66.41.36.78 1.06.78 2.14 0 1.54-.01 2.79-.01 3.16 0 .3.21.67.8.55C20.21 21.4 23.5 17.09 23.5 12 23.5 5.65 18.35.5 12 .5z"/></svg>
                            GitHub
                        </a>
                        <a href="https://linkedin.com/in/shipon-sarder-900727102" target="_blank" rel="noopener noreferrer" class="link-underline inline-flex items-center gap-2 text-[13.5px] hover:text-ink-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM19 19h-3v-4.74c0-1.13-.02-2.58-1.57-2.58-1.57 0-1.81 1.23-1.81 2.5V19h-3v-9h2.88v1.23h.04a3.16 3.16 0 012.85-1.56c3.05 0 3.61 2 3.61 4.61z"/></svg>
                            LinkedIn
                        </a>
                        <a href="tel:+8801925727000" class="link-underline inline-flex items-center gap-2 text-[13.5px] hover:text-ink-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.37 1.9.72 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0122 16.92z"/></svg>
                            WhatsApp
                        </a>
                        <a href="mailto:shipon0142@gmail.com" class="link-underline inline-flex items-center gap-2 text-[13.5px] hover:text-ink-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                            Email
                        </a>
                    </div>
                </div>

                {{-- Right column: form (always visible) with optional success banner --}}
                <div data-contact-panel>
                    @if(session('contact.success'))
                        <div data-contact-success class="mb-6 flex items-start gap-3 rounded-sm bg-accent-faint px-4 py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-accent shrink-0 mt-0.5" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
                            <p class="text-[14px] text-ink-primary leading-[1.5]">
                                Thanks — I'll get back to you within a day.
                            </p>
                        </div>
                    @endif
                    <p class="label-mono">Send a message</p>
                        <form data-contact-form action="{{ route('contact.send') }}" method="POST" class="mt-6 space-y-5" novalidate>
                            @csrf

                            {{-- Honeypot: off-screen, ignored by real users --}}
                            <div aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
                                <label for="contact-website">Website</label>
                                <input type="text" id="contact-website" name="website" tabindex="-1" autocomplete="off" value="">
                            </div>

                            <div>
                                <label for="contact-name" class="label-mono block">Name</label>
                                <input
                                    type="text"
                                    id="contact-name"
                                    name="name"
                                    maxlength="100"
                                    required
                                    class="mt-2 w-full bg-transparent border-0 border-b border-border focus:border-accent focus:ring-0 focus:outline-none text-[15px] text-ink-primary placeholder:text-ink-muted py-2 px-0"
                                    aria-describedby="contact-name-error"
                                    value="{{ old('name') }}"
                                >
                                <p id="contact-name-error" data-error-for="name" class="mt-1.5 text-[12px] text-red-500 min-h-[1rem]">@error('name'){{ $message }}@enderror</p>
                            </div>

                            <div>
                                <label for="contact-email" class="label-mono block">Email</label>
                                <input
                                    type="email"
                                    id="contact-email"
                                    name="email"
                                    maxlength="150"
                                    required
                                    class="mt-2 w-full bg-transparent border-0 border-b border-border focus:border-accent focus:ring-0 focus:outline-none text-[15px] text-ink-primary placeholder:text-ink-muted py-2 px-0"
                                    aria-describedby="contact-email-error"
                                    value="{{ old('email') }}"
                                >
                                <p id="contact-email-error" data-error-for="email" class="mt-1.5 text-[12px] text-red-500 min-h-[1rem]">@error('email'){{ $message }}@enderror</p>
                            </div>

                            <div>
                                <label for="contact-message" class="label-mono block">Message</label>
                                <textarea
                                    id="contact-message"
                                    name="message"
                                    rows="5"
                                    maxlength="2000"
                                    required
                                    class="mt-2 w-full bg-transparent border-0 border-b border-border focus:border-accent focus:ring-0 focus:outline-none text-[15px] text-ink-primary placeholder:text-ink-muted py-2 px-0 resize-y"
                                    aria-describedby="contact-message-error"
                                >{{ old('message') }}</textarea>
                                <p id="contact-message-error" data-error-for="message" class="mt-1.5 text-[12px] text-red-500 min-h-[1rem]">@error('message'){{ $message }}@enderror</p>
                            </div>

                            <div class="flex flex-col items-end gap-3">
                                <button
                                    type="submit"
                                    data-contact-submit
                                    class="inline-flex items-center gap-2 bg-accent hover:bg-accent-soft text-white font-medium text-[13.5px] px-5 py-2.5 rounded-sm transition-colors disabled:opacity-60 disabled:cursor-not-allowed"
                                >
                                    <span data-submit-label>Send message</span>
                                    <svg data-submit-spinner class="hidden w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                                    </svg>
                                </button>
                                <p data-contact-status class="text-[12.5px] text-ink-secondary min-h-[1.25rem] w-full text-right">
                                    @if(session('contact.error')){{ session('contact.error') }}@endif
                                </p>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="border-t border-border py-8">
    <div class="max-w-content mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-3">
        <p class="font-mono text-[11px] text-ink-muted">© {{ date('Y') }} Shipon Sarder — built in Dhaka.</p>
        <p class="font-mono text-[11px] text-ink-muted">Laravel · Tailwind · Geist</p>
        <div class="flex items-center gap-1">
            <button type="button" class="p-1.5 text-ink-secondary hover:text-accent transition-colors" data-theme-toggle aria-label="Switch theme">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/></svg>
            </button>
            <a href="#top" class="p-1.5 text-ink-secondary hover:text-accent transition-colors" aria-label="Back to top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M12 19V5"/><path d="M5 12l7-7 7 7"/></svg>
            </a>
        </div>
    </div>
</footer>

<script>
    // Theme toggle
    (function () {
        var SUN = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M4.93 4.93l1.41 1.41"/><path d="M17.66 17.66l1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="M6.34 17.66l-1.41 1.41"/><path d="M19.07 4.93l-1.41 1.41"/></svg>';
        var MOON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>';

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

    // Scroll spy (subtle nav highlight)
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
                l.removeAttribute('aria-current');
            });
            var a = linkById.get(id);
            if (a) {
                a.classList.add('text-ink-primary');
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

    // Contact form: fetch-based submit with in-place success swap
    (function () {
        var form = document.querySelector('[data-contact-form]');
        if (!form) return;

        var panel = document.querySelector('[data-contact-panel]');
        var submit = form.querySelector('[data-contact-submit]');
        var label = form.querySelector('[data-submit-label]');
        var spinner = form.querySelector('[data-submit-spinner]');
        var status = form.querySelector('[data-contact-status]');
        var tokenMeta = document.querySelector('meta[name="csrf-token"]');
        var token = tokenMeta ? tokenMeta.getAttribute('content') : '';

        function clearErrors() {
            form.querySelectorAll('[data-error-for]').forEach(function (el) { el.textContent = ''; });
            if (status) status.textContent = '';
        }

        function showFieldError(field, message) {
            var el = form.querySelector('[data-error-for="' + field + '"]');
            if (el) el.textContent = message;
        }

        function setSubmitting(on) {
            submit.disabled = on;
            if (label) label.textContent = on ? 'Sending…' : 'Send message';
            if (spinner) spinner.classList.toggle('hidden', !on);
        }

        function renderSuccess() {
            form.reset();
            setSubmitting(false);
            clearErrors();

            var existing = panel.querySelector('[data-contact-success]');
            if (existing) existing.remove();

            var banner =
                '<div data-contact-success class="mb-6 flex items-start gap-3 rounded-sm bg-accent-faint px-4 py-3">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-accent shrink-0 mt-0.5" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>' +
                    '<p class="text-[14px] text-ink-primary leading-[1.5]">Thanks — I\'ll get back to you within a day.</p>' +
                '</div>';

            panel.insertAdjacentHTML('afterbegin', banner);
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            clearErrors();
            setSubmitting(true);

            fetch(form.getAttribute('action'), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new FormData(form)
            })
                .then(function (res) {
                    return res.json().catch(function () { return { ok: false, message: 'Unexpected response.' }; })
                        .then(function (body) { return { status: res.status, body: body }; });
                })
                .then(function (r) {
                    if (r.status === 200 && r.body.ok) {
                        renderSuccess();
                        return;
                    }
                    if (r.status === 422 && r.body.errors) {
                        Object.keys(r.body.errors).forEach(function (field) {
                            var msgs = r.body.errors[field];
                            showFieldError(field, Array.isArray(msgs) ? msgs[0] : String(msgs));
                        });
                        var first = form.querySelector('[data-error-for]:not(:empty)');
                        if (first) {
                            var name = first.getAttribute('data-error-for');
                            var input = form.querySelector('[name="' + name + '"]');
                            if (input) input.focus();
                        }
                        setSubmitting(false);
                        return;
                    }
                    // 429, 502, 503, other
                    if (status) status.textContent = r.body.message || 'Something went wrong. Please email shipon0142@gmail.com directly.';
                    setSubmitting(false);
                })
                .catch(function () {
                    if (status) status.textContent = 'Network error. Please email shipon0142@gmail.com directly.';
                    setSubmitting(false);
                });
        });
    })();
</script>

</body>
</html>
