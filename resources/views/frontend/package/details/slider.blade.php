@if ($slider_photos)

    <div class="light-slide-item">
        <div class="clearfix">
            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                @foreach ($slider_photos as $photo)
                    <li data-thumb="{{url('storage/app/public/images/slider/'.$photo->image)}}">
                                        <span class="inner-slider-text">
                                       {{$photo->text}}
                                        </span>
                        <img src="{{url('storage/app/public/images/slider/'.$photo->image)}}"
                             style="border-radius: 5px;"/>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endif
