// Events Calendar
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import bootstrapPlugin from '@fullcalendar/bootstrap';

var stringifyEvent = function (event) {
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var output = '<h6 class="event-popover"><i style="background-color: ' + event.backgroundColor + '" class="event-tag"></i> ' + event.title + '</h6>';

  if (event.start === event.end || !event.end) {
    output += '<p>' + months[event.start.getMonth()] +
      ' ' + event.start.getDate() +
      ', ' + event.start.getFullYear() +
      '</p>';
  } else {
    output += '<p>' + months[event.start.getMonth()] +
      ' ' + event.start.getDate();
    if (event.start.getYear() !== event.end.getYear()) {
      output += ', ' + event.start.getFullYear();
    }
    output += ' to ';
    if (event.start.getMonth() !== event.end.getMonth()) {
      output += months[event.end.getMonth()] + ' ';
    }
    output += ' ' + event.end.getDate() + ', ' + event.end.getFullYear();
    output += '</p>';
  }

  if (event.extendedProps.details) {
    output += '<p>' + event.extendedProps.details + '</p>';
  }

  return output
};

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('events-calendar');

  var columnHeaders = ['S','M','T','W','T','F','S'];


  var calendar = new Calendar(calendarEl, {
    themeSystem: 'bootstrap',
    plugins: [ dayGridPlugin, bootstrapPlugin ],
    height: 'auto',
    header: {
      left:   'prev',
      center: 'title',
      right:  'next'
    },
    columnHeaderText: (date) => {
      return columnHeaders[date.getDay()];
    },
    events: window.calendar_events,
    eventMouseEnter: (info) => {
      $(info.el).closest('.fc-event-container').popover({
        html: true,
        placement: 'top',
        trigger: 'manual',
        content: stringifyEvent(info.event),
      }).popover('show')
    },
    eventMouseLeave: (info) => {
      $(info.el).closest('.fc-event-container').popover('hide')
    }
  });

  calendar.render();
});
