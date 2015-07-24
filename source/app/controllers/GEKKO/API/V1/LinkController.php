<?php
namespace GEKKO\API\V1;

use Chrisbjr\ApiGuard\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Chrisbjr\ApiGuard\Transformers\ApiKeyTransformer;

class LinkController extends ApiGuardController {

	protected $apiMethods = [
		'postShorten' => [
			'keyAuthentication' => true,
		]
	];

	/**
	 * Shorten a new URL
	 *
	 * @return Response
	 */
	public function postShorten()
	{
		// No big url
		if(!\Input::has('bigurl'))
			return \Response::json(array('error' => array('code' => 'MISSING-PARAMETERS', 'http_code' => '400', 'message' => 'Bad Request')), 400);

		$bigURL = \Input::get('bigurl');
		$user = $this->apiKey->user;

		// No user linked to API key - SHOULD NEVER HAPPEN
		if(!isset($user))
			return \Response::json(array('error' => array('code' => 'NOT-AUTH', 'http_code' => '403', 'message' => 'Forbidden: SHOULD NEVER HAPPEN!')), 403);

		// User has gone over quota so cant shorten
		if($user->quota_max != 0 && ($user->quota_used + 1) > $user->quota_max)
			return \Response::json(array('error' => array('code' => 'QUOTA-USED', 'http_code' => '400', 'message' => 'Bad Request')), 403);

		if (filter_var($bigURL, FILTER_VALIDATE_URL) === false)
			return \Response::json(array('error' => array('code' => 'URL-INVALID', 'http_code' => '400', 'message' => 'Bad Request')), 400);

		$dbLink = new \Link;
		$dbLink->user_id = $user->id;
		$dbLink->code = $dbLink->generateCode();
		$dbLink->destination = $bigURL;
		$dbLink->save();

		$user->quota_used += 1;
		$user->save();

		$linkURL = \Request::root().'/'.$dbLink->code;

		return \Response::json(array('ok' => array('code' => 'LINK-SHORTENED', 'http_code' => '200', 'message' => 'OK', 'data' => array('url' => $linkURL, 'code' => $dbLink->code))), 200);
	}

}
