<ul class="nav nav-pills nav-stacked">
    <li class="{{(Request::is('admin/regions')? 'active' : '')}}">
        {{HTML::linkAction('Admin\RegionController@index', 'Home')}}
    </li>
    <li class="{{(Request::is('admin/regions/create')? 'active' : '')}}">
        {{HTML::linkAction('Admin\RegionController@create', 'Create')}}
    </li>

    <li class="nav-header">Regions</li>
    @foreach(Region::all() as $region)
    <li class="{{(Request::is('admin/regions/'.$region->id.'*')? 'active': '')}}">
        {{HTML::linkAction('Admin\RegionController@show', $region->name, array($region->id))}}
    </li>
    @endforeach
</ul>