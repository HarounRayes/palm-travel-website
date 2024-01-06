@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="float-left col-sm-6">
                    <h1>View Comment</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 float-left col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" disabled class="form-control"
                                           value="{{$comment->blog->name_en}}">
                                </div>
                                <div class="form-group">
                                    <label>Commenter Name </label>
                                    <input type="text" disabled class="form-control"
                                           value="{{$comment->commenter_name}}">
                                </div>
                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea class="form-control" disabled>{{$comment->comment_text}}</textarea>
                                </div>
                                <div class="form-group">
                                    <form id="form-edit1"
                                          action="{{route('admin.blogs.comments.update',['blog' => $comment->blog_id ,'comment' => $comment->id])}}"
                                          enctype="multipart/form-data" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="status" value="1"/>
                                        <button type="submit" class="btn btn-success">Active</button>
                                    </form>
                                    <form id="form-edit2"
                                          action="{{route('admin.blogs.comments.update',['blog' => $comment->blog_id ,'comment' => $comment->id])}}"
                                          enctype="multipart/form-data" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="status" value="2"/>
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
