import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import animate from 'tailwindcss-animate'
import containerQueries from '@tailwindcss/container-queries'
import daisyui from 'daisyui'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],

  theme: {
    extend: {
      colors: {
        ocean: {
          50: '#F0F9FF',
          100: '#E0F2FE',
          200: '#BAE6FD',
          300: '#7DD3FC',
          400: '#38BDF8',
          500: '#0EA5E9',
          600: '#0284C7',
          700: '#0369A1',
          800: '#075985',
          900: '#0C4A6E',
        },
        eco: {
          100: '#DCFCE7',
          300: '#86EFAC',
          500: '#22C55E',
          700: '#15803D',
        },
        sand: '#F8FAFC',
      },

      borderRadius: {
        xl: '1rem',
        '2xl': '1.5rem',
      },

      boxShadow: {
        soft: '0 4px 14px rgba(0, 0, 0, 0.05)',
        card: '0 10px 25px rgba(0, 0, 0, 0.08)',
        hover: '0 15px 35px rgba(0, 0, 0, 0.12)',
      },

      keyframes: {
        fadeIn: {
          '0%': { opacity: 0 },
          '100%': { opacity: 1 },
        },
        slideUp: {
          '0%': { transform: 'translateY(10px)', opacity: 0 },
          '100%': { transform: 'translateY(0)', opacity: 1 },
        },
      },

      animation: {
        fade: 'fadeIn 0.4s ease-out',
        slide: 'slideUp 0.4s ease-out',
      },

      fontFamily: {
        sans: ['Figtree', 'sans-serif'],
      },
    },
  },

  plugins: [
    forms,
    typography,
    animate,
    containerQueries,
    daisyui,
  ],

  daisyui: {
    themes: [
      {
        oceanTheme: {
          primary: "#0EA5E9",
          secondary: "#0369A1",
          accent: "#22C55E",
          neutral: "#1F2937",
          "base-100": "#F0F9FF",
          info: "#38BDF8",
          success: "#22C55E",
          warning: "#FACC15",
          error: "#EF4444",
        },
      },
    ],
  },
}