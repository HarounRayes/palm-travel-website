@if ($package->inclusions)
<?php

    if (isset($package['open_include']) && $package['open_include'] == '1') {
        $open_include = '';
        $icon_include = 'fa-minus first';
    } else {
        $open_include = 'collapse';
        $icon_include = 'fa-plus';
    }
    ?>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#559685;">
                <h4 class="panel-title slide" style="color:#fff;" data-toggle="collapse"
                    data-target="#fqa-{{$package->id}}-Inclistion">
                    <i class="fas {{$icon_include}}"></i>
                    <b>{{trans('messages.What_included')}} </b>
                </h4>
            </div>
            <div id="fqa-{{$package->id}}-Inclistion" class="panel-collapse {{$open_include}} fqa-body">
                <div class="panel-body">
                    @foreach ($package->inclusions as $Inclistion)
                        <label>
                            <i class="fas fa-check" aria-hidden="true" style="color:green"></i>
                            {{$Inclistion->value}}
                        </label>
                        </br>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
