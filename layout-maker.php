<!doctype html>
<!--[if IEMobile]> <html class="no-js ie-mobile" lang="en"> <![endif]-->
<!--[if (lt IE 7)&!(IEMobile) ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile) ]> <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if (IE 8)&!(IEMobile) ]> <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<title>CHASSIS 2.0</title>
	
	<?php include("includes/head.php"); ?>
	
	<!-- development QA only (remove), not for production use -->
	<link rel="stylesheet" href="dev/css/debug.css" />

    <?php
        /* uncomment for Less PHP support
		require 'dev/less/lessc.inc.php';
		$less1 = new lessc('dev/less/templates/layouts/layouts.less');
		file_put_contents('css/templates/layouts/layouts.css', $less1->parse());
		
		$less2 = new lessc('dev/less/templates/components/components.less');
		file_put_contents('css/templates/components/components.css', $less2->parse());
		
		$less3 = new lessc('dev/less/templates/pages/pages.less');
		file_put_contents('css/templates/pages/pages.css', $less3->parse());
	    */
	?>
	
	<!-- Less CSS: for development only, should not be used on production --> 
    <!--  --> 
    <link rel="stylesheet/less" type="text/css" href="dev/less/templates/layouts/layouts.less" />
    <link rel="stylesheet/less" type="text/css" href="dev/less/templates/components/components.less" />
    <link rel="stylesheet/less" type="text/css" href="dev/less/templates/pages/pages.less" />
    
    <script src="dev/less/less.js"></script>
    <script> less.env = "development"; less.watch(); </script>
	
	<!-- Compiled Less CSS 
	<link rel="stylesheet" type="text/css" href="css/templates/layouts/layouts.css" /> 
	<link rel="stylesheet" type="text/css" href="css/templates/components/components.css" />
    <link rel="stylesheet" type="text/css" href="css/templates/pages/pages.css" />
    -->
</head>

<body class="cms-bg-1 debug-grid">
	
	<?php include("templates/components/skip-links.php"); ?>
	
	<div id="wrapper" class="layout-store"><!-- wrapper used to provide extra stylistic hooks e.g. LHS and RHS shadows -->

		<div id="container" class="en-gb chassis home cat-1 cat-1-2 cms-seasonal"><!-- to allow for customised seasonal layouts -->

			<div id="main"><!-- components: source order important for layout, order can be changed to cater for new layout requirements -->

				<!-- layout -->

				<style type="text/css"> 
				
				    body {
				        margin: 0;
				    }
				
					#header {
						border-bottom: 2px solid #333;
					}
					
					.message {
						text-align: center;
					}
					
					#footer {
						display: none;
					}
					
					
					#container .area {
						outline: 1px solid #999;
						margin: 0;
						position: absolute;
					}
					
					#container .draggable { 
						z-index: 5;
						top: 0;
						left: 0;
						width: 180px; 
						height: 108px; 
						padding: 0; 
						margin: 0;
						opacity: 0.7;
						border: 0!important;
					}

					.draggable h2 {
						padding: 5px;
						font-size: 15px; 
						font-family: arial, helvetica;
						color: #999;
						text-align: center;
					}	

					.ui-widget-header p, .ui-widget-content p { 
						margin: 0; 
					}

					.add,
					.remove,
					.save {
						position: absolute;
						top: 10px;
						left: 85%;
						background-color: #666;
						color: #fff;
						font-size: 15px;
					}
					.remove {
						top: 50px;
					}
					.save {
						top: 90px;
					}
					
					#linkto-generated {
						position: absolute;
						top: 140px;
						left: 85%;
						text-decoration: underline;
						color: #333;
						font-size: 14px;
					}
					
					.arrow-down {
						float: left;
						position: relative;
						top: 3px;
						width: 0;
						height: 0;
						margin-right: 5px;
						border-left: 10px solid transparent;
						border-right: 10px solid transparent;
						border-top: 10px solid #333;
					}
					
					#container {
					    min-height: 600px;
					}
					
				</style>

				<link type="text/css" href="dev/layout-creator/js/jquery.ui.all.css" rel="stylesheet" />
				
				<script type="text/javascript" src="dev/layout-creator/js/base64encoder.js"></script>
				<script type="text/javascript" src="dev/layout-creator/js/jquery.ui.core.js"></script>
				<script type="text/javascript" src="dev/layout-creator/js/jquery.ui.widget.js"></script>
				<script type="text/javascript" src="dev/layout-creator/js/jquery.ui.mouse.js"></script>
				<script type="text/javascript" src="dev/layout-creator/js/jquery.ui.draggable.js"></script>
				<script type="text/javascript" src="dev/layout-creator/js/jquery.ui.resizable.js"></script>

				<script>
				var layoutMaker = (function($) {

					var generatedLess = "",
					    GRID_BASELINE,
    					GRID_COLUMN,
    					GRID_GUTTER, 
					init = function() {
					    createXhr();
					}();
					
					function createXhr() {
                        // read baseline grid constants from Less
				        $.ajax({
                        	url: "dev/less/baseplate.grid.constants.less",
                			beforeSend: function() { 
                				// e.g. loading indicators here

                			},
                			cache: false,
                			dataType : "html", 
                			success: function(data) {
                                var tempData = [];
                                tempData  = data.split("@"),
                                
                                GRID_BASELINE = parseInt(tempData[1].split(";")[0].split(":")[1].replace("px","")),
                                GRID_COLUMN = parseInt(tempData[2].split(";")[0].split(":")[1].replace("px","")),
                                GRID_GUTTER = parseInt(tempData[3].split(";")[0].split(":")[1].replace("px",""));
                                
                                // loaded data now setup editor
                        		createButtons();
        						addEvents();
                			},  
                			complete: function(){

                			},
                			error: function() {

                			},
                			dataFilter : function (data, type) {
                			  // Parsing JSON strings can throw a SyntaxError exception, 
                			  // so we wrap the call in a try catch block 

                				try { 
                				    // check validity
                				}

                				catch (e) { 
                				    // Invalid data; 
                				} 

                			  return data;
                			}
                    	}); // end $.ajax
					}

					function createButtons() {
						$('<button class="add">Add</button>').appendTo("body");
						$('<button class="remove">Remove</button>').appendTo("body");
						$('<button class="save">Snap to and Save to link</button>').appendTo("body");
						$('<a href="#" id="linkto-generated"><span class="arrow-down"></span>Save Generated Layout</a>').appendTo("body");
						$('<div class="message">You can only generate layouts in browsers that support <a href="http://en.wikipedia.org/wiki/Data_URI_scheme">Data URIs</a></div>').appendTo("body");
					}

					function createArea() {
						layoutMaker.areaCount++;

						$("#container").append('<div id="area-'+layoutMaker.areaCount+'" class="area draggable resizable ui-widget-content"><h2>Area '+layoutMaker.areaCount+'</h2></div>');
						$('#area-'+layoutMaker.areaCount)
						.draggable({ grid: [1,(GRID_BASELINE/2)] })
						.resizable({
							containment: '#container',
							grid: [1,(GRID_BASELINE/2)],
							resize : function() {

							}
						})
						.position().top = 0;
					} // creaetArea()

					function removeArea() {
						$('#area-'+layoutMaker.areaCount).detach();
						layoutMaker.areaCount -=1; 
					}

					function saveAreas() {
						var gridLeft = 0;
						var adjustedLeft = 0;
						var gridWidth = 0;
						var adjustedWidth = 0;
						var today = new Date();
						
						generatedLess = "/* --- Begin Generated Less Layout "+
						
						"on Date: " + today.getDate() + "/" + 
						(today.getMonth() +1) + "/" +
						today.getFullYear() + " | Time:" + " " +
						today.getHours() + ":" +
						today.getMinutes() + ":" +
						today.getSeconds() +
						" -- */\n";

						$(".area").each(function(i){
							var id = $(this).attr("id");
							var top = $(this).position().top;
							var left = $(this).position().left;
							var height = $(this).height();
							var width = $(this).width();

							// adjustments
							gridLeft = left / (GRID_COLUMN + GRID_GUTTER);
							adjustedLeft = (Math.round(gridLeft) * (GRID_COLUMN + GRID_GUTTER)) + GRID_GUTTER;

							gridWidth = width / (GRID_COLUMN + GRID_GUTTER);
							adjustedWidth = (Math.round(gridWidth) * (GRID_COLUMN + GRID_GUTTER)) - GRID_GUTTER;
							//console.log(adjustedWidth);

							$(this).width(adjustedWidth);

							$(this).css({
								left: adjustedLeft
							});
							// log data to console

							generatedLess += "."+ id + " {\n ";
							generatedLess += "  .top("+ layoutMaker.convertToBaseline(top) + ");\n ";
							generatedLess += "  .left("+ layoutMaker.convertToColumn(adjustedLeft) + ");\n ";
							generatedLess += "  .width("+ layoutMaker.convertToColumn(adjustedWidth) + ");\n ";
							generatedLess += "  .height("+ layoutMaker.convertToBaseline(height) + ");\n ";
							generatedLess += "}\n";

						});
						generatedLess += "/* --- End Layout CSS (copy above) -- */\n";
						generatedLess += "\n ";
						
						encodeLink(generatedLess);
					} // saveAreas()
					
					function encodeLink(generatedLess) {
					
						var base64encodeDataUri = "data:text/plain;base64," + Base64.encode(generatedLess);
						$("#linkto-generated").hide()
						.fadeIn("slow")
						.attr("href", base64encodeDataUri);
					}
					
					function addEvents() {
						$(function() {
							$(".add").bind("click", function(){
								createArea();
							});
							$(".remove").bind("click", function(){
								removeArea();
							});
							$(".save").bind("click", function(){
								saveAreas();
							});	
						});
					};

					return {
						areaCount: 0,
						convertToBaseline : function(yValue) {
							return Math.round(yValue / GRID_BASELINE);
						},
						convertToColumn : function(xValue) {
							return Math.round(xValue / (GRID_COLUMN + GRID_GUTTER));
						} 
					}
				}(jQuery));

				</script>


			</div><!-- id="main" -->
                <!--
				<div id="header" role="banner">
					<h1><acronym title="CSS HTML And Structured Scripts in Standards">CHASSIS</acronym></h1>
				</div> --> <!-- id="header" -->

		</div><!-- id="container" -->
	</div><!-- id="wrapper" -->
</body>
</html>