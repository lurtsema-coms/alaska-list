import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
            },
            backgroundImage: {
                woman: "url('../images/woman.jpg')",
                building: "url('../images/buildings.jpg')",
                scattered: "url('../images/scattered-forcefields.svg')",
                splashed: "url('../images/wave3.svg')",
                brainstorm: "url('../images/brainstorming.jpg')",
            },
            screens: {
                xsm: "400px",
            },
        },
    },

    plugins: [forms],
};
