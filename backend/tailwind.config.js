/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors : {
            brand_primary : "#1C3D78",
            brand_secondary : "#2196F3",
            brand_danger : '#E53935',
            brand_orange : "#F57C00",
            brand_warning : "#F57C00"
        }
    },
  },
  plugins: [],
}

