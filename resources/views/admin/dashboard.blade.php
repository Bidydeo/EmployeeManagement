@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blank Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid ">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6 ">
                    <!-- small box -->
                    <div class="small-box bg-info ">
                        <div class="inner">
                            <h3>{{ $leaves->count() }}</h3>
                            <p>Leaves</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('leaves.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $employees->count() }}</h3>
                            <p>Employees</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $leaves->count() }}</h3>
                            <p>Leaves</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('leaves.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Left col -->
                <section id="left-col" class="col-lg-7 connectedSortable">
                    <div class="card col-md-12 mr-2">
                        <div class="card-header">
                            <h3 class="card-title">Calendar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <section class="content">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-body p-0">
                                            <!-- THE CALENDAR -->
                                            <div id="calendar"></div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </section>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                            <div x-init="Echo.channel('chat')
                                .listen('MessageSent', (event) => { console.log(event) })"></div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section ìd="right-col" class="col-lg-5 connectedSortable">
                    <div class="card col-md-12 ml-2">
                        <div class="card-header">
                            <h3 class="card-title">Title</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div style="text-align: center">
                                    <h2>Astazi: {{ date('l, d-m-Y') }}</h2>
                                </div>
                                <button id="clockInBtn" class="btn-lg btn-primary m-5">ClockIn</button>
                                <button id="clockOutBtn" class=" btn-lg btn-secondary m-5 float-right">ClockOut</button>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="hide-on-small">Day</th>
                                            <th>Date</th>
                                            <th>Employee</th>
                                            <th>Location</th>
                                            <th>ClockIn</th>
                                            <th>ClockOut</th>
                                        </tr>
                                    </thead>
                                    <tbody id="attendance-tbody">
                                        @foreach ($attendances->sortByDesc('created_at')->take(10) as $attendance)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('l') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                                                <td>{{ $attendance->employee->employee_name }}</td>
                                                <td>{{ $attendance->location->name }}</td>
                                                <td class="clock-in-time">{{ $attendance->clock_in_time }}</td>
                                                <td class="clock-out-time">{{ $attendance->clock_out_time }}</td>
                                                {{-- <td>{{ $attendance->latitude_in }} - {{ $attendance->longitude_in }}</td>
                                                <td>{{ $attendance->latitude_out }} - {{ $attendance->longitude_out }} --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- Construct the card with style you want. Here we are using card-danger -->
                    <!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
                    <!-- The contextual class should match the card, so we are using direct-chat-danger -->
                    <div class="card card-primary card-outline direct-chat direct-chat-primary direct-chat-contacts-open">
                        <div class="card-header">
                            <h3 class="card-title">Direct Chat</h3>
                            <div class="card-tools">
                                <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">3</span>
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                                    data-widget="chat-pane-toggle">
                                    <i class="fas fa-comments"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove"><i
                                        class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <!-- Message. Default to the left -->
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                                        <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="/docs/3.0/assets/img/user1-128x128.jpg"
                                        alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        Is this template really for free? That's unbelievable!
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                <!-- /.direct-chat-msg -->
                                <!-- Message to the right -->
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-right">Sarah Bullock</span>
                                        <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="/docs/3.0/assets/img/user3-128x128.jpg"
                                        alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        You better believe it!
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                <!-- /.direct-chat-msg -->
                            </div>
                            <!--/.direct-chat-messages-->
                            <!-- Contacts are loaded here -->
                            <div class="direct-chat-contacts">
                                <ul class="contacts-list">
                                    <li>
                                        <a href="#">
                                            <img class="contacts-list-img" src="/docs/3.0/assets/img/user1-128x128.jpg">
                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    Count Dracula
                                                    <small class="contacts-list-date float-right">2/28/2015</small>
                                                </span>
                                                <span class="contacts-list-msg">How have you been? I was...</span>
                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                </ul>
                                <!-- /.contacts-list -->
                            </div>
                            <!-- /.direct-chat-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="text" name="message" placeholder="Type Message ..."
                                        class="form-control">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-primary">Send</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-chat -->
                </section>
            </div>
        </div>
        <template>

        </template>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var events = [
                @foreach ($leaves as $leave)
                    {
                        title: '{{ $leave->employee->employee_name }}',
                        start: '{{ $leave->start_date }}',
                        end: '{{ $leave->end_date }}'
                    },
                @endforeach
            ];

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto',
                themeSystem: 'bootstrap',
                events: events,
                slotDuration: '00:30',
                slotMinTime: '07:00',
                slotMaxTime: '18:00',
                locale: 'ro',
                //weekNumbers: true,
                nowIndicator: true,
                //businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                //daysOfWeek: [ 1, 2, 3, 4, 5 ], // Monday - Friday
                //startTime: '8:00', // a start time (10am in this example)
                //endTime: '17:00', // an end time (6pm in this example)
                //},
            });
            calendar.render();
        });
    </script>
    <script>
        document.getElementById('clockInBtn').addEventListener('click', function() {
            // Preia locația curentă a utilizatorului
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Trimite cererea de clock-in către server
                fetch('/admin/clock-in', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            latitude: latitude,
                            longitude: longitude
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            console.log('Clock-in success:', data);
                            // Dacă cererea a fost cu succes, actualizează tabelul
                            updateTable(data.data);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Eroare la clock-in:', error);
                    });
            });
        });

        function updateTable(attendance) {
            var tableBody = document.getElementById('attendance-tbody');


            var rows = tableBody.getElementsByTagName('tr');
            if (rows.length >= 10) {
                tableBody.removeChild(rows[rows.length - 1]);
            }
            // Creează un nou rând cu un data attribute pentru attendance_id
            var newRow = document.createElement('tr');
            newRow.setAttribute('data-attendance-id', attendance.attendance_id); // Asociază attendance_id cu rândul
            newRow.innerHTML = `
                <td>${attendance.day_of_week}</td> <!-- Ziua săptămânii -->
                <td>${attendance.date}</td> <!-- Data -->
                <td>${attendance.employee_name}</td> <!-- Numele angajatului -->
                <td>${attendance.location_name}</td> <!-- Numele locației -->
                <td>${attendance.clock_in_time}</td> <!-- Ora de clock-in -->
                <td>${attendance.clock_out_time || 'N/A'}</td> <!-- Ora de clock-out, sau 'N/A' dacă nu există -->
        `;
            tableBody.insertBefore(newRow, tableBody.firstChild);
        }
        document.getElementById('clockOutBtn').addEventListener('click', function() {
            // Preia locația curentă a utilizatorului
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Trimite cererea de clock-out către server
                fetch('/admin/clock-out', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token pentru securitate
                        },
                        body: JSON.stringify({
                            latitude: latitude, // Transmite coordonatele GPS
                            longitude: longitude
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'error') {
                            alert(data.message);
                        } else {
                            console.log('Clock-out success:', data);
                            console.log(data.data);
                            updateClockOutInTable(data.data); // Actualizează tabelul cu datele noi
                        }
                    })
                    .catch(error => {
                        console.error('Error during clock-out:', error);
                    });
            });
        });

        // Funcția pentru actualizarea orei de clock-out în tabelul existent
        function updateClockOutInTable(attendance) {
            var tableBody = document.getElementById('attendance-tbody');
            var rows = tableBody.getElementsByTagName('tr'); // Obținem toate rândurile din tabel

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                // Verifică dacă rândul curent are același attendance_id
                if (row.getAttribute('data-attendance-id') === String(attendance.attendance_id)) {
                    // Actualizează ora de clock-out pentru rândul corect
                    row.cells[5].textContent = attendance.clock_out_time || 'N/A'; // Ora de clock-out
                    break; // Ieși din buclă după ce ai găsit și actualizat rândul corect
                }
            }
        }
    </script>
    {{-- <script>
        const reverb = new Reverb('attendance-channel');

        // Ascultă evenimentele de tip NewAttendanceAdded
        reverb.listen('NewAttendanceAdded', function(event) {

            // Actualizează tabelul de prezență cu noua înregistrare
            updateTable(attendance.data);
            console.log(attendance);

        });

        // Funcția de actualizare a tabelului
        function updateTable(attendance) {
            var tableBody = document.getElementById('attendance-tbody'); // Selectorul pentru tabel

            // Creează un nou rând cu datele de prezență primite
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td>${attendance.day_of_week}</td>
        <td>${attendance.date}</td>
        <td>${attendance.employee_name}</td>
        <td>${attendance.location_name}</td>
        <td>${attendance.clock_in_time}</td>
        <td>${attendance.clock_out_time || 'N/A'}</td>
        `;

            // Adaugă noul rând în tabel
            tableBody.insertBefore(newRow, tableBody.firstChild);
        }
    </script> --}}
@endsection
