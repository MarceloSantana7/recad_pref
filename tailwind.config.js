/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",  // Views do CodeIgniter
    "./public/**/*.html",    // Outros arquivos HTML estáticos
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}