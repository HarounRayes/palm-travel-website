<div class="col-md-12 col-xs-12 login-blocks">
    <h2> {{trans('messages.Login')}} : </h2>
        <div class="form-group">
            <label for="email">
                {{trans('messages.Email')}}
            </label>
            <input type="email" class="form-control" id="email" name="email" required/>
        </div>
        <div class="form-group">
            <label for="password">
                {{trans('messages.Password')}}
            </label>
            <input type="password" class="form-control" id="password" name="password" required/>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-default" onclick="formLogin()">
                {{trans('messages.Login')}}
            </button>
            <a href="{{route('member.password.request')}}" class="btn btn-default">
                {{trans('messages.Forget-password')}}
            </a>
        </div>
    <br>
</div>
