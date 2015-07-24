<?php

class Link extends \Eloquent {
	protected $fillable = array('code', 'destination');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'links';

	/**
	* Get the user that the file belongs to.
	*
	* @return user
	*/
	public function user() {
		return $this->belongsTo('User');
	}

	/**
	* Generate random
	*
	* @return string
	*/
	public function generateCode($length = 6)
	{
		$avail_chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$avail_chars_len = strlen($avail_chars);
		do {
			$newCode = "";
			for ($i = 0; $i < $length; $i++) {
				$newCode .= $avail_chars[mt_rand(0, $avail_chars_len - 1)];
			}
		}
		while ($this->codeExists($newCode));

		return $newCode;
	}

	/**
	 * Checks whether a key exists in the database or not
	 *
	 * @param $code
	 * @return bool
	 */
	private function codeExists($code)
	{
		$codeCount = self::where('code', '=', $code)->limit(1)->count();
		if ($codeCount > 0) return true;
		return false;
	}

}