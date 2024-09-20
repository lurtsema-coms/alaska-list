import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import scrollbar from 'tailwind-scrollbar'; // Import the scrollbar plugin

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", "sans-serif"],
                poppins: ["Poppins", "sans-serif"],
                darkerGrotesque: ['"Darker Grotesque"', "sans-serif"],
                bebasNeue: ['"Bebas Neue"', "sans-serif"],
            },
            backgroundImage: {
                woman: "url('../images/woman.jpg')",
                building: "url('../images/buildings.jpg')",
                scattered: "url('../images/scattered-forcefields.svg')",
                blob: "url('../images/wave4.svg')",
                brainstorm: "url('../images/brainstorming.jpg')",
                "search-gradient":
                    "linear-gradient(to right, #3C6E9A, #4988A5)",
            },
            screens: {
                xsm: "400px",
                'lg-max': { 'max': '1532px' },  // Custom screen for <= 1532px
            },
            textShadow: {
                custom: "0em 0.1em 0.1em rgba(0, 0, 0, 0.4)",
            },
        },
    },

    plugins: [
        forms,
        scrollbar,  // Add the scrollbar plugin
        function ({ addUtilities }) {
            addUtilities({
                ".text-shadow-custom": {
                    textShadow: "0em 0.1em 0.1em rgba(0, 0, 0, 0.4)",
                },
                ".column-wrapper": {
                    columnCount: "1",
                    columnGap: "1.5rem",
                    "@screen md": {
                        columnCount: "3",
                    },
                },
                ".avoid-break": {
                    breakInside: "avoid",
                },
            });
        },
    ],

    variants: {
        scrollbar: ['rounded'], // Enable rounded scrollbar variant
    },
};
