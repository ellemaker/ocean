module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
    ],
    theme: {
        extend: {
            spacing: {
               '72': '18rem',
               '84': '21rem',
               '96': '24rem',
            }
        },
        inset: {
            '0': 0,
            '1/2': '50%'
        }
    },
    variants: {},
    plugins: [
        require('@tailwindcss/custom-forms')
    ]
}
