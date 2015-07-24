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
			{{ Form::open(array('url' => url('manage/register/', null, Config::get("app.use_https")),  'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) }}
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							{{ Form::text('username', '', array('class' => 'form-control', 'placeholder' => Lang::get('user.register_page_username'), 'label' => Lang::get('user.register_page_username'))) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
							{{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => Lang::get('user.register_page_email'), 'label' => Lang::get('user.register_page_email'))) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							{{ Form::password('password', array('class' => 'form-control', 'placeholder' => Lang::get('user.register_page_password'), 'label' => Lang::get('user.register_page_password'))) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							{{ Form::password('password_confirm', array('class' => 'form-control', 'placeholder' => Lang::get('user.register_page_password_confirm'), 'label' => Lang::get('user.register_page_password_confirm'))) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 controls">
						<button type="submit" class="col-sm-5 btn btn-info pull-left">{{{ Lang::get('user.register_page_register') }}}</button>
						<a href="{{ URL::to('/manage/login/', null, Config::get("app.use_https")) }}" class="col-sm-5 btn btn-danger pull-right">{{{ Lang::get('user.register_page_cancel') }}}</a>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div>

@stop