/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                pastel: {
                    bg: '#FDFBF9', // Soft Cream/Off-white
                    green: '#7C9070', // Pastel Sage Green
                    peach: '#F6E1C3', // Pastel Peach/Sand
                    card: '#FFFFFF',
                }
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            borderRadius: {
                '3xl': '1.5rem',
            }
        },
    },
    plugins: [],
}
