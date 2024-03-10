@extends('layouts.app')

@section('content')
    @if($blog->header_image != '')
        <div class="page-head"
             style="background-image: url({{url('storage/app/public/images/blog/'.$blog->header_image)}});
                 background-size: cover; background-position: center;background-repeat: no-repeat"
        >
        </div>
    @else
        <div class="page-head" style='background-color: #b0a579'></div>
    @endif

    <!-- End page header -->
    <div class="content-area single-property" style="background-color: #FCFCFC;">
        <div class="container padding-top-40">

            <div class="row">
                <div class="col-md-12 single-property-content ">

                    <div class="panel with-nav-tabs flight_map_tap3">
                        <div class="section">
                            <h1 class="s-property-title">
                                {{$blog->name}}
                            </h1>

                            <div class="s-property-content">
                                <p>
                                    {!! $blog->info !!}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="section">
                            <div class="card my-4">
                                <h5 class="card-header">
                                    {{trans('messages.Add_comment')}}
                                </h5>
                                <div class="card-body">
                                    <form method="post" action="{{route('comment',['blog' => $blog->id])}}">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control" name="commenter_name" id='name'
                                                   placeholder=" {{trans('messages.Name')}}" required/>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" name="comment_text" id="text"
                                                      required placeholder=" {{trans('messages.Message')}}"></textarea>
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                                            <div class="col-md-6">
                                                {!! RecaptchaV3::field('blogs') !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="comment_send">
                                            {{trans('messages.Send')}}
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="section">
                            <div class="card my-4">
                            @if ($comments)
                                @foreach ($comments as $comment)
                                    <!-- Single Comment -->
                                        <div class="media mb-4 card">
                                            <div class="col-sm-12 padding-bottom-10 padding-top-10">
                                                <i class="fab fa-user-circle-o rounded-circle inline-block"></i>
                                                <h4 class="mt-0 inline-block">
                                                    {{$comment->commenter_name}}
                                                </h4>
                                            </div>

                                            <div class="media-body col-sm-12 padding-bottom-20">

                                                {{$comment->comment_text}}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
