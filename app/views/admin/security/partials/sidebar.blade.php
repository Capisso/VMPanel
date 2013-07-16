<ul class="nav nav-pills nav-stacked">
    <li class="nav-header">Security Manager</li>
    <li class="{{(Request::is('admin/security')? 'active' : '')}}">
        {{HTML::linkAction('Admin\Security\HomeController@getIndex', 'Home')}}
    </li>
    <li class="{{(Request::is('admin/security/intrusion*')? 'active' : '')}}">
        {{HTML::linkAction('Admin\Security\IntrusionController@index', 'Intrusion Detection System')}}
    </li>
    <li>
        <a href="">Node Attack Log</a>
    </li>
    <li>
        <a href="">Event Log</a>
    </li>
</ul>