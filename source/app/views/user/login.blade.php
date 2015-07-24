@extends('layouts.user')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.title_login') }}} - {{{ Lang::get('site.title') }}}
@parent
@stop

{{-- Content --}}
@section('content')

<div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
	<div class="panel panel-info" >
		<div class="panel-body" >
			{{ Form::open(array('url' => url('manage/login/', null, Config::get("app.use_https")),  'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) }}
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							{{ Form::text('username', '', array('class' => 'form-control', 'placeholder' => Lang::get('user.login_page_username'), 'label' => Lang::get('user.login_page_username'))) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							{{ Form::password('password', array('class' => 'form-control', 'placeholder' => Lang::get('user.login_page_password'), 'label' => Lang::get('user.login_page_password'))) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="checkbox">
							<label>
								{{ Form::checkbox('rememberme', '', false, array('label' => Lang::get('user.login_page_remember'))) }}&nbsp;{{{ Lang::get('user.login_page_remember') }}}
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 controls">
					@if(Config::get("auth.user_registration"))
						<button type="submit" class="col-sm-5 btn btn-info pull-left">{{{ Lang::get('user.login_page_login') }}}</button>
						<a href="{{ URL::to('/manage/register/', null, Config::get("app.use_https")) }}" class="col-sm-5 btn btn-success pull-right">{{{ Lang::get('user.login_page_register') }}}</a>
					@else
						<button type="submit" class="col-sm-12 btn btn-info btn-full">{{{ Lang::get('user.login_page_login') }}}</button>
					@endif
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div>

@stop