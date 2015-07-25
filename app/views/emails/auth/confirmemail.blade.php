<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Activate Account</h2>

		<div>
			Hi <b>{{ $username }}</b>,<br />
			To complete your account registration, please activate your account by visiting this link: <a href="{{ URL::to('manage/register/confirm', array($activation_code), Config::get("app.use_https")) }}" target="_blank">{{ URL::to('manage/register/confirm', array($activation_code), Config::get("app.use_https")) }}</a><br/>
			This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.<br />
			<br /><br />If you did not request this please contact us immediately.
		</div>
	</body>
</html>