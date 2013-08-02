<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lstrickland
 * Date: 8/2/13
 * Time: 9:51 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Admin;

use App;
use Input;
use Redirect;
use SSHKey;
use Validator;
use View;

class AccountController extends BaseController {

	public function getIndex() {

	}

	public function getSshKeys() {
		return View::make('admin/account/ssh-keys', array(
			'keys' => $this->user->keys,
			'title' => 'Your SSH Keys'
		));
	}

	/**
	 * Add a new SSH key to your account
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postSshKeys() {
		$rules = array(
			'name' => 'required',
			'key' => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()) {
			return Redirect::action('AccountController@getSshKeys')->withErrors($validator);
		}

		$sshkey = new SSHKey();

		$sshkey->name = Input::get('name');
		$sshkey->key = Input::get('key');
		$sshkey->user_id = $this->user->id;

		$sshkey->save();

		return Redirect::refresh();
	}

	/**
	 * Delete a ssh key based on ID.
	 *
	 * @todo more checking
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteSshKeys($id) {
		$key = SSHKey::find($id);
		if($key->user_id != $this->user->id) {
			App::abort(401);
		}

		$key->delete();

		return Redirect::back();
	}

	public function getApiAccess() {

	}

	public function getSettings() {
		return View::make('admin/account/settings', array(
			'title' => 'Account Settings'
		));
	}

}
