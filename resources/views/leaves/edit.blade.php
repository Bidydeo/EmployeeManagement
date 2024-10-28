@extends('layouts.master') 
@section('content')
<!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editeaza cerere de concediu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Editeaza Cerere de Concediu</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Editeaza cererea</h3>

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

              @if($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                <form action="{{ route('leaves.update', $leave->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="leave_type_id">Tip de Concediu</label>
                            <select name="leave_type_id" id="leave_type_id" class="form-control" required>
                                <!-- Iterează prin tipurile de concedii pe care le ai -->
                                @foreach($leave_types as $leave_type)
                                    <option value="{{ $leave_type->id }}" {{ $leave->leave_type_id == $leave_type->id ? 'selected' : '' }}>{{ $leave_type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Data de Început</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $leave->start_date }}" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">Data de Sfârșit</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $leave->end_date }}" required>
                        </div>

                        <div class="form-group">
                            <label for="substitute_employee_id">Persoana Înlocuitoare</label>
                            <select name="substitute_employee_id" id="substitute_employee_id" class="form-control" >
                                <!-- Opțiunea "Fără înlocuitor" inclusă în lista de angajați -->
                                <option value="" {{ isset($leave) && !$leave->substitute_employee_id ? 'selected' : '' }}>Fără înlocuitor</option>

                                <!-- Iterează prin lista de angajați pentru a afișa opțiunile disponibile -->
                                @foreach($employees as $employee)
                                    @if($employee->id !== auth()->user()->employee->id)
                                        <option value="{{ $employee->id }}"
                                            {{ isset($leave) && $leave->substitute_employee_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->employee_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="reason">Motivul Concediului</label>
                            <textarea name="reason" id="reason" class="form-control">{{ $leave->reason }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvează Modificările</button>
                </form>
        </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
      </div>
      <!-- /.card -->
  </section>
    <!-- /.content -->
@endsection