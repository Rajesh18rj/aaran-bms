import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./Aaran/**/*.blade.php", // 👈 Ensure Aaran views are included
        "./Aaran/Assets/Resources/components/pdf-view/**/*.blade.php",
        "./Aaran/**/*.js",
        "./Aaran/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                asul: ["Asul", "sans-serif"],
            },
            keyframes: {
                slideIn: {
                    '0%': { transform: 'translateX(-50%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                },
            },
            animation: {
                slideIn: 'slideIn 1s ease-out',
            },
        },
    },
    plugins: [forms, typography],
};
