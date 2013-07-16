<ul class="nav nav-pills nav-stacked">
    <li class="nav-header">Plan Manager</li>
    <li class="{{(Request::is('admin/plans')? 'active' : '')}}">
        {{HTML::linkAction('Admin\PlanController@index', 'Home')}}
    </li>
    <li class="{{(Request::is('admin/plans/create')? 'active' : '')}}">
        {{HTML::linkAction('Admin\PlanController@create', 'Create')}}
    </li>

    <li class="nav-header">Plans</li>
    @foreach(Plan::all() as $plan)
    <li class="{{(Request::is('admin/plans/'.$plan->id.'*')? 'active' : '')}}">
        {{ HTML::linkAction('Admin\PlanController@show', $plan->name, array($plan->id)) }}
    </li>
    @endforeach
</ul>