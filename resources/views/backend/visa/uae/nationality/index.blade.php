@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visa UAE Nationalities</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Nationalities</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if(Auth::guard('admin')->user()->hasAnyPermission('visa.uae.nationalities.create.en','visa.uae.nationalities.create.ar'))
                                <a style="width: max-content" href="{{route('admin.uaeNationalities.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Nationality</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nationality Name EN</th>
                                    <th>Nationality Name AR</th>
                                    <th>Add to home</th>
                                    <th>Manage</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($nationalities)
                                    @foreach($nationalities as $nationality)
                                        <tr>
                                            <td>{{$nationality->name_en}}</td>
                                            <td>{{$nationality->name_ar}}</td>
                                            <td>
                                                @if($nationality->add_to_home == '1')
                                                    <input class="visa-nationality-switch" type="checkbox" name="my-checkbox" checked
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success" data-id="{{$nationality->id}}"
                                                           data-on-value="1" data-off-value="0">
                                                @else
                                                    <input class="visa-nationality-switch" type="checkbox" name="my-checkbox"
                                                           data-bootstrap-switch
                                                           data-off-color="danger" data-on-color="success"
                                                           data-on-value="1" data-off-value="0" data-id="{{$nationality->id}}">
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('visa.uae.nationalities.edit.en','visa.uae.nationalities.edit.ar'))
                                                    <a href="{{route('admin.uaeNationalities.edit', $nationality->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('visa.uae.nationalities.delete'))
                                                    <form
                                                        action="{{route('admin.uaeNationalities.destroy', $nationality->id)}}"
                                                        method="post" style="width: 50%;display: inline-block;">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Nationality Name En</th>
                                    <th>Nationality Name Ar</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
    </section>

@endsection
