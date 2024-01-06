@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Comments of ({{$blog->name_en}})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Comments of ({{$blog->name_en}})</li>
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

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Commenter Name</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($comments)
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>
                                                {{$comment->commenter_name}}
                                            </td>
                                            <td>{{$comment->comment_text}}</td>
                                            <td>
                                                @if($comment->status == 0)
                                                    {{'Pending'}}
                                                @elseif($comment->status == 1)
                                                    {{'Active'}}
                                                @elseif($comment->status == 2)
                                                    {{'Reject'}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('admin.blogs.comments.show',['blog' => $comment->blog_id ,'comment' => $comment->id])}}"
                                                   class="btn btn-primary">View</a>
                                                <form
                                                    action="{{route('admin.blogs.comments.destroy',['blog' => $comment->blog_id ,'comment' =>$comment->id])}}"
                                                    method="post" style="width: 50%;display: inline-block;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>

                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Commenter Name</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
