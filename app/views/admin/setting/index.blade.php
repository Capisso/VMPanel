@extends('templates/admin/sidebar')

@section('sidebar')
<ul id="settingTab" class="nav nav-pills nav-stacked">
    <li class="nav-header">Setting Manager</li>
    <li class="active"><a href="#general" data-toggle="tab">General</a></li>
    <li><a href="#theme" data-toggle="tab">Theme Options</a></li>
    <li><a href="#profile" data-toggle="tab">Server Communication</a></li>
</ul>
@stop

@section('content')

<div id="settingTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="general">
        <p>These settings include settings for the app and your website.</p>

        <br>

        {{ Form::open(array('method' => 'put', 'action' => 'Admin\SettingController@putUpdate', 'class' => 'form-horizontal')) }}
            <div class="control-group">
                <label for="siteName" class="control-label">Site Name</label>
                <div class="controls">
                    {{Form::text('site.name', Setting::get('site.name'), array('id' => 'siteName'))}}
                </div>
            </div>
            <div class="control-group">
                <label for="siteThemeUser" class="control-label">User Theme</label>
                <div class="controls">
                    {{ Form::select('site.theme.user', Setting::get('site.themes'), Setting::get('site.theme.user'), array('id' => 'siteThemeUser')) }}
                </div>
            </div>
            <div class="control-group">
                <label for="siteThemeAdmin" class="control-label">Admin Theme</label>
                <div class="controls">
                    {{ Form::select('site.theme.admin', Setting::get('site.themes'), Setting::get('site.theme.user'), array('id' => 'siteThemeAdmin')) }}
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        {{ Form::close() }}

    </div>
    <div class="tab-pane fade" id="theme">

        <h3>Bootswatcher</h3>
        <p>You can use Bootswatch to easily change the "skin" of your panel. </p>

        {{ Form::open(array('method' => 'put', 'action' => 'Admin\SettingController@putUpdate', 'class' => 'form-horizontal')) }}
            <div class="control-group">
                <label for="themeBootswatch" class="control-label">Skin</label>
                <div class="controls">
                    {{ Form::select('theme.bootswatch', $bootswatchSkins, Config::get('theme.bootswatch'), array('id' => 'themeBootswatch')) }}
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        {{ Form::close() }}

        <h4>Avaliable Skins</h4>
        <ul class="thumbnails">
            @foreach($bootswatch as $skin)
            <li class="span2">
                <div class="thumbnail">
                    <img src="{{ $skin['thumbnail'] }}" alt="">
                    <h3 class="text-center">{{{ $skin['name'] }}}</h3>
                </div>
            </li>
            @endforeach
        </ul>

    </div>
    <div class="tab-pane fade" id="profile">

        <p>These settings control your communication with your Server master.</p>

        <br>

        {{ Form::open(array('method' => 'put', 'action' => 'Admin\SettingController@putUpdate', 'class' => 'form-horizontal')) }}
            <div class="control-group">
                {{ Form::label('saltHost', 'Host', array('class' => 'control-label')) }}
                <div class="controls">
                    {{Form::text('salt[host]', Setting::get('salt.host'), array('id' => 'saltHost'))}}
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('saltPort', 'Port', array('class' => 'control-label')) }}
                <div class="controls">
                    {{Form::text('salt[port]', Setting::get('salt.port'), array('id' => 'saltPort'))}}
                </div>
            </div>

            <div class="control-group">
                {{ Form::label('saltAuth', 'Auth Type', array('class' => 'control-label')) }}
                <div class="controls">
                    {{Form::text('salt[auth_type]', Setting::get('salt.auth_type'), array('id' => 'saltAuth'))}}
                </div>
            </div>

            <div class="control-group">
                <label for="saltUsername" class="control-label">Username</label>
                <div class="controls">
                    {{Form::text('salt[auth_username]', $auth['username'], array('id' => 'saltUsername'))}}
                </div>
            </div>
            <div class="control-group">
                <label for="saltPassword" class="control-label">Password</label>
                <div class="controls">
                    {{Form::password('salt[auth_password]', $auth['password'], array('id' => 'saltPassword'))}}
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        {{ Form::close() }}

    </div>
    <div class="tab-pane fade" id="dropdown1">
        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
    </div>
    <div class="tab-pane fade" id="dropdown2">
        <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
    </div>
</div>


@stop
