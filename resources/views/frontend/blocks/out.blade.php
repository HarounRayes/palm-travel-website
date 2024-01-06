
@if ($package->exclusions)
    <?php
    if (isset($package['open_not_include']) && $package['open_not_include'] == '1') {
        $open_not_include = '';
        $icon_not_include = 'fa-minus first';
    } else {
        $open_not_include = 'collapse';
        $icon_not_include = 'fa-plus';
    }
    ?>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#559685;">
                <h4 class="panel-title slide" style="color:#fff;" data-toggle="collapse" data-target="#fqa-{{$package->id}}-Exculusion" >
                    <i class="fas {{$icon_not_include}}" ></i> <b>{{trans('messages.What_not_included')}}</b>
                </h4>
            </div>
            <div id="fqa-{{$package->id}}-Exculusion" class="panel-collapse {{$open_not_include}} fqa-body">
                <div class="panel-body">
                    @foreach ($package->exclusions as $Exculusion)
                        <label>
                            <i class="fas fa-times" aria-hidden="true" style="color:red"></i>
                            {{$Exculusion->value}}
                        </label></br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
