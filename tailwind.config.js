const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary-bg': '#CEBD9A',
                'secondary-bg': '#7D6836',
                'primary-fg': '#73726E',
                'secondary-fg': '#846B47',
            },
            spacing: {
                '1/2': '50%',
                '1/3': '33.333333%',
                '2/3': '66.666667%',
                '1/4': '25%',
                '2/4': '50%',
                '3/4': '75%',
                '1/5': '20%',
                '2/5': '40%',
                '3/5': '60%',
                '4/5': '80%',
                '1/6': '16.666667%',
                '2/6': '33.333333%',
                '3/6': '50%',
                '4/6': '66.666667%',
                '5/6': '83.333333%',
                '1/12': '8.333333%',
                '2/12': '16.666667%',
                '3/12': '25%',
                '4/12': '33.333333%',
                '5/12': '41.666667%',
                '6/12': '50%',
                '7/12': '58.333333%',
                '8/12': '66.666667%',
                '9/12': '75%',
                '10/12': '83.333333%',
                '11/12': '91.666667%',

                '1/2-screen': '50vh',
                '1/3-screen': '33.333333vh',
                '2/3-screen': '66.666667vh',
                '1/4-screen': '25vh',
                '2/4-screen': '50vh',
                '3/4-screen': '75vh',
                '1/5-screen': '20vh',
                '2/5-screen': '40vh',
                '3/5-screen': '60vh',
                '4/5-screen': '80vh',
                '1/6-screen': '16.666667vh',
                '2/6-screen': '33.333333vh',
                '3/6-screen': '50vh',
                '4/6-screen': '66.666667vh',
                '5/6-screen': '83.333333vh',
                '1/12-screen': '8.333333vh',
                '2/12-screen': '16.666667vh',
                '3/12-screen': '25vh',
                '4/12-screen': '33.333333vh',
                '5/12-screen': '41.666667vh',
                '6/12-screen': '50vh',
                '7/12-screen': '58.333333vh',
                '8/12-screen': '66.666667vh',
                '9/12-screen': '75vh',
                '10/12-screen': '83.333333vh',
                '11/12-screen': '91.666667vh',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
