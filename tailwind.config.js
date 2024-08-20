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
                bebasNeue: ['"Bebas Neue"', "sans-serif"], 
            },
            backgroundImage: {
                woman: "url('../images/woman.jpg')",
                building: "url('../images/buildings.jpg')",
                scattered: "url('../images/scattered-forcefields.svg')",
                blob: "url('../images/wave4.svg')",
                brainstorm: "url('../images/brainstorming.jpg')",
                'search-gradient': 'linear-gradient(to right, #143E7A, #4988A5)',
                
            },
            screens: {
                xsm: "400px",
            },
            textShadow: {
                'custom': '0em 0.1em 0.1em rgba(0, 0, 0, 0.4)',
            },
        },
    },

    plugins: [
        forms,
        function ({ addUtilities }) {
            addUtilities({
                '.text-shadow-custom': {
                    textShadow: '0em 0.1em 0.1em rgba(0, 0, 0, 0.4)',
                },
            })
        },
    ],
};
