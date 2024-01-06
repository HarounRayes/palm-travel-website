@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Homepage Images </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Img</li>
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
            </div>
                <form id="demo-form2" method="POST" action="{{ route('admin.home.info.save') }}"
                     enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3>About Section</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En title</label>
                                        <input type="text" class="form-control"
                                               name="about_title_en"
                                               value="{{$about_image->title_section_1_en}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar title</label>
                                        <input type="text" class="form-control"
                                               name="about_title_ar"
                                               value="{{$about_image->title_section_1_ar}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En text</label>
                                        <textarea class="textarea"
                                                  name="about_text_en">{{$about_image->intro_en}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar text</label>
                                        <textarea class="textarea"
                                                  name="about_text_ar">{{$about_image->intro_ar}}</textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                       id="about_image_en" name="about_image_en">
                                                <label class="custom-file-label" for="about_image_en">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        @if(isset($about_image->header_image_en))
                                            <img style="width: 100px;"
                                                 src="{{ url('storage/app/public/images/info/'.$about_image->header_image_en) }}"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>AR Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                       id="about_image_ar" name="about_image_ar">
                                                <label class="custom-file-label" for="about_image_ar">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        @if(isset($about_image->header_image_ar))
                                            <img style="width: 100px;"
                                                 src="{{ url('storage/app/public/images/info/'.$about_image->header_image_ar) }}"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3>Video Section</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En title</label>
                                        <input type="text" class="form-control"
                                               name="video_title_en"
                                               value="{{$service_image->title_section_1_en}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar title</label>
                                        <input type="text" class="form-control"
                                               name="video_title_ar"
                                               value="{{$service_image->title_section_1_ar}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En text</label>
                                        <textarea class="textarea"
                                                  name="video_text_en">{{$service_image->intro_en}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar text</label>
                                        <textarea class="textarea"
                                                  name="video_text_ar">{{$service_image->intro_ar}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                @if($service_image->is_image == 1)
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary1" checked name="is_image" value="1"
                                                   onclick="showImage()">
                                            <label for="radioPrimary1">
                                                Image
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary2" name="is_image" value="0"
                                                   onclick="showVideo()">
                                            <label for="radioPrimary2">
                                                Video
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary1" name="is_image" value="1"
                                                   onclick="showImage()">
                                            <label for="radioPrimary1">
                                                Image
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary2" checked name="is_image" value="0"
                                                   onclick="showVideo()">
                                            <label for="radioPrimary2">
                                                Video
                                            </label>
                                        </div>
                                    </div>
                            @endif
                            </div>
                            <div class="row">
                            @php
                                if($service_image->is_image == 1){
    $image = 'display: block' ;
    $video = 'display: none';
}
else{
       $image = 'display: none' ;
    $video = 'display: block';
}
                            @endphp
                            <!-- Image -->
                                <div class="form-group" id="image-div" style="{{$image}}">
                                    <label for="service_image">Service Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"
                                                   id="service_image" name="service_image">
                                            <label class="custom-file-label" for="service_image">Choose
                                                file</label>
                                        </div>
                                    </div>
                                    @if(isset($service_image->header_image_en))
                                        <img style="width: 100px;"
                                             src="{{ url('storage/app/public/images/info/'.$service_image->header_image_en) }}"/>
                                    @endif
                                </div>
                                <!-- Video -->
                                <div class="form-group" id="video-div" style="{{$video}}">
                                    <label for="service_image">Service Video</label>
                                    <input type="text" name="service_video"
                                           value="{{$service_image->header_image_en}}"
                                           class="form-control">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3>Feature Section</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En title</label>
                                        <input type="text" class="form-control"
                                               name="feature_title_en"
                                               value="{{$feature_section->title_section_1_en}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar title</label>
                                        <input type="text" class="form-control"
                                               name="feature_title_ar"
                                               value="{{$feature_section->title_section_1_ar}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En text</label>
                                        <textarea class="textarea"
                                                  name="feature_text_en">{{$feature_section->intro_en}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar text</label>
                                        <textarea class="textarea"
                                                  name="feature_text_ar">{{$feature_section->intro_ar}}</textarea>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3>Journey Section</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En button</label>
                                        <input type="text" class="form-control"
                                               name="journey_title_en"
                                               value="{{$journey_section->title_section_1_en}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar button</label>
                                        <input type="text" class="form-control"
                                               name="journey_title_ar"
                                               value="{{$journey_section->title_section_1_ar}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En text</label>
                                        <textarea class="textarea"
                                                  name="journey_text_en">{{$journey_section->intro_en}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar text</label>
                                        <textarea class="textarea"
                                                  name="journey_text_ar">{{$journey_section->intro_ar}}</textarea>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3>Newsletter Section</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En Title</label>
                                        <input type="text" class="form-control"
                                               name="newsletter_title_en"
                                               value="{{$newsletter_section->title_section_1_en}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar Title</label>
                                        <input type="text" class="form-control"
                                               name="newsletter_title_ar"
                                               value="{{$newsletter_section->title_section_1_ar}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En text</label>
                                        <textarea class="textarea"
                                                  name="newsletter_text_en">{{$newsletter_section->intro_en}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ar text</label>
                                        <textarea class="textarea"
                                                  name="newsletter_text_ar">{{$newsletter_section->intro_ar}}</textarea>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="form-group" style="padding: 15px;">
                                <input type="submit" class="btn btn-success" value="Save"/>
                            </div>
                        </div>
                    </div>

                    </form>

            </div>
    </section>


@endsection
