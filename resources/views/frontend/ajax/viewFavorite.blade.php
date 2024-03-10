<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">
        <span class="">{{trans('messages.My Favorites')}}</span>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </h4>
</div>
<div class="modal-body">
    @if(!Auth::guard('member')->user()->favorites->isEmpty())
        @foreach(Auth::guard('member')->user()->favorites as $favorite)
            <div class="favorite-area" id="favorite-area-{{$favorite->id}}">
                <div class="favorite-package-name">
                    <a href="{{route('details',['symbol' => $favorite->package->symbol,'hotel' => $favorite->package->defaultHotel()->symbol])}}"
                       target="_blank">
                        {{$favorite->package->name}}
                    </a>
                </div>

                <div class="favorite-package-manage">
                    <a class="" onclick="delete_favorite('{{$favorite->id}}')"
                       title="{{trans('messages.delete_from_favorites')}}">
                        <i class="fas fa-trash"></i></a>
                </div>
            </div>
        @endforeach
    @else
        <div class="favorite-area text-center">
            {{trans('messages.No-Favorites')}}
        </div>
    @endif
</div>
