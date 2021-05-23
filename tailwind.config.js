const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        backgroundColor: theme => ({
            'primary': '#D1FAE5',
            'secondary': '#ffed4a',
            'danger': '#e3342f',
        })
    },
    colors: {
        gray: colors.coolGray,
        blue: colors.lightBlue,
        red: colors.rose,
        pink: colors.fuchsia,
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
