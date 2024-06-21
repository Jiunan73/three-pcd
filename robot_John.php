<!DOCTYPE html>
<html lang="en">
	<head>
		<title>three.js webgl - collada - kinematics</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<link type="text/css" rel="stylesheet" href="main.css">
		<script src='../build/three.min.js'></script>
		<!--<script src='../build/threex.domevents.js'></script>-->
		
		<script type="text/javascript" src="TcAdsWebService.js"></script>
		<script src="assets/js/jquery/jquery-1.9.1.min.js"></script>
		
		
		<script src="ParticleEngine/OrbitControls.js"></script>
	
		
		<!--<script src="assets/js/highcharts.js"></script>-->
		
		<style type="text/css">
		
			#container {
			  height: 300px;
			}

			.highcharts-data-table table {
			  font-family: Verdana, sans-serif;
			  border-collapse: collapse;
			  border: 1px solid #ebebeb;
			  margin: 10px auto;
			  text-align: center;
			  width: 100%;
			  max-width: 500px;
			}

			.highcharts-data-table caption {
			  padding: 1em 0;
			  font-size: 1.2em;
			  color: #555;
			}

			.highcharts-data-table th {
			  font-weight: 600;
			  padding: 0.5em;
			}

			.highcharts-data-table td,
			.highcharts-data-table th,
			.highcharts-data-table caption {
			  padding: 0.5em;
			}

			.highcharts-data-table thead tr,
			.highcharts-data-table tr:nth-child(even) {
			  background: #f8f8f8;
			}

			.highcharts-data-table tr:hover {
			  background: #f1f7ff;
			}

			.highcharts-credits {
			display: none !important;
			}

			.highcharts-background{
				fill:#ffffff
			}
			
			/*
			#childParentDiv{width:1500px; height:840px;overflow:hidden;}
			#childParentDiv img{transform:scale(1,1);transition: all 1s ease-out;}
			#childParentDiv img:hover{transform:scale(1.2,1.2);}
			*/
			
			body {
			  overflow-y: hidden; /* Hide vertical scrollbar */
			  overflow-x: hidden; /* Hide horizontal scrollbar */
			}
		
		
		</style>
		
	</head>
	<body>
		<div id="info">
			<!--<a href="https://threejs.org" target="_blank" rel="noopener">three.js</a> collada loader - kinematics<br/>
			robot from <a href="https://github.com/rdiankov/collada_robots" target="_blank" rel="noopener">collada robots</a>-->
			<img  width="100%" height="100" src="textures/windLabel.png" alt="" />
			
			<!--<iframe src="http://192.168.2.182/pages/hmi/" id="sbIframe" style="height:100%;width:11%;position:absolute;top:400%;left:28%;display:none" />-->
		</div>
		
		
		
		
		
		
		<div id="agvDiv" style="display:none">
			
			<!--right<img src="textures/a01_1.png" style="width:25px;height:70px;position:absolute;top:55%;left:87%;" alt="" />-->
			<!--right<div id="info" style='background-color: #008080;width:300px;height:290px;position:absolute;top:24%;left:80%;text-align:left'>-->
			<div id="info" class="agvClass" style='background-color: #008080;width:300px;height:290px;position:absolute;top:24%;left:10%;text-align:left'>
			
				<label><font size="6" id="agvStatus">運轉狀態：……</font></label><br>
				<label><font size="6" id="agvStep">Step：……</font></label><br>
				<label><font size="6" id="agvCvMode">CV Mode：……</font></label><br>
				<label><font size="6" id="agvError">Error code：……</font></label><br>
				<label><font size="6" id="agvLink">連線狀態：……</font></label><br>
				<label><font size="6" id="agvSoc">電量：……</font></label><br>
				<label><font size="6" id="agvV">電壓：……</font></label><br>
				<label><font size="6" id="agvI">電流：……</font></label><br>
				<label><font size="6" id="agvT1">溫度1：……</font></label><br>
				<label><font size="6" id="agvT2">溫度2：……</font></label><br>
			</div>
		</div>
		<!--<button  style="width:300px;height:290px;position:absolute;top:63%;left:79%;background-color: transparent;border-width:0px;outline:none; " type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> </button>-->
		<!--<button id="agvButton" style="width:300px;height:290px;position:absolute;top:63%;left:79%; " type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> </button>-->
		<div style="position:absolute;top:78%;left:21%;background-color: #3C3C3C;width:1100px;height:180px;padding:10px;opacity:0.5;display:none"></div>
		
		<table style="position:absolute;top:81%;left:23%;border:3px #9D9D9D solid;padding:5px;display:none" rules="all" cellpadding='5'>
			<thead style='background-color: #3C3C3C;'>
				<tr>
					<th align="center" valign="center"><font size="6" color="#BEBEBE">項目</font></th>
					<th align="center" valign="center"><font size="6" color="#BEBEBE">數據</font></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="300px" align="center" valign="center"><font size="5" color="#BEBEBE">Move數</font></td>
					<td width="700px" align="center" valign="center"><font size="5" color="#FFFFFF">5次</font></td>
				</tr>
				<tr>
					<td width="150px" align="center" valign="center"><font size="5" color="#BEBEBE">稼動率</font></td>
					<td width="550px" align="center" valign="center"><font size="5" color="#FFFFFF">50%</font></td>
				</tr>
				<tr>
					<td width="150px" align="center" valign="center"><font size="5" color="#BEBEBE">Tact Time</font></td>
					<td width="550px" align="center" valign="center"><font size="5" color="#FFFFFF">51 Sec</font></td>
				</tr>
			</tbody>
		</table>
		<button style="border:none;background-color: #008080;display:none" id="vibrationSimulation"><font size="4" color="#FFFFFF">振動模擬</font></button>
		
		<div style="position:absolute;top:0%;left:65%;display:none">
			<button style="border:none;background-color: #008080;" id="childPareButton" value="顯示電子圍籬"><font size="4" color="#FFFFFF">電子圍籬</font></button>
			<button style="border:none;background-color: #008080;" id="rollback"><font size="4" color="#FFFFFF">復原3D場域</font></button>
			<button style="border:none;background-color: #008080;" id="electricity" value="隱藏用電資訊"><font size="4" color="#FFFFFF">用電資訊</font></button>
			<!--<button style="border:none;background-color: #008080;" id="agvButton"><font size="4" color="#FFFFFF">AMR資訊</font></button>-->
			<button style="border:none;background-color: #008080;" id="SBButton"><font size="4" color="#FFFFFF">第三站資訊</font></button>
			<button style="border:none;background-color: #008080;" id="TMButton"><font size="4" color="#FFFFFF">第二站資訊</font></button>
			<button style="border:none;background-color: #008080;" id="FCButton"><font size="4" color="#FFFFFF">第一站資訊</font></button>
			
		</div>
		
		<!--<div style=''>
			<table style="position:absolute;top:82%;left:25%;border:3px #00FFFF solid;padding:5px;" rules="all" cellpadding='5'>
				<thead style='background-color: #008080;'>
					<tr>
						<th><font size="6">項目</font></th>
						<th><font size="6">數據</font></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="350px" align="center" valign="center"><font size="5">Move數</font></td>
						<td width="650px" align="center" valign="center"><font size="5">5</font></td>
					</tr>
					<tr>
						<td width="150px" align="center" valign="center"><font size="5">稼動率</font></td>
						<td width="550px" align="center" valign="center"><font size="5">50%</font></td>
					</tr>
					<tr>
						<td width="150px" align="center" valign="center"><font size="5">Tact Time</font></td>
						<td width="550px" align="center" valign="center"><font size="5">51 Sec</font></td>
					</tr>
				</tbody>
			</table>
		</div>-->

		
		
		<figure class="highcharts-figure" style="position:absolute;top:50px;left:72%;width: 25%;" >
			<div id="container" style='display:none'></div>
		</figure>
		
		
		
		<div id="childParent" style='display:none'>

			<div id="childParentDiv" class="childParentMin" style='background-color: #008080;width:600px;height:600px;position:absolute;top:7%;left:71%;text-align:left'>
			<!--<div id="childParentDiv" class="childPareMin" style='background-color: #008080;width:1500px;height:840px;position:absolute;top:7%;left:10%;text-align:left'>-->
				<!--<iframe src="http://192.168.2.114:5000/" style="height:100%;width:100%">
				  你的瀏覽器不支援 iframe
				</iframe>
				-->
				<a href="#" id="childParentLink">
					
					<!--<img src="http://192.168.2.5:5000/" id="childParentImg" style="width:100%;height:100%;" alt="" />-->
				</a>
				<!--<img src="http://192.168.2.114:5000/" id="agvData" style="width:250px;height:250px;position:absolute;top:7%;left:84%;" alt="" />-->
			</div>
		</div>
		
		
		


		<script type="module">
		
			/*待辦
			1. 速度
			2. 乾燥包有無偵測
			3. cv異常顯示
			4. SB視覺顯示
			5. 異常模擬按鈕 70% 
			*/
			

			//import * as THREE from '../build/three.module.js';
			//import * as THREEx from '../build/threex.domevents.js';
			
			
			
			
			
			
			
			
			$(document).on("click", "#agvButton", function() {
			
				if($("#agvDiv").attr("style")=="display:none"){
					$("#agvDiv").attr("style","");
				}else{
					$("#agvDiv").attr("style","display:none");
				}
				
			});
			
			$(document).on("click", "#childParentLink", function() {
			
				if($("#childParentDiv").attr("class")=="childParentMin"){
					$("#childParentDiv").attr("style","background-color: #008080;width:1500px;height:840px;position:absolute;top:7%;left:10%;text-align:left;");
					$("#childParentDiv").attr("class","childParentMax");
					//$("#childParentImg").attr("style","transform:scale(1,1);transition: all 1s ease-out;");
				}else{
					$("#childParentDiv").attr("style","background-color: #008080;width:400px;height:500px;position:absolute;top:7%;left:78%;text-align:left");
					$("#childParentDiv").attr("class","childParentMin");
				}
				
			});
			
			//queryDownBoxData();


			
			import * as THREE from '../build/three.module.js';
			import {
				WebGLRenderer,
				PerspectiveCamera,
				Scene,
				Mesh,
				PlaneBufferGeometry,
				ShadowMaterial,
				DirectionalLight,
				PCFSoftShadowMap,
				sRGBEncoding,
				Color,
				AmbientLight,
				Box3,
				LoadingManager,
				MathUtils,
			} from '../build/three.module.js';

			import Stats from './jsm/libs/stats.module.js';

			import { TWEEN } from './jsm/libs/tween.module.min.js';
			import { ColladaLoader } from './jsm/loaders/ColladaLoader.js';
			import { OrbitControls } from './jsm/controls/OrbitControls.js';
			//import { OBJLoader } from './jsm/loaders/OBJLoader.js';
			import { STLLoader } from './jsm/loaders/STLLoader.js';
			
			import URDFLoader from './jsm/loaders/URDFLoader.js';
			import {PCDLoader } from './jsm/loaders/PCDLoader.js';

			let container, stats;

			var camera, scene, renderer,grid;
			let particleLight;
			const pcdLoader = new PCDLoader();
			let points1;
			let points2;
			const pointCloudMaterial = new THREE.PointsMaterial({
            size: 0.02,
            vertexColors :true,
            opacity: 0.4,
            depthWrite: false,
            transparent: true,
        });
        const pointCloudMaterial_Red = new THREE.PointsMaterial({
            size: 0.2,
            color: 0xff0000,
            opacity: 0.5,
            transparent: true,
            
        });
			//***************Robot***************
			//第一站
			let FCRobot;
			//第二站
			let TMRobot;
			//第三站
			let SBRobot;
			//**********************************
			var FCBoxDown;
			var TMBoxDown;
			var SBBoxDown;
			var AGVBoxDown;
			
			let TMFinger;
			
			
			let kinematicsTween; 
			const tweenParameters01 = {};
			const tweenParameters02 = {};
			const tweenParameters021 = {};
			const tweenParameters03 = {};
			const tweenParameters04 = {};
			
			var readSymbolValuesSize = 0;

			let object;
			var controls;
			
			var FancLinkChild;
			var SBChild;
			var TMLinkChild;
			
			const targetValue = {};
			const SBTargetValue = {};
			const targetValue4 = {};
			let mesh = new THREE.Mesh();
			var isBoxUpFinish = "true";
			var downBoxLastPt01 = 0;
			var downBoxLastPt02 = 0;
			var downBoxLastPt03 = 0;

			//***************手臂***************
			//第一站
			var FCFinger;
			var FCSponge;
			
			//第三站
			var SBSponge;
			var SBSco;
			//**********************************
			
			//***************上蓋***************
			//第一站
			var boxUpDown01;
			var boxUpFinger01;
			var boxUpCv01;
			//第二站
			var boxUpFinger02;
			var boxUpCv02;
			//第三站
			var boxUpFinger03;
			var boxUpDown03;
			
			var AGVboxUpDown;
			//**********************************
			
			//***************乾燥包***************
			//第一站乾燥包
			var nozzleDry;
			var tmDry;
			var sbDry;
			var tmBoxDry;
			var sbBoxDry;
			
			//第三站
			var SBSbser;
			//**********************************
			
			var powerAGV;
			var whiteAGV;
			
			var isFCSuckUpBox = false;
			
			var entryIndex = 0;
			var FCIsNew = "false";
			var entrySBIndex = 0;
			var TMIsNew = "false";
			var lastFCBoxPosit=0;
			var lastTMBoxPosit = 0;
			
			var agvBoxIndex = 0;
			
			var cvModeStatus3 = "";
			
			var plane01;
			
			var FCSpeed			= "";
			var TMSpeed 		= "";
			var SBSpeed 		= "";
			
			var fcDownBoxStatus   	= 1;
			var fcDownBoxPosit   	= 0;
			var tmDownBoxPosit   	= 0;
			var sbDownBoxStatus   	= 0;
			var sbDownBoxPosit   	= 0;
			var agvDownBoxPosit		= 0;
			var bVisable = false;
			
			var agvUpTime = 0;
			var agvDownTime = 0;
			
			var xyArray = [];
			var tagIndex = 1;
			
			
			
			
			//getXYData();
			
			init();
			
			
			
			//*********************WebService Start****************************
			
			var NETID = "172.18.235.203.1.1"; // Empty string for local machine;
			//var NETID = "169.254.235.176.1.1"; // Empty string for local machine;
            var PORT = "851"; // PLC Runtime
            var SERVICE_URL = "http://192.168.100.180:8090/TcAdsWebService/TcAdsWebService.dll"; // HTTP path to the TcAdsWebService;


            var client = new TcAdsWebService.Client(SERVICE_URL, null, null);

            var general_timeout = 100;

            var readLoopID = null;
            var readLoopDelay = 100;

            var readSymbolValuesData = null;

            // Array of symbol names to read;
            var handlesVarNames = [];
			var handles=[];

			for (var i = 1052; i <= 1063; i++) {
				handlesVarNames.push("GVL.mb_Output_Registers[" + i + "]");
			}

			for (var i = 3052; i <= 3063; i++) {
				handlesVarNames.push("GVL.mb_Output_Registers[" + i + "]");
			}
			
			for (var i = 5052; i <= 5063; i++) {
				handlesVarNames.push("GVL.mb_Output_Registers[" + i + "]");
			}
			
			//第一站換夾
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1023 + "]");//36
			
			//第二站換夾
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3022 + "]");//37
			
			//第一站海綿吸盤吸上蓋box
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1032 + "]");//38
			
			//第二站海綿吸盤吸上蓋box
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3032 + "]");//39
			
			//第三站海綿吸盤吸上蓋box
			handlesVarNames.push("GVL.mb_Output_Registers[" + 4032 + "]");//40
			
			//第一站上蓋box上架
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1329 + "]");//41
			
			//第二站上蓋box上架
			handlesVarNames.push("GVL.mb_Output_Registers[" + 5329 + "]");//42
			
			//第一站輸送帶位置
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1326 + "]");//43
			
			//第一站吸乾躁包
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1031 + "]");//44
			
			//第一站放sbser
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1327 + "]");//45
			
			//第二站輸送帶位置
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3326 + "]");//46
			
			handlesVarNames.push("Robot_OPCUA.motorWinding1_temp");//47
			
			//第三站換夾
			handlesVarNames.push("GVL.mb_Output_Registers[" + 4023 + "]");//48
			
			//第三站吸sbser
			handlesVarNames.push("GVL.mb_Output_Registers[" + 4031 + "]");//49
			
			//第三站輸送帶位置
			handlesVarNames.push("GVL.mb_Output_Registers[" + 5326 + "]");//50
			
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1200 + "]");//51
			
			//AGV上轉動
			handlesVarNames.push("GVL.mb_Output_Registers[" + 610 + "]");//52
			
			
			
			
			//第一站狀態
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1000 + "]");//53
			//第一站流程STEP
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1026 + "]");//54			
			//第一站CV Mode
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1200 + "]");//55
			//第一站Error code
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1002 + "]");//56
			//第一站連線狀態
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1302 + "]");//57
			//第一站robot speed
			handlesVarNames.push("GVL.mb_Output_Registers[" + 1004 + "]");//58
			
			
			//第二站狀態
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3000 + "]");//59
			//第二站流程STEP
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3023 + "]");//60
			//第二站CV Mode
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3200 + "]");//61
			//第二站Error code
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3002 + "]");//62
			//第二站連線狀態
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3302 + "]");//63
			//第二站robot speed
			handlesVarNames.push("GVL.mb_Output_Registers[" + 3004 + "]");//64
			

			//第三站狀態
			handlesVarNames.push("GVL.mb_Output_Registers[" + 4000 + "]");//65
			//第三站流程STEP
			handlesVarNames.push("GVL.mb_Output_Registers[" + 4024 + "]");//66
			//第三站CV Mode
			handlesVarNames.push("GVL.mb_Output_Registers[" + 5200 + "]");//67
			//第三站Error code
			handlesVarNames.push("GVL.mb_Output_Registers[" + 4002 + "]");//68
			//第三站連線狀態
			handlesVarNames.push("GVL.mb_Output_Registers[" + 5302 + "]");//69
			//第三站robot speed
			handlesVarNames.push("GVL.mb_Output_Registers[" + 4004 + "]");//70
			
			
			
			
			//AGV運轉狀態
			handlesVarNames.push("GVL.mb_Output_Registers[" + 620 + "]");//71
			//AGV流程STEP
			handlesVarNames.push("GVL.mb_Output_Registers[" + 621 + "]");//72
			//AGV CV Mode
			handlesVarNames.push("GVL.mb_Output_Registers[" + 622 + "]");//73
			//AGV Error code
			handlesVarNames.push("GVL.mb_Output_Registers[" + 623 + "]");//74
			//AGV電壓
			handlesVarNames.push("GVL.mb_Output_Registers[" + 624 + "]");//75
			//AGV電量
			handlesVarNames.push("GVL.mb_Output_Registers[" + 625 + "]");//76
			//AGV電流
			handlesVarNames.push("GVL.mb_Output_Registers[" + 626 + "]");//77
			//AGV溫度1
			handlesVarNames.push("GVL.mb_Output_Registers[" + 627 + "]");//78
			//AGV溫度2
			handlesVarNames.push("GVL.mb_Output_Registers[" + 628 + "]");//79
			//AGV連線狀態
			handlesVarNames.push("GVL.mb_Output_Registers[" + 629 + "]");//80
			
			
			handlesVarNames.push("PLC3.bVibrationLevel");//81
			//handlesVarNames.push("PLC3.i2.x");
			handlesVarNames.push("PLC3.bVisable");//82
			
			
			//handlesVarNames.push("GVL.mb_Output_Registers[" + 5098 + "]");//81
			
			
				
			loadTwinCat();
				
			function loadTwinCat(){
				 // Occurs if the window has loaded;
				window.onload = (function () {

					// Create sumcommando for reading twincat symbol handles by symbol name;
					var handleswriter = new TcAdsWebService.DataWriter();

					// Write general information for each symbol handle to the TcAdsWebService.DataWriter object;
					for (var i = 0; i < handlesVarNames.length; i++) {
						handleswriter.writeDINT(TcAdsWebService.TcAdsReservedIndexGroups.SymbolHandleByName);
						handleswriter.writeDINT(0);
						handleswriter.writeDINT(4); // Expected size; A handle has a size of 4 byte;
						handleswriter.writeDINT(handlesVarNames[i].length); // The length of the symbol name string;
					}

					// Write symbol names after the general information to the TcAdsWebService.DataWriter object;
					for (var i = 0; i < handlesVarNames.length; i++) {
						handleswriter.writeString(handlesVarNames[i]);
					}

					// Send the list-read-write command to the TcAdsWebService by use of the readwrite function of the TcAdsWebService.Client object;
					client.readwrite(
						NETID,
						PORT,
						0xF082, 	// IndexGroup = ADS list-read-write command; Used to request handles for twincat symbols;
						handlesVarNames.length, // IndexOffset = Count of requested symbol handles;
						(handlesVarNames.length * 4) + (handlesVarNames.length * 8), // Length of requested data + 4 byte errorcode and 4 byte length per twincat symbol;
						handleswriter.getBase64EncodedData(),
						RequestHandlesCallback,
						null,
						general_timeout,
						RequestHandlesTimeoutCallback,
						true);
						

				});
			}
			
			 // Occurs if the readwrite for the sumcommando has finished;
            var RequestHandlesCallback = (function (e, s) {
			
			

                if (e && e.isBusy) {
                    // HANDLE PROGRESS TASKS HERE;
                   var message = "Requesting handles...";
                    td_TMAxis1Value.innerHTML = message;
                    td_TMAxis2Value.innerHTML = message;
                    td_TMAxis3Value.innerHTML = message;
                    td_TMAxis4Value.innerHTML = message;
                    td_TMAxis5Value.innerHTML = message;
                    td_TMAxis6Value.innerHTML = message;
                    td_FCAxis1Value.innerHTML = message;
					td_FCAxis2Value.innerHTML = message;
					td_FCAxis3Value.innerHTML = message;
					td_FCAxis4Value.innerHTML = message;
					td_FCAxis5Value.innerHTML = message;
					td_FCAxis6Value.innerHTML = message;
					td_SBAxis1Value.innerHTML = message;
					td_SBAxis2Value.innerHTML = message;
					td_SBAxis3Value.innerHTML = message;
					td_SBAxis4Value.innerHTML = message;
					td_SBAxis5Value.innerHTML = message;
					td_SBAxis6Value.innerHTML = message;
                    // Exit callback function because request is still busy;
                    return;
                }
				

                if (e && !e.hasError) {

                    // Get TcAdsWebService.DataReader object from TcAdsWebService.Response object;
                    var reader = e.reader;

                    // Read error code and length for each handle;
                    for (var i = 0; i < handlesVarNames.length; i++) {

                        var err = reader.readDWORD();
                        var len = reader.readDWORD();
						
                        if (err != 0) {
                            //div_log.innerHTML = "Handle error!";
                            return;
                        }

                    }
					
                    // Read handles from TcAdsWebService.DataReader object;
                    handles = new Array(handlesVarNames.length);
					
					for (var i = 0; i < handles.length; i++) {
						handles[i] = reader.readDWORD();;
					}

                    // Create sum commando to read symbol values based on the handle
                    var readSymbolValuesWriter = new TcAdsWebService.DataWriter();
					
					readSymbolValuesSize = 0;
                    for (var i = 0; i < handles.length; i++) {
                    //  "MAIN.dwordValue" // DWORD
						readSymbolValuesWriter.writeDINT(TcAdsWebService.TcAdsReservedIndexGroups.SymbolValueByHandle); // IndexGroup
						readSymbolValuesWriter.writeDINT(handles[i]); // IndexOffset = The target handle
						//readSymbolValuesWriter.writeDINT(2); // size to read init
						
						//"Robot_OPCUA.motorWinding1_temp"
						if(i==47){
							readSymbolValuesWriter.writeDINT(4); // size to read init
							readSymbolValuesSize = readSymbolValuesSize + 4;
						//"PLC3.bVibrationLevel"
						}else if(i==81 || i==82){
							readSymbolValuesWriter.writeDINT(1); // size to read init
							readSymbolValuesSize = readSymbolValuesSize + 1;
						}else{
							readSymbolValuesWriter.writeDINT(2); // size to read init
							readSymbolValuesSize = readSymbolValuesSize + 2;
						}
					}
				
                    // Get Base64 encoded data from TcAdsWebService.DataWriter;
                    readSymbolValuesData = readSymbolValuesWriter.getBase64EncodedData();
                    // Start cyclic reading of symbol values;
                    readLoopID = window.setInterval(ReadLoop, readLoopDelay);

                } else {

                    if (e.error.getTypeString() == "TcAdsWebService.ResquestError") {
                        // HANDLE TcAdsWebService.ResquestError HERE;
                        //div_log.innerHTML = "Error: StatusText = " + e.error.statusText + " Status: " + e.error.status;
                    }
                    else if (e.error.getTypeString() == "TcAdsWebService.Error") {
                        // HANDLE TcAdsWebService.Error HERE;
                        //div_log.innerHTML = "01Error: ErrorMessage = " + e.error.errorMessage + " ErrorCode: " + e.error.errorCode;
                    }

                }

            });
			
			// Occurs if the readwrite for the sumcommando to request symbol handles runs into timeout;
            var RequestHandlesTimeoutCallback = (function () {
                // HANDLE TIMEOUT HERE;
                //div_log.innerHTML = "Requuest handles timeout!";
            });
			
			function ReadLoop(){
				 client.readwrite(
                    NETID,
                    PORT,
                    0xF080, // 0xF080 = Read command;
                    handlesVarNames.length, // IndexOffset = Variables count;
                    readSymbolValuesSize + (handlesVarNames.length * 4),
					//(handlesVarNames.length * 2) + (handlesVarNames.length * 4),
                    readSymbolValuesData,
                    ReadCallback,
                    null,
                    general_timeout,
                    ReadTimeoutCallback,
                    true);
			}

            // Interval callback for cyclic reading;
			/*
            var ReadLoop = (function () {

                // Send the read-read-write command to the TcAdsWebService by use of the readwrite function of the TcAdsWebService.Client object;
                client.readwrite(
                    NETID,
                    PORT,
                    0xF080, // 0xF080 = Read command;
                    8, // IndexOffset = Variables count;
                    26 + (8 * 4), // Length of requested data + 4 byte errorcode per variable;
                    readSymbolValuesData,
                    ReadCallback,
                    null,
                    general_timeout,
                    ReadTimeoutCallback,
                    true);

            });
			*/

            // Occurs if the read-read-write command has finished;
            var ReadCallback = (function (e, s) {

                if (e && e.isBusy) {
                    // HANDLE PROGRESS TASKS HERE;
                    // Exit callback function because request is still busy;
                    return;
                }

                if (e && !e.hasError) {

                    var reader = e.reader;
                    
                    // Read error codes from begin of TcAdsWebService.DataReader object;
                    for (var i = 0; i < handlesVarNames.length; i++) {
                        var err = reader.readDWORD();
                        if (err != 0) {
                            //div_log.innerHTML = "Symbol error!";
                            return;
                        }
                    }

                    var myArray = new Array(handlesVarNames.length);
					for (var i = 0; i < myArray.length; i++) {
						//myArray[i] = reader.readWORD();;
						
						//"Robot_OPCUA.motorWinding1_temp"
						if(i==47){
							myArray[i] = reader.readREAL();
						//"PLC3.bVibrationLevel"
						}else if(i==81 || i==82){
							myArray[i] = reader.readBOOL();
						}else{
							myArray[i] = reader.readWORD();;
						}
					}
					
					var start_idx=0;// 0 12 24
					var FCAxis1Value = wordToFloat32(myArray[start_idx+0], myArray[start_idx+1]);
                    var FCAxis2Value = wordToFloat32(myArray[start_idx+2], myArray[start_idx+3]);
                    var FCAxis3Value = wordToFloat32(myArray[start_idx+4], myArray[start_idx+5]);
                    var FCAxis4Value = wordToFloat32(myArray[start_idx+6], myArray[start_idx+7]);
                    var FCAxis5Value = wordToFloat32(myArray[start_idx+8], myArray[start_idx+9]);
                    var FCAxis6Value = wordToFloat32(myArray[start_idx+10], myArray[start_idx+11]);
					
					
					start_idx=12;// 0 12 24
					var TMAxis1Value = wordToFloat32(myArray[start_idx+0], myArray[start_idx+1]);
                    var TMAxis2Value = wordToFloat32(myArray[start_idx+2], myArray[start_idx+3]);
                    var TMAxis3Value = wordToFloat32(myArray[start_idx+4], myArray[start_idx+5]);
                    var TMAxis4Value = wordToFloat32(myArray[start_idx+6], myArray[start_idx+7]);
                    var TMAxis5Value = wordToFloat32(myArray[start_idx+8], myArray[start_idx+9]);
                    var TMAxis6Value = wordToFloat32(myArray[start_idx+10], myArray[start_idx+11]);
					
					
					start_idx=24;// 0 12 24
					var SBAxis1Value = wordToFloat32(myArray[start_idx+0], myArray[start_idx+1]);
                    var SBAxis2Value = wordToFloat32(myArray[start_idx+2], myArray[start_idx+3]);
                    var SBAxis3Value = wordToFloat32(myArray[start_idx+4], myArray[start_idx+5]);
                    var SBAxis4Value = wordToFloat32(myArray[start_idx+6], myArray[start_idx+7]);
                    var SBAxis5Value = wordToFloat32(myArray[start_idx+8], myArray[start_idx+9]);
                    var SBAxis6Value = wordToFloat32(myArray[start_idx+10], myArray[start_idx+11]);
					
					var FCGripValue 	= myArray[36];
					var TMGripValue 	= myArray[37];//0吸盤;1/2風刀;3 3秒後放乾燥包;4吸乾燥包
					var FCSucker 		= myArray[38];
					var TMSucker 		= myArray[39];//1吸;0放
					var SBSucker 		= myArray[40];
					var FCUpBoxPed 		= myArray[41];
					var TMUpBoxPed 		= myArray[42];
					var FCBoxCvPosit 	= myArray[43];
					var FCDesiccant	 	= myArray[44];
					var FCDesiccantPed 	= myArray[45];
					var TMBoxCvPosit 	= myArray[46];
					var SBGripValue 	= myArray[48];
					var SBSbser 		= myArray[49];
					var SBBoxCvPosit 	= myArray[50];
					var FCCvClip		= myArray[51];
					var AGVFlow			= myArray[52];
					var FCStatus		= myArray[53];
					var TMStatus		= myArray[54];
					var SBStatus		= myArray[55];
					FCSpeed				= myArray[58];
					TMSpeed 			= myArray[64];
					SBSpeed 			= myArray[70];
					bVisable 			= myArray[82];
					//var FCStatus		= myArray[55];
					
					//第一站狀態轉換
					var dec = parseInt(FCStatus);  
					var bin = dec.toString(2); 
					var arr = Array.from(bin);
					var status1 = "";
					
					if(arr[0]=="1"){
						status1 = "Run";
					}else if(myArray[56]=!"0"){
						status1 = "Down";
					}else{
						status1 = "Idle";
					}
					
					//第二站狀態轉換
					var dec2 = parseInt(myArray[59]);  
					var bin2 = dec2.toString(2); 
					var arr2 = Array.from(bin2);
					var status2 = "";
					if(arr2.length>=5){
						if(arr2[0]=="1"){
							status2 = "Run";
						}
					}else if(arr2.length<=4){
						if(myArray[62]=!"0"){
							status2 = "Down";
						}else{
							status2 = "Idle";
						}
					}
					
					
					//第三站狀態轉換
					var dec3 = parseInt(myArray[65]);  
					var bin3 = dec3.toString(2); 
					var arr3 = Array.from(bin3);
					var status3 = "";
					if(arr3[4]=="1"){
						status3 = "Run";
					}else if(myArray[68]=!"0"){
						status3 = "Down";
					}else{
						status3 = "Idle";
					}
					
					
					
					
					//第一站CV Mode轉換
					var cvMode1 = parseInt(myArray[55]);  
					var cvModeBin1 = cvMode1.toString(2); 
					var cvModeArr1 = Array.from(cvModeBin1);
					var cvModeStatus1 = "";
					if(cvModeArr1.length>=5){
						if(cvModeBin1.substr(cvModeBin1.length-4,1)=="1"){
							cvModeStatus1 = "Input";
						}else if(cvModeBin1.substr(cvModeBin1.length-5,1)=="1"){
							cvModeStatus1 = "Out";
						}
					}
					
					//第二站CV Mode轉換
					var cvMode2 = parseInt(myArray[61]);  
					var cvModeBin2 = cvMode2.toString(2); 
					var cvModeArr2 = Array.from(cvModeBin2);
					var cvModeStatus2 = "";
					if(cvModeArr2.length>=5){
						if(cvModeBin2.substr(cvModeBin2.length-4,1)=="1"){
							cvModeStatus2 = "Input";
						}else if(cvModeBin2.substr(cvModeBin2.length-5,1)=="1"){
							cvModeStatus2 = "Out";
						}
					}
					
					//第三站CV Mode轉換
					var cvMode3 = parseInt(myArray[67]);  
					var cvModeBin3 = cvMode3.toString(2); 
					var cvModeArr3 = Array.from(cvModeBin3);
					if(cvModeArr3.length>=5){
						if(cvModeBin3.substr(cvModeBin3.length-4,1)=="1"){
							cvModeStatus3 = "Input";
						}else if(cvModeBin3.substr(cvModeBin3.length-5,1)=="1"){
							cvModeStatus3 = "Out";
						}
					}
					
					$("#FCStatus").html("運轉狀態："+status1);
					$("#FCStep").html("Step："+myArray[54]);
					$("#FCCvMode").html("CV Mode："+cvModeStatus1);
					$("#FCError").html("Error code："+myArray[56]);
					$("#FCLink").html("連線狀態："+myArray[57]);
					$("#FCRobotSpeed").html("Robot Speed："+myArray[58]);
					
					
					$("#TMStatus").html("運轉狀態："+status2);
					$("#TMStep").html("Step："+myArray[60]);
					$("#TMCvMode").html("CV Mode："+cvModeStatus2);
					$("#TMError").html("Error code："+myArray[62]);
					$("#TMLink").html("連線狀態："+myArray[63]);
					$("#TMRobotSpeed").html("Robot Speed："+myArray[64]);
					
					
					$("#SBStatus").html("運轉狀態："+status3);
					$("#SBStep").html("Step："+myArray[66]);
					$("#SBCvMode").html("CV Mode："+cvModeStatus3);
					$("#SBError").html("Error code："+myArray[68]);
					$("#SBLink").html("連線狀態："+myArray[69]);
					$("#SBRobotSpeed").html("Robot Speed："+myArray[70]);
					if(bVisable==false){
						$("#electricity").attr("value","隱藏用電資訊");
					}else{
						$("#electricity").attr("value","顯示用電資訊");
					}
					
					var agvStatus = "";
					if(myArray[71]=="1"){
						agvStatus = "待機";
					}else if(myArray[71]=="2"){
						agvStatus = "出料";
					}else if(myArray[71]=="3"){
						agvStatus = "入料";
					}else if(myArray[71]=="4"){
						agvStatus = "充電";
					}
					
					var agvCvMode = "";
					if(myArray[73]=="0"){
						agvCvMode = "停機";
					}else if(myArray[73]=="1"){
						agvCvMode = "運轉";
					}
					
					var newI = 0;
					if(myArray[77]>=30000){
						newI = parseInt(myArray[77])-65535;
					}else{
						newI = myArray[77];
					}
					
					$("#agvStatus").html("運轉狀態："+agvStatus);
					$("#agvStep").html("Step："+myArray[72]);
					$("#agvCvMode").html("CV Mode："+agvCvMode);
					$("#agvError").html("Error code："+myArray[74]);
					$("#agvLink").html("連線狀態："+myArray[80]);
					$("#agvSoc").html("電量："+myArray[76]+"%");
					$("#agvV").html("電壓："+myArray[75]/100+"V");
					if(newI<0){
						$("#agvI").html("放電電流："+Math.abs(newI/10)+"I");
					}else{
						$("#agvI").html("充電電流："+Math.abs(newI/10)+"I");
					}
					
					$("#agvT1").html("溫度1："+myArray[78]+"℃");
					$("#agvT2").html("溫度2："+myArray[79]+"℃");
					
				
					//第一站Fanuc
					targetValue["joint_1"] = FCAxis1Value * Math.PI/180;
					targetValue["joint_2"] = FCAxis2Value * Math.PI/180;
					FCAxis3Value=FCAxis3Value+FCAxis2Value;
					targetValue["joint_3"] = ((FCAxis3Value)) * Math.PI/180;
					targetValue["joint_4"] = FCAxis4Value * Math.PI/180;
					targetValue["joint_5"] = (FCAxis5Value) * Math.PI/180;
					targetValue["joint_6"] = (FCAxis6Value) * Math.PI/180;
					targetValue["FCGrip"] = FCGripValue;
					targetValue["FCSucker"] = FCSucker;
					targetValue["FCUpBoxPed"] = FCUpBoxPed;
					//targetValue["FCBoxCvPosit"] = 56;
					targetValue["FCBoxCvPosit"] = FCBoxCvPosit;
					targetValue["FCDesiccant"] = FCDesiccant;
					targetValue["FCDesiccantPed"] = FCDesiccantPed;
					targetValue["FCCvClip"] = FCCvClip;
					//targetValue["AGVFlow"] = AGVFlow;
					
					//第一站吸嘴
					//targetValue["joint_1"] = -0.111;
					//targetValue["joint_2"] = 0.224;
					//targetValue["joint_3"] = -0.279;
					//targetValue["joint_4"] = 0.001;
					//targetValue["joint_5"] = -1.058;
					//targetValue["joint_6"] = 1.299;
					
					//第二站TM
					targetValue["j1"] = (TMAxis1Value) * Math.PI/180;
					targetValue["j2"] = -TMAxis2Value * Math.PI/180;
					targetValue["j3"] = -TMAxis3Value * Math.PI/180;
					targetValue["j4"] = TMAxis4Value * Math.PI/180;
					targetValue["j5"] = (TMAxis5Value+180) * Math.PI/180;
					targetValue["j6"] = -(TMAxis6Value) * Math.PI/180;
					//targetValue["j6"] = (TMAxis6Value-90) * Math.PI/180;
					
					if(TMGripValue==1 || TMGripValue==2){
						targetValue["Link_joint2"] = 0;
						//if(TMGripValue==1){
							//targetValue["Link_joint2"] = 0;
						//}else if(TMGripValue==2){
							//targetValue["Link_joint2"] = Math.PI;
						//}
					}else if(TMGripValue==0 || TMGripValue==4){
						targetValue["Link_joint2"] = -1.5;
					}
					targetValue["TMGripValue"] = TMGripValue;
					
					
					/*targetValue["j1"] = 1.862;
					targetValue["j2"] = -0.274;
					targetValue["j3"] = -1.657;
					targetValue["j4"] = -0.355;
					targetValue["j5"] = 4.704;
					targetValue["j6"] = -1.862;
					*/
					
					
					
					targetValue["Link_joint1"] = 0;
					targetValue["Link_joint3"] = 0;
					targetValue["Link_joint4"] = 0;
					targetValue["camera_joint"] = 0;
					targetValue["sucker_joint"] = 0;
					targetValue["wind_knife_joint"] = 0;
					targetValue["TMSucker"] = TMSucker;
					targetValue["TMUpBoxPed"] = TMUpBoxPed;
					targetValue["TMBoxCvPosit"] = TMBoxCvPosit;
					
					if(targetValue["TMSucker"]==1 && (targetValue["TMGripValue"]!=2 || targetValue["TMGripValue"]!=4 || targetValue["TMGripValue"]!=3)){
						//console.log("第二站吸上蓋！"+targetValue["j1"]+"====="+targetValue["j2"]+"==="+targetValue["j3"]+"======"+targetValue["j4"]+"========="+targetValue["j5"]+"======"+targetValue["j6"]);
					}
					
					
					
					//第三站SB
					SBTargetValue["joint_1"] = (SBAxis1Value) * Math.PI/180;
					SBTargetValue["joint_2"] = SBAxis2Value * Math.PI/180;
					SBTargetValue["joint_3"] = SBAxis3Value * Math.PI/180;
					SBTargetValue["joint_4"] = SBAxis4Value * Math.PI/180;
					SBTargetValue["joint_5"] = SBAxis5Value * Math.PI/180;
					//SBTargetValue["joint_6"] = (SBAxis6Value) * Math.PI/180;
					SBTargetValue["joint_6"] = (SBAxis6Value-23.5) * Math.PI/180;
					
					//第三站吸上蓋============-0.2381633337819918==========0.7340377701947252==========0.9320316132801294==========-0.007128518139774674===========1.4819641917903226=============-0.25573929815964686
					//console.log("第三站吸上蓋============"+SBTargetValue["joint_1"]+"=========="+SBTargetValue["joint_2"]+"=========="+SBTargetValue["joint_3"]+"=========="+SBTargetValue["joint_4"]+"==========="+SBTargetValue["joint_5"]+"============="+SBTargetValue["joint_6"]);
					
					//第三站吸上蓋
					//SBTargetValue["joint_1"] = -0.238;
					//SBTargetValue["joint_2"] = 0.734;
					//SBTargetValue["joint_3"] = 0.932;
					//SBTargetValue["joint_4"] = -0.007;
					//SBTargetValue["joint_5"] = 1.481;
					//SBTargetValue["joint_6"] = -0.255;
					
					
					/*
					SBTargetValue["joint_1"] = -0.342;
					SBTargetValue["joint_2"] = -1.003;
					SBTargetValue["joint_3"] = -1.427;
					SBTargetValue["joint_4"] = -3.636;
					SBTargetValue["joint_5"] = 0.635;
					SBTargetValue["joint_6"] = 0.017;
					
					SBTargetValue["joint_1"] = -0.386;
					SBTargetValue["joint_2"] = 0.906;
					SBTargetValue["joint_3"] = 1.134;
					SBTargetValue["joint_4"] = -3.141;
					SBTargetValue["joint_5"] = -1.100;
					SBTargetValue["joint_6"] = 2.744;
					*/
					
					targetValue["SBBoxCvPosit"] = SBBoxCvPosit;
					//targetValue["SBBoxCvPosit"] = 300;
					targetValue["base_link-base"] = 0;
					targetValue["flange-tool0"] = 0;
					targetValue["link_6-flange"] = 0;
	
					SBTargetValue["SBGrip"] = SBGripValue;
					SBTargetValue["SBSucker"] = SBSucker;
					SBTargetValue["SBSbser"] = SBSbser;
					
					setupTween01();
					setupTween02();
					setupTween021();
					setupTween03();
					
					ReloadPowerAGV();
					//updateDownBoxData();
					ReloadWind();
					setupTween04();
					updateVisionImg();

                } else {	

                    if (e.error.getTypeString() == "TcAdsWebService.ResquestError") {
                        // HANDLE TcAdsWebService.ResquestError HERE;
                       // div_log.innerHTML = "Error: StatusText = " + e.error.statusText + " Status: " + e.error.status;
                    }
                    else if (e.error.getTypeString() == "TcAdsWebService.Error") {
                        // HANDLE TcAdsWebService.Error HERE;
                        //div_log.innerHTML = "02Error: ErrorMessage = " + e.error.errorMessage + " ErrorCode: " + e.error.errorCode;
                    }
                }

            });

            // Occurs if the read-read-write command runs into timeout;
            var ReadTimeoutCallback = (function () {
                // HANDLE TIMEOUT HERE;
                //div_log.innerHTML = "Read timeout!";
            });
			
			 $("#electricity").click(function(){
				if($(this).attr("value")=="隱藏用電資訊"){
					buttonSendPlc(true,82);
					$(this).attr("value","顯示用電資訊");
				}else{
					buttonSendPlc(false,82);
					$(this).attr("value","隱藏用電資訊");
					$("#childParent").attr("style","display:none");
					$("#childParentImg").remove();
					$("#childPareButton").attr("value","顯示電子圍籬");
					$("#viewDiv").attr("style","display:none");
					$("#fcDiv").attr("style","display:none");
					$("#tmDiv").attr("style","display:none");
					$("#sbDiv").attr("style","display:none");
				}
			 });
			
			 $("#vibrationSimulation").mousedown(function(){
				buttonSendPlc(true,81);
				$(this).html("振動模擬開始");
			 });
			 
			 $("#vibrationSimulation").mouseup(function(){
				buttonSendPlc(false,81);
				$(this).html("振動模擬");
			 });
			 
			 $("#childPareButton").click(function(){
				if($(this).attr("value")=="顯示電子圍籬"){
					$("#childParent").attr("style","");
					$(this).attr("value","隱藏電子圍籬");
					$("#electricity").attr("value","顯示用電資訊");
					buttonSendPlc(true,82);
					$("#childParentLink").append("<img src='http://192.168.100.188:5000/' id='childParentImg' style='width:100%;height:100%;' alt='' />");
					$("#viewDiv").attr("style","display:none");
					$("#fcDiv").attr("style","display:none");
					$("#tmDiv").attr("style","display:none");
					$("#sbDiv").attr("style","display:none");
				}else{
					$("#childParent").attr("style","display:none");
					$(this).attr("value","顯示電子圍籬");
					$("#electricity").attr("value","隱藏用電資訊");
					$("#childParentImg").remove();
					buttonSendPlc(false,82);
					//$("#childParentLink").remove("<img src='http://192.168.2.5:5000/' id='childParentImg' style='width:100%;height:100%;' alt='' />");
				}
					
			 });
			 
			 $(document).on("click", "#FCVisionButton", function() {

				if($("#FCVisionImg").attr("style")=="display:none"){
					$("#FCVisionImg").attr("style","");
					
				}else{
					$("#FCVisionImg").attr("style","display:none");
				}
				setVisionDiv();
				
			});
			
			
			
			$(document).on("click", "#TMVisionButton", function() {

				if($("#TMVisionImg").attr("style")=="display:none"){
					$("#TMVisionImg").attr("style","");
				}else{
					$("#TMVisionImg").attr("style","display:none");
				}
				setVisionDiv();
				
			});
			
			$(document).on("click", "#SBVisionButton", function() {

				if($("#sbIframe").attr("style")=="display:none"){
					$("#sbIframe").attr("src","http://192.168.100.182/pages/hmi/");
					$("#sbIframe").attr("style","");
				}else{
					$("#sbIframe").attr("style","display:none");
					$("#sbIframe").attr("src","");
				}
				setVisionDiv();
				
			});
			
			
			
			function setVisionDiv(){
				var size = 30;
				var isOpen = false;
				if($("#FCVisionImg").attr("style")==""){
					size = size + 250;
					isOpen = true;
				}
				if($("#TMVisionImg").attr("style")==""){
					size = size + 250;
					isOpen = true;
				}
				if($("#sbIframe").attr("style")==""){
					size = size + 250;
					isOpen = true;
				}
				
				if(isOpen){
					$("#viewDiv").attr("style","width:390px;height:"+size+"px;position:absolute;top:9%;left:83%;text-align:left");
					$("#electricity").attr("value","顯示用電資訊");
					buttonSendPlc(true,82);
					$("#childParent").attr("style","display:none");
					$("#childParentImg").remove();
					$("#childPareButton").attr("value","顯示電子圍籬");
				}else{
					$("#viewDiv").attr("style","width:390px;height:"+size+"px;position:absolute;top:9%;left:83%;text-align:left;display:none");
				}
				
			}
			
			$(document).on("click", "#FCButton", function() {

				if($("#fcDiv").attr("style")=="display:none"){
					$("#fcDiv").attr("style","");
					$("#electricity").attr("value","顯示用電資訊");
					buttonSendPlc(true,82);
					$("#childParent").attr("style","display:none");
					$("#childParentImg").remove();
					$("#childPareButton").attr("value","顯示電子圍籬");
				}else{
					$("#fcDiv").attr("style","display:none");
				}
				
			});
			
			$(document).on("click", "#TMButton", function() {

				if($("#tmDiv").attr("style")=="display:none"){
					$("#tmDiv").attr("style","");
					$("#electricity").attr("value","顯示用電資訊");
					buttonSendPlc(true,82);
					$("#childParent").attr("style","display:none");
					$("#childParentImg").remove();
					$("#childPareButton").attr("value","顯示電子圍籬");
				}else{
					$("#tmDiv").attr("style","display:none");
				}
				
			});
			
			$(document).on("click", "#SBButton", function() {

				if($("#sbDiv").attr("style")=="display:none"){
					$("#sbDiv").attr("style","");
					$("#electricity").attr("value","顯示用電資訊");
					buttonSendPlc(true,82);
					$("#childParent").attr("style","display:none");
					$("#childParentImg").remove();
					$("#childPareButton").attr("value","顯示電子圍籬");
				}else{
					$("#sbDiv").attr("style","display:none");
				}
				
			});
			 
			$(document).on("click", "#rollback", function() {
				location.reload();	
			});
				
				
			 
			 function buttonSendPlc(value,writeIndex){
			 
			 	
				 // Create TcAdsWebService.DataWriter for write-read-write command.
                var writer = new TcAdsWebService.DataWriter();

                // Write general write-read-write commando information to TcAdsWebService.DataWriter object;
                var size = 1;
				
				
               //var myArray = new Array(handlesVarNames.length);
				writer.writeDINT(TcAdsWebService.TcAdsReservedIndexGroups.SymbolValueByHandle);
                writer.writeDINT(handles[writeIndex]);
                writer.writeDINT(size);//大小
				
				writer.writeBOOL(value);
				
                client.readwrite(
                        NETID,
                        PORT,
                        0xF081, // 0xF081 = Call Write SumCommando
                        size, // 變數的個數
                        (size+(size*4)), // Length of requested data + 4 byte errorcode per variable.
                        writer.getBase64EncodedData(),
                        WriteCallback,
                        null,
                        general_timeout,
                        WriteTimeoutCallback,
                        true);
			 }
			

            var WriteCallback = (function(e,s){

                if (e && e.isBusy) {
                    // HANDLE PROGRESS TASKS HERE;
                    var message = "Writing data to plc...";
                   // div_log.innerHTML = message;
                    // Exit callback function because request is still busy;
                    return;
                }

                if (e && !e.hasError) {

                    var message = "Writing data successfully finished...";
                    //div_log.innerHTML = message;

                } else {

                    if (e.error.getTypeString() == "TcAdsWebService.ResquestError") {
                        // HANDLE TcAdsWebService.ResquestError HERE;
                        //div_log.innerHTML = "Error: StatusText = " + e.error.statusText + " Status: " + e.error.status;
                    }
                    else if (e.error.getTypeString() == "TcAdsWebService.Error") {
                        // HANDLE TcAdsWebService.Error HERE;
                        //div_log.innerHTML = "Error: ErrorMessage = " + e.error.errorMessage + " ErrorCode: " + e.error.errorCode;
                    }

                }
            });

            // Occurs if the write-read-write command runs into timeout;
            var WriteTimeoutCallback = (function () {
                // HANDLE TIMEOUT HERE;
                //div_log.innerHTML = "Write timeout!";
            });
				
			
			function wordToFloat32(word1,word2) {
			
				
			
				// 將 4 個字節轉換為一個 32 位的整數
				var bytes=[0, 0, 0, 0];
				bytes[0]=(word1 >> 8) & 0xFF;
				bytes[1]=(word1) & 0xFF;
				bytes[2]=(word2 >> 8) & 0xFF;
				bytes[3]=(word2) & 0xFF;;
				let buf =new Uint8Array(bytes);
				buf.reverse();
				var float32 = new Float32Array(buf.buffer);
				//float32[0] = int32;
				 
				// 返回轉換後的單精度浮點數
				return float32[0];
			}
			//*********************WebService end****************************
			
			function getXYData(){
				//var arrowHelper = new THREE.ArrowHelper(direction, origin, length, 0xff0000); // 参数依次为：向量方向、起点、箭头长度、箭头颜色
				$.post( "ajax/QueryWindMeter100.php",
				function(data){
					console.log(data);
					
					 xyArray = [];
					
					for(var i=1; i<data.length; i++){
						
							var aveAngle = parseInt(data[i][5]);
							var aveSpeed = 5; 
							//var aveSpeed = parseFloat(data[i][6])*100; 
							var aveVerticalAngle = parseFloat(data[i][7])*100; 
							//var aveVerticalAngle = parseInt(totalVerticalAngle/index); 
							
							var radian = aveAngle * Math.PI / 180;//将角度转换为弧度
							var angleRadian = aveVerticalAngle * Math.PI / 180;//将角度转换为弧度
							var x = Math.cos(radian)*aveSpeed;
							//var y = Math.sin(angleRadian);
							var z = Math.sin(radian)*aveSpeed;
							
							
							//var x = aveSpeed * Math.sin(angleRadian) * Math.cos(radian);
							var y = aveSpeed * Math.sin(angleRadian) * Math.sin(radian);
							//var z = aveSpeed * Math.cos(angleRadian);
							
							$("#panel"+tagIndex).attr("style","");
							$("#link"+tagIndex).attr("windAngle",aveAngle);
							$("#link"+tagIndex).attr("elevationAngle",aveVerticalAngle);
							tagIndex++;
							
							console.log("aveAngle====="+aveAngle+"========radian==="+radian+"=======aveSpeed====="+aveSpeed);
							console.log("x====="+x+"========y==="+y+"============"+z);
							
							xyArray.push(new THREE.Vector3(x-5, ((y*5))+3, z+17));
							//xyArray.push(new THREE.Vector3(x-5, (y*5)+3, z+7));
							//xyArray.push(new THREE.Vector3(x-5, y+3, z+7));
							//xyArray.push(new THREE.Vector3((x/20)+5, 0, (z/20)));
						
					}
					console.log("bbbbbbbbbbbbbbbbbbbb");
					
					console.log(xyArray);
				},"json");
			}
			
			
			
			function init() {
			
				container = document.createElement( 'div' );
				document.body.appendChild( container );
				
				window.innerWidth=window.innerWidth;
				window.innerHeight=window.innerHeight;
				
				camera = new THREE.PerspectiveCamera( 35, window.innerWidth / window.innerHeight, 2, 2000 );
				//camera.position.set( 14.589, 2.555, -1.296 );
				camera.position.set( 19.875, 3.424, -0.270 );
				//camera.position.set( 15.38, 2.65, -0.21 );
				//camera.position.set( 23.21, 3.82, -0.06 );

				scene = new THREE.Scene();
				scene.background = new THREE.Color( 0x000000 );
				scene.position.set( 0, 0, -0.5 );
				//console.log(scene.position)
				
				// Grid
				grid = new THREE.GridHelper( 23, 23, 0x888888, 0x444444 );
				grid.position.set( 2.5, -4, 1.3 );
				//scene.add( grid );

				// Add the COLLADA
				particleLight = new THREE.Mesh( new THREE.SphereGeometry( 4, 8, 8 ), new THREE.MeshBasicMaterial( { color: 0xffffff } ) );
				scene.add( particleLight );

				//背景
				

				// Lights
				const light = new THREE.HemisphereLight( 0xffffff, 0x111122 );
				light.position.set( 0,10,0 );
				scene.add( light );

				const pointLight = new THREE.PointLight( 0xffffff, 0.3 );
				particleLight.add( pointLight );

				renderer = new THREE.WebGLRenderer();
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				
				container.appendChild( renderer.domElement );

				stats = new Stats();
				//container.appendChild( stats.dom );

				controls = new OrbitControls( camera, renderer.domElement );
				controls.enablePan = true;
				controls.enableDamping = true;
				
				const planeGeometry = new THREE.PlaneGeometry(28, 100)
				const planeMaterial = new THREE.MeshLambertMaterial({ color: 0x4F4F4F })
				let plane = new THREE.Mesh(planeGeometry, planeMaterial)
				plane.rotation.x = -0.5 * Math.PI // 使平面與 y 軸垂直，並讓正面朝上
				plane.position.set(-0.3, -4.5, 1.3)
				scene.add(plane);
				
				const planeGeometry01 = new THREE.PlaneGeometry(10, 150)
				const planeMaterial01 = new THREE.MeshLambertMaterial({ color: 0x4F4F4F })
				plane01 = new THREE.Mesh(planeGeometry01, planeMaterial01)
				plane01.rotation.x = -0.5 * Math.PI // 使平面與 y 軸垂直，並讓正面朝上
				plane01.position.set(-3.5, -4.2, -1.4);
				
				//scene.add(plane01);
				
				
				
				//**************************************手臂**************************************
				const manager = new LoadingManager();
				//第一站，Fanc
				const fancLoader = new URDFLoader( manager );
				
				pcdLoader.load( './models/MAP4F.pcd', function ( points ) {
                //points.geometry.center();
                //const passThrough = new pcl.filters.PassThrough();
                //points1=points;
               
              

                console.log(points);
                points.geometry.rotateX( -Math.PI/2 );
                
                //points.geometry.rotateY( -Math.PI/2 )
                //points.material = pointCloudMaterial;
                //points.name = 'MAP4F.pcd';
                console.log("Number of points:", points.geometry.attributes.position.count);
                let positions = new Float32Array(points.geometry.attributes.position.count);
                let colors = new Float32Array(points.geometry.attributes.position.count);
                let positions_red = new Float32Array(points.geometry.attributes.position.count);
                let idx=0;
                let idx_red=0;
                for (let i = 0; i < points.geometry.attributes.position.count; i++) {
                    let x = points.geometry.attributes.position.getX(i);
                    let y = points.geometry.attributes.position.getY(i);
                    let z = points.geometry.attributes.position.getZ(i);
                    y=y+x*0.037-1.4+z*0.025;
                    if (i<5){
                
                        console.log("z:",z);}
                    //X <50 y 是高度
                    if ( x > 50 && y > 0 && y < 2.6) {

                        if (z < -7.5) 
                        {	//z深度
                            //牆壁外刪除 -7.5
                     
                            positions[idx*3]=x;
                            positions[idx*3+1]=y;
                            positions[idx*3+2]=z;
                            colors [idx*3]=0.4*y ; //R
                            colors [idx*3+1]=1;//G
                            colors[idx*3+2]=0;//B

                            idx++;  
                         }
                         else
                         {
    
                            positions_red[idx_red*3]=x;
                            positions_red[idx_red*3+1]=y;
                            positions_red[idx_red*3+2]=z;
                            idx_red++;  
                         }
                        //const point = new THREE.Vector3(x, y, z)
                        //geometry.vertices.push(point)
                        //points.geometry.attributes.position.setX(i,0);
                        //points.geometry.attributes.position.setZ(i,0);
                        //points.geometry.attributes.position.setY(i,0);
                        //console.log("x:",z);
                    }
                    
                }
                positions = positions.slice(0, idx * 3);
                colors = colors.slice(0, idx * 3);
                // 分割點雲數據為兩半
                console.log("idx Number of points:", idx);
                console.log("idx_red Number of points:", idx_red);
                const geometry = new THREE.BufferGeometry()
                const geometry_red = new THREE.BufferGeometry()
                geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
                geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

                geometry_red.setAttribute('position', new THREE.BufferAttribute(positions_red, 3));
                points1 = new THREE.Points(geometry, pointCloudMaterial)
                points2 = new THREE.Points(geometry_red, pointCloudMaterial_Red)
                scene.add( points1 );
                //scene.add( points2 );
                console.log(points1);
				//前後 高低 左右
                points1.position.set(20, -4.2, 70);
                points1.rotation.y += 1.56;
				//points2.position.set(-100, 0, 0);
               // scene.add( points2 );
                //scene.add( points );
                //const gui = new GUI();
                //gui.add( points.material, 'size', 0.01, 1 ).onChange( render );
                //gui.addColor( points.material, 'color' ).onChange( render );
                //gui.open();
                //render();
            } );
				//第一站吸嘴
				
				
				
				
				
				
				
				
				
				
				
				
				

				//第一站海綿吸盤boxUp
				const boxUpLoader = new URDFLoader( manager );
				
			
				
				
				
				
				

				//自走車
				const powerAGVLoader = new URDFLoader( manager );
				
				
				powerAGVLoader.load('../../LFT_Car/urdf/LFT_Car.urdf', whiteAGVResult => {
					
					//whiteAGVResult.scale.set( 1, 1, 1 );	
					whiteAGVResult.position.set( 0.3, -3.5, 8.2 );//最左邊x=>0.3,z=>5.2:最右邊x=>0.65,z=>-10.15
					whiteAGVResult.rotation.x = -Math.PI/2;
					whiteAGVResult.rotation.z = -Math.PI/2;
					
					whiteAGV = whiteAGVResult;
					
					scene.add(whiteAGVResult);

					//************************************
				});
				
				
				
				
				
			
				
				
				
				var updateIndex = 60;
				var interval;
				var isAllRun = false;
				var lineArrowHelpers = [];
				var arrowHelpers00 = [];
				var arrowHelpers01 = [];
				var directionArray00 = [];
				var directionArray01 = [];
				var objectArray = [];
				var timeIndex = 0;
				var arrowIndex = 0;
						
				
				
				setInterval(function () {
					
					console.log("aaaaaaa")
					
					clearInterval(interval);//中斷迴圈
			
						xyArray = [];
						//objectArray = [];
						directionArray01 = [];
						arrowHelpers00 = [];
						arrowHelpers01 = [];
						//arrowIndex=0;
						
						for(var lineIndex = 0;lineIndex<lineArrowHelpers.length;lineIndex++){
							
							scene.remove(lineArrowHelpers[lineIndex]);
							
						}
						lineArrowHelpers = [];
					
						$.post( "ajax/QueryWindMeter100.php",
						function(data){
	
							for(var i=1; i<data.length; i++){
							
								var aveAngle = parseFloat(data[i][5]);
								var aveSpeed = parseFloat(data[i][6]);
								var aveSpeed = 100;						
								var aveVerticalAngle = parseFloat(data[i][7]); 
								//var aveVerticalAngle = parseInt(totalVerticalAngle/index); 
									
								var radian = aveAngle * Math.PI / 180;//将角度转换为弧度
								var angleRadian = aveVerticalAngle * Math.PI / 180;//将角度转换为弧度
								var x = Math.cos(radian)*aveSpeed;
								var z = Math.sin(radian)*aveSpeed;
								var y = aveSpeed * Math.sin(angleRadian) * Math.sin(radian);
								
								console.log("y============="+y);
								
								xyArray.push(new THREE.Vector3((x/10)+4, (y*10)+4, (z/20)+13.5));
							
							}
						
							//曲線箭頭路徑
							var curve = new THREE.CatmullRomCurve3(xyArray);
						
							var points = curve.getPoints(50);//曲線上幾個箭頭
						
							//曲線(中間路徑自動安插路徑)
							for(var y = 0; y < points.length - 1; y++) {
							
								var direction01 = new THREE.Vector3().subVectors(points[y + 1], points[y]).normalize();
								var direction02 = new THREE.Vector3().subVectors(points[y + 1], points[y]).normalize();
								var direction03 = new THREE.Vector3().subVectors(points[y + 1], points[y]).normalize();
								var arrowHelper01 = new THREE.ArrowHelper(direction01, points[y], 0,0xFFFFFF,0.15,0.15);
								var arrowHelper02 = new THREE.ArrowHelper(direction02, points[y], 0,0xFFFFFF,0.15,0.15);								
								var arrowHelper03 = new THREE.ArrowHelper(direction03, points[y], (points[y].distanceTo(points[y + 1]))-0.0,0xFFFFFF,0.0,0.0);
								scene.add(arrowHelper03);
								lineArrowHelpers.push(arrowHelper03);
								
								directionArray01.push(direction02);
								arrowHelpers00.push(arrowHelper01);
								arrowHelpers01.push(arrowHelper02);
								
								//scene.add(arrowHelper02);
							}
							
							interval = setInterval(function () {
								if((timeIndex>=5 || arrowIndex==0) && arrowIndex<50){
									var arrowObject = {arrowHelpers:arrowHelpers00[arrowIndex],next:1,isAdd:isAllRun};
									objectArray.push(arrowObject);
										
									timeIndex = 0;
									arrowIndex++;
								}
							
								for(var index=0;index<objectArray.length;index++){
									var newArrow = objectArray[index].arrowHelpers;
									var newNext = objectArray[index].next;
									var isAdd = objectArray[index].isAdd;
									
									newArrow.setDirection(directionArray01[newNext]);
									newArrow.position.x = arrowHelpers01[newNext].position.x;
									newArrow.position.y = arrowHelpers01[newNext].position.y;
									newArrow.position.z = arrowHelpers01[newNext].position.z;
											
									//newArrow.color.set("#FF0000");
									if(!isAdd){
										scene.add(newArrow);
										objectArray[index].isAdd = true;
									}
									objectArray[index].next = newNext + 1;
									if(objectArray[index].next>=50){
										objectArray[index].next = 1;
										isAllRun = true;
									}
								}

								timeIndex++;
								
								
							}, 300);
							
							
							
						},"json");
					
				}, 30000);
				
				
				
				window.addEventListener( 'resize', onWindowResize );

				animate();
				
			}
			
			function reloadRobotAxis(actMin,actMax,actValue,fakeMin,fakeMax){
				var actRate = (actValue-actMin) / (actMax - actMin);
				var fakeRate = actRate * (fakeMax - fakeMin);
				var fakeValue = fakeMin + fakeRate;
				
				return fakeValue;
			}
			
			var lastAGVloading = "";
			var firstEntryThree = 0;
			var isRemoveAGVBox = false;
			
			function ReloadPowerAGV(){
				$.post( "ajax/powerAGV.php",
				function(data){
					
					//powerAGV.position.set(-5,-4, -8.5 );//02
					//powerAGV.position.set(-5,-4, 4.5 );//02
					//powerAGV.position.set(0,-4, 4.5 );//01
					
					//x=0-(9784-value)*0.023
					//y=4.5-(10518-value)*0.025
					
					for(i=1; i<data.length; i++){
						if(data[i][5]=="105"){
						
							//powerAGV.position.x = 0.3;//左邊
							powerAGV.position.x = 0.15-(441-parseInt(data[i][1]))*0.0271;//675==>
							/*
							真實=>330->827=497
							虛假=>4.3~-8.0=12.3
							比率=>12.3/497=0.024	
							*/
							powerAGV.position.z = 4.3-(827-parseInt(data[i][2]))*0.0247;
							//powerAGV.position.z = 5.2-(827-parseInt(data[i][2]))*0.028;
							//powerAGV.rotation.z = -((180- Math.abs(parseInt(data[i][3])))/100)*0.01745;
							
							powerAGV.rotation.z = parseInt(data[i][3]) * Math.PI/180;
							
							if(powerAGV.position.z==4.705){
								if(firstEntryThree==0){
									//AGVBoxDown.position.x = -0.785;
									firstEntryThree = 1;
								}
								//第三站
								$("#agvData").attr("style","width:25px;height:70px;position:absolute;top:55%;left:17%;");
								$(".agvClass").attr("style","background-color: #008080;width:300px;height:290px;position:absolute;top:24%;left:10%;text-align:left");
							
							}else if(powerAGV.position.z==-7.89){
							
								//第一站
								$("#agvData").attr("style","width:25px;height:70px;position:absolute;top:55%;left:85%;");
								$(".agvClass").attr("style","background-color: #008080;width:300px;height:290px;position:absolute;top:24%;left:78%;text-align:left");
							
								firstEntryThree = 1;
							}else{
							
								
								$("#agvData").attr("style","width:25px;height:70px;position:absolute;top:55%;left:85%;display:none");
								$(".agvClass").attr("style","background-color: #008080;width:300px;height:290px;position:absolute;top:24%;left:78%;text-align:left;display:none");
							
								firstEntryThree = 1;
							}
							
							
							if(lastAGVloading!=data[i][4]){
								if(data[i][4]=="3"){
									AGVBoxDown.add(AGVboxUpDown);
									powerAGV.add(AGVBoxDown);
									AGVBoxDown.position.y = 0.25;
									//AGVBoxDown.position.x = 0.2;
								}else{
									//powerAGV.remove(AGVBoxDown);
									//AGVBoxDown.position.y = 1.41;
									
									//AGVBoxDown.position.x = agvDownBoxPosit;
									isRemoveAGVBox = true;
								}
							}
							
							
							targetValue["AGVFlow"] = parseInt(data[i][6]);
							
							
							lastAGVloading = data[i][4];
						}else{
							whiteAGV.position.x = 0.15-(441-parseInt(data[i][1]))*0.0271;//675==>
							whiteAGV.position.z = 10.2-(1086-parseInt(data[i][2]))*0.01;
							whiteAGV.rotation.z = parseInt(data[i][3]) * Math.PI/180;
							//whiteAGV.rotation.z = -((180- Math.abs(parseInt(data[i][3])))/100)*0.01745;
						}
					}
					
				},"json");
			}
			
			function ReloadWind01(){
				
				$.post( "ajax/wind.php",
				function(data){
					
					for(i=1; i<data.length; i++){
						targetValue4["LFT01_Joint"] = 0;
						targetValue4["LFT02_Joint"] = 0;
						targetValue4["LFT03_Joint"] = 0;
						targetValue4["LFT04_Joint"] = 0;
						targetValue4["LFT05_Joint"] = 0;
						targetValue4["LFT06_Joint"] = (parseInt(data[i][3])-400)/1000*(-1);
					}
					
				},"json");
			}
			
			function updateDownBoxData(){
			
				$.post( "ajax/updateDemoLineDownBox.php",
				{
					fcDownBoxStatus:fcDownBoxStatus,
					fcDownBoxPosit:fcDownBoxPosit,
					tmDownBoxPosit:tmDownBoxPosit,
					sbDownBoxStatus:sbDownBoxStatus,
					sbDownBoxPosit:sbDownBoxPosit,
					FCIsNew:FCIsNew,
					entryIndex:entryIndex,
					TMIsNew:TMIsNew,
					entrySBIndex:entrySBIndex,
					downBoxLastPt01:downBoxLastPt01,
					downBoxLastPt02:downBoxLastPt02,
					isBoxUpFinish:isBoxUpFinish,
					agvDownBoxPosit:agvDownBoxPosit
				},
				function(data){
				
					//console.log(data);
				
					//if(data.indexof("1")>0){
						//console.log("update OK");
					//}else{
						//console.log("update NG");
					//}
					
				});
			
			}
			
			function queryDownBoxData(){
			
				$.post( "ajax/queryDemoLineDownBox.php",
				function(data){
				
					//console.log(data);
					
					for(i=1; i<data.length; i++){
						fcDownBoxStatus = parseInt(data[i][0]);
						fcDownBoxPosit = data[i][1];
						tmDownBoxPosit = data[i][2];
						sbDownBoxStatus = parseInt(data[i][3]);
						sbDownBoxPosit = data[i][4];
						FCIsNew = data[i][5];
						entryIndex = data[i][6];
						TMIsNew = data[i][7];
						entrySBIndex = data[i][8];
						downBoxLastPt01 = data[i][9];
						downBoxLastPt02 = data[i][10];
						isBoxUpFinish = data[i][11];
						agvDownBoxPosit = parseFloat(data[i][12]);
					}
				},"json");
			
			}
			
			var fcIsSber = 0;
			var alertIndex = 1;
			var isSuckDry = 0;
			var tmSuckDryIndex = 0;
			var isFlowToAgv = false;
			
			function setupTween01() {
			
				if(FCSpeed=="1" || TMSpeed=="1" || SBSpeed=="1"){
					if(alertIndex==5){
						plane01.material.color.setHex(0xFF0000);
					}else if(alertIndex==9){
						plane01.material.color.setHex(0x4F4F4F);
						alertIndex = 0;
					}
					alertIndex++;			
				}else{
					alertIndex = 1;
					plane01.material.color.setHex(0x4F4F4F);
				}
					
				
			
				const target = {};
				const duration = THREE.MathUtils.randInt( 100, 500 );
				
				for ( const prop in FCRobot.joints ) {
				
					//使用 hasOwnProperty 測試屬性是否存在
					if ( FCRobot.joints.hasOwnProperty( prop ) ) {
							
						//判斷關節的參數static是否為false(false表非靜止)
						if ( ! FCRobot.joints[ prop ].static ) {
								
							const joint = FCRobot.joints[ prop ];
							
							const old = tweenParameters01[ prop ];

							//判斷是否為undefined?不是為old，是為joint.zeroPosition
							const position = old ? old : 0;
								
							tweenParameters01[ prop ] = position;
							
							//由joint.limits.min至joint.limits.max之間亂數取一值
							//target[ prop ] = THREE.MathUtils.randInt( joint.limits.min, joint.limits.max );
							target[ prop ] = targetValue[ prop ];
							//target[ prop ] = THREE.MathUtils.randFloatSpread(2) - 1;

						}

					}

				}
				
					
				//new TWEEN.Tween(coords) 建立新的 Tween 物件來改變 coords
				//.to({ x: 300, y: 200 }, 1000) // 在 1000ms 內移動至（300, 200）
				//.easing(TWEEN.Easing.Quadratic.Out) // 補間動畫效果
				//.onUpdate(function() { // 在 coords 被改變時會執行的 callback function
				//使用 onUpdate 函式來執行當座標值有改變時需要做的相對應修改
				kinematicsTween = new TWEEN.Tween( tweenParameters01 ).to( target, 100 ).easing( TWEEN.Easing.Quadratic.Out );
				kinematicsTween.onUpdate( function ( object ) {
				for ( const prop in FCRobot.joints ) {	
					if ( FCRobot.joints.hasOwnProperty( prop ) ) {
						if ( ! FCRobot.joints[ prop ].static ) {	
								FCRobot.setJointValue( prop, object[ prop ] );	
							}
						}
					}
				} );

				kinematicsTween.start();
				
				//targetValue["FCGrip"]=2;
				
				
					
				
				
				
				//1海綿吸盤;2吸嘴
				if(targetValue["FCGrip"]==1){
					
				
					FancLinkChild.remove(FCFinger);
				
					scene.remove(FCSponge);
					FCSponge.position.set(0,0,0);
					FCSponge.rotation.set(0,0,0);

					//**********海綿吸盤與Fanc手臂綁定後**********
					FCSponge.rotation.y = -Math.PI / 2;
					FCSponge.rotation.z = 0.42 ;
					FCSponge.scale.x = 1.0;
					FCSponge.scale.y = 1.0;
					FCSponge.scale.z = 1.0;
					FancLinkChild.add( FCSponge );
					//******************************************
					
				}else if(targetValue["FCGrip"]==2){
					
					
					//console.log("第一站吸嘴！"+targetValue["joint_1"]+"====="+targetValue["joint_2"]+"==="+targetValue["joint_3"]+"======"+targetValue["joint_4"]+"========="+targetValue["joint_5"]+"======"+targetValue["joint_6"]);
					
				
					FancLinkChild.remove(FCSponge);
				
					scene.remove(FCFinger);
					FCFinger.position.set(0,0,0);
					FCFinger.rotation.set(0,0,0);
					
					//**********吸嘴與Fanc手臂綁定後之設定**********
					FCFinger.position.x = 0.21;//上下
					FCFinger.position.y = 0.06;//前後
					FCFinger.position.z = 0.15;//左右

					FCFinger.rotation.z = -Math.PI / 2 ;
					FCFinger.rotation.x = -2.0;
					
					FCFinger.scale.x = 1.0;
					FCFinger.scale.y = 1.0;
					FCFinger.scale.z = 0.8;

					FancLinkChild.add( FCFinger );
					//******************************************
					
				}else if(targetValue["FCGrip"]==3){
				
					FancLinkChild.remove(FCFinger);
					FancLinkChild.remove(FCSponge);
					
					FCFinger.position.set(0,0,0);
					FCSponge.position.set(0,0,0);
					
					FCFinger.rotation.set(0,0,0);
					FCSponge.rotation.set(0,0,0);
					
					//**********吸嘴放置於置物架之設定**********
					FCFinger.position.x = -1.92;
					FCFinger.position.y = -1.05;
					FCFinger.position.z =  -6.2;
					
					FCFinger.rotation.z = Math.PI;
					FCFinger.scale.x = 3.0;
					FCFinger.scale.y = 3.0;
					FCFinger.scale.z = 3.0;
					
					scene.add( FCFinger );
					//******************************************
					
					//**********海綿吸盤放置於置物架之設定**********
					FCSponge.position.x = -2.02;
					FCSponge.position.y = -0.42;
					FCSponge.position.z = -6.15;
					FCSponge.rotation.x = -1.6 ;
					FCSponge.scale.x = 3.0;
					FCSponge.scale.y = 3.0;
					FCSponge.scale.z = 3.0;
					scene.add(FCSponge);
					//******************************************
				}
				///下蓋在第一站cv的位置;0指未在第一站cv位置
				
				//console.log("三站位置==="+targetValue["FCBoxCvPosit"]+"==============="+targetValue["TMBoxCvPosit"]+"================="+targetValue["SBBoxCvPosit"]);
				
				
				//第一站下蓋
				//if(targetValue["FCBoxCvPosit"]!=0 && targetValue["TMBoxCvPosit"]==0){
				if(targetValue["FCBoxCvPosit"]!=0){
					
					if(targetValue["FCBoxCvPosit"] < lastFCBoxPosit || lastFCBoxPosit==0){
						FCIsNew = "false";
						scene.add(FCBoxDown);

						if(fcDownBoxStatus==1){
							FCBoxDown.add(boxUpDown01);
						}
						
					}
					
					//targetValue["FCBoxCvPosit"] = 33;
					//targetValue["FCCvClip"] = 6153;
					if(targetValue["FCBoxCvPosit"] <= 75){
						if(targetValue["FCCvClip"]!=6153){
							//FCBoxDown.position.z = -6+((targetValue["FCBoxCvPosit"]*1.65)/33);///1.65為3d的起尾總長;51為第一站開始至挾住box的targetValue["FCBoxCvPosit"]值(所以要先知道挾住box的targetValue["FCBoxCvPosit"]是多少)	
							//FCBoxDown.position.z = -6+(targetValue["FCBoxCvPosit"]*0.022);///1.65為3d的起尾總長;51為第一站開始至挾住box的targetValue["FCBoxCvPosit"]值(所以要先知道挾住box的targetValue["FCBoxCvPosit"]是多少)	
							//FCBoxDown.position.z = -6+(targetValue["FCBoxCvPosit"]*0.022);///1.65為3d的起尾總長;51為第一站開始至挾住box的targetValue["FCBoxCvPosit"]值(所以要先知道挾住box的targetValue["FCBoxCvPosit"]是多少)	
							FCBoxDown.position.z = -6+(targetValue["FCBoxCvPosit"]*0.017);///1.65為3d的起尾總長;51為第一站開始至挾住box的targetValue["FCBoxCvPosit"]值(所以要先知道挾住box的targetValue["FCBoxCvPosit"]是多少)	
						
						}else{
							FCBoxDown.position.z = -4.70;
						}
					}else{
						//if(FCBoxDown.position.z<=-4.35){
							//FCBoxDown.position.z = -4.35+((targetValue["FCBoxCvPosit"]*3.2)/80);
						//}
						//FCBoxDown.position.z = -6+((targetValue["FCBoxCvPosit"])*0.042);
						FCBoxDown.position.z = -4.70+((targetValue["FCBoxCvPosit"]-75)*0.035);
						//FCBoxDown.position.z = -4.70+((targetValue["FCBoxCvPosit"]-75)*0.029);
					}
					
					
					
					//FC Box位置;將狀態儲存至DB
					fcDownBoxPosit = FCBoxDown.position.z;
				}
				
				
				
				//console.log("FCIsNew========="+FCIsNew+"=======entryIndex===="+entryIndex);
				
				//targetValue["TMBoxCvPosit"] = 1;
				//targetValue["TMBoxCvPosit"] = 62;
				//第二站下蓋
				if(targetValue["TMBoxCvPosit"]!=0){
				//if(targetValue["TMBoxCvPosit"]!=0 && targetValue["SBBoxCvPosit"]==0){
					if(FCIsNew=="false" && entryIndex==0){
						scene.remove(FCBoxDown);
						scene.add(TMBoxDown);
						TMBoxDown.remove(tmBoxDry);
	
						//-3.719
						downBoxLastPt01 = FCBoxDown.position.z;
						
						//console.log("downBoxLastPt01==========="+downBoxLastPt01);
						
						entryIndex=1;
						FCIsNew = "true";
					}
					
					if(targetValue["TMBoxCvPosit"] < lastTMBoxPosit || lastTMBoxPosit==0){
						TMIsNew = "false";
						scene.remove(FCBoxDown);
						scene.add(TMBoxDown);
					}
					
					
					//TMBoxDown.position.z = -2.8+((targetValue["TMBoxCvPosit"]*3.2)/136);
					//TMBoxDown.position.z = -1.9;
					TMBoxDown.position.z = -2.8+targetValue["TMBoxCvPosit"]*0.025;
					//TMBoxDown.position.z = parseFloat(downBoxLastPt01)+targetValue["TMBoxCvPosit"]*0.025;
					
					//console.log("downBoxLastPt01==========="+downBoxLastPt01+"================"+targetValue["TMBoxCvPosit"]+"========="+TMBoxDown.position.z);
					
					//TMBoxDown.position.z = parseFloat(downBoxLastPt01)+targetValue["TMBoxCvPosit"]*0.058;
					//TMBoxDown.position.z = parseFloat(downBoxLastPt01)+((targetValue["TMBoxCvPosit"]*3.2)/120);
					
					//TM Box位置;將狀態儲存至DB
					tmDownBoxPosit = TMBoxDown.position.z;
					
				}else{
					entryIndex=0;
					FCIsNew = "false";
					

				}
				
				//TMBoxDown.position.z = -10.324;
				//TMBoxDown.position.z = -3.719;
				
				//console.log(targetValue["TMBoxCvPosit"]+"=======第三站下蓋====="+targetValue["SBBoxCvPosit"]);
				
				
				
				
				//第三站下蓋
				if(targetValue["SBBoxCvPosit"]!=0){
				
					
					if(TMIsNew=="false" && entrySBIndex==0){
						scene.remove(TMBoxDown);
						
						scene.add(SBBoxDown);
						
						//console.log("dddddddddddddddddddddddd========"+TMBoxDown.position.z);
						//-3.324
						downBoxLastPt02 = TMBoxDown.position.z;
						//console.log("downBoxLastPt02==========="+downBoxLastPt02);
						
						entrySBIndex=1;
						TMIsNew = "true";
						SBBoxDown.remove(boxUpDown03);
					}
					
					//if(targetValue["SBBoxCvPosit"]>=229){
					if(targetValue["SBBoxCvPosit"]>=275 && targetValue["SBBoxCvPosit"]<=277){
						SBBoxDown.position.z = 2.075;
						//SBBoxDown.position.z = 2.0;
						scene.add(SBBoxDown);
						//SBBoxDown.position.z = -1.12;
						//-0.785;
						//AGVBoxDown.position.x = -0.785;
						//scene.remove(SBBoxDown);
						//powerAGV.add(AGVBoxDown);
					}else{
					
						scene.add(SBBoxDown);
						
						//SBBoxDown.position.z = -1.12;
						SBBoxDown.position.z = 0.4+(targetValue["SBBoxCvPosit"]*0.005);
						//SBBoxDown.position.z = parseFloat(downBoxLastPt02)+(targetValue["SBBoxCvPosit"]*0.005);
						//SBBoxDown.position.z = parseFloat(downBoxLastPt02)+((targetValue["SBBoxCvPosit"]*(2.35-parseFloat(downBoxLastPt02)))/260);
						//SBBoxDown.position.z = -1.12+((targetValue["SBBoxCvPosit"]*3.47)/260);
						//SBBoxDown.position.z = downBoxLastPt02+((targetValue["TMBoxCvPosit"]*1.90)/259);
						//SBBoxDown.position.z = downBoxLastPt02+((targetValue["TMBoxCvPosit"]*1.90)/229);
					}
					
					//SB Box位置;將狀態儲存至DB
					sbDownBoxPosit = SBBoxDown.position.z;
					
					
				}else{
					entrySBIndex=0;
					TMIsNew = "false";
					//scene.remove(SBBoxDown);
					//isBoxUpFinish = "false";
				}
				
				lastFCBoxPosit = targetValue["FCBoxCvPosit"];
				lastTMBoxPosit = targetValue["TMBoxCvPosit"];
				
				//console.log("targetValue[AGVFlow]========aaaaaaaaaaaa====="+targetValue["AGVFlow"]+"============="+targetValue["FCBoxCvPosit"]);
				
				//第一站
				//if(targetValue["AGVFlow"]!=0 && powerAGV.position.z==-8.0){
				if(targetValue["AGVFlow"]==16){
					
					//console.log("第一站============"+targetValue["FCBoxCvPosit"]);
				
					if(targetValue["FCBoxCvPosit"]!=0){
						scene.add(FCBoxDown);
						powerAGV.remove(AGVBoxDown);
					}else{
						if(agvBoxIndex>=2){
							AGVBoxDown.position.y = AGVBoxDown.position.y - 0.0375;//0.01移動間隔
							agvBoxIndex = 0;
						}
						agvBoxIndex=agvBoxIndex+0.8; 
						fcDownBoxStatus = 1;
					}
					
					agvDownTime = agvDownTime + 1;
					
					//AGVBoxDown.position.x = AGVBoxDown.position.x + 0.1;
					//AGVBoxDown.position.x = 0.63;//第一站位置
					
					//agvBoxIndex速度
					
				}else if(targetValue["AGVFlow"]==32){//第三站
				
					//console.log("第三站======aaaaaaaaaaaaaaaaa======");
				//}else if(targetValue["AGVFlow"]!=0 && powerAGV.position.z==4.3){//第三站
				
					scene.remove(SBBoxDown);
					
					//console.log("第三站======bbbbbbbbbbbb======");
					
					
					if(!isFlowToAgv){
						AGVBoxDown.position.y = 1.41;
						
						AGVBoxDown.add(AGVboxUpDown);
						powerAGV.add(AGVBoxDown);
						
						isFlowToAgv = true;
					
					}

					//AGVBoxDown.position.x = -0.785;//第三站位置
					if((agvDownBoxPosit - 0.065)>0.25){
						if(agvBoxIndex>=2){
							AGVBoxDown.position.y = agvDownBoxPosit - 0.065;//0.01移動間隔
							//AGVBoxDown.position.y = agvDownBoxPosit - 0.02255;//0.01移動間隔
							//AGVBoxDown.position.x = AGVBoxDown.position.x + 0.0002;
							agvBoxIndex = 0;
						}
					}
					agvBoxIndex=agvBoxIndex+0.8;

					agvDownBoxPosit = AGVBoxDown.position.y;
					
					agvUpTime = agvUpTime + 1;
				
				}else{
					//console.log("agvDownTime==========="+agvDownTime);
					//console.log("agvUpTime==========="+agvUpTime);
					AGVBoxDown.position.y = 0.25;
					agvBoxIndex=0; 
					
					agvDownTime = 0;
					agvUpTime = 0;
					isFlowToAgv = false;
					
				}
				
				
				//console.log("第一手臂1海綿吸盤吸上蓋box==========="+targetValue["FCSucker"]);
				
				
				//第一手臂1海綿吸盤吸上蓋box
				if(targetValue["FCSucker"]!=0){

					FCBoxDown.remove(boxUpDown01);
					
					//FC SB Box無上蓋;將狀態儲存至DB
					//fcDownBoxStatus = 0;
					sbDownBoxStatus = 0;
					
					boxUpFinger01.scale.set(0.93,0.9,0.9);
					boxUpFinger01.rotation.z = -Math.PI/2 ;
					boxUpFinger01.rotation.y = Math.PI;
					boxUpFinger01.position.x = -0.57;
					boxUpFinger01.position.y = -0.26;
					boxUpFinger01.position.z = -0.15;
					FCSponge.add(boxUpFinger01);

				//上蓋放置於一、二手臂架台中間
				}else{
					if(targetValue["FCUpBoxPed"]!=0){
						FCSponge.remove(boxUpFinger01);
					}
				}
				
				if(targetValue["FCUpBoxPed"]!=0){
				
					
				
					//FCSponge.remove(boxUpFinger01);
					
					boxUpCv01.scale.set(2.8,2.8,2.8);
				
					//**********放置於下盒之設定**********
					boxUpCv01.rotation.x = Math.PI/2;
					boxUpCv01.position.x = -1.18;
					boxUpCv01.position.y = -1.02;
					boxUpCv01.position.z = -1.85;
					
					scene.add(boxUpCv01);
										
					
				}else{
					scene.remove(boxUpCv01);
				}
				
				//console.log("1吸;0放========"+targetValue["TMSucker"]);
				//console.log("0吸盤;1/2風刀;3吸乾燥包========"+targetValue["TMGripValue"]);
				
				//第二手臂1海綿吸盤吸上蓋box
				if(targetValue["TMSucker"]==1 && targetValue["TMGripValue"]==0){
				
					scene.remove(boxUpCv01);
					
					boxUpFinger02.scale.set(1.12,1.12,1.12);
					
					boxUpFinger02.rotation.y =Math.PI/2;
					boxUpFinger02.rotation.z =Math.PI/2;
					//boxUpFinger02.rotation.y =Math.PI/2 ;
					
					boxUpFinger02.position.x = 0.240;//大下小上
					boxUpFinger02.position.y = 0.185;//大前小後
					boxUpFinger02.position.z = 0.70;//大左小右
					
					TMFinger.add(boxUpFinger02);

				}else if(targetValue["TMGripValue"]==4){
					
					
					tmDry.scale.set(0.15,0.15,0.15);
					tmDry.rotation.y =Math.PI/2;
					tmDry.rotation.z =Math.PI/2;
					
					tmDry.position.x = 0.242;//大下小上
					tmDry.position.y = 0.02;//大前小後
					tmDry.position.z = 0.1;//大左小右
					
					TMFinger.add(tmDry);
				}else if(targetValue["TMGripValue"]==3){
					if(tmSuckDryIndex>=20){
						TMFinger.remove(tmDry);
						tmSuckDryIndex = 0;
						
						//TM放乾燥包至box
						tmBoxDry.scale.set(0.15,0.15,0.15);
						
						tmBoxDry.position.x = -0.15;//大下小上
						tmBoxDry.position.y = -0.6;//大前小後
						tmBoxDry.position.z = -0.1;//大下小上
						
						TMBoxDown.add(tmBoxDry);
					}else{
						tmSuckDryIndex++;
					}
				}else{
					
					TMFinger.remove(boxUpFinger02);
					
				}
				
				//第二站boxUp cv
				if(targetValue["TMUpBoxPed"]!=0){
				
					TMFinger.remove(boxUpFinger02);
					
					boxUpCv02.scale.set(2.8,2.8,2.8);
				
					//**********放置於下盒之設定**********
					boxUpCv02.rotation.x = Math.PI/2;
					boxUpCv02.position.x = -0.55;
					boxUpCv02.position.y = -1.6;
					boxUpCv02.position.z = 1.5;

					scene.add(boxUpCv02);

				}else{
					scene.remove(boxUpCv02);
				}
				
				//console.log("isBoxUpFinish=========="+isBoxUpFinish);
				
				 //第三手臂1海綿吸盤吸上蓋box
				if(SBTargetValue["SBSucker"]==1){
				
					scene.remove(boxUpCv02);
				
					boxUpFinger03.position.set(0,0,0);
					boxUpFinger03.rotation.set(0,0,0);
			
					boxUpFinger03.scale.set(0.93,0.93,0.93);
					//boxUpFinger03.scale.set(1.12,1.12,1.12);
					boxUpFinger03.rotation.z = -Math.PI/2 ;
					boxUpFinger03.rotation.y = Math.PI;

					boxUpFinger03.position.x = -0.54;
					boxUpFinger03.position.y = -0.235;
					boxUpFinger03.position.z = -0.125;

					SBSponge.add(boxUpFinger03);
					
					isBoxUpFinish = "true";

				}else if(isBoxUpFinish=="true"){
					
					
					
					SBSponge.remove(boxUpFinger03);
					
					boxUpFinger03.position.set(0,0,0);
					boxUpFinger03.rotation.set(0,0,0);
					
					SBBoxDown.add(boxUpDown03);
					isBoxUpFinish = "false";
					
					//SB Box蓋上蓋;將狀態儲存至DB
					sbDownBoxStatus = 1;
					
				}else{
					
					SBSponge.remove(boxUpFinger03);
					
					boxUpFinger03.position.set(0,0,0);
					boxUpFinger03.rotation.set(0,0,0);
				}
				
				//第一手臂1海綿吸盤吸sbser
				if(targetValue["FCDesiccant"]==1){
				
					nozzleDry.position.set(0,0,0);
					nozzleDry.rotation.set(0,0,0);
					
					nozzleDry.scale.set(0.15,0.15,0.15);
					
					nozzleDry.rotation.x = -Math.PI/2 ;
					
					nozzleDry.position.x = -0.13;//前後
					nozzleDry.position.y = 0.06;//上下
					nozzleDry.position.z = -0.23;
					
					FCFinger.add(nozzleDry);
					
					
					
				//sbser放置於後架台上
				}else{
					FCFinger.remove(nozzleDry);
				}
				
			}
			
			function setupTween02() {
		
				//const targetValue = {};
				const target = {};
				
				const duration = THREE.MathUtils.randInt( 1000, 5000 );
				
				for ( const prop in TMRobot.joints ) {
					
					//使用 hasOwnProperty 測試屬性是否存在
					if ( TMRobot.joints.hasOwnProperty( prop ) ) {
							
						//判斷關節的參數static是否為false(false表非靜止)
						if ( ! TMRobot.joints[ prop ].static ) {
							
							const joint = TMRobot.joints[ prop ];
							const old = tweenParameters02[ prop ];

							//判斷是否為undefined?不是為old，是為joint.zeroPosition
							const position = old ? old : 0;
								
							tweenParameters02[ prop ] = position;
							//由joint.limits.min至joint.limits.max之間亂數取一值
							//target[ prop ] = THREE.MathUtils.randInt( joint.limits.min, joint.limits.max );
							target[ prop ] = targetValue[ prop ];

						}

					}

				}
					
				//new TWEEN.Tween(coords) 建立新的 Tween 物件來改變 coords
				//.to({ x: 300, y: 200 }, 1000) // 在 1000ms 內移動至（300, 200）
				//.easing(TWEEN.Easing.Quadratic.Out) // 補間動畫效果
				//.onUpdate(function() { // 在 coords 被改變時會執行的 callback function
				//使用 onUpdate 函式來執行當座標值有改變時需要做的相對應修改
				kinematicsTween = new TWEEN.Tween( tweenParameters02 ).to( target, 100 ).easing( TWEEN.Easing.Quadratic.Out );
				kinematicsTween.onUpdate( function ( object ) {
					for ( const prop in TMRobot.joints ) {
						
						if ( TMRobot.joints.hasOwnProperty( prop ) ) {

							if ( ! TMRobot.joints[ prop ].static ) {	
								TMRobot.setJointValue( prop, object[ prop ] );	
							}

						}

					}

				} );

				kinematicsTween.start();

			}
			
			function setupTween021() {
				
				//targetValue["Link_joint2"] = -1.5;
				
				//const targetValue = {};
				const target = {};
				
				for ( const prop in TMFinger.joints ) {
					
					//使用 hasOwnProperty 測試屬性是否存在
					if ( TMFinger.joints.hasOwnProperty( prop ) ) {
							
						//判斷關節的參數static是否為false(false表非靜止)
						if ( ! TMFinger.joints[ prop ].static ) {
							
							const joint = TMFinger.joints[ prop ];
								
							const old = tweenParameters021[ prop ];

							//判斷是否為undefined?不是為old，是為joint.zeroPosition
							const position = old ? old : 0;
								
							tweenParameters021[ prop ] = position;
							//由joint.limits.min至joint.limits.max之間亂數取一值
							//target[ prop ] = THREE.MathUtils.randInt( joint.limits.min, joint.limits.max );
							target[ prop ] = targetValue[ prop ];

						}

					}

				}
					
				//new TWEEN.Tween(coords) 建立新的 Tween 物件來改變 coords
				//.to({ x: 300, y: 200 }, 1000) // 在 1000ms 內移動至（300, 200）
				//.easing(TWEEN.Easing.Quadratic.Out) // 補間動畫效果
				//.onUpdate(function() { // 在 coords 被改變時會執行的 callback function
				//使用 onUpdate 函式來執行當座標值有改變時需要做的相對應修改
				kinematicsTween = new TWEEN.Tween( tweenParameters021 ).to( target, 100 ).easing( TWEEN.Easing.Quadratic.Out );
				kinematicsTween.onUpdate( function ( object ) {
					for ( const prop in TMFinger.joints ) {
						
						if ( TMFinger.joints.hasOwnProperty( prop ) ) {

							if ( ! TMFinger.joints[ prop ].static ) {	
								TMFinger.setJointValue( prop, object[ prop ] );	
							}

						}

					}

				} );

				kinematicsTween.start();

			}
			
			function setupTween03() {
				
				//SBTargetValue["joint_1"] = -0.238;
				//	SBTargetValue["joint_2"] = 0.734;
				//	SBTargetValue["joint_3"] = 0.932;
				//	SBTargetValue["joint_4"] = -0.007;
				//	SBTargetValue["joint_5"] = 1.481;
				//	SBTargetValue["joint_6"] = -0.255;
			
			//放sbser
			/*
			SBTargetValue["joint_1"] = -0.386;
					SBTargetValue["joint_2"] = 0.906;
					SBTargetValue["joint_3"] = 1.134;
					SBTargetValue["joint_4"] = -3.141;
					SBTargetValue["joint_5"] = -1.100;
					SBTargetValue["joint_6"] = 2.744;
					
					//吸sbser
					SBTargetValue["joint_1"] = -0.342;
					SBTargetValue["joint_2"] = -1.003;
					SBTargetValue["joint_3"] = -1.427;
					SBTargetValue["joint_4"] = -3.636;
					SBTargetValue["joint_5"] = 0.635;
					SBTargetValue["joint_6"] = 0.017;
					*/
					
					
					
				if(SBTargetValue["joint_2"]<=-1.003){
					SBTargetValue["joint_2"] = -1.003;
				}	
			
				//const targetValue = {};
				const target = {};
				
				const duration = THREE.MathUtils.randInt( 1000, 5000 );
				
				for ( const prop in SBRobot.joints ) {
				
					//使用 hasOwnProperty 測試屬性是否存在
					if ( SBRobot.joints.hasOwnProperty( prop ) ) {
							
						//判斷關節的參數static是否為false(false表非靜止)
						if ( ! SBRobot.joints[ prop ].static ) {
						
							const joint = SBRobot.joints[ prop ];
								
							const old = tweenParameters03[ prop ];

							//判斷是否為undefined?不是為old，是為joint.zeroPosition
							const position = old ? old : 0;
								
							tweenParameters03[ prop ] = position;
							//由joint.limits.min至joint.limits.max之間亂數取一值
							//target[ prop ] = THREE.MathUtils.randInt( joint.limits.min, joint.limits.max );
							target[ prop ] = SBTargetValue[ prop ];

						}

					}
				}
				
				
					
				//new TWEEN.Tween(coords) 建立新的 Tween 物件來改變 coords
				//.to({ x: 300, y: 200 }, 1000) // 在 1000ms 內移動至（300, 200）
				//.easing(TWEEN.Easing.Quadratic.Out) // 補間動畫效果
				//.onUpdate(function() { // 在 coords 被改變時會執行的 callback function
				//使用 onUpdate 函式來執行當座標值有改變時需要做的相對應修改
				kinematicsTween = new TWEEN.Tween( tweenParameters03 ).to( target, 100 ).easing( TWEEN.Easing.Quadratic.Out );
				kinematicsTween.onUpdate( function ( object ) {
					for ( const prop in SBRobot.joints ) {
						
						if ( SBRobot.joints.hasOwnProperty( prop ) ) {

							if ( ! SBRobot.joints[ prop ].static ) {	
								SBRobot.setJointValue( prop, object[ prop ] );	
							}
						}
					}
				} );

				kinematicsTween.start();
				
				//console.log("1海綿吸盤;2菜瓜布=============="+SBTargetValue["SBGrip"]);

				//SBTargetValue["SBGrip"] = 3;
				//1海綿吸盤;2菜瓜布
				if(SBTargetValue["SBGrip"]==1){
				
					SBChild.remove( SBSco );
					scene.remove(SBSponge);
					SBSponge.position.set(0,0,0);
					SBSponge.rotation.set(0,0,0);
				
					//**********海綿吸盤與Staub手臂綁定後**********
					SBSponge.scale.x = SBSponge.scale.y = SBSponge.scale.z = 1.2;
					SBSponge.rotation.z = Math.PI-0.02 ;
					SBSponge.rotation.x = Math.PI ;
					SBChild.add( SBSponge );
					
					//**********菜瓜布放置於置物架之設定**********
					SBSco.scale.x = SBSco.scale.y = SBSco.scale.z = 3.0;
					SBSco.position.x = -1.35;
					SBSco.position.y = -0.63;
					SBSco.position.z = 2.4;
						
					SBSco.rotation.x = -Math.PI / 2;
					scene.add(SBSco);
					//******************************************
					
				}else if(SBTargetValue["SBGrip"]==2){
				
					SBChild.remove( SBSponge );
					scene.remove(SBSco);
					SBSco.position.set(0,0,0);
					SBSco.rotation.set(0,0,0);
				
					//**********海綿吸盤與Staub手臂綁定後**********
					SBSco.scale.x = SBSco.scale.y = SBSco.scale.z = 1.2;
					SBSco.rotation.x = Math.PI;
					//SBSco.rotation.x = Math.PI/2 ;
					//SBSco.rotation.z = Math.PI/2 ;

					//SBSco.position.x = 0.00;
					//SBSco.position.y =0.00;
					SBSco.position.z = 0.01;
					SBChild.add( SBSco );
					
					//**********海綿吸盤放置於置物架之設定**********
					SBSponge.scale.x = SBSponge.scale.y = SBSponge.scale.z = 3.0;
					SBSponge.position.x = -1.95;
					SBSponge.position.y = -0.60;
					SBSponge.position.z = 2.4;
					SBSponge.rotation.x = -1.6 ;
						
					 scene.add(SBSponge);
					//******************************************
				}else if(SBTargetValue["SBGrip"]==3 || SBTargetValue["SBGrip"]==4 || SBTargetValue["SBGrip"]==0){
				//}else if(testIndex==50){
				
					SBChild.remove(SBSponge);
					SBChild.remove(SBSco);
					
					SBSponge.position.set(0,0,0);
					SBSco.position.set(0,0,0);
					
					SBSponge.rotation.set(0,0,0);
					SBSco.rotation.set(0,0,0);
					
					//**********菜瓜布放置於置物架之設定**********
					SBSco.scale.x = SBSco.scale.y = SBSco.scale.z = 3.0;
					SBSco.position.x = -1.35;
					SBSco.position.y = -0.63;
					SBSco.position.z = 2.4;
						
					SBSco.rotation.x = -Math.PI / 2;
					scene.add(SBSco);
					//******************************************
					
					//**********海綿吸盤放置於置物架之設定**********
					SBSponge.scale.x = SBSponge.scale.y = SBSponge.scale.z = 3.0;
					SBSponge.position.x = -1.95;
					SBSponge.position.y = -0.60;
					SBSponge.position.z = 2.4;
					SBSponge.rotation.x = -1.6 ;
						
					 scene.add(SBSponge);
					//******************************************
				}
				
				//SBTargetValue["SBSbser"]=0;
				//console.log("第三手臂吸乾臊包========"+SBTargetValue["SBSbser"]);
				
				//第三手臂1海綿吸盤吸sbser
				if(SBTargetValue["SBSbser"]==1){
				
					sbDry.scale.set(0.15,0.15,0.15);
					//sbDryResult.rotation.y =Math.PI/2;
					sbDry.rotation.z =Math.PI/2;
					
					sbDry.position.x = -0.09;//大下小上
					sbDry.position.y = 0.02;//大前小後
					sbDry.position.z = -0.16;//大下小上
					
					SBSponge.add(sbDry);
				}else{
					SBSponge.remove(sbDry);
				}
			}
			
			function ReloadWind(){
				
					$.post( "ajax/wind.php",
					function(data){
						
						var lastwindAngle = 0;
						for(var i=1; i<data.length; i++){
							//data[i][3] = 1150;
							targetValue4["LFT01_Joint"] = 0;
							targetValue4["LFT02_Joint"] = 0;
							targetValue4["LFT03_Joint"] = 0;
							targetValue4["LFT04_Joint"] = 0;
							targetValue4["LFT05_Joint"] = 0;
							targetValue4["LFT06_Joint"] = (parseInt(data[i][3])-400)/1000*(-1);
							
							if(parseInt(data[i][3])<410){
								$("#canvas-container1").attr("style","position: absolute; left:0%; top:100px;display:none");
							}else{
								$("#canvas-container1").attr("style","position: absolute; left:0%; top:100px;");
							}
							
							lastwindAngle = data[i][4];
						}
						
					},"json");
				}
			
			function setupTween04() {
				
				
				//targetValue4["LFT01_Joint"] = 0;
				//targetValue4["LFT02_Joint"] = 0;
				//targetValue4["LFT03_Joint"] = 0;
				//targetValue4["LFT04_Joint"] = 0;
				//targetValue4["LFT05_Joint"] = 0;
				//targetValue4["LFT06_Joint"] = -0.7;
		
			
				//const targetValue = {};
				const target = {};
				
				const duration = THREE.MathUtils.randInt( 1000, 5000 );
				
				for ( const prop in whiteAGV.joints ) {
					
					//使用 hasOwnProperty 測試屬性是否存在
					if ( whiteAGV.joints.hasOwnProperty( prop ) ) {
							
						//判斷關節的參數static是否為false(false表非靜止)
						if ( ! whiteAGV.joints[ prop ].static ) {
						
							const joint = whiteAGV.joints[ prop ];
								
							const old = tweenParameters04[ prop ];

							//判斷是否為undefined?不是為old，是為joint.zeroPosition
							const position = old ? old : 0;
								
							tweenParameters04[ prop ] = position;
							//由joint.limits.min至joint.limits.max之間亂數取一值
							//target[ prop ] = THREE.MathUtils.randInt( joint.limits.min, joint.limits.max );
							target[ prop ] = targetValue4[ prop ];

						}

					}
				}
				
				
					
				//new TWEEN.Tween(coords) 建立新的 Tween 物件來改變 coords
				//.to({ x: 300, y: 200 }, 1000) // 在 1000ms 內移動至（300, 200）
				//.easing(TWEEN.Easing.Quadratic.Out) // 補間動畫效果
				//.onUpdate(function() { // 在 coords 被改變時會執行的 callback function
				//使用 onUpdate 函式來執行當座標值有改變時需要做的相對應修改
				kinematicsTween = new TWEEN.Tween( tweenParameters04 ).to( target, 100 ).easing( TWEEN.Easing.Quadratic.Out );
				kinematicsTween.onUpdate( function ( object ) {
					for ( const prop in whiteAGV.joints ) {
						
						if ( whiteAGV.joints.hasOwnProperty( prop ) ) {

							if ( ! whiteAGV.joints[ prop ].static ) {	
								whiteAGV.setJointValue( prop, object[ prop ] );	
							}
						}
					}
				} );

				kinematicsTween.start();
				
			}
			
			function updateVisionImg(){
				//$('#img01').attr("src","http://192.168.100.182/S1/img0.jpg?"+new Date().getTime());
				//$('#img02').attr("src","http://192.168.100.182/S2/img0.jpg?"+new Date().getTime());
				//$('#img03').attr("src","http://192.168.100.182/S3/img0.jpg?"+new Date().getTime()); 
			}
			
			
			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function animate() {
			
				requestAnimationFrame( animate );

				render();
				stats.update();
				TWEEN.update();

			}

			function render() {

				const timer = 1 * 0.0001;

				//camera.position.x = 40;
				//camera.position.y = 2;
				//camera.position.z = Math.sin( timer ) * 20;
				//console.log(camera.position.x+"========="+camera.position.y+"============"+camera.position.z);
				

				//camera.lookAt( 0, 5, 0 );
				
				particleLight.position.x = Math.sin( timer * 4 ) * 3009;
				particleLight.position.y = Math.cos( timer * 5 ) * 4000;
				particleLight.position.z = Math.cos( timer * 4 ) * 3009;
				
				//controls.update();

				renderer.render( scene, camera );

			}
			

		</script>
		
		<script type="text/javascript">
			 
		   $(function() {

			   var radianValue = 0;
			   var runIndex = 0;
			   var lastIndex = "";
			   
			   
			   
			   //smokeInit();
			   
			
			
		
			   
			   $(document).on('click', '.accordion-toggle.accordion-toggle-styled.collapsed', function(){
					radianValue = parseInt($(this).attr("windAngle")) * Math.PI / 180;
					runIndex = $(this).attr("value");
					
					$("#containerDiv1").appendTo("#pointDiv"+runIndex);
					
					
					engine.particleMesh.rotation.y = radianValue;
				});
				
				/*
				$(document).on('click', '.accordion-toggle.accordion-toggle-styled.collapsed', function(){
					radianValue = parseInt($(this).attr("windAngle")) * Math.PI / 180;
					runIndex = $(this).attr("value");

					if((lastIndex!="")){
						$("#canvas-container"+lastIndex).remove();
						$("#containerDiv"+lastIndex).append("<div id='canvas-container"+lastIndex+"' style='position: absolute; left:19px; top:0px;'></div>");
					}
					lastIndex = $(this).attr("value");
					smokeInit();
				});
				*/
				
				function smokeInit(){
					//var windWidth = window.innerWidth-500;
				   //var windHeight = window.innerHeight-500;
				   //var windWidth = window.innerWidth;
				   //var windHeight = window.innerHeight;
				   var windWidth = 1000;
				   var windHeight = 280;
				   
					//scene
					scene = new THREE.Scene();
					//camera
					var camera = new THREE.PerspectiveCamera( 45, windWidth / windHeight, 0.1, 1000 );
					camera.position.set(0,-13,5);
					camera.lookAt(new THREE.Vector3( 0, 5, 0 ));
					
					//renderer
					var renderer = new THREE.WebGLRenderer();
					renderer.setSize( windWidth, windHeight );

					//controls
					var controls = new THREE.OrbitControls( camera, renderer.domElement );
					 
					//show canvas
					$("#canvas-container1").html(renderer.domElement);
					//$("#canvas-container"+runIndex).html(renderer.domElement);
				
					
					//directional light
					var directionalLight = new THREE.DirectionalLight(0xffffff);
					directionalLight.position.set(6, 0, 6);
					scene.add(directionalLight);
					 
					//plane
					var geometry = new THREE.PlaneGeometry(20, 20);
					var material = new THREE.MeshLambertMaterial( { color: 0x555555 } );
					var plane = new THREE.Mesh( geometry, material );
					//scene.add(plane);
					
				
					//particle
					
					//小白量測點：X440,Y1000
				
					//rain
					var settings = {
					  positionStyle    : Type.CUBE,
					  positionBase     : new THREE.Vector3( 0, 0, 0 ),
					  positionSpread   : new THREE.Vector3( 0, 0, 0 ),

					  velocityStyle    : Type.CUBE,
					  velocityBase     : new THREE.Vector3( 0, 0, 5 ),
					  velocitySpread   : new THREE.Vector3( 2, 2, 0 ), 
					  accelerationBase : new THREE.Vector3( 0,0,-1 ),
					  
					  

					  angleBase               : 0,
					  angleSpread             : 720,
					  angleVelocityBase       : 0,
					  angleVelocitySpread     : 1000,
					  
					  sizeTween    : new Tween( [0, 1], [3, 8] ),
					  opacityTween : new Tween( [0.1, 0.2], [0.5, 0] ),
					  colorTween   : new Tween( [0.4, 1], [ new THREE.Vector3(0,0,0.5), new THREE.Vector3(0, 0, 0.5) ] ),

					  particlesPerSecond : 50,
					  particleDeathAge   : 0.5,  
					  emitterDeathAge    : 60
					};
				
					
					
					

					//render scene
					var render = function () {
						requestAnimationFrame(render);
						renderer.render(scene, camera);

						engine.update( 0.005 * 0.5 );
					};
				  
					render();
				}
		   });
			 
		</script>
		
		
		
	<table style='display:none'>
        <tr>
            <td>MAIN.TMAxis1:</td>
            <td id="td_TMAxis1Value"></td>
        </tr>
        <tr>
            <td>MAIN.TMAxis2:</td>
            <td id="td_TMAxis2Value"></td>
        </tr>
        <tr>
            <td>MAIN.TMAxis3:</td>
            <td id="td_TMAxis3Value"></td>
        </tr>
        <tr>
            <td>MAIN.TMAxis4:</td>
            <td id="td_TMAxis4Value"></td>
        </tr>
        <tr>
            <td>MAIN.TMAxis5:</td>
            <td id="td_TMAxis5Value"></td>
        </tr>
        <tr>
            <td>MAIN.TMAxis6:</td>
            <td id="td_TMAxis6Value"></td>
        </tr>
		
		<tr>
            <td>MAIN.FCAxis1:</td>
            <td id="td_FCAxis1Value"></td>
        </tr>
        <tr>
            <td>MAIN.FCAxis2:</td>
            <td id="td_FCAxis2Value"></td>
        </tr>
        <tr>
            <td>MAIN.FCAxis3:</td>
            <td id="td_FCAxis3Value"></td>
        </tr>
        <tr>
            <td>MAIN.FCAxis4:</td>
            <td id="td_FCAxis4Value"></td>
        </tr>
        <tr>
            <td>MAIN.FCAxis5:</td>
            <td id="td_FCAxis5Value"></td>
        </tr>
        <tr>
            <td>MAIN.FCAxis6:</td>
            <td id="td_FCAxis6Value"></td>
        </tr>
		
		<tr>
            <td>MAIN.SBAxis1:</td>
            <td id="td_SBAxis1Value"></td>
        </tr>
		<tr>
            <td>MAIN.SBAxis2:</td>
            <td id="td_SBAxis2Value"></td>
        </tr>
		<tr>
            <td>MAIN.SBAxis3:</td>
            <td id="td_SBAxis3Value"></td>
        </tr>
		<tr>
            <td>MAIN.SBAxis4:</td>
            <td id="td_SBAxis4Value"></td>
        </tr>
		<tr>
            <td>MAIN.SBAxis5:</td>
            <td id="td_SBAxis5Value"></td>
        </tr>
		<tr>
            <td>MAIN.SBAxis6:</td>
            <td id="td_SBAxis6Value"></td>
        </tr>
		
        
		<div id="div_log"></div>
    </table>
    
		
	</body>
</html>