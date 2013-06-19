<ul class="nav nav-pills nav-stacked">
    <li class="{{(Request::is('admin/addresses')? 'active' : '')}}">
        {{HTML::linkAction('Admin\AddressController@index', 'Home')}}
    </li>
    <li class="{{(Request::is('admin/addresses/create')? 'active' : '')}}">
        {{HTML::linkAction('Admin\AddressController@create', 'Create')}}
    </li>
</ul>