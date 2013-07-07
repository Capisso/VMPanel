@extends('layouts/user')

@section('content')

<h2>example.com (192.168.0.28)</h2>

<div class="btn-group">
    <button class="btn btn-info"><i class="icon-eye-open icon-white"></i> Remote Console</button>
</div>

<div class="btn-group">
    <button class="btn"><i class="icon-repeat"></i> Reboot</button>
    <button class="btn"><i class="icon-off"></i> Shutdown</button>
    <button class="btn"><i class="icon-hdd"></i> Reinstall</button>
</div>

<div class="btn-group">
    <button class="btn"><i class="icon-cog"></i> Scale</button>
</div>
<div class="clearfix"></div><br>
<p>
    <strong>Status:</strong> <span class="text-success">Online</span>
    <strong>Region:</strong> Dallas, TX
    <strong>Created On:</strong> {{ date('r', time()) }}
</p>

<hr>

<ul id="serverTab" class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">Information</a></li>
    <li><a href="#configuration" data-toggle="tab">Configuration</a></li>
</ul>
<div id="serverTabs" class="tab-content">
    <div class="tab-pane fade in active" id="home">

        <div class="row-fluid">
            <div class="span6">
                <h4>Server Information</h4>
                <table class="table">
                    <tr>
                        <th>CPU</th>
                        <td>AMD FX(tm)-6100 Six-Core Processor</td>
                    </tr>
                    <tr>
                        <th>Memory</th>
                        <td>2048MB</td>
                    </tr>
                    <tr>
                        <th>Disk</th>
                        <td>120GB</td>
                    </tr>
                    <tr>
                        <th>Bandwidth</th>
                        <td>20TB</td>
                    </tr>
                </table>
            </div>
            <div class="span6">
                <h4>Event Log</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><a href="">Boot</a></td>
                            <td>3 Hours Ago</td>
                        </tr>
                        <tr>
                            <td><a href="">Reinstall</a></td>
                            <td>3 Hours Ago</td>
                        </tr>
                        <tr>
                            <td><a href="">Shutdown</a></td>
                            <td>3 Hours Ago</td>
                        </tr>
                        <tr>
                            <td><a href="">Create</a></td>
                            <td>6 Hours Ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="terminal">
        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
    </div>
    <div class="tab-pane fade" id="configuration">
        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
    </div>
</div>

@stop