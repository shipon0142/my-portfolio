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
