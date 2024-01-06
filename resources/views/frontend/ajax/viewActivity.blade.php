<div class="modal-activity-head" style="padding-bottom: 20px;">
   <button style="z-index: 1000;" type="button" class="close" data-dismiss="modal">
       <p style="padding: 0 0 3px;">&times; </p>
   </button>
</div>
<div class="modal-activity-body">
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="activity-img">
                <img src="{{ url('storage/app/public/images/activity/'.$activity->image) }}" alt="{{$activity->name}}">
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <h4><b>{{$activity->name}}</b></h4>
            {!! $activity->intro !!}
        </div>
    </div>
    <div class="row">
        <div class="activity-details">
            <div class="panel-heading">
                <ul class="nav nav-tabs nav-tabs-activity">
                    <li class="active">
                        <a class="hidden-xs text-blue" href="#tab1primary" data-toggle="tab">
                            <i class="fas fa-file-alt"></i>
                            <br> {{trans('messages.Overview')}}
                        </a>
                        <a class="hidden-lg hidden-md hidden-sm text-blue" href="#tab1primary" data-toggle="tab">
                            <i class="fas fa-file-alt"></i>
                            <br> {{trans('messages.Overview_mob')}}
                        </a>

                    </li>

                    <li class="">
                        <a class="text-blue" href="#tab2primary" data-toggle="tab">
                            <i class="fas fa-map-marker">
                            </i>
                            <br>
                            {{trans('messages.Information')}}
                        </a>
                    </li>

                    <li class="">
                        <a class="text-blue" href="#tab3primary" data-toggle="tab">
                            <i class="fas fa-check-circle">
                            </i>
                            <br>
                            {{trans('messages.Inclusion')}}
                        </a>
                    </li>

                    <li class="">
                        <a class="text-blue" href="#tab4primary" data-toggle="tab">
                            <i class="fas fa-times-circle" aria-hidden="true"></i>
                            <br>
                            {{trans('messages.Exclusion')}}
                        </a>
                    </li>

                    <li class="">
                        <a class="text-blue hidden-xs" href="#tab5primary" data-toggle="tab">
                            <i class="fas fa-pen-nib"> </i>
                            <br>
                            {{trans('messages.Terms_and_Condition')}}
                        </a>
                        <a class="text-blue hidden-lg hidden-md hidden-sm" href="#tab5primary" data-toggle="tab">
                            <i class="fas fa-pen-nib">
                            </i>
                            <br>
                            {{trans('messages.Terms_and_Condition_mob')}}
                        </a>
                    </li>

                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content" >
                    <div class="tab-pane fade active in" id="tab1primary">
                        <div class="section">
                            <div class="s-property-content" style="margin-top: -15px;">
                                <h4>{{trans('messages.Overview')}}</h4>
                                <p>
                                    {!! $activity->overview !!}
                                </p>
                            </div>
                        </div>
                        <div class="section">
                            <div class="s-property-content" style="margin-top: -15px;">
                                <h4>{{trans('messages.Information')}}</h4>
                                <p>
                                    {!! $activity->info !!}
                                </p>

                            </div>
                        </div>
                        <div class="section">
                            <h4>{{trans('messages.Inclusion')}}</h4>
                            @foreach ($activity->inclusions as $inclusion)
                                <label>
                                    <i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                    {{$inclusion->value}}
                                </label>
                                </br>
                            @endforeach
                        </div>
                        <div class="section">
                            <h4>{{trans('messages.Exclusion')}}</h4>
                            @foreach ($activity->exclusions as $exclusion)
                                <label>
                                    <i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                    {{$exclusion->value}}
                                </label>
                                </br>
                            @endforeach
                        </div>
                        <div class="section">

                            <div class="s-property-content" style="margin-top: -15px;">
                                <h4>{{trans('messages.Terms_and_Condition')}}</h4>
                                <p>
                                    {!! $activity->term !!}
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2primary">
                        <div class="section">
                            <div class="s-property-content" style="margin-top: -15px;">
                                <p>
                                    {!! $activity->info !!}
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3primary">
                        <div class="section">
                            @foreach ($activity->inclusions as $inclusion)
                                <label>
                                    <i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                    {{$inclusion->value}}
                                </label>
                                </br>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4primary">
                        <div class="section">
                            @foreach ($activity->exclusions as $exclusion)
                                <label>
                                    <i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                    {{$exclusion->value}}
                                </label>
                                </br>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab5primary">
                        <div class="section">
                            <div class="s-property-content" style="margin-top: -15px;">
                                <p>
                                    {!! $activity->term !!}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
