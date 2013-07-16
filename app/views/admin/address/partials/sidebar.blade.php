<ul class="nav nav-pills nav-stacked">
    <li class="nav-header">IP Address Manager</li>
    <li class="{{(Request::is('admin/addresses')? 'active' : '')}}">
        {{HTML::linkAction('Admin\AddressController@index', 'Home')}}
    </li>
    <li class="{{(Request::is('admin/addresses/create')? 'active' : '')}}">
        {{HTML::linkAction('Admin\AddressController@create', 'Add')}}
    </li>
</ul>