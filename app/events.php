<?php

Event::listen('security.intrusion', 'IntrusionEventHandler@register');