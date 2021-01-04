const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        container: {
            center: true,
            padding: {
                default: '1rem',
                sm: '2rem',
                lg: '3rem',
                xl: '4rem',
            },
        },
        customForms: theme => ({
            default: {
                'input, textarea, select': {
                    width: theme('width.full'),
                    borderColor: theme('colors.gray.300'),
                    '&:focus': {
                        borderColor: theme('colors.purple.500'),
                        boxShadow: `0 0 0 1px ${theme('colors.purple.500')}`,
                    },
                },
                'checkbox, radio': {
                    color: theme('colors.purple.500'),
                    borderColor: theme('colors.gray.300'),
                    '&:focus': {
                        borderColor: theme('colors.purple.500'),
                        boxShadow: `0 0 0 1px ${theme('colors.purple.500')}`,
                    },
                },
            },
        }),
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
