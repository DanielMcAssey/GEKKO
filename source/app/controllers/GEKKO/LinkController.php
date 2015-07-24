<?php
namespace GEKKO;

class LinkController extends \BaseController {


	/**
	 * Delete Link
	 *
	 * @return Response
	 */
	public function postDelete()
	{
		if(!(\Auth::check() && \Input::has("linkid")))
			return \Response::json(array('error' => array('code' => 'NOT-AUTH', 'http_code' => '403', 'message' => 'Forbidden')), 403);

		$linkID = \Input::get("linkid");
		$shortenedLink = \Link::find($linkID);

		if(\Auth::user()->id != $shortenedLink->user_id)
			return \Response::json(array('error' => array('code' => 'NOT-AUTH', 'http_code' => '403', 'message' => 'Forbidden')), 403);

		$shortenedLink->delete();

		if((\Auth::user()->quota_used - 1) >= 0)
		{
			\Auth::user()->quota_used -= 1;
			\Auth::user()->save();
		}

		return \Response::json(array('ok' => array('code' => 'LINK-DELETED', 'http_code' => '200', 'message' => 'OK')), 200);
	}


	/**
	 * Get latest links from last ID
	 *
	 * @return Response
	 */
	public function getLatest()
	{
		if(!(\Auth::check() && \Input::has("lastid")))
			return \Response::json(array('error' => array('code' => 'NOT-AUTH', 'http_code' => '403', 'message' => 'Forbidden')), 403);

		$lastLinkID = \Input::get("lastid");
		$linkList = \Link::where('user_id', '=', \Auth::user()->id)->where('id', '>', $lastLinkID)->get();

		if(count($linkList) <= 0)
			return \Response::json(array('error' => array('code' => 'NO-LINKS', 'http_code' => '200', 'message' => 'OK')), 200);

		$returnArray = array();
		for($i = 0; $i < count($linkList); $i++)
		{
			$selectedLink = $linkList[$i];
			$tmpArray = array();
			$tmpArray["id"] = $selectedLink->id;
			$tmpArray["code"] = $selectedLink->code;
			$tmpArray["destination"] = $selectedLink->destination;
			$tmpArray["clicks"] = $selectedLink->clicks;
			$tmpArray["date"] = date('Y-m-d G:i:s', strtotime($selectedLink->created_at));
			$returnArray[] = $tmpArray;
		}
		return \Response::json(array('ok' => array('code' => 'LINKS-RETRIEVED', 'http_code' => '200', 'message' => 'OK', 'data' => array('links' => $returnArray))), 200);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(\Auth::check())
		{
			$lastLink = \Auth::user()->links()->first();
			$links = \Auth::user()->linksByPage(10);
			if($lastLink != null)
			{
				return \View::make('user.index')->with('shortenedLinks', $links)->with('lastShortenedLinkID', $lastLink->id);
			}
			else
			{
				return \View::make('user.index')->with('shortenedLinks', $links)->with('lastShortenedLinkID', 0);
			}
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}