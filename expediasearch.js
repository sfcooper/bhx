<script language="javascript">    function Initialise() {        var numModes = 6;        for (i = 0; i < numModes; i++) {	        if (document.getElementById("exp_SearchType" + i)!=null) {		        document.getElementById("exp_SearchType" + i).checked = true;	            exp_showMode(i);	            return;	        }        }    }    function exp_showMode(whichMode) {	    var numModes = 6;	    for (i = 0; i < numModes; i++) {		    if (typeof(document.getElementById("exp-wiz-" + i)=='object'))		        document.getElementById("exp-wiz-" + i).style.display = (i == whichMode) ? "block" : "none";	    }    }    function exp_showRooms(roomNo) {        document.getElementById("exp-wiz-room2").style.display = (roomNo == 2) ? "block" : "none";    }</script><!-- start wizard code (300) --><style type="text/css">#exp_SearchWizard {	font: 11px Arial, Helvetica, sans-serif;}.exp-wiz form{	font-family: Arial, Helvetica, sans-serif;	font-size: 11px;}.exp-wiz * {	border: 0;	}.exp-wiz .rule-light {	height: 1px;	background-color: #e2e2e2;	margin: 0 1px;	clear: both;}.exp-wiz .rule-dark {	height: 1px;	background-color: #b2b2b2;	margin: 0 1px;	clear:both;}.exp-wiz UL {	margin: 2px 1px;	padding: 0;	list-style-type: none;	overflow: hidden;}.exp-wiz UL LI {	padding: 0;	margin: 0px;	white-space: nowrap;	width: 40%;	float: left;}.exp-wiz .textbox {	border: 1px solid #809db9;	font-size: 11px;	font-family:Arial, Helvetica, sans-serif;	padding: 1px 2px;}.exp-wiz .select{    width:170px;}.exp-wiz SELECT {	border: 1px solid #809db9;	font-size: 11px;	font-family:Arial, Helvetica, sans-serif;}.exp-wiz .label {	display: block;	margin: 0 0 2px 0;}.exp-wiz .greenButton {	float:right;}.exp-wiz .greenButton a:hover {	background-position:center -377px;}.exp-wiz .greenButton a {	background:transparent url(http://media.expedia.com/media/content/shared/graphics/fusion/buttonBG.png) no-repeat scroll center -80px;	border:1px solid #8CBA7E;	color:#FFFFFF !important;	display:block;	font-size:11px;	padding:1px 14px;	text-decoration:none;}.exp-wiz .blue {	color:#1253a3;}.exp-wiz-logo {	font-size: 16px;	color: #1253a3;	font-weight: bold;	padding: 2px 4px;}.exp-wiz-panel {	padding: 0 8px;}.exp-wiz-panel-child {    margin: 0 0 5px 0;}#exp-wiz-0 {	display:block;}#exp-wiz-1, #exp-wiz-2, #exp-wiz-3, #exp-wiz-4, #exp-wiz-5 {	display:none;}.exp-wiz-cap1 {	height:1px; background-color:#bdbdbd; margin:0 2px;}.exp-wiz-cap2 {	height:1px; border-left:1px solid #bdbdbd; border-right:1px solid #bdbdbd; margin:0 1px;}#exp-wiz-morelink {	float: left; 	padding:7px 8px;}.exp-wiz-panel-left {	float: left; 	padding: 4px 0;}#exp-wiz-searchbutton {	padding:7px 8px;	text-align:right;	overflow:hidden;}</style><!--[if IE]><style type="text/css">.exp-wiz-panel-child {    margin: 0 0 3px 0;}.exp-wiz-panel-left {	padding: 3px 0 1px 0;}#exp-wiz-morelink {	padding:4px 8px;}#exp-wiz-searchbutton {	padding:4px 8px;}</style><![endif]--><div style="width:300px;" class="exp-wiz">	<form name="exp_SearchWizard" id="exp_SearchWizard" method="post">	    <div class="exp-wiz-cap1"><!-- --></div>	    <div class="exp-wiz-cap2"><!-- --></div>	    <div style="border-left:1px solid #bdbdbd; border-right:1px solid #bdbdbd;">		    <div class="exp-wiz-bg">			    <div class="exp-wiz-logo">				    <!-- logo/unbranded text -->				    				    <!--Create your trip-->				    				        <label id="exp_Label1" class="label">Create your package</label>                    				    <!-- /logo -->			    </div>			    <div class="rule-light"><!-- --></div>			    <ul id="exp-wiz-search-type">			    				    <li><input name="exp_SearchType" type="radio" value="0" checked id="exp_SearchType0" onclick="exp_showMode(0)" /> Flight + Hotel</li>                					    <li><input name="exp_SearchType" type="radio" value="1" id="exp_SearchType1" onclick="exp_showMode(1)" /> Flights</li>                				    <li><input name="exp_SearchType" type="radio" value="2" id="exp_SearchType2" onclick="exp_showMode(2)" /> Hotels</li>                				    <li><input name="exp_SearchType" type="radio" value="3" id="exp_SearchType3" onclick="exp_showMode(3)" /> Cars</li>                				    <li><input name="exp_SearchType" type="radio" value="4" id="exp_SearchType4" onclick="exp_showMode(4)" /> Activities</li>                				    <li><input name="exp_SearchType" type="radio" value="5" id="exp_SearchType5" onclick="exp_showMode(5)" /> Packages</li>                			    </ul>			    <div class="rule-light"><!-- --></div>    						    <!-- mode 0 Flight Hotel -->			    <div class="exp-wiz-panel" id="exp-wiz-0">				    <div class="exp-wiz-panel-left" style="width: 195px; border-right: 1px solid #e2e2e2;">				        <div class="exp-wiz-panel-child" style="overflow:hidden;">				            <div style="float:left; margin-right:8px;">					            <label id="exp_Label2" class="label">Leaving from:</label>					            <input class="textbox" id="exp_FH_FrAirport" type="text" style="width: 84px;" />				            </div>				            <div style="float:left">					            <label id="exp_Label3" class="label">Going to:</label>					            <input class="textbox" id="exp_FH_DestName" type="text" style="width: 84px;" />				            </div>                        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label4" class="label">Departing:</label>					        <input class="textbox" id="exp_FH_FromDate" type="text" value="dd/mm/yy" style="width: 54px;" />&nbsp;&nbsp;					        <select id="exp_FH_FromTime" style="width:66px; display:inline;">					            <option value="362" selected="selected">Anytime</option>					            <option value="361">Morning</option>					            <option value="721">Afternoon</option>					            <option	value="1081">Evening</option>						        </select>				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label5" class="label">Returning:</label>					        <input class="textbox" id="exp_FH_ToDate" type="text" value="dd/mm/yy" style="width: 54px;" />&nbsp;&nbsp;					        <select id="exp_FH_ToTime" style="width:66px; display:inline;">					            <option value="362" selected="selected">Anytime</option>					            <option value="361">Morning</option>					            <option value="721">Afternoon</option>					            <option	value="1081">Evening</option>						        </select>				        </div>		            </div>		            <div style="float: left; padding: 4px; width: 75px; overflow: hidden;">				        <div class="exp-wiz-panel-child">					        <label id="exp_Label6" class="label">Adult <nobr>(19-64):</nobr></label>					        <select id="exp_FH_NumAdult" style="width:36px;">					        <option value="0">0</option>					        <option value="1" selected="selected">1</option>					        <option value="2">2</option>					        <option value="3">3</option>					        <option	value="4">4</option>					        <option value="5">5</option>					        <option value="6">6</option>						        </select>				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label7" class="label">Children <nobr>(0-18):</nobr></label>					        <select id="exp_FH_NumChild" style="width:36px;">					        <option value="0" selected="selected">0</option>					        <option value="1">1</option>					        <option value="2">2</option>					        <option value="3">3</option>					        <option	value="4">4</option>					        <option value="5">5</option>					        <option value="6">6</option>						        </select>				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label8" class="label">Seniors <nobr>:</nobr></label>					        <select id="exp_FH_NumSenior" style="width:36px;">					        <option value="0" selected="selected">0</option>					        <option value="1">1</option>					        <option value="2">2</option>					        <option value="3">3</option>					        <option	value="4">4</option>					        <option value="5">5</option>					        <option value="6">6</option>						        </select>				        </div>                    </div>			    </div>			    <!-- /mode 0 Flight Hotel -->			    <!-- mode 1 Flights -->			    <div class="exp-wiz-panel" id="exp-wiz-1">				    <div class="exp-wiz-panel-left" style="width: 195px; border-right: 1px solid #e2e2e2;">                        <div class="exp-wiz-panel-child" style="overflow:hidden;">				            <div style="float:left; margin-right:8px;">					            <label id="exp_Label9" class="label">Leaving from:</label>    					        <input class="textbox" id="exp_F_FrAirport" type="text" style="width: 84px;" />				            </div>				            <div style="float:left">    					        <label id="exp_Label10" class="label">Going to:</label>					            <input class="textbox" id="exp_F_ToAirport" type="text" style="width: 84px;" />				            </div>				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label11" class="label">Departing:</label>					        <input class="textbox" id="exp_F_FromDate" type="text" value="dd/mm/yy" style="width: 54px;" />&nbsp;&nbsp;					        <select id="exp_F_FromTime" style="width:66px; display:inline;">					            <option value="362" selected="selected">Anytime</option>					            <option value="361">Morning</option>					            <option value="721">Afternoon</option>					            <option	value="1081">Evening</option>						        </select>				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label12" class="label">Returning:</label>					        <input class="textbox" id="exp_F_ToDate" type="text" value="dd/mm/yy" style="width: 54px;" />&nbsp;&nbsp;					        <select id="exp_F_ToTime" style="width:66px; display:inline;">					            <option value="362" selected="selected">Anytime</option>					            <option value="361">Morning</option>					            <option value="721">Afternoon</option>					            <option	value="1081">Evening</option>						        </select>				        </div>                    </div>                    <div style="float: left; padding: 4px; width: 75px; overflow: hidden;">				        <div class="exp-wiz-panel-child">					        <label id="exp_Label13" class="label">Adult <nobr>(19-64):</nobr></label>					        <select id="exp_F_NumAdult" style="width:36px;">					        <option value="0">0</option>					        <option value="1" selected="selected">1</option>					        <option value="2">2</option>					        <option value="3">3</option>					        <option	value="4">4</option>					        <option value="5">5</option>					        <option value="6">6</option>						        </select>				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label14" class="label">Children <nobr>(0-18):</nobr></label>					        <select id="exp_F_NumChild" style="width:36px;">					        <option value="0" selected="selected">0</option>					        <option value="1">1</option>					        <option value="2">2</option>					        <option value="3">3</option>					        <option	value="4">4</option>					        <option value="5">5</option>					        <option value="6">6</option>						        </select>				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label15" class="label">Seniors <nobr>:</nobr></label>					        <select id="exp_F_NumSenior" style="width:36px;">					        <option value="0" selected="selected">0</option>					        <option value="1">1</option>					        <option value="2">2</option>					        <option value="3">3</option>					        <option	value="4">4</option>					        <option value="5">5</option>					        <option value="6">6</option>						        </select>				        </div>    			    </div>			    </div>			    <!-- /mode 1 Flights -->			    <!-- mode 2 Hotels -->			    <div class="exp-wiz-panel" id="exp-wiz-2">			        <div class="exp-wiz-panel-left" style="width: 195px; border-right: 1px solid #e2e2e2;">				        <div class="exp-wiz-panel-child">					        <label id="exp_Label16" class="label">Destination:</label>					        <input class="textbox" id="exp_H_CityName" type="text"/>				        </div>				        <div class="exp-wiz-panel-child" style="overflow:hidden;">					        <div style="float:left; margin-right:8px;">					            <label id="exp_Label17" class="label">Check-in date:</label>					            <input class="textbox" id="exp_H_InDate" type="text" value="dd/mm/yy" style="width: 54px;" />    				        </div>   				            <div style="float:left; margin-right:8px;">					            <label id="exp_Label18" class="label">Check-out date:</label>					            <input class="textbox" id="exp_H_OutDate" type="text" value="dd/mm/yy" style="width: 54px;" />                            </div>				        </div>				        <div class="exp-wiz-panel-child" style="display:none;">					        <label id="Label1" class="label">Rooms:</label>					        <select id="exp_H_NumRoom" style="width:36px;">					            <option value="1" selected="selected">1</option>					            <option value="2">2</option>					        </select>				        </div>	                </div>                    <div style="float: left; padding: 4px; width: 75px; overflow: hidden;">	                    <div class="exp-wiz-panel-child">			                <div style="margin: 0 6px 0 0">Adult <nobr>(19-64):</nobr></div>			                <div style="margin: 0 6px 0 0;">					            <select id="exp_H_NumAdult" style="width:36px;">					                <option value="0">0</option>					                <option value="1">1</option>					                <option value="2" selected="selected">2</option>					                <option value="3">3</option>					                <option	value="4">4</option>					                <option value="5">5</option>					                <option value="6">6</option>						            </select>				            </div>			            </div>			            <div class="exp-wiz-panel-child">			                <div>Children<br /><nobr>(0-18):</nobr></div>			                <div style="float:left; width: 40px;">					            <select id="exp_H_NumChild" style="width:36px;">					                <option value="0" selected="selected">0</option>					                <option value="1">1</option>					                <option value="2">2</option>					                <option value="3">3</option>					                <option	value="4">4</option>					                <option value="5">5</option>					                <option value="6">6</option>						            </select>				            </div>			            </div>                    </div>			    </div>			    <!-- /mode 2 Hotels -->			    <!-- mode 3 Cars -->			    <div class="exp-wiz-panel" id="exp-wiz-3">			        <div class="exp-wiz-panel-left" style="width: 170px; border-right: 1px solid #e2e2e2;">				        <div class="exp-wiz-panel-child">					        <label id="exp_Label20" class="label">Pick-up location:</label>					        <input class="textbox" id="exp_C_PickupLoc" type="text" style="width: 100px;" />				        </div>				        <div class="exp-wiz-panel-child">				            <label id="exp_Label21" class="label">Pick-up date & time:</label>					        <input class="textbox" id="exp_C_FromDate" type="text" value="dd/mm/yy" style="width: 54px;" />&nbsp;&nbsp;					        <select id="exp_C_FromTime" style="width:66px; display:inline;">					            <option value="362" selected="selected">Anytime</option>					            <option value="361">Morning</option>					            <option value="721">Afternoon</option>					            <option	value="1081">Evening</option>						        </select>				        </div>				        <div class="exp-wiz-panel-child">    			            <label id="exp_Label22" class="label">Return date & time:</label>					        <input class="textbox" id="exp_C_ToDate" type="text" value="dd/mm/yy" style="width: 54px;" />&nbsp;&nbsp;					        <select id="exp_C_ToTime" style="width:66px; display:inline;">					            <option value="362" selected="selected">Anytime</option>					            <option value="361">Morning</option>					            <option value="721">Afternoon</option>					            <option	value="1081">Evening</option>						        </select>				        </div>                    </div>                    <div style="float: left; padding: 4px; width: 100px; overflow: hidden;">				        <div class="exp-wiz-panel-child">					        <label id="exp_Label23" class="label">Car Type:<nobr></label>					        <select id="exp_C_CarClass" class="exp-wiz-carclass" style="width:98px;">                                <option selected="selected" value="NOPREFERENCE">No Preference</option>                                <option value="Minicar">Mini-car</option>                                <option value="Economy">Economy</option>                                <option value="Compact">Compact</option>                                <option value="Midsize">Midsize</option>                                <option value="Standard">Standard</option>                                <option value="FullSize">Full Size</option>                                <option value="Premium">Premium</option>                                <option value="Luxury">Luxury</option>					        </select>				        </div>                    </div>			    </div>			    <!-- /mode 3 Cars -->			    <!-- mode 4 Actvities -->			    <div class="exp-wiz-panel" id="exp-wiz-4">				    <div class="exp-wiz-panel-left" style="width: 195px; border-right: none;">				        <div class="exp-wiz-panel-child">					        <label id="exp_Label24" class="label">Destination:</label>					        <input class="textbox" id="exp_A_LocationName" type="text"/>				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label25" class="label">From:</label>					        <input class="textbox" id="exp_A_StartDate" type="text" value="dd/mm/yy" style="width: 54px;" />&nbsp;&nbsp;				        </div>				        <div class="exp-wiz-panel-child">					        <label id="exp_Label26" class="label">Until:</label>					        <input class="textbox" id="exp_A_EndDate" type="text" value="dd/mm/yy" style="width: 54px;" />&nbsp;&nbsp;				        </div>	                </div>			    </div>  			    <!-- /mode 4 Actvities -->			    <!-- mode 5 3PP -->                    <div class="exp-wiz-panel" id="exp-wiz-5">	    <div class="leftcol" style="float: left; width: 199px; padding: 4px 0; border-right: 1px solid #e2e2e2;">	        <input type="hidden" id="Target" name="Target" value="Regions"/>	        <div class="exp-wiz-panel-child" style="float:left; padding-right:10px;">		        <label id="exp_Label44" class="label">Leaving from:</label>		        <select id="exp_UK3PP_LeavingFrom" style="width: 100px;">		            <option value="">Any</option>			        <option value="STN-LTN-LHR-LGW">London All Airports</option>			        <option value="ABZ">Aberdeen</option>			        <option value="BFS">Belfast</option>			        <option value="BHD">Belfast Harbor</option>			        <option value="BHX">Birmingham</option>			        <option value="BLK">Blackpool</option>			        <option value="BOH">Bournemouth</option>			        <option value="BRS">Bristol</option>			        <option value="CWL">Cardiff Wales</option>			        <option value="CVT">Coventry</option>			        <option value="DSA">Doncaster Sheffield Airport</option>			        <option value="DUB">Dublin</option>			        <option value="MME">Durham Tees Valley</option>			        <option value="EMA">East Midlands</option>			        <option value="EDI">Edinburgh</option>			        <option value="EXT">Exeter</option>			        <option value="GLA">Glasgow City</option>			        <option value="PIK">Glasgow Prestwick</option>			        <option value="HUY">Humberside</option>			        <option value="LBA">Leeds</option>			        <option value="LPL">Liverpool</option>			        <option value="LCY">London City</option>			        <option value="LGW">London Gatwick</option>			        <option value="LHR">London Heathrow</option>			        <option value="STN">London Stansted</option>			        <option value="LTN">Luton Int.</option>			        <option value="MAN">Manchester</option>			        <option value="NCL">Newcastle</option>			        <option value="NWI">Norwich</option>			        <option value="IOM">Ronaldsway</option>			        <option value="SOU">Southampton Eastleigh</option>		        </select>	        </div>	        <div class="exp-wiz-panel-child">		        <label id="exp_Label45" class="label">Earliest departure:</label>		        <input class="textbox" id="exp_UK3PP_FromDate" type="text" value="dd/mm/yyyy" style="width: 59px;" />&nbsp;&nbsp;	        </div>	        <div class="exp-wiz-panel-child" style="float:left; padding-right:10px;">		        <label id="exp_Label46" class="label">Going to:</label>		        <select id="exp_UK3PP_GoingTo" style="width: 100px;">				    <option value="">Any</option>				    <option value="10011">Africa</option>				    <option value="10020">Arabian Peninsula</option>				    <option value="10017">Asia</option>				    <option value="10000">Balearic Islands</option>				    <option value="10024">Canada</option>				    <option value="10001">Canary Islands</option>				    <option value="10014">Caribbean</option>				    <option value="10028">Central Europe</option>				    <option value="10030">Croatia, Bulgaria, Eastern Europe</option>				    <option value="10034">Cruises</option>				    <option value="10038">Cyprus</option>				    <option value="10013">Dominican Republic</option>				    <option value="10010">Egypt</option>				    <option value="10021">France</option>				    <option value="10029">Germany</option>				    <option value="10006">Greece Mainland</option>				    <option value="10005">Greek Islands</option>				    <option value="10036">Indian Ocean</option>				    <option value="10007">Italy</option>				    <option value="10032">Late Deals</option>				    <option value="10039">Malta</option>				    <option value="10016">Mexico</option>				    <option value="10026">Middle East</option>				    <option value="10022">Northern Europe</option>				    <option value="10002">Portugal</option>				    <option value="10003">Spanish Mainland</option>				    <option value="10033">Tours</option>				    <option value="10008">Tunisia, Morocco</option>				    <option value="10004">Turkey</option>				    <option value="10015">USA</option>		        </select>	        </div>	        <div class="exp-wiz-panel-child">		        <label id="exp_Label47" class="label">Latest leturn:</label>		        <input class="textbox" id="exp_UK3PP_ToDate" type="text" value="dd/mm/yyyy" style="width: 59px;" />&nbsp;&nbsp;	        </div>	        <div class="exp-wiz-panel-child" style="float:left;" >		        <label id="exp_Label48" class="label">Duration:</label>                <select id="exp_UK3PP_Duration"> 				    <option selected="selected" value="6;7">1 week</option>				    <option value="6;14">2 weeks</option>				    <option value="6;10">10 nights</option>				    <option value="6;11">11 nights</option>				    <option value="">--------------------------</option>				    <option value="6;5">5 nights</option>				    <option value="6;6">6 nights</option>				    <option value="6;7">7 nights</option>				    <option value="6;8">8 nights</option>				    <option value="6;9">9 nights</option>				    <option value="6;10">10 nights</option>				    <option value="6;11">11 nights</option>				    <option value="6;12">12 nights</option>				    <option value="6;13">13 nights</option>				    <option value="6;14">14 nights</option>				    <option value="6;15">15 nights</option>				    <option value="6;16">16 nights</option>				    <option value="6;17">17 nights</option>				    <option value="6;18">18 nights</option>				    <option value="6;19">19 nights</option>				    <option value="6;20">20 nights</option>				    <option value="6;21">21 nights</option>				    <option value="6;22">22 nights</option>				    <option value="6;23">23 nights</option>				    <option value="6;24">24 nights</option>				    <option value="6;25">25 nights</option>				    <option value="6;26">26 nights</option>				    <option value="6;27">27 nights</option>				    <option value="6;28">28 nights</option>                </select>	        </div>        </div>        <div class="rightcol" style="float: left; padding: 4px 0px 4px 7px; width: 73px;            overflow: hidden;">	        <div class="exp-wiz-panel-child">		        <label id="exp_Label49" class="label">Adult<br />(19-64):</label>		        <select id="exp_UK3PP_NumAdults">                    <option value="25">1</option>                    <option value="25;25" selected="selected">2</option>                    <option value="25;25;25">3</option>                    <option value="25;25;25;25">4</option>                    <option value="25;25;25;25;25">5</option>                    <option value="25;25;25;25;25;25">6</option>                    <option value="25;25;25;25;25;25;25">7</option>                    <option value="25;25;25;25;25;25;25;25">8</option>                    <option value="25;25;25;25;25;25;25;25;25">9</option>                </select>	        </div>	        <div class="exp-wiz-panel-child">		        <label id="exp_Label50" class="label">Select child<br />ages:</label>	        </div>	        <div class="exp-wiz-panel-child" style="padding-right:5px;">	            <select id="exp_UK3PP_Child1" style="width: 35px; float:left;">                    <option value="">---</option>                    <option value="1">&lt;2</option>                    <option value="2">2</option>                    <option value="3">3</option>                    <option value="4">4</option>                    <option value="5">5</option>                    <option value="6">6</option>                    <option value="7">7</option>                    <option value="8">8</option>                    <option value="9">9</option>                    <option value="10">10</option>                    <option value="11">11</option>                    <option value="12">12</option>                    <option value="13">13</option>                    <option value="14">14</option>                    <option value="15">15</option>                    <option value="16">16</option>                </select>	        </div>	        <div class="exp-wiz-panel-child">	            <select id="exp_UK3PP_Child2" style="width: 35px;">                    <option value="">---</option>                    <option value="1">&lt;2</option>                    <option value="2">2</option>                    <option value="3">3</option>                    <option value="4">4</option>                    <option value="5">5</option>                    <option value="6">6</option>                    <option value="7">7</option>                    <option value="8">8</option>                    <option value="9">9</option>                    <option value="10">10</option>                    <option value="11">11</option>                    <option value="12">12</option>                    <option value="13">13</option>                    <option value="14">14</option>                    <option value="15">15</option>                    <option value="16">16</option>                </select>	        </div>        </div>    </div>                  			    <!-- /mode 5 3PP -->  		        <div class="rule-dark"><!-- --></div>			    <div id="exp-wiz-morelink">				    <a id="exp_MoreOptions" href="javascript:exp_MoreOptions();">more search options</a>			    </div>					    <div id="exp-wiz-searchbutton">				    <div class="greenButton"><a href="javascript:exp_SubmitWiz();">Search</a></div>			    </div>			    <div style="clear:both; height:0"><!-- --></div>		    </div>	    </div>	    <div class="exp-wiz-cap2"><!-- --></div>	    <div class="exp-wiz-cap1"><!-- --></div>	</form></div><script language="javascript">    function exp_MoreOptions()    {                //FLIGHT + HOTEL            if  (document.getElementById("exp_SearchType0").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=PKGLAUNCH&DestName=" + encodeURI(document.getElementById("exp_FH_DestName").value) +"&FrAirport="+ encodeURI(document.getElementById("exp_FH_FrAirport").value) +"&FromDate="+ document.getElementById("exp_FH_FromDate").value +"&ToDate="+ document.getElementById("exp_FH_ToDate").value +"&FromTime="+ document.getElementById("exp_FH_FromTime").value +"&ToTime="+ document.getElementById("exp_FH_ToTime").value +"&NumAdult="+ document.getElementById("exp_FH_NumAdult").value +"&NumChild="+ document.getElementById("exp_FH_NumChild").value +"&NumSenior="+ document.getElementById("exp_FH_NumSenior").value +"&NumRoom=1");            }        	        //FLIGHTS            if  (document.getElementById("exp_SearchType1").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=FLIGHTWIZ&eapid=0-3&langid=2057" + "&DepAirpName=" + encodeURI(document.getElementById("exp_F_FrAirport").value) + "&DestAirpName=" + encodeURI(document.getElementById("exp_F_ToAirport").value) + "&DepDate=" + document.getElementById("exp_F_FromDate").value  + "&DepTime=" + document.getElementById("exp_F_FromTime").value + "&ReturnDate=" + document.getElementById("exp_F_ToDate").value + "&ReturnTime=" + document.getElementById("exp_F_ToTime").value +"&NumAdult="+ document.getElementById("exp_F_NumAdult").value +"&NumChild="+ document.getElementById("exp_F_NumChild").value +"&NumSenior="+ document.getElementById("exp_F_NumSenior").value);            }                //HOTEL            if  (document.getElementById("exp_SearchType2").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=HOTWIZ&MoreOptions=1&cityname=" + encodeURI(document.getElementById("exp_H_CityName").value) + "&indate=" + document.getElementById("exp_H_InDate").value +"&outdate="+ document.getElementById("exp_H_OutDate").value +"&numadult="+ document.getElementById("exp_H_NumAdult").value +"&numchild="+ document.getElementById("exp_H_NumChild").value +"&numroom="+ document.getElementById("exp_H_NumRoom").value);            }                //CARS            if  (document.getElementById("exp_SearchType3").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=CARWIZD&Equipment=1&pickuploc=" + encodeURI(document.getElementById("exp_C_PickupLoc").value) +"&PickUpDate="+ document.getElementById("exp_C_FromDate").value +"&DropOffDate="+ document.getElementById("exp_C_ToDate").value +"&PIckUpTime="+ document.getElementById("exp_C_FromTime").value +"&DropOffTime="+ document.getElementById("exp_C_ToTime").value +"&CarClass=" + document.getElementById("exp_C_CarClass").value);            }                //ACTIVITIES            if  (document.getElementById("exp_SearchType4").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=TSHOPSSEARCH&LocationName=" + encodeURI(document.getElementById("exp_A_LocationName").value) +"&StartDate="+ document.getElementById("exp_A_StartDate").value +"&EndDate="+ document.getElementById("exp_A_EndDate").value);            }                //3PP            if  (document.getElementById("exp_SearchType5").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?http://booking.expedia.co.uk");            }            }        function exp_SubmitWiz()    {        //FLIGHT + HOTEL                    if  (document.getElementById("exp_SearchType0").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=PACKAGEWIZ&DestName=" + encodeURI(document.getElementById("exp_FH_DestName").value) +"&FrAirport="+ encodeURI(document.getElementById("exp_FH_FrAirport").value) +"&FromDate="+ document.getElementById("exp_FH_FromDate").value +"&ToDate="+ document.getElementById("exp_FH_ToDate").value +"&FromTime="+ document.getElementById("exp_FH_FromTime").value +"&ToTime="+ document.getElementById("exp_FH_ToTime").value +"&NumAdult="+ document.getElementById("exp_FH_NumAdult").value +"&NumChild="+ document.getElementById("exp_FH_NumChild").value +"&NumSenior="+ document.getElementById("exp_FH_NumSenior").value +"&NumRoom=1");            }                //FLIGHT        	            if  (document.getElementById("exp_SearchType1").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=EXPFLTWIZ&FrAirport=" + encodeURI(document.getElementById("exp_F_FrAirport").value) +"&ToAirport="+ encodeURI(document.getElementById("exp_F_ToAirport").value) +"&FromDate="+ document.getElementById("exp_F_FromDate").value +"&ToDate="+ document.getElementById("exp_F_ToDate").value +"&FromTime="+ document.getElementById("exp_F_FromTime").value +"&ToTime="+ document.getElementById("exp_F_ToTime").value +"&NumAdult="+ document.getElementById("exp_F_NumAdult").value +"&NumChild="+ document.getElementById("exp_F_NumChild").value +"&NumSenior="+ document.getElementById("exp_F_NumSenior").value);            }                //HOTEL            if  (document.getElementById("exp_SearchType2").checked == true)            {                var redirectURL;                redirectURL = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=HOTSEARCH&cityname=" + encodeURI(document.getElementById("exp_H_CityName").value) + "&indate=" + document.getElementById("exp_H_InDate").value +"&outdate="+ document.getElementById("exp_H_OutDate").value +"&numadult="+ document.getElementById("exp_H_NumAdult").value +"&numchild="+ document.getElementById("exp_H_NumChild").value +"&numroom="+ document.getElementById("exp_H_NumRoom").value);                if ( document.getElementById("exp_H_NumRoom").value == 2 ) {                    redirectURL = redirectURL + escape("&numadult2="+ document.getElementById("exp_H_NumAdult2").value +"&numchild2="+ document.getElementById("exp_H_NumChild2").value);                }                document.location = redirectURL;            }                //CAR            if  (document.getElementById("exp_SearchType3").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=CARSEARCH&pickuploc=" + encodeURI(document.getElementById("exp_C_PickupLoc").value) +"&FromDate="+ document.getElementById("exp_C_FromDate").value +"&ToDate="+ document.getElementById("exp_C_ToDate").value +"&FromTime="+ document.getElementById("exp_C_FromTime").value +"&ToTime="+ document.getElementById("exp_C_ToTime").value +"&Class=" + document.getElementById("exp_C_CarClass").value);            }                //ACTIVITES            if  (document.getElementById("exp_SearchType4").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=/pubspec/scripts/eap.asp" + escape("?GOTO=TSHOPSSEARCH&LocationName=" + encodeURI(document.getElementById("exp_A_LocationName").value) +"&StartDate="+ document.getElementById("exp_A_StartDate").value +"&EndDate="+ document.getElementById("exp_A_EndDate").value);            }                //3PP        //UK 3            if  (document.getElementById("exp_SearchType5").checked == true)            {                document.location = "http://clk.tradedoubler.com/click?p=21874&a=1683084&g=17638408&url=http://booking.expedia.co.uk/tt.aspx?" + escape("Departure=" + encodeURI(document.getElementById("exp_UK3PP_LeavingFrom").value) +"&Region="+ encodeURI(document.getElementById("exp_UK3PP_GoingTo").value) +"&Duration="+ document.getElementById("exp_UK3PP_Duration").value +"&FromDate="+ document.getElementById("exp_UK3PP_FromDate").value +"&ToDate="+ document.getElementById("exp_UK3PP_ToDate").value +"&NumAdults="+ document.getElementById("exp_UK3PP_NumAdults").value +"&Child1="+ document.getElementById("exp_UK3PP_Child1").value +"&Child2="+ document.getElementById("exp_UK3PP_Child2").value);            }            }        Initialise();</script>