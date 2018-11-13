
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta property="og:image" content="http://www.rateastate.online/ratestate.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="https://d3js.org/d3-array.v1.min.js"></script>
    <script src="https://d3js.org/d3-color.v1.min.js"></script>
    <script src="https://d3js.org/d3-format.v1.min.js"></script>
    <script src="https://d3js.org/d3-interpolate.v1.min.js"></script>
    <script src="https://d3js.org/d3-time.v1.min.js"></script>
    <script src="https://d3js.org/d3-time-format.v2.min.js"></script>
    <script src="https://d3js.org/d3-scale.v2.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Assistant|Permanent+Marker" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <style type="text/css">

        /* On mouse hover, lighten state color */
        path:hover {
            fill-opacity: .7;
        }

        /* Style for Custom Tooltip */
        div.tooltip {
            position: absolute;
            text-align: center;
            min-width: 150px;
            max-width: 300px;
            height: 20px;
            padding: 2px;
            font: 16px sans-serif;
            background: white;
            border: 0px;
            pointer-events: none;
        }

        /* Legend Font Style */
        body {
            font: 20px 'Assistant', sans-serif;
            color: lightgrey;
            background-color:#373738;
        }
        h1{
            font-family: 'Permanent Marker', cursive;
        }
        input{
            font-size: 22px;
        }
        .highrating{
            color:plum;
            font-weight: bolder;
        }
        .lowrating{
            color: darkmagenta;
            font-weight: bolder;
        }

        /* Legend Position Style */
        .legend {
            display:none;
            position:absolute;
            left:800px;
            top:350px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Rate-A-State</h1>

            <p>Click on any state to vote on its awesomeness (or lack therof). May the best state win!</p>
        </div>
    </div>
    <div class="row">


        <div id="svgcontainer" class="col-lg-8 col-md-12">

        </div>
        <div class="top_panel col-lg-4 col-md-12">

        </div>
        <div class="leaderboard col-lg-4 col-md-12">

        </div>
    </div>



<script type="text/javascript">


    /*  This visualization was made possible by modifying code provided by:

    Scott Murray, Choropleth example from "Interactive Data Visualization for the Web"
    https://github.com/alignedleft/d3-book/blob/master/chapter_12/05_choropleth.html

    Malcolm Maclean, tooltips example tutorial
    http://www.d3noob.org/2013/01/adding-tooltips-to-d3js-graph.html

    Mike Bostock, Pie Chart Legend
    http://bl.ocks.org/mbostock/3888852  */


    //Width and height of map
    var width = 960;
    var height = 500;

    // D3 Projection
    var projection = d3.geo.albersUsa()
        .translate([width/2-100, height/2])    // translate to center of screen
        .scale([1000]);          // scale things down so see entire US

    // Define path generator
    var path = d3.geo.path()               // path generator that will convert GeoJSON to SVG paths
        .projection(projection);  // tell path generator to use albersUsa projection


    // Define linear scale for output
    var color = d3.scaleLinear()
        .domain([0,10])
        .range(["white", "purple"]);




    //Create SVG element and append map to the SVG
    var svg = d3.select("#svgcontainer")
        .append("svg")
        .attr("width", width)
        .attr("height", height);

    // Append Div for tooltip to SVG
    var div = d3.select("body")
        .append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);

    function loadMap(){
        // Load in my states data!
        d3.json("http://www.rateastate.online/index.php/welcome/states_json", function(data) {
            color.domain([10,5,1]); // setting the range of the input data

// Load GeoJSON data and merge with states data
            d3.json("us-states.json", function(json) {

// Loop through each state data value in the .csv file
                for (var i = 0; i < data.length; i++) {

                    // Grab State Name
                    var dataState = data[i].state;

                    // Grab data value
                    var dataValue = data[i].rating;

                    // Find the corresponding state inside the GeoJSON
                    for (var j = 0; j < json.features.length; j++)  {
                        var jsonState = json.features[j].properties.name;


                        if (dataState == jsonState) {

                            // Copy the data value into the JSON
                            json.features[j].properties.rating = dataValue;
                            json.features[j].properties.abbr = data[i].abbr;

                            // Stop looking through the JSON
                            break;
                        }
                    }
                }

// Bind the data to the SVG and create one path per GeoJSON feature
                svg.selectAll("path")
                    .data(json.features)
                    .enter()
                    .append("path")
                    .attr("d", path)
                    .style("stroke", "#fff")
                    .style("stroke-width", "1")
                    .style("fill", function(d) {

                        // Get data value
                        var value = d.properties.rating;
                        if (value) {
                            //If value exists…
                            console.log(d.properties.name);
                            console.log(color(value));
                            return color(value);

                        } else {
                            //If value is undefined…
                            return "rgb(213,222,217)";
                        }
                    })
                    .on("click", function(d) {
                        d3.selectAll('path').style('stroke','white');
                        d3.select(this.parentNode.appendChild(this)).transition().duration(300)
                            .style({'stroke-opacity':1,'stroke':'#F00'});
                        loadState(d.properties.abbr,'');

                    })
                    .on("mouseover", function(d) {

                        div.transition()
                            .duration(200)
                            .style("opacity", .9)
                            .style("color", 'black');
                        div.text(d.properties.name +": "+ d.properties.rating)
                            .style("left", (d3.event.pageX) + "px")
                            .style("top", (d3.event.pageY - 28) + "px");
                    })


                    // fade out tooltip on mouse out
                    .on("mouseout", function(d) {
                        div.transition()
                            .duration(500)
                            .style("opacity", 0);
                    })




// Modified Legend Code from Mike Bostock: http://bl.ocks.org/mbostock/3888852
                var legend = d3.select("body").append("svg")
                    .attr("class", "legend")
                    .attr("width", 140)
                    .attr("height", 200)
                    .selectAll("g")
                    .data(color.domain().slice().reverse())
                    .enter()
                    .append("g")
                    .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

                legend.append("rect")
                    .attr("width", 18)
                    .attr("height", 18)
                    .style("fill", color);

                // legend.append("text")
                //     .data(legendText)
                //     .attr("x", 24)
                //     .attr("y", 9)
                //     .attr("dy", ".35em")
                //     .text(function(d) { return d; });
            });

        });
    }
    loadMap();

    function loadState(abbr,msg=''){
        var url = "http://www.rateastate.online/index.php/welcome/state_profile/"+abbr+"?msg="+msg;
        $.get(url, function(page){
            $('.top_panel').html(page);
            window.history.pushState("object or string", "Title", "http://www.rateastate.online//?state="+abbr);
        })
    }
    <?php if($this->input->get('state')):?>
    setTimeout(function(){loadState('<?=$this->input->get('state')?>','Your vote has been cast')}, 2000);

    <?php endif?>

</script>

</div>
</body>

</html>