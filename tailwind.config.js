module.exports = {
  prefix: 't',
  theme: {
    extend: {
      colors: {
        title: '#3d5170',
        primary: '#2d7bbf',
        error: '#ff6347',
        black: {
          100: '#5a6169'
        }
      }
    },
    backgroundColors: {
      primary: '#f4ad2b',
    },
    container: {
      center: true,
      padding: '2rem'
    }
  },
  variants: {
    backgroundColor: ['responsive', 'hover', 'focus', 'active'],
  },
  plugins: []
}
 