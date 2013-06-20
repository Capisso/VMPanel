<ul class="nav nav-pills nav-stacked">
    <li class="nav-header">Users</li>
    <li class="{{(Request::is('admin/users')? 'active' : '')}}">
        {{HTML::linkAction('Admin\UserController@index', 'Home')}}
    </li>
    <li class="{{(Request::is('admin/users/create')? 'active' : '')}}">
        {{HTML::linkAction('Admin\UserController@create', 'Create')}}
    </li>
</ul>