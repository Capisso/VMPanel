<ul class="nav nav-pills nav-stacked">
    <li class="{{(Request::is('admin/nodes')? 'active' : '')}}">
        {{HTML::linkAction('Admin\NodeController@index', 'Home')}}
    </li>
    <li class="{{(Request::is('admin/nodes/create')? 'active' : '')}}">
        {{HTML::linkAction('Admin\NodeController@create', 'Add')}}
    </li>
</ul>