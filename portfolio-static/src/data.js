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
    { group: 'Languages', items: ['Java', 'Kotlin', 'Dart', 'C', 'C++'] },
    { group: 'Mobile & UI', items: ['Flutter', 'Jetpack Compose', 'XML', 'Firebase'] },
    { group: 'Architecture & Patterns', items: ['MVVM', 'MVP', 'Clean Architecture', 'BLoC', 'Provider', 'Riverpod'] },
    { group: 'Other', items: ['RESTful APIs', 'CI/CD', 'Problem Solving', 'Competitive Programming'] },
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
