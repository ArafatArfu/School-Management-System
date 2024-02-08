@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Admin</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">

                {{ csrf_field() }}

                <div class="card-body">
                    <div class="form-group">
                        <label">Name</label>
                        <input type="text"  value="{{ old('name') }} " name="name" required class="form-control" placeholder="Name">
                    </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="{{ old('email') }} " name="email" required  class="form-control"placeholder="Email">

                   <div style="color:red"> {{ $errors->first('email') }} </div>

                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password"required class="form-control" placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection