// Events Calendar
import FullCalendar from 'vue-full-calendar';

Vue.use(FullCalendar);

var app = new Vue({
  el: '#events-calendar',
  data: {
    events: window.events
  }
});

