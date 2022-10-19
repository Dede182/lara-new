/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    pagination: theme => ({
        // Customize the color only. (optional)
        color: theme('colors.teal.600'),
        //
        link : 'py-2 px-3 border-r  text-black no-underline',
        // Customize styling using @apply. (optional)
        wrapper: 'flex justify-center list-reset',

        // Customize styling using CSS-in-JS. (optional)
        wrapper: {
            'display': 'flex',
            'justify-items': 'center',

        },
    }),
    fontFamily:{
        'sans': ['Merriweather', 'sans-serif'],
    },
    extend:{

    }
},
  plugins: [
    require('flowbite/plugin'),
    require('tailwindcss-plugins/pagination'),
  ],
}
