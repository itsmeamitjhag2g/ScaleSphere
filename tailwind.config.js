/** @type {import('tailwindcss').Config} */
module.exports = {
  // Must be ONE selector. Commas break CSS (e.g. `.tw-home, .tw-about .flex`
  // applies every utility to `.tw-home` itself and empties / crushes layouts).
  important: "main",
  corePlugins: {
    preflight: false,
  },
  content: [
    "./app/**/*.{php,js}",
    "./public/**/*.{js,html}",
    "./front.php",
    "./index.php",
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          DEFAULT: "#1F7A5A",
          dark: "#16604A",
          soft: "#E4F1EA",
          deep: "#0F1B3D",
          red: "#1F7A5A",
          blue: "#1F7A5A",
          orange: "#3B8767",
        },
        ink: "#0F1B3D",
        muted: "#5F6878",
        line: "#E6E7EA",
        royal: "#FFFEFA",
        tmf: {
          red: "#1F7A5A",
          blue: "#1F7A5A",
          orange: "#3B8767",
        },
      },
      fontFamily: {
        display: ["Plus Jakarta Sans", "Montserrat", "sans-serif"],
        body: ["Nunito Sans", "sans-serif"],
        mono: [
          "ui-monospace",
          "SFMono-Regular",
          "Menlo",
          "Consolas",
          "monospace",
        ],
      },
      maxWidth: {
        site: "1400px",
      },
    },
  },
  plugins: [],
};
