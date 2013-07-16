<?php

class IntrusionEventHandler {

    /**
     * Register a new intrusion alert and in the future
     * send an email if over specified amount.
     *
     * @param $event
     */
    public function register($event) {

        IDSLog::create(array(
            'name' => $event->getName(),
            'value' => $event->getValue(),
            'filters' => json_encode($event->getFilters()),
            'impact' => $event->getImpact(),
            'tags' => json_encode($event->getTags()),
            'page' => Request::path(),
            'ip' => Request::getClientIp(),
            'request' => json_encode($_REQUEST)
        ));


        // @todo send email if over limit
    }

}
