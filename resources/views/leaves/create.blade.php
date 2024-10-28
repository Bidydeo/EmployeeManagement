@extends('layouts.master') 
@section('content')
<!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Creează cerere de concediu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Creează cerere de concediu</li>
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
          <h3 class="card-title">Cerere noua</h3>

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
      
              <form action="{{ route('leaves.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="leave_type">Tip concediu</label>
                      <select name="leave_type_id" id="leave_type_id" class="form-control" required>
                          @foreach($leaveTypes as $leaveType)
                              <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                          @endforeach
                      </select>
                  </div>
      
                  <div class="form-group">
                      <label for="start_date">Data început</label>
                      <input type="date" name="start_date" id="start_date" class="form-control" required>
                  </div>
      
                  <div class="form-group">
                      <label for="end_date">Data sfârșit</label>
                      <input type="date" name="end_date" id="end_date" class="form-control" required>
                  </div>
      
                  <div class="form-group">
                      <label for="substitute_employee_id">Înlocuitor</label>
                      <select name="substitute_employee_id" id="substitute_employee_id" class="form-control">
                        <option value="">Fara Inlocuitor</option>
                          @foreach($employees as $employee)
                            @if($employee->id !== auth()->user()->employee->id)
                              <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                            @endif
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="reason">Reason</label>
                      <textarea type="text" name="reason" id="reason" class="form-control" ></textarea>
                  </div>
      
                  <button type="submit" class="btn btn-primary">Trimite cererea</button>
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