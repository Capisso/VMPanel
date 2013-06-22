@extends('layouts/admin')

@section('content')


<h2>Settings</h2>

<div class="row">

    <div class="col col-lg-3">
        <ul id="myTab" class="nav nav-tabs nav-pills nav-stacked">
            <li class="nav-header">Categories</li>
            <li class="active"><a href="#general" data-toggle="tab">General</a></li>
            <li><a href="#profile" data-toggle="tab">Server Communication</a></li>
        </ul>
    </div>

    <div class="col col-lg-9">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="general">
                <p>These settings include settings for the app and your website.</p>

                <br>

                {{ Form::open(array('method' => 'put', 'action' => 'Admin\SettingController@putUpdate', 'class' => 'form-horizontal')) }}
                    <div class="row">
                        <label for="siteName" class="col col-lg-2 control-label">Site Name</label>
                        <div class="col col-lg-4">
                            {{Form::text('site.name', Setting::get('site.name'), array('id' => 'siteName'))}}
                        </div>
                    </div>
                    <div class="row">
                        <label for="siteThemeUser" class="col col-lg-2 control-label">User Theme</label>
                        <div class="col col-lg-4">
                            {{ Form::select('site.theme.user', Setting::get('site.themes'), Setting::get('site.theme.user'), array('id' => 'siteThemeUser')) }}
                        </div>
                    </div>
                    <div class="row">
                        <label for="siteThemeAdmin" class="col col-lg-2 control-label">Admin Theme</label>
                        <div class="col col-lg-4">
                            {{ Form::select('site.theme.admin', Setting::get('site.themes'), Setting::get('site.theme.user'), array('id' => 'siteThemeAdmin')) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-10 col-offset-2">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                {{ Form::close() }}



            </div>
            <div class="tab-pane fade" id="profile">

                <p>These settings control your communication with your Server master.</p>

                <br>

                {{ Form::open(array('method' => 'put', 'action' => 'Admin\SettingController@putUpdate', 'class' => 'form-horizontal')) }}
                    <div class="row">
                        <label for="saltIP" class="col col-lg-2 control-label">Master IP</label>
                        <div class="col col-lg-4">
                            {{Form::text('salt[ip]', Setting::get('salt.ip'), array('id' => 'saltIP'))}}
                        </div>
                    </div>
                    <div class="row">
                        <label for="saltPort" class="col col-lg-2 control-label">Master Port</label>
                        <div class="col col-lg-4">
                            {{Form::text('salt[port]', Setting::get('salt.port'), array('id' => 'saltPort'))}}
                        </div>
                    </div>

                    <div class="row">
                        <label for="saltUsername" class="col col-lg-2 control-label">Master Username</label>
                        <div class="col col-lg-4">
                            {{Form::text('salt[username]', Setting::get('salt.username'), array('id' => 'saltUsername'))}}
                        </div>
                    </div>
                    <div class="row">
                        <label for="saltPassword" class="col col-lg-2 control-label">Master Password</label>
                        <div class="col col-lg-4">
                            {{Form::password('salt[password]', Setting::get('salt.password'), array('id' => 'saltPassword'))}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-10 col-offset-2">
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
    </div>

</div>


</div>

@stop