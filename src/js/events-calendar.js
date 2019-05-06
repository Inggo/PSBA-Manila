// Events Calendar
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import bootstrapPlugin from '@fullcalendar/bootstrap';

var stringifyEvent = function (event) {
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var output = '<h6 class="event-popover"><i class="event-tag" style="background: ' + event.backgroundColor + '"></i> ' + event.title + '</h6>';

  if (!event.end || (event.start.getYear() == event.end.getYear() && event.start.getMonth() == event.end.getMonth() && event.start.getDate() == event.end.getDate())) {
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
    events: window.calendar_events ? window.calendar_events.map((event) => {
      if (event.end) {
        var end = new Date(event.end);
        event.end = new Date(end.getFullYear(), end.getMonth(), end.getDate(), 23, 59, 59);  
      }
      return event;
    }) : [],
    eventMouseEnter: (info) => {
      $(info.el).closest('.fc-event-container').popover({
        html: true,
        placement: 'top',
        trigger: 'hover',
        content: stringifyEvent(info.event),
        container: 'body',
        boundary: 'window',
        sanitize: false
      }).popover('show')
    },
    displayEventTime: false
  });

  calendar.render();
});
