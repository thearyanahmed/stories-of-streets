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
            backgroundImage: theme => ({
                'auth': "url('/img/background/dreamer.svg')",
                'auth-form' : "linear-gradient(to left bottom, #07bfa6, #16ad9e, #249b94, #308988, #38787a)",
            }),

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
