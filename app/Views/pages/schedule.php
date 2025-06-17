<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>
<style>
    .layout {
        display: grid;
        grid-template-rows: 70px 1fr;
        height: 100vh;
    }

    .body {
        display: grid;
        grid-template-columns: 250px 1fr;
    }

    .main-content {
        display: grid;
        grid-template-rows: 20% 1fr;
        height: 100%;
    }

    .search-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20%;
        flex-direction: row;
        padding: 20px;
    }

    .content {
        padding: 20px;
        max-height: 70vh;
        overflow-y: scroll;
    }
</style>

<div class="layout">
    <div class="header">
        <?= view('layouts/header') ?>
    </div>

    <div class="body">
        <div class="sidebar">
            <?= view('layouts/sideBar') ?>
        </div>
        <div class="main-content">
            <div class="search-header">
                <?= view('layouts/main-content/search') ?>
            </div>
            <div class="content">
                <div id="calendar"></div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var calendarEl = document.getElementById('calendar');

                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay,yearView'
                            },
                            views: {
                                yearView: {
                                    type: 'dayGrid',
                                    duration: {
                                        years: 1
                                    },
                                    buttonText: 'Year'
                                }
                            },
                            initialDate: '<?= date('Y-m-d') ?>',
                            navLinks: true,
                            selectable: true,
                            selectMirror: true,
                            select: function(arg) {
                                var title = prompt('Event Title:');
                                if (title) {
                                    const eventData = {
                                        title: title,
                                        start: arg.startStr,
                                        end: arg.endStr,
                                        allDay: arg.allDay
                                    };

                                    fetch('<?= base_url('calendar/save-event') ?>', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify(eventData)
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.status === 'success') {
                                                eventData.id = data.id;
                                                calendar.addEvent(eventData);
                                            } else {
                                                alert('Failed to save event.');
                                            }
                                        });

                                }

                                calendar.unselect();
                            },
                            eventClick: function(arg) {
                                if (confirm('Are you sure you want to delete this event?')) {
                                    const eventId = arg.event.id;

                                    fetch(`<?= base_url('calendar/delete-event') ?>/${eventId}`, {
                                            method: 'DELETE',
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.status === 'success') {
                                                arg.event.remove(); // Remove from UI only after successful delete
                                            } else {
                                                alert('Failed to delete event.');
                                            }
                                        });
                                }
                            },
                            editable: true,
                            dayMaxEvents: true, // allow "more" link when too many events
                            events: '<?= base_url('calendar/get-events') ?>',
                            eventDrop: function(info) {
                                updateEvent(info.event);
                            },
                            eventResize: function(info) {
                                updateEvent(info.event);
                            },

                        });

                        function updateEvent(event) {
                            const eventData = {
                                id: event.id,
                                start: event.startStr,
                                end: event.endStr,
                                allDay: event.allDay
                            };

                            fetch('<?= base_url('calendar/update-event') ?>', {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(eventData)
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.status !== 'success') {
                                        alert('Update failed.');
                                    } else {
                                        event.setStart(eventData.start);
                                        event.setEnd(eventData.end);
                                    }
                                });
                        }


                        calendar.render();
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>