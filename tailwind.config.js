import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    primary: '#4f46e5',
                    dark: '#312e81',
                    surface: '#ffffff',
                    background: '#f8fafc',
                    text: '#0f172a',
                    muted: '#64748b',
                    border: '#e2e8f0',
                    success: '#059669',
                    warning: '#d97706',
                },
            },
            borderRadius: { brand: '1rem', card: '1.25rem' },
            boxShadow: { card: '0 1px 3px rgb(15 23 42 / 0.08), 0 1px 2px rgb(15 23 42 / 0.04)' },
        },
    },

    plugins: [forms],
};
