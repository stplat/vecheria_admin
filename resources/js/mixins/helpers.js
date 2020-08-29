export default {
  methods: {
    /* Формат дня недели */
    formatDateHelper(string) {
      const date = new Date(string);
      const year = date.getFullYear();
      const month = date.getMonth() < 9 ? '0' + Number(date.getMonth() + 1) : Number(date.getDate() + 1);
      const day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();

      return `${ year }-${ month }-${ day }`;
    },

    /* Формат времени */
    formatTimeHelper(date) {
      const hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
      const minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
      const seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();

      return `${ hours }:${ minutes }`;
    }
  },
  directives: {
    'prevent-number': {
      bind(el, binding) {
        const inputHandler = function(e) {
          var ch = String.fromCharCode(e.which);
          var re = new RegExp(/[A-Za-zА-Яа-яЁё]/);
          if (ch.match(re)) {
            e.preventDefault();
          }
        };
        el.addEventListener('keypress', inputHandler);
      }
    }
  }
};

export function serialize(array, name) {
  return array.reduce((item, carry) => {
    return `${String(item)}&${name}[]=${String(carry)}`;
  }, '').replace("&", "");
};
