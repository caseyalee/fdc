const { colors } = require('tailwindcss/defaultTheme')
module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
  // purge: [],
  purge: {
    enabled: false,
  },
  theme: {
    container: {
      center: false,
      padding: '1.5rem',
    },
    colors: {
      black: colors.black,
      white: colors.white,
      gray: colors.gray,
      red: colors.red,
      transparent: colors.transparent,
    },
    fontWeight: {
      light: 300,
      normal: 400,
      medium: 600,
      semibold: 600,
      bold: 800,
      extrabold: 900,
      black: 900,
    },
    extend: {
      typography: {
        default: {
          css: {
            color: '#333',
            a: {
              color: '#2C0F33',
              '&:hover': {
                color: '#782A88',
              },
            },
            h2: {
              color: '#2C0F33',
            },
            h3: {
              color: '#333333',
            },
            h4: {
              color: '#000000',
            },
            '.lead': {
              color: '#6e3f79',
            },
            '.mb-0': {
              marginBottom: 0,
            },
            '.mt-0': {
              marginTop: 0,
            },
            '.my-0': {
              marginTop: 0,
              marginBottom: 0,
            },
            '.button': {
              color: '#FFFFFF',
              '&:hover': {
                backgroundColor: '#000000',
                color: '#FFFFFF',
              },
            },
          },
        },
      },
      colors: {
        'c-purple' : {
          default: '#782A88',
          light: '#A452CB',
          lighter: '#BD9ACE',
          dark: '#2C0F33',
          darker: '#1E0923',
        },
      },
      screens: {
        '2xl' : '1440px',
        '3xl' : '1600px',
        '4xl' : '1920px',
      },
      height: {
        72 : '18rem',
        80 : '20rem',
      },
      opacity: {
        85 : '0.85',
        95 : '0.95',
      },
      spacing: {
        square: '50%',
        video: '56.25%',
        72: '18rem',
        108 : '32rem',
      },
      fontFamily: {
        'proxima' : ['proxima', 'sans-serif'],
      },
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/ui'),
  ],
}
