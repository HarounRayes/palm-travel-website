@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add User </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        @if($errors->count() != 0)
                            <div class="form-group">
                                <div class="col-8 col-md-8">
                                    @foreach ($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <form id="demo-form2" method="POST" action="{{ route('admin.users.store') }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label>Username <span class="required">*</span></label>
                                    <input type="text" name="username" class="form-control"
                                           value="{{old('username')}}">
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="required">*</span></label>
                                    <input type="text" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password Confirmation <span class="required">*</span></label>
                                    <input type="text" name="password_confirmation" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Role <span class="required">*</span></label>
                                 <select name="role" class="form-control" required>
                                     <option value="">Select</option>
                                     @foreach($roles as $role)
                                         <option value="{{$role->name}}">
                                             {{$role->name}}
                                         </option>
                                     @endforeach
                                 </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.card -->
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="form-group" style="padding: 15px;">
                                <input type="submit" class="btn btn-success" value="Save"/>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </section>


@endsection
