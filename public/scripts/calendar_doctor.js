document.addEventListener('DOMContentLoaded', function() {
    var idDoctor = document.getElementById('id-doctor').value;
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: { 
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch(`http://localhost/Online-Doctor-Appointment-System/doctor/schedulesdoctor.php?id=${idDoctor}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const events = data.map(event => ({
                        title: `${event.title}`,
                        start: `${event.scheduledate}T${event.scheduletime}`,
                        allDay: false 
                    }));
                    successCallback(events);
                })
                .catch(error => {
                    console.error('Error fetching events:', error);
                    failureCallback(error); 
                });
        },
        eventClick: function(info) {
            const eventTime = info.event.start.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'}); 
            alert('Session: ' + info.event.title + ' at ' + eventTime);
        },
    });

    calendar.render();
});
