const colors = require('tailwindcss/colors');

const gray = {
    50: 'hsl(167, 33%, 97%)',
    100: 'hsl(167, 15%, 91%)',
    200: 'hsl(167, 16%, 82%)',
    300: 'hsl(167, 13%, 65%)',
    400: 'hsl(167, 10%, 53%)',
    500: 'hsl(167, 12%, 43%)',
    600: 'hsl(167, 14%, 37%)',
    700: 'hsl(167, 18%, 30%)',
    800: 'hsl(167, 20%, 25%)',
    900: '#1A312C', // Requested MantaCil color
};

module.exports = {
    content: [
        './resources/scripts/**/*.{js,ts,tsx}',
    ],
    theme: {
        extend: {
            fontFamily: {
                header: ['"IBM Plex Sans"', '"Roboto"', 'system-ui', 'sans-serif'],
            },
            colors: {
                black: '#131a20',
                // "primary" and "neutral" are deprecated, prefer the use of "blue" and "gray"
                // in new code.
                primary: {
                    50: '#fdf9eb',
                    100: '#faefce',
                    200: '#f7e1a3',
                    300: '#f5d175',
                    400: '#f6c15b', // MantaCil Gold
                    500: '#f1aa36',
                    600: '#e59020',
                    700: '#bf7019',
                    800: '#9c5b1b',
                    900: '#7e4a1a',
                },
                gray: gray,
                neutral: gray,
                cyan: colors.cyan,
            },
            fontSize: {
                '2xs': '0.625rem',
            },
            transitionDuration: {
                250: '250ms',
            },
            borderColor: theme => ({
                default: theme('colors.neutral.400', 'currentColor'),
            }),
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
    ]
};
