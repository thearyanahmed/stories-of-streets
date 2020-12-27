const defaultTheme = require('tailwindcss/resolveConfig')(require('tailwindcss/defaultConfig')).theme

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Popins', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    checkbox: {
        color: defaultTheme.colors.green[400],
    },

    plugins: [require('@tailwindcss/ui')],
};
