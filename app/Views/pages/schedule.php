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
        border: 1px solid violet;
        padding: 20px;
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
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
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

                                    // Save to database
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
                                                calendar.addEvent(eventData); // Render on calendar
                                            } else {
                                                alert('Failed to save event.');
                                            }
                                        });
                                }

                                calendar.unselect();
                            },
                            eventClick: function(arg) {
                                if (confirm('Are you sure you want to delete this event?')) {
                                    arg.event.remove()
                                }
                            },
                            editable: true,
                            dayMaxEvents: true, // allow "more" link when too many events
                            events: []
                        });

                        calendar.render();
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>