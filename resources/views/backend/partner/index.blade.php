@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Partners</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Partners</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if(Auth::guard('admin')->user()->hasAnyPermission('partners.create.en','partners.create.ar'))
                                <a style="width: max-content" href="{{route('admin.partners.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Partner</a>
                            @endif
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>En Name</th>
                                    <th>Ar Name</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($partners)
                                    @foreach($partners as $partner)
                                        <tr>
                                            <td>{{$partner->name_en}}</td>
                                            <td>{{$partner->name_ar}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('partners.edit.en','partners.edit.ar'))
                                                    <a href="{{route('admin.partners.edit', $partner->id)}}" title="Edit"
                                                       class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('partners.delete'))
                                                    <form action="{{route('admin.partners.destroy', $partner->id)}}"
                                                          method="post" style="width: 50%;display: inline-block;">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-danger" title="Delete"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
