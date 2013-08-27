//	HYPE.documents["animacion"]

(function HYPE_DocumentLoader() {
	var resourcesFolderName = "animacion_Resources";
	var documentName = "animacion";
	var documentLoaderFilename = "animacion_hype_generated_script.js";

	// find the URL for this script's absolute path and set as the resourceFolderName
	try {
		var scripts = document.getElementsByTagName('script');
		for(var i = 0; i < scripts.length; i++) {
			var scriptSrc = scripts[i].src;
			if(scriptSrc != null && scriptSrc.indexOf(documentLoaderFilename) != -1) {
				resourcesFolderName = scriptSrc.substr(0, scriptSrc.lastIndexOf("/"));
				break;
			}
		}
	} catch(err) {	}

	// Legacy support
	if (typeof window.HYPE_DocumentsToLoad == "undefined") {
		window.HYPE_DocumentsToLoad = new Array();
	}
 
	// load HYPE.js if it hasn't been loaded yet
	if(typeof HYPE_108 == "undefined") {
		if(typeof window.HYPE_108_DocumentsToLoad == "undefined") {
			window.HYPE_108_DocumentsToLoad = new Array();
			window.HYPE_108_DocumentsToLoad.push(HYPE_DocumentLoader);

			var headElement = document.getElementsByTagName('head')[0];
			var scriptElement = document.createElement('script');
			scriptElement.type= 'text/javascript';
			scriptElement.src = resourcesFolderName + '/' + 'HYPE.js?hype_version=108';
			headElement.appendChild(scriptElement);
		} else {
			window.HYPE_108_DocumentsToLoad.push(HYPE_DocumentLoader);
		}
		return;
	}
	
	// guard against loading multiple times
	if(HYPE.documents[documentName] != null) {
		return;
	}
	
	var hypeDoc = new HYPE_108();
	
	var attributeTransformerMapping = {b:"i",c:"i",bC:"i",d:"i",aS:"i",M:"i",e:"f",aT:"i",f:"d",N:"i",O:"i",g:"c",aU:"i",P:"i",Q:"i",aV:"i",R:"c",aW:"f",aI:"i",S:"i",T:"i",l:"d",aX:"i",aJ:"i",m:"c",n:"c",aK:"i",X:"i",aZ:"i",aL:"i",Y:"i",A:"c",B:"c",C:"c",D:"c",t:"i",E:"i",G:"c",bA:"c",a:"i",bB:"i"};

var scenes = [{initialValues:{"91":{G:"#444444",aU:8,aV:8,r:"inline",e:"0.000000",s:"Courier,'Courier New',Monospace",t:56,Z:"break-word",aP:"pointer",v:"bold",w:"&lt;",aA:{type:1,transition:1,sceneOid:"108"},x:"visible",j:"absolute",k:"div",y:"preserve",z:"19",aS:8,aT:8,a:1,b:105},"73":{G:"#444444",aU:8,aV:8,r:"inline",e:"0.000000",t:14,Z:"break-word",aP:"pointer",v:"bold",w:"- Arrastra Hilo 2 Rodillos.",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",j:"absolute",k:"div",y:"preserve",z:"3",aS:8,aT:8,a:318,b:135},"88":{o:"content-box",h:"TM216%20copia.png",x:"visible",a:63,q:"100% 100%",b:30,j:"absolute",r:"inline",c:239,z:"8",k:"div",d:260,e:"0.000000"},"76":{G:"#444444",aU:8,aV:8,r:"inline",e:"0.000000",f:"0deg",t:18,Y:18,Z:"break-word",aP:"pointer",v:"bold",aY:"1",w:"M\u00e1quina Soldadora<div><font class=\"Apple-style-span\" color=\"#b92300\">MIG - MAG &nbsp;TM 216</font></div>",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",j:"absolute",k:"div",y:"preserve",z:"6",aS:8,E:-1,aT:8,a:309,b:64},"127":{b:175,z:"21",K:"Solid",c:90,L:"Solid",d:15,aS:6,M:1,e:"0.000000",bD:"none",aT:6,N:1,O:1,g:"#8AAD48",aU:6,P:1,aV:6,j:"absolute",aI:4,k:"div",l:"0deg",aX:0,aJ:4,m:"#000000",n:"#8AAD48",aK:4,aL:4,A:"#A0A0A0",B:"#A0A0A0",Z:"break-word",r:"inline",C:"#A0A0A0",D:"#A0A0A0",t:13,F:"center",v:"bold",G:"#FFFFFF",aP:"pointer",w:"Ficha T\u00e9cnica",x:"visible",I:"Solid",a:317,y:"preserve",J:"Solid"},"74":{G:"#444444",bB:0,aU:8,aV:8,r:"inline",bC:0,e:"0.000000",t:14,Z:"break-word",aP:"pointer",v:"bold",w:"- Bobina Interna 15 Kg.",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"4",aS:8,aT:8,bA:"#000000",a:318,b:118},"90":{G:"#444444",aU:8,aV:8,r:"inline",e:"0.000000",s:"Courier,'Courier New',Monospace",t:56,Z:"break-word",aP:"pointer",v:"bold",w:"&gt;",aA:{type:1,transition:1,sceneSymbol:1},x:"visible",j:"absolute",k:"div",y:"preserve",z:"18",aS:8,aT:8,a:519,b:105},"72":{c:187,d:46,I:"Solid",e:"0.000000",J:"Solid",K:"Solid",g:"#F5F4F5",L:"Solid",aP:"pointer",M:1,N:1,j:"absolute",x:"visible",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},O:1,P:1,A:"#A0A0A0",C:"#A0A0A0",z:"2",B:"#A0A0A0",D:"#A0A0A0",k:"div",a:317,b:118},"75":{G:"#000000",bB:0,aU:8,aV:8,r:"inline",bC:0,e:"0.000000",f:"0deg",t:30,u:"normal",Z:"break-word",aP:"pointer",v:"bold",aY:"1",w:"NUEVA",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"5",aS:8,aT:8,bA:"#000000",a:307,b:31},"119":{o:"content-box",h:"Captura%20de%20pantalla%202012-07-13%20a%20la%28s%29%2019.29.17.png",x:"visible",a:506,q:"100% 100%",b:14,j:"absolute",r:"inline",c:41,z:"20",k:"div",d:12,e:"0.000000"}},timelines:{kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[{f:"2",t:0,d:0.53333336,i:"e",e:"1.000000",r:1,s:"0.000000",o:"72"},{f:"2",t:0,d:0.53333336,i:"e",e:"1.000000",r:1,s:"0.000000",o:"73"},{f:"2",t:0,d:0.53333336,i:"e",e:"1.000000",r:1,s:"0.000000",o:"74"},{f:"2",t:0,d:0.53333336,i:"e",e:"1.000000",r:1,s:"0.000000",o:"75"},{f:"2",t:0,d:0.53333336,i:"e",e:"1.000000",r:1,s:"0.000000",o:"76"},{f:"2",t:0,d:0.53333336,i:"e",e:"1.000000",r:1,s:"0.000000",o:"88"},{f:"2",t:0,d:0.53333336,i:"e",e:"1.000000",r:1,s:"0.000000",o:"90"},{f:"2",t:0,d:0.53333336,i:"e",e:"1.000000",r:1,s:"0.000000",o:"91"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"119"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"127"}],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:9}},sceneIndex:0,perspective:"600px",oid:"54",onSceneAnimationCompleteAction:{type:1,transition:1,sceneSymbol:1},backgroundColor:"#FFFFFF",name:"1"},{initialValues:{"34":{G:"#444444",aU:8,aV:8,r:"inline",e:"0.000000",t:14,Z:"break-word",aP:"pointer",v:"bold",w:"- Arrastra Hilo 4 Rodillos.",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",j:"absolute",k:"div",y:"preserve",z:"27",aS:8,aT:8,a:54,b:119},"128":{b:193,z:"53",K:"Solid",c:90,L:"Solid",d:15,aS:6,M:1,e:"0.000000",bD:"none",aT:6,N:1,O:1,g:"#8AAD48",aU:6,P:1,aV:6,j:"absolute",aI:4,k:"div",l:"0deg",aJ:4,m:"#000000",n:"#8AAD48",aK:4,aL:4,A:"#A0A0A0",B:"#A0A0A0",Z:"break-word",r:"inline",C:"#A0A0A0",D:"#A0A0A0",t:13,F:"center",v:"bold",G:"#FFFFFF",aP:"pointer",w:"Ficha T\u00e9cnica",x:"visible",I:"Solid",a:56,y:"preserve",J:"Solid"},"32":{G:"#000000",bB:0,aU:8,aV:8,r:"inline",bC:0,e:"0.000000",f:"0deg",t:30,u:"normal",Z:"break-word",aP:"pointer",v:"bold",aY:"1",w:"NUEVA",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"28",aS:8,aT:8,bA:"#000000",a:49,b:32},"92":{G:"#444444",bB:0,aU:8,aV:8,bC:0,r:"inline",e:"0.000000",s:"Courier,'Courier New',Monospace",t:56,Z:"break-word",aP:"pointer",v:"bold",w:"&gt;",aA:{type:1,transition:1,sceneSymbol:1},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"49",aS:8,aT:8,bA:"#000000",a:518,b:105},"35":{G:"#444444",bB:0,aU:8,aV:8,r:"inline",bC:0,e:"0.000000",t:14,Z:"break-word",aP:"pointer",v:"bold",w:"- Sistema de Enfriamiento<div>&nbsp; por Agua.</div>",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"26",aS:8,aT:8,bA:"#000000",a:54,b:138},"97":{o:"content-box",h:"jaja.png",x:"visible",a:251,q:"100% 100%",b:5,j:"absolute",r:"inline",c:270,z:"32",k:"div",d:280,e:"0.000000"},"121":{o:"content-box",h:"Captura%20de%20pantalla%202012-07-13%20a%20la%28s%29%2019.29.08.png",x:"visible",a:506,q:"100% 100%",b:14,j:"absolute",r:"inline",c:41,z:"52",k:"div",d:12,e:"0.000000"},"33":{G:"#444444",aU:8,aV:8,r:"inline",e:"0.000000",f:"0deg",t:18,Y:18,Z:"break-word",aP:"pointer",v:"bold",aY:"1",w:"M\u00e1quina Soldadora<div><font class=\"Apple-style-span\" color=\"#cb2e27\">MIG - MAG &nbsp;TM 650 W</font></div>",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",j:"absolute",k:"div",y:"preserve",z:"29",aS:8,E:-1,aT:8,a:49,b:65},"93":{G:"#444444",bB:0,aU:8,aV:8,bC:0,r:"inline",e:"0.000000",s:"Courier,'Courier New',Monospace",t:56,Z:"break-word",aP:"pointer",v:"bold",w:"&lt;",aA:{type:1,transition:1,sceneSymbol:2},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"50",aS:8,aT:8,bA:"#000000",a:1,b:105},"31":{c:189,d:64,I:"Solid",e:"0.000000",J:"Solid",K:"Solid",g:"#F5F4F5",L:"Solid",aP:"pointer",M:1,N:1,j:"absolute",x:"visible",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},O:1,P:1,A:"#A0A0A0",C:"#A0A0A0",z:"25",B:"#A0A0A0",D:"#A0A0A0",k:"div",a:56,b:119}},timelines:{kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"31"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"35"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"34"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"32"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"33"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"97"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"92"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"93"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"121"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"128"}],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:10}},sceneIndex:1,perspective:"600px",oid:"1",onSceneAnimationCompleteAction:{type:1,transition:1,sceneSymbol:1},backgroundColor:"#FFFFFF",name:"2"},{onSceneLoadAction:{type:0},initialValues:{"122":{o:"content-box",h:"Captura%20de%20pantalla%202012-07-13%20a%20la%28s%29%2019.29.25.png",x:"visible",a:506,q:"100% 100%",b:14,j:"absolute",r:"inline",c:41,z:"58",k:"div",d:12,e:"0.000000"},"99":{G:"#444444",aU:8,aV:8,r:"inline",e:"0.000000",t:14,Z:"break-word",aP:"pointer",v:"bold",w:"- Arrastra Hilo 4 Rodillos.",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",j:"absolute",k:"div",y:"preserve",z:"27",aS:8,aT:8,a:324,b:125},"102":{G:"#000000",bB:0,aU:8,aV:8,r:"inline",bC:0,e:"0.000000",f:"0deg",t:30,u:"normal",Z:"break-word",aP:"pointer",v:"bold",aY:"1",w:"NUEVA",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"28",aS:8,aT:8,bA:"#000000",a:319,b:38},"105":{G:"#444444",bB:0,aU:8,aV:8,bC:0,r:"inline",e:"0.000000",s:"Courier,'Courier New',Monospace",t:56,Z:"break-word",aP:"pointer",v:"bold",w:"&lt;",aA:{type:1,transition:1,sceneSymbol:2},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"56",aS:8,aT:8,bA:"#000000",a:0,b:105},"112":{o:"content-box",h:"kk.png",x:"visible",a:52,q:"100% 100%",b:34,j:"absolute",r:"inline",c:251,z:"31",k:"div",d:240,e:"0.000000"},"101":{G:"#444444",bB:0,aU:8,aV:8,bC:0,r:"inline",e:"0.000000",s:"Courier,'Courier New',Monospace",t:56,Z:"break-word",aP:"pointer",v:"bold",w:"&gt;",aA:{type:1,transition:1,sceneOid:"54"},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"55",aS:8,aT:8,bA:"#000000",a:518,b:105},"104":{G:"#444444",aU:8,aV:8,r:"inline",e:"0.000000",f:"0deg",t:18,Y:18,Z:"break-word",aP:"pointer",v:"bold",aY:"1",w:"M\u00e1quina Inversora<div><font class=\"Apple-style-span\" color=\"#cb2e27\">MIG - MAG &nbsp;TM 500&nbsp;</font></div>",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",j:"absolute",k:"div",y:"preserve",z:"29",aS:8,E:-1,aT:8,a:319,b:71},"123":{G:"#444444",bB:0,aU:8,aV:8,r:"inline",bC:0,e:"0.000000",t:14,Z:"break-word",aP:"pointer",v:"bold",w:"- Control Digital.",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"32",aS:8,aT:8,bA:"#000000",a:324,b:161},"98":{c:189,d:64,I:"Solid",e:"0.000000",J:"Solid",K:"Solid",g:"#F5F4F5",L:"Solid",aP:"pointer",M:1,N:1,j:"absolute",x:"visible",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},O:1,P:1,A:"#A0A0A0",C:"#A0A0A0",z:"25",B:"#A0A0A0",D:"#A0A0A0",k:"div",a:326,b:125},"103":{G:"#444444",bB:0,aU:8,aV:8,r:"inline",bC:0,e:"0.000000",t:14,Z:"break-word",aP:"pointer",v:"bold",w:"- Bobina Interna 15 Kg.",aA:{goToURL:"www.solcotec.cl",type:5,openInNewWindow:false},x:"visible",aZ:0,j:"absolute",y:"preserve",k:"div",z:"26",aS:8,aT:8,bA:"#000000",a:324,b:143},"129":{b:199,z:"59",K:"Solid",c:90,L:"Solid",d:15,aS:6,M:1,e:"0.000000",bD:"none",aT:6,N:1,O:1,g:"#8AAD48",aU:6,P:1,aV:6,j:"absolute",aI:4,k:"div",l:"0deg",aJ:4,m:"#000000",n:"#8AAD48",aK:4,aL:4,A:"#A0A0A0",B:"#A0A0A0",Z:"break-word",r:"inline",C:"#A0A0A0",D:"#A0A0A0",t:13,F:"center",v:"bold",G:"#FFFFFF",aP:"pointer",w:"Ficha T\u00e9cnica",x:"visible",I:"Solid",a:326,y:"preserve",J:"Solid"}},timelines:{kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"105"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"99"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"102"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"101"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"103"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"104"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"98"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"122"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"112"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"123"},{f:"2",t:0,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"129"}],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:10}},sceneIndex:2,perspective:"600px",oid:"108",onSceneAnimationCompleteAction:{type:1,transition:1,sceneOid:"54"},backgroundColor:"#FFFFFF",name:"3"}];


	
	var javascripts = [];


	
	var Custom = {};
	var javascriptMapping = {};
	for(var i = 0; i < javascripts.length; i++) {
		try {
			javascriptMapping[javascripts[i].identifier] = javascripts[i].name;
			eval("Custom." + javascripts[i].name + " = " + javascripts[i].source);
		} catch (e) {
			hypeDoc.log(e);
			Custom[javascripts[i].name] = (function () {});
		}
	}
	
	hypeDoc.setAttributeTransformerMapping(attributeTransformerMapping);
	hypeDoc.setScenes(scenes);
	hypeDoc.setJavascriptMapping(javascriptMapping);
	hypeDoc.Custom = Custom;
	hypeDoc.setCurrentSceneIndex(0);
	hypeDoc.setMainContentContainerID("animacion_hype_container");
	hypeDoc.setResourcesFolderName(resourcesFolderName);
	hypeDoc.setShowHypeBuiltWatermark(0);
	hypeDoc.setShowLoadingPage(true);
	hypeDoc.setDrawSceneBackgrounds(true);
	hypeDoc.setDocumentName(documentName);

	HYPE.documents[documentName] = hypeDoc.API;

	hypeDoc.documentLoad(this.body);
}());

