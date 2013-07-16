<?php

namespace Admin\Security;

use Admin\BaseController;
use View;
use IDSLog;
use Event;

class IntrusionController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $events = IDSLog::all();

        return View::make('admin/security/intrusion/index', array(
            'events' => $events,
            'title' => 'Intrusion Detection System',
            'description' => 'This system automatically detects attempted SQL Injection/XSS exploits made against your panel. You can view more information about the event or report it to Capisso by clicking view.',
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $event = IDSLog::find($id);

        return View::make('admin/security/intrusion/show', compact('event'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        $event = IDSLog::find($id)->first();
        Event::fire('admin.intrusion.destroy', array($event));
        $event->delete();

        return \Redirect::action('Admin\Security\IntrusionController@index');
    }
}