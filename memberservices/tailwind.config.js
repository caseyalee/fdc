const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'c-purple' : {
                    DEFAULT: '#782A88',
                    light: '#8C2BA0',
                    lighter: '#BD9ACE',
                    dark: '#2C0F33',
                    darker: '#1E0923',
                },
                'green' : {
                    50: '#F3FDED',
                    100: '#E2F7D3',
                    200: '#C5EDAF',
                    300: '#99DF80',
                    400: '#6BCB51',
                    500: '#47B135',
                    600: '#339026',
                    700: '#277520',
                    800: '#205C1B',
                    900: '#1A4C18',
                },
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
