@extends('layouts.users.master')
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
                            <h3>{{ $leaves->count() }}</h3>
                            <p>Leaves</p>
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
                <section class="col-lg-7 connectedSortable">
                    <div class="card col-md-12 mr-2">
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
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">
                    <div class="card col-md-12 ml-2">
                        <div class="card-header">
                            <h3 class="card-title">Program de lucru: 8:00 - 17:00.</h3>
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
                                            <th>Day</th>
                                            <th>Date</th>
                                            <th>Location</th>
                                            <th>ClockIn</th>
                                            <th>ClockOut</th>
                                        </tr>
                                    </thead>
                                    <tbody id="attendance-tbody">
                                        @foreach ($attendances->sortByDesc('created_at')->take(5) as $attendance)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('l') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                                                <td>{{ $attendance->location->name }}</td>
                                                <td class="clock-in-time">{{ $attendance->clock_in_time }}
                                                </td>
                                                <td class="clock-out-time">
                                                    {{ $attendance->clock_out_time }}</td>
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
                    </div>
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
                                <!-- small box -->
                                <div class="small-box bg-info">
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
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </section>
            </div>
        </div>
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
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                events: events
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
                fetch('/clock-in', {
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
            if (rows.length >= 5) {
                tableBody.removeChild(rows[rows.length - 1]);
            }
            // Creează un nou rând cu un data attribute pentru attendance_id
            var newRow = document.createElement('tr');
            newRow.setAttribute('data-attendance-id', attendance.attendance_id); // Asociază attendance_id cu rândul
            newRow.innerHTML = `
                <td>${attendance.day_of_week}</td> <!-- Ziua săptămânii -->
                <td>${attendance.date}</td> <!-- Data -->
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
                fetch('/clock-out', {
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
                    row.cells[4].textContent = attendance.clock_out_time || 'N/A'; // Ora de clock-out
                    break; // Ieși din buclă după ce ai găsit și actualizat rândul corect
                }
            }
        }
    </script>
@endsection
