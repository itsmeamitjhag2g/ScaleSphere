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
          DEFAULT: "#1C4FD6",
          dark: "#163AA8",
          soft: "#E8EEF8",
          deep: "#0B1A3A",
        },
        ink: "#0F172A",
        muted: "#64748B",
        line: "#E2E8F0",
      },
      fontFamily: {
        display: ["Montserrat", "sans-serif"],
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
