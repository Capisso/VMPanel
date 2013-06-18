@extends('layouts/user')

@section('content')

<h2>example.com</h2>

<div class="btn-group">
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Power Options
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#">Reboot</a></li>
            <li><a href="#">Shutdown</a></li>
        </ul>
    </div>

    <button type="button" class="btn btn-default">Shutdown</button>
    <button type="button" class="btn btn-default">3</button>

    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Dropdown
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#">Dropdown link</a></li>
            <li><a href="#">Dropdown link</a></li>
            <li><a href="#">Dropdown link</a></li>
        </ul>
    </div>
</div>

<hr>

<div class="bs-example bs-example-tabs">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#">Statistics</a></li>
        <li><a href="#">Terminal</a></li>
        <li><a href="#">Configuration</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">

            <br>

            <div id="charts"></div>


            <script src="http://d3js.org/d3.v3.min.js"></script>
            <script src="/themes/capisso_default/assets/js/bullet.js"></script>
            <script>

                var margin = {top: 5, right: 40, bottom: 20, left: 120},
                    width = 900 - margin.left - margin.right,
                    height = 50 - margin.top - margin.bottom;

                var chart = d3.bullet()
                    .width(width)
                    .height(height);

                d3.json("bullets.json", function(error, data) {
                    var svg = d3.select("#charts").selectAll("svg")
                        .data(data)
                        .enter().append("svg")
                        .attr("class", "bullet")
                        .attr("width", width + margin.left + margin.right)
                        .attr("height", height + margin.top + margin.bottom)
                        .append("g")
                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
                        .call(chart);

                    var title = svg.append("g")
                        .style("text-anchor", "end")
                        .attr("transform", "translate(-6," + height / 2 + ")");

                    title.append("text")
                        .attr("class", "title")
                        .text(function(d) { return d.title; });

                    title.append("text")
                        .attr("class", "subtitle")
                        .attr("dy", "1em")
                        .text(function(d) { return d.subtitle; });

                    /*
                    d3.selectAll("button").on("click", function() {
                        svg.datum(randomize).call(chart.duration(1000)); // TODO automatic transition
                    });
                    */
                });

                function randomize(d) {
                    if (!d.randomizer) d.randomizer = randomizer(d);
                    d.ranges = d.ranges.map(d.randomizer);
                    d.markers = d.markers.map(d.randomizer);
                    d.measures = d.measures.map(d.randomizer);
                    return d;
                }

                function randomizer(d) {
                    var k = d3.max(d.ranges) * .2;
                    return function(d) {
                        return Math.max(0, d + k * (Math.random() - .5));
                    };
                }

            </script>

        </div>
        <div class="tab-pane fade" id="profile">
            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
        </div>
        <div class="tab-pane fade" id="dropdown1">
            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
        </div>
        <div class="tab-pane fade" id="dropdown2">
            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
        </div>
    </div>
</div>

<style>


    .bullet { font: 10px sans-serif; }
    .bullet .marker { stroke: #000; stroke-width: 2px; }
    .bullet .tick line { stroke: #666; stroke-width: .5px; }
    .bullet .range.s0 { fill: #eee; }
    .bullet .range.s1 { fill: #ddd; }
    .bullet .range.s2 { fill: #ccc; }
    .bullet .measure.s0 { fill: lightsteelblue; }
    .bullet .measure.s1 { fill: steelblue; }
    .bullet .title { font-size: 14px; font-weight: bold; }
    .bullet .subtitle { fill: #999; }

</style>


@stop