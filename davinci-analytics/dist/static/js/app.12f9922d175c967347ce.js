webpackJsonp([1],{"8Zu9":function(t,e){},Cvst:function(t,e){},EfbN:function(t,e){},MeB6:function(t,e){},NHnr:function(t,e,r){"use strict";function n(t){r("8Zu9")}function a(t){r("hHOE")}function s(t){r("EfbN")}function o(t){r("Cvst")}function i(t){r("WVht")}function l(t){r("MeB6")}Object.defineProperty(e,"__esModule",{value:!0});var c=r("7+uW"),u={name:"app",data:function(){return{records:[]}},computed:{totalHours:function(){if(this.records.length>1){return this.records.reduce(function(t,e){return parseInt(t)+parseInt(e.eventHours)},0)}return 0}},created:function(){this.getData()},methods:{getData:function(){var t=this;fetch("https://rampages.us/davinci-events/wp-json/davinci/v1/data").then(function(t){return t.json()}).then(function(e){console.log(t.records),t.records=e})}}},d=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{attrs:{id:"app"}},[r("div",{staticClass:"wrapper"},[r("nav",{staticClass:"sidebar"},[r("ul",[r("li",[r("router-link",{attrs:{to:"/"}},[r("svg",{staticClass:"fil0",attrs:{"xmlns:dc":"http://purl.org/dc/elements/1.1/","xmlns:cc":"http://creativecommons.org/ns#","xmlns:rdf":"http://www.w3.org/1999/02/22-rdf-syntax-ns#","xmlns:svg":"http://www.w3.org/2000/svg",xmlns:"http://www.w3.org/2000/svg","xmlns:sodipodi":"http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd","xmlns:inkscape":"http://www.inkscape.org/namespaces/inkscape",version:"1.1",x:"0px",y:"0px",viewBox:"0 0 100 100"}},[r("g",{attrs:{transform:"translate(0,-952.36218)"}},[r("path",{staticStyle:{"text-indent":"0","text-transform":"none",direction:"ltr","block-progression":"tb","baseline-shift":"baseline",color:"#000000","enable-background":"accumulate"},attrs:{d:"m 59,958.36219 c -4.9587,0 -9,4.04127 -9,9 0,3.38475 1.8839,6.36989 4.6562,7.90625 l -5.0624,16.90623 c -1.4423,-0.5034 -2.982,-0.8125 -4.5938,-0.8125 -4.514,0 -8.532,2.1735 -11.0938,5.5 l -14,-13.12498 C 21.1991,982.3153 22,980.42771 22,978.36219 c 0,-4.40644 -3.5936,-8 -8,-8 -4.4064,0 -8,3.59356 -8,8 0,4.40644 3.5936,8 8,8 1.6114,0 3.117,-0.45604 4.375,-1.28125 l 14.4062,13.50003 C 31.656,1000.5963 31,1002.8945 31,1005.3622 c 0,3.4963 1.2798,6.7003 3.4062,9.1562 L 22,1026.8934 c -1.9024,-1.5707 -4.3474,-2.5312 -7,-2.5312 -6.0632,0 -11,4.9366 -11,11 0,6.0632 4.9367,11 11,11 6.0633,0 11,-4.9368 11,-11 0,-2.6773 -0.9655,-5.1213 -2.5625,-7.0313 l 12.4063,-12.4062 c 2.458,2.1346 5.6524,3.4375 9.1562,3.4375 5.034,0 9.4388,-2.6578 11.9062,-6.6563 l 15.4376,5.1563 c -0.209,0.8034 -0.3438,1.6324 -0.3438,2.5 0,5.511 4.489,10 10,10 5.511,0 10,-4.489 10,-10 0,-5.511 -4.489,-10 -10,-10 -3.9266,0 -7.3338,2.29 -8.9688,5.5937 l -15.1562,-5.0312 c 0.7338,-1.6985 1.125,-3.5976 1.125,-5.5625 0,-1.5872 -0.2611,-3.1078 -0.75,-4.5312 l 25.5938,-13.71881 c 1.2813,1.39613 3.1205,2.25 5.1562,2.25 3.8541,0 7,-3.14586 7,-7 0,-3.85414 -3.1459,-7 -7,-7 -3.8541,0 -7,3.14586 -7,7 0,1.09625 0.2658,2.13695 0.7188,3.0625 l -25.2813,13.53128 c -1.3233,-2.5533 -3.4229,-4.6331 -5.9687,-5.9688 l 5.0937,-16.96873 c 0.7738,0.21777 1.5955,0.34375 2.4375,0.34375 4.9587,0 9,-4.04127 9,-9 0,-4.95873 -4.0413,-9 -9,-9 z m 0,2 c 3.8779,0 7,3.12213 7,7 0,3.87787 -3.1221,7 -7,7 -3.8779,0 -7,-3.12213 -7,-7 0,-3.87787 3.1221,-7 7,-7 z m -45,12 c 3.3256,0 6,2.67444 6,6 0,3.32556 -2.6744,6 -6,6 -3.3256,0 -6,-2.67444 -6,-6 0,-3.32556 2.6744,-6 6,-6 z m 75,5 c 2.7733,0 5,2.22674 5,5 0,2.77326 -2.2267,5 -5,5 -1.631,0 -3.0576,-0.77017 -3.9688,-1.96875 l -0.5,-0.9375 -0.062,0.0312 C 84.173,983.84749 84,983.11659 84,982.36219 c 0,-2.77326 2.2267,-5 5,-5 z m -44,15.99998 c 6.6393,0 12,5.3608 12,12.00003 0,6.6392 -5.3607,12 -12,12 -6.6393,0 -12,-5.3608 -12,-12 0,-6.63923 5.3607,-12.00003 12,-12.00003 z m 37,19.00003 c 4.4302,0 8,3.5698 8,8 0,4.4302 -3.5698,8 -8,8 -4.4302,0 -8,-3.5698 -8,-8 0,-4.4302 3.5698,-8 8,-8 z m -67,14 c 4.9824,0 9,4.0175 9,9 0,4.9823 -4.0177,9 -9,9 -4.9823,0 -9,-4.0177 -9,-9 0,-4.9825 4.0176,-9 9,-9 z","fill-opacity":"1",stroke:"none",marker:"none",visibility:"visible",display:"inline",overflow:"visible"}})])]),t._v("\n          Overview\n          ")])],1),t._v(" "),r("li",[r("router-link",{attrs:{to:"/events"}},[r("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",version:"1.1",x:"0px",y:"0px",viewBox:"0 0 100 100","enable-background":"new 0 0 100 100","xml:space":"preserve"}},[r("path",{attrs:{d:"M78.125,11.33h-4.25V3.973h-8v7.357h-32V3.973h-8v7.357h-4c-6.617,0-12,5.383-12,12v60.697c0,6.617,5.383,12,12,12h56.25  c6.617,0,12-5.383,12-12V23.33C90.125,16.713,84.742,11.33,78.125,11.33z M82.125,84.027c0,2.205-1.794,4-3,4h-56.25  c-3.206,0-5-1.795-5-4v-49h64.25V84.027z M62.282,40.762H52.203v11.277h10.079V40.762z M62.282,72.234H52.203v11.277h10.079V72.234z   M62.282,56.9H52.203v11.277h10.079V56.9z M76.768,40.762H66.688v11.277h10.079V40.762z M76.768,72.234H66.688v11.277h10.079V72.234  z M76.768,56.9H66.688v11.277h10.079V56.9z M33.311,56.9H23.231v11.277h10.079V56.9z M33.311,72.234H23.231v11.277h10.079V72.234z   M33.311,40.762H23.231v11.277h10.079V40.762z M47.796,56.9H37.717v11.277h10.079V56.9z M47.796,72.234H37.717v11.277h10.079V72.234  z M47.796,40.762H37.717v11.277h10.079V40.762z"}})]),t._v("\n          Events")])],1),t._v(" "),r("li",[r("router-link",{attrs:{to:"/students"}},[r("svg",{attrs:{"xmlns:dc":"http://purl.org/dc/elements/1.1/","xmlns:cc":"http://creativecommons.org/ns#","xmlns:rdf":"http://www.w3.org/1999/02/22-rdf-syntax-ns#","xmlns:svg":"http://www.w3.org/2000/svg",xmlns:"http://www.w3.org/2000/svg","xmlns:sodipodi":"http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd","xmlns:inkscape":"http://www.inkscape.org/namespaces/inkscape",viewBox:"0 0 1171.932 1111.4528",version:"1.1",x:"0px",y:"0px"}},[r("g",{attrs:{transform:"translate(43298.519,-5180.4159)"}},[r("path",{attrs:{d:"m -42409.019,6290.6395 c -46.466,-5.9624 -92.284,-25.4252 -128.246,-54.4776 -18.416,-14.8775 -41.518,-40.7316 -53.925,-60.3489 -28.743,-45.4489 -42.814,-101.0357 -38.722,-152.9711 6.275,-79.6344 46.466,-148.7032 112.148,-192.727 21.692,-14.5393 49.942,-27.168 75.279,-33.6526 24.917,-6.3771 34.094,-7.4451 63.97,-7.4451 29.876,0 39.053,1.068 63.97,7.4451 64.067,16.3967 120.357,59.3731 154.261,117.7766 46.856,80.7136 44.702,182.1068 -5.556,261.5741 -12.407,19.6173 -35.509,45.4714 -53.925,60.3489 -36.627,29.5891 -82.05,48.6686 -129.967,54.5918 -12.439,1.5376 -46.932,1.4712 -59.287,-0.1143 z m 68.1,-62.1948 c 36.652,-7.9441 70.859,-26.0676 96.573,-51.1668 19.501,-19.0342 39.452,-51.2429 47.702,-77.0091 7.029,-21.9507 8.674,-33.2314 8.674,-59.4558 0,-26.2245 -1.645,-37.5051 -8.674,-59.4558 -8.25,-25.7663 -28.201,-57.9749 -47.702,-77.0091 -19.408,-18.9439 -49.851,-37.4454 -74.713,-45.4061 -21.951,-7.0285 -33.232,-8.6743 -59.456,-8.6743 -26.224,0 -37.505,1.6458 -59.456,8.6743 -24.862,7.9607 -55.305,26.4622 -74.713,45.4061 -19.501,19.0342 -39.452,51.2428 -47.702,77.0091 -7.029,21.9507 -8.674,33.2313 -8.674,59.4558 0,20.4643 0.441,26.3934 2.749,36.9558 4.166,19.068 8.305,30.8122 17.151,48.6692 27.266,55.044 76.932,91.6752 140.02,103.2723 17.054,3.135 50.807,2.5088 68.221,-1.2656 z m -170.096,-145.7567 0,-41.875 35,0 35,0 0,41.875 0,41.875 -35,0 -35,0 0,-41.875 z m 97.5,-41.875 0,-83.75 35,0 35,0 0,83.75 0,83.75 -35,0 -35,0 0,-83.75 z m 100,41.875 0,-41.875 35.625,0 35.625,0 0,41.875 0,41.875 -35.625,0 -35.625,0 0,-41.875 z m -984.988,192.1875 c 0,-3.2656 0.853,-13.25 1.881,-22.1875 1.027,-8.9375 2.424,-21.5938 3.105,-28.125 0.68,-6.5313 2.668,-17.7813 4.417,-25 1.75,-7.2188 3.67,-16.2188 4.268,-20 0.598,-3.7813 1.742,-8.5625 2.542,-10.625 0.799,-2.0625 3.033,-9.375 4.963,-16.25 3.175,-11.3091 5.863,-19.0518 15.404,-44.375 3.796,-10.0771 16.601,-37.364 21.221,-45.2226 1.89,-3.2162 3.437,-6.3747 3.437,-7.0189 0,-0.6443 1.041,-2.5128 2.314,-4.1524 1.272,-1.6396 4.159,-6.319 6.415,-10.3985 2.256,-4.0796 5.153,-8.5451 6.437,-9.9232 1.283,-1.3782 2.369,-3.1029 2.412,-3.8326 0.175,-2.9851 27.466,-40.3471 39.72,-54.3786 8.585,-9.8295 45.364,-46.6958 57.84,-57.9766 2.906,-2.6281 10.041,-8.2531 15.855,-12.5 5.813,-4.2469 12.771,-9.523 15.461,-11.7247 2.69,-2.2017 9.228,-6.6814 14.531,-9.9549 5.302,-3.2734 9.921,-6.3302 10.265,-6.7927 0.344,-0.4626 3.438,-2.42 6.875,-4.3499 3.438,-1.9299 8.301,-4.6655 10.808,-6.0792 14.61,-8.2377 29.249,-15.8269 38.567,-19.9931 5.844,-2.6129 14.705,-6.6523 19.691,-8.9764 4.986,-2.3242 9.656,-4.2257 10.376,-4.2257 0.72,0 5.64,-1.6457 10.934,-3.6572 33.451,-12.7111 84.176,-24.329 115.874,-26.5394 88.733,-6.1877 159.319,2.1987 223.374,26.5394 5.294,2.0115 10.356,3.6658 11.25,3.6763 0.894,0.01 2.413,0.5177 3.376,1.1271 1.354,0.8571 -1.015,4.3182 -10.464,15.2933 -36.721,42.6484 -60.618,95.3522 -69.026,152.2375 -2.971,20.0946 -2.938,62.734 0.06,83.198 7.578,51.6536 28.587,101.36 59.548,140.8823 10.917,13.9358 35.821,38.6854 48.128,47.8287 5.5,4.0862 10.534,7.876 11.188,8.4217 0.653,0.5458 -161.769,0.9923 -360.938,0.9923 l -362.125,0 0.01,-5.9375 z m 479.363,-532.0583 c -0.687,-0.2671 -5.469,-1.1458 -10.625,-1.9528 -21.385,-3.3466 -44.647,-10.722 -62.467,-19.8048 -12.458,-6.3499 -30.348,-17.5752 -35.716,-22.4108 -1.35,-1.2159 -5.969,-5.2214 -10.266,-8.9011 -9.662,-8.2764 -29.528,-30.9534 -35.203,-40.1847 -26.778,-43.5627 -35.098,-76.9635 -35.098,-140.9033 0,-18.0657 0.448,-32.8467 0.996,-32.8467 0.548,0 4.907,2.5903 9.688,5.7562 15.576,10.3163 23.986,15.206 53.066,30.8537 5.156,2.7746 15.15,8.2936 22.208,12.2646 7.058,3.971 13.949,7.5742 15.313,8.007 1.363,0.4328 2.479,1.3116 2.479,1.9527 0,0.6412 0.582,1.1658 1.293,1.1658 0.712,0 5.634,2.4535 10.938,5.4523 5.304,2.9988 15.269,8.4348 22.144,12.0801 6.875,3.6453 16.719,8.9979 21.875,11.8947 5.156,2.8968 18.243,9.8719 29.082,15.5002 l 19.707,10.2333 20.293,-10.7199 c 11.161,-5.8959 23.668,-12.6109 27.793,-14.9221 4.125,-2.3112 19.875,-10.9353 35,-19.1645 15.125,-8.2293 32.281,-17.6502 38.125,-20.9354 5.844,-3.2852 15.969,-8.7962 22.5,-12.2467 6.531,-3.4504 16.938,-9.1055 23.125,-12.5667 6.188,-3.4613 13.781,-7.652 16.875,-9.3128 8.69,-4.6649 26.273,-15.568 26.998,-16.7416 2.365,-3.8271 3.001,1.4567 2.996,24.8866 0,27.7044 -1.823,44.484 -7.973,73.6088 -8.209,38.8813 -22.856,69.0469 -47.506,97.8368 -31.824,37.1692 -72.739,60.0781 -125.14,70.0667 -7.224,1.377 -49.941,3.0485 -52.5,2.0544 z m 12.374,-195.2583 c -3.368,-1.7897 -10.624,-5.6716 -16.124,-8.6263 -5.5,-2.9547 -33.344,-17.8768 -61.875,-33.1603 -81.319,-43.5605 -89.085,-47.7252 -137.5,-73.7359 -34.536,-18.5542 -56.399,-30.2649 -89.762,-48.0797 -18.006,-9.6146 -32.738,-17.8631 -32.738,-18.3299 0,-0.4667 7.172,-4.632 15.938,-9.2561 8.765,-4.6241 19.312,-10.2337 23.437,-12.4658 20.075,-10.8632 55.074,-29.6489 66.25,-35.5604 6.875,-3.6365 14.188,-7.5881 16.25,-8.7815 2.063,-1.1934 9.375,-5.1459 16.25,-8.7834 6.875,-3.6375 26.844,-14.3206 44.375,-23.7401 17.531,-9.4196 49.031,-26.3051 70,-37.5232 20.969,-11.2182 46.844,-25.0986 57.5,-30.8453 10.656,-5.7467 22.827,-12.2051 27.046,-14.3519 l 7.671,-3.9032 20.454,10.9965 c 52.789,28.3809 52.092,28.0071 132.954,71.2983 24.063,12.8824 48.531,25.9589 54.375,29.0588 5.844,3.1 12.313,6.6099 14.375,7.7998 2.063,1.1899 9.375,5.1246 16.25,8.7437 6.875,3.6191 14.188,7.5559 16.25,8.7484 2.063,1.1925 10.5,5.6932 18.75,10.0016 8.25,4.3084 16.688,8.8122 18.75,10.0086 2.063,1.1963 8.25,4.5642 13.75,7.484 5.5,2.9199 16.328,8.6659 24.063,12.769 7.734,4.103 14.062,7.8447 14.062,8.3149 0,0.4703 -2.109,1.967 -4.687,3.3261 -2.579,1.3591 -14.25,7.5896 -25.938,13.8456 -48.237,25.8198 -75.592,40.3432 -85.625,45.4608 -5.844,2.9807 -12.594,6.6546 -15,8.1641 -2.406,1.5096 -12.812,7.2549 -23.125,12.7676 -28.65,15.315 -47.952,25.6617 -121.614,65.1913 -37.325,20.0299 -68.038,36.418 -68.251,36.418 -0.213,0 -3.143,-1.4643 -6.511,-3.2541 z"}})])]),t._v("\n          Students")])],1),t._v(" "),r("li",[r("router-link",{attrs:{to:"/program"}},[r("svg",{staticStyle:{"enable-background":"new 0 0 100 100"},attrs:{xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",version:"1.1",x:"0px",y:"0px",viewBox:"0 0 100 100","xml:space":"preserve"}},[r("path",{attrs:{d:"M73,45.059V32c0-0.552-0.448-1-1-1H62c0-6.617-5.383-12-12-12s-12,5.383-12,12H28c-0.552,0-1,0.448-1,1v13.059  c-4.493,0.5-8,4.317-8,8.941c0,4.962,4.038,9,9,9s9-4.038,9-9c0-4.624-3.507-8.441-8-8.941V33h9.181  c0.902,5.344,5.339,9.494,10.819,9.949v20.11c-4.493,0.5-8,4.317-8,8.941c0,4.962,4.038,9,9,9s9-4.038,9-9  c0-4.624-3.507-8.441-8-8.941v-20.11c5.481-0.455,9.917-4.606,10.819-9.949H71v12.059c-4.493,0.5-8,4.317-8,8.941  c0,4.962,4.038,9,9,9s9-4.038,9-9C81,49.376,77.493,45.559,73,45.059z M24.023,59.754c0.582-0.991,1.498-1.754,2.585-2.094  c0.383-0.12,0.657-0.456,0.697-0.855s-0.162-0.783-0.513-0.976c-0.813-0.446-1.317-1.288-1.317-2.196c0-1.389,1.13-2.519,2.52-2.519  s2.519,1.13,2.519,2.519c0,0.908-0.505,1.75-1.317,2.196c-0.351,0.193-0.553,0.577-0.513,0.976s0.314,0.735,0.697,0.855  c1.089,0.34,2.007,1.105,2.589,2.1C30.84,60.54,29.473,61,28,61C26.523,61,25.154,60.538,24.023,59.754z M35,54  c0,1.647-0.575,3.16-1.531,4.357c-0.519-0.763-1.19-1.41-1.964-1.898c0.641-0.79,1.007-1.782,1.007-2.826  c0-2.492-2.027-4.519-4.519-4.519c-2.492,0-4.52,2.027-4.52,4.519c0,1.043,0.366,2.036,1.007,2.826  c-0.771,0.486-1.44,1.13-1.958,1.889C21.573,57.152,21,55.643,21,54c0-3.86,3.14-7,7-7S35,50.14,35,54z M48.089,34.488  C46.8,33.78,46,32.443,46,31c0-2.206,1.794-4,4-4s4,1.794,4,4c0,1.443-0.8,2.78-2.089,3.488c-0.352,0.193-0.553,0.577-0.514,0.976  c0.04,0.398,0.314,0.735,0.696,0.855c1.516,0.474,2.828,1.479,3.714,2.806C54.168,40.3,52.167,41,50,41s-4.168-0.7-5.808-1.875  c0.886-1.326,2.198-2.331,3.714-2.806c0.382-0.12,0.656-0.457,0.696-0.855C48.642,35.065,48.44,34.681,48.089,34.488z   M46.023,77.754c0.582-0.991,1.498-1.754,2.585-2.094c0.383-0.12,0.657-0.456,0.697-0.855s-0.162-0.783-0.513-0.976  c-0.813-0.446-1.317-1.288-1.317-2.196c0-1.389,1.13-2.519,2.52-2.519s2.519,1.13,2.519,2.519c0,0.908-0.505,1.75-1.317,2.196  c-0.351,0.193-0.553,0.577-0.513,0.976s0.314,0.735,0.697,0.855c1.089,0.34,2.007,1.105,2.589,2.1C52.84,78.54,51.473,79,50,79  C48.523,79,47.154,78.538,46.023,77.754z M57,72c0,1.647-0.575,3.16-1.531,4.357c-0.519-0.763-1.19-1.41-1.964-1.898  c0.641-0.79,1.007-1.782,1.007-2.826c0-2.492-2.027-4.519-4.519-4.519c-2.492,0-4.52,2.027-4.52,4.519  c0,1.043,0.366,2.036,1.007,2.826c-0.771,0.486-1.44,1.13-1.958,1.889C43.573,75.152,43,73.643,43,72c0-3.86,3.14-7,7-7  S57,68.14,57,72z M57.32,37.79c-0.786-1.103-1.807-2.02-2.982-2.672C55.389,34.02,56,32.552,56,31c0-3.309-2.691-6-6-6s-6,2.691-6,6  c0,1.552,0.611,3.02,1.662,4.118c-1.175,0.652-2.197,1.569-2.982,2.672C41.022,36.005,40,33.622,40,31c0-5.514,4.486-10,10-10  s10,4.486,10,10C60,33.622,58.978,36.005,57.32,37.79z M68.023,59.754c0.582-0.991,1.498-1.754,2.585-2.094  c0.383-0.12,0.657-0.456,0.697-0.855s-0.162-0.783-0.513-0.976c-0.813-0.446-1.317-1.288-1.317-2.196c0-1.389,1.13-2.519,2.52-2.519  s2.519,1.13,2.519,2.519c0,0.908-0.505,1.75-1.317,2.196c-0.351,0.193-0.553,0.577-0.513,0.976s0.314,0.735,0.697,0.855  c1.089,0.34,2.007,1.105,2.589,2.1C74.84,60.54,73.473,61,72,61C70.523,61,69.154,60.538,68.023,59.754z M77.469,58.357  c-0.519-0.763-1.19-1.41-1.964-1.898c0.641-0.79,1.007-1.782,1.007-2.826c0-2.492-2.027-4.519-4.519-4.519  c-2.492,0-4.52,2.027-4.52,4.519c0,1.043,0.366,2.036,1.007,2.826c-0.771,0.486-1.44,1.13-1.958,1.889  C65.573,57.152,65,55.643,65,54c0-3.86,3.14-7,7-7s7,3.14,7,7C79,55.647,78.425,57.16,77.469,58.357z"}})]),t._v("\n          Program")])],1)])]),t._v(" "),r("div",{staticClass:"main-view"},[r("router-view")],1)])])},h=[],v={render:d,staticRenderFns:h},p=v,f=r("VU/8"),m=n,g=f(u,p,!1,m,null,null),_=g.exports,x=r("/ocq"),C=(r("wDpx"),r("9EFi"),r("Z3P3"),r("qb6w"),r("vwbq")),w={name:"Index",data:function(){return{msg:"Innovate LLP Analytics",subtitle:"VCU Innovate LLP equips innovative entrepreneurs with a human-centered design foundation to launch new ventures or products."}},computed:{records:function(){return this.$parent.records},totalHours:function(){if(this.$parent.records.length>1){return this.records.reduce(function(t,e){return parseInt(t)+parseInt(e.eventHours)},0)}return 0},eventList:function(){function t(t,e,r){return r.indexOf(t)===e}var e=this.records.map(function(t){return t.eventTitle});return e=e.filter(t)},reflectionsByMonth:function(){var t=[];return this.records.map(function(t){return t.postDate.split(" ")[0].split("-")[1]}).forEach(function(e){var r=!1;if(t.forEach(function(t){t.month===e&&(t.count++,r=!0)}),!r){var n={month:e,count:1};t.push(n)}}),t},eventsByMonth:function(){var t=this.records.map(function(t){return{month:t.postDate.split(" ")[0].split("-")[1],eventID:t.eventID}}),e=[];t.forEach(function(t){var r=!1;if(e.forEach(function(e){e.month===t.month&&(e.events.push(t.eventID),r=!0)}),!r){var n={month:t.month,events:[]};n.events.push(t.eventID),e.push(n)}});var r=function(t){return t.filter(function(e,r){return t.indexOf(e)===r})};return e.forEach(function(t){t.events=r(t.events)}),e=e.map(function(t){return{month:t.month,count:t.events.length}})},hoursLoggedByMonth:function(){var t=[];return this.records.map(function(t){return{month:t.postDate.split(" ")[0].split("-")[1],hours:t.eventHours}}).forEach(function(e){var r=!1;if(t.forEach(function(t){t.month===e.month&&(t.count=t.count+parseInt(e.hours),r=!0)}),!r){var n={month:e.month,count:parseInt(e.hours)};t.push(n)}}),t},networkStructure:function(){function t(t){var e={};return t.filter(function(t){return!e.hasOwnProperty(t)&&(e[t]=!0)})}var e={nodes:[],links:[]},r={};this.$parent.records.forEach(function(t){r[t.userEmail]={id:t.userEmail,group:t.userMajor?t.userMajor:"N/A"}});for(var n in r)e.nodes.push(r[n]);var a={};this.records.forEach(function(t){a[t.eventID]?a[t.eventID].push(t):(a[t.eventID]=[],a[t.eventID].push(t))});for(var s in a){var o;!function(){o=a[s],o.sort(function(t,e){var r=t.userEmail.toUpperCase(),n=e.userEmail.toUpperCase();return r<n?-1:r>n?1:0});var e=[];o.forEach(function(t){e.push(t.userEmail)});var r=t(e);a[s]=r}()}var i={};for(var l in a)for(var c=a[l],u=0;u<c.length;u++){i[c[u]]||(i[c[u]]={});var d=u+1;for(d;d<c.length;d++)void 0===i[c[u]][c[d]]?i[c[u]][c[d]]=1:i[c[u]][c[d]]++}for(var h in i)for(var v in i[h]){var p={source:h,target:v,value:i[h][v]};e.links.push(p)}return e}},filters:{},updated:function(){console.log(this.networkStructure),this.clearNetworkDiagram(),this.makeNetworkDiagram(),this.makeSparklineChart("line1",this.eventsByMonth,"month","count"),this.makeSparklineChart("line2",this.hoursLoggedByMonth,"month","count"),this.makeSparklineChart("line3",this.reflectionsByMonth,"month","count")},methods:{makeNetworkDiagram:function(){function t(){u.attr("x1",function(t){return t.source.x}).attr("y1",function(t){return t.source.y}).attr("x2",function(t){return t.target.x}).attr("y2",function(t){return t.target.y}),d.attr("cx",function(t){return t.x}).attr("cy",function(t){return t.y})}function e(t){console.log(t)}function r(t){C.b.active||c.alphaTarget(.3).restart(),t.fx=t.x,t.fy=t.y}function n(t){t.fx=C.b.x,t.fy=C.b.y}function a(t){C.b.active||c.alphaTarget(0),t.fx=null,t.fy=null}var s=C.i("#network"),o=+s.attr("width"),i=+s.attr("height"),l=C.g(C.h),c=C.f().force("link",C.d().id(function(t){return t.id})).force("charge",C.e()).force("center",C.c(o/2,i/2)),u=s.append("g").attr("class","links").selectAll("line").data(this.networkStructure.links).enter().append("line").attr("stroke-width",function(t){return Math.sqrt(t.value)}),d=s.append("g").attr("class","nodes").selectAll("circle").data(this.networkStructure.nodes).enter().append("circle").attr("r",5).attr("fill",function(t){return l(t.group)}).on("click",e).call(C.a().on("start",r).on("drag",n).on("end",a));d.append("title").text(function(t){return t.id}),c.nodes(this.networkStructure.nodes).on("tick",t),c.force("link").links(this.networkStructure.links)},clearNetworkDiagram:function(){C.j("svg#network > g").remove()},makeSparklineChart:function(t,e,r,n){window.AmCharts.makeChart(t,{type:"serial",dataProvider:e,categoryField:r,autoMargins:!1,marginLeft:0,marginRight:0,marginTop:0,marginBottom:0,graphs:[{valueField:n,lineColor:"#a9ec49",showBalloon:!1}],valueAxes:[{gridAlpha:0,axisAlpha:0}],categoryAxis:{gridAlpha:0,axisAlpha:0}})}},mounted:function(){this.clearNetworkDiagram(),this.makeNetworkDiagram(),this.makeSparklineChart("line1",this.eventsByMonth,"month","count"),this.makeSparklineChart("line2",this.hoursLoggedByMonth,"month","count"),this.makeSparklineChart("line3",this.reflectionsByMonth,"month","count")}},b=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row mt-3"},[r("div",{staticClass:"col-lg-12"},[r("h1",[t._v(t._s(t.msg))]),t._v(" "),r("h2",[t._v(t._s(t.subtitle))]),t._v(" "),r("div",{staticClass:"card-deck mt-3"},[r("div",{staticClass:"card"},[r("div",{staticClass:"card-body"},[r("h4",{staticClass:"card-title"},[t._v(t._s(t.eventList.length)+" Total Events")]),t._v(" "),r("div",{staticStyle:{"vertical-align":"middle",display:"inline-block",width:"100%",height:"75px"},attrs:{id:"line1"}})])]),t._v(" "),r("div",{staticClass:"card"},[r("div",{staticClass:"card-body"},[r("h4",{staticClass:"card-title"},[t._v(t._s(t.totalHours)+" Total Hours")]),t._v(" "),r("div",{staticStyle:{"vertical-align":"middle",display:"inline-block",width:"100%",height:"75px"},attrs:{id:"line2"}})])]),t._v(" "),r("div",{staticClass:"card"},[r("div",{staticClass:"card-body"},[r("h4",{staticClass:"card-title"},[t._v(t._s(t.records.length)+" Total Reflections")]),t._v(" "),r("div",{staticStyle:{"vertical-align":"middle",display:"inline-block",width:"100%",height:"75px"},attrs:{id:"line3"}})])])])])]),t._v(" "),r("div",{staticClass:"row mt-3"},[r("div",{staticClass:"col-lg-6"},[r("h3",[t._v("Innovation by the Numbers")]),t._v(" "),r("p",[t._v(t._s(t.networkStructure.nodes.length)+" students have made "+t._s(t.networkStructure.links.length)+" connections across disciplines like business, engineering, art, sciences, and the humanities.")]),t._v(" "),r("svg",{attrs:{id:"network",width:"500",height:"300"}})])])])},k=[],F={render:b,staticRenderFns:k},y=F,A=r("VU/8"),S=a,E=A(w,y,!1,S,null,null),D=E.exports,z={name:"Program",data:function(){return{}},computed:{},mounted:function(){},updated:function(){},methods:{createChart:function(){window.AmCharts.makeChart("chart-div",{type:"serial",theme:"light",legend:{horizontalGap:10,maxColumns:1,position:"right",useGraphSettings:!0,markerSize:10},dataProvider:this.nationalList,valueAxes:[{stackType:"regular",axisAlpha:.5,gridAlpha:0}],graphs:[{ballonText:"",fillAlphas:.8,labelText:"[[value]]",lineAlpha:.3,title:"Some Distance",type:"column",color:"#000",valueField:"Some_Distance"},{ballonText:"",fillAlphas:.8,labelText:"[[value]]",lineAlpha:.3,title:"Exclusively Distance",type:"column",color:"#000",valueField:"Exclusive_Distance"},{ballonText:"",fillAlphas:.8,labelText:"[[value]]",lineAlpha:.3,title:"No Distance",type:"column",color:"#000",valueField:"None_Distance"}],rotate:!0,categoryField:"Year",categoryAxis:{gridPosition:"start",axisAlpha:0,gridAlpha:0,position:"left"},export:{enabled:!0}})}}},M=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"hello"},[r("h1",[t._v(t._s(t.msg))]),t._v(" "),r("p",[t._v("These statistics should help you compare national trends in distance education enrollments. You can filter by level using the dropdown menu.")]),t._v(" "),r("div",{attrs:{id:"chart-div"}})])},B=[],L={render:M,staticRenderFns:B},H=L,T=r("VU/8"),I=s,V=T(z,H,!1,I,"data-v-65cc9764",null),j=V.exports,P=(r("4as0"),{name:"Events",data:function(){return{msg:"Innovate LLP Events"}},computed:{eventsHash:function(){var t={};return this.$parent.records.forEach(function(e){t[e.eventID]?t[e.eventID].reflections=t[e.eventID].reflections+1:t[e.eventID]={eventTitle:e.eventTitle,eventHours:e.eventHours,reflections:1}}),t}},created:function(){},updated:function(){},mounted:function(){},methods:{createChart:function(){window.AmCharts.makeChart("chartdiv",{type:"xy",theme:"light",valueAxes:[{axisAlpha:0,position:"bottom"},{minMaxMultiplier:1.2,axisAlpha:0,position:"left"}],balloon:{fixedPosition:!0},startDuration:1.5,graphs:[{bullet:"round",bulletBorderAlpha:.2,bulletAlpha:.8,lineAlpha:0,fillAlphas:0,valueField:"Exclusive_Distance",balloonText:'<span style="font-size:18px;">State: [[State]]</br>In-State Students: [[x]]</br>Out-of-State Students: [[y]]</br>Total Distance Students: [[value]]</br></span>',xField:"InState_Students",yField:"OutOfState_Students",maxBulletSize:100}],export:{enabled:!0},dataProvider:this.filteredList}).addListener("clickGraphItem",this.selectState)},createLineChart:function(){window.AmCharts.makeChart("linechart",{type:"serial",theme:"light",maginRight:40,marginLeft:40,autoMarginOffset:20,dataDateFormat:"YYYY",valueAxes:[{id:"v1",axisAlpha:0,position:"left",ignoreAxisWidth:!0}],balloon:{borderThickness:1,shadowAlpha:0},graphs:[{id:"g1",balloon:{drop:!0,adjustBorderColor:!1,color:"#ffffff"},bullet:"round",bulletBorderAlpha:1,bulletColor:"#FFFFFF",bulletSize:5,useLineColorForBulletBorder:!0,valueField:"Exclusive_Distance"},{id:"g2",balloon:{drop:!0,adjustBorderColor:!1,color:"#ffffff"},bullet:"round",bulletBorderAlpha:1,bulletColor:"#FFFFFF",bulletSize:5,useLineColorForBulletBorder:!0,valueField:"InState_Students"},{id:"g3",balloon:{drop:!0,adjustBorderColor:!1,color:"#ffffff"},bullet:"round",bulletBorderAlpha:1,bulletColor:"#FFFFFF",bulletSize:5,useLineColorForBulletBorder:!0,valueField:"OutOfState_Students"},{id:"g4",balloon:{drop:!0,adjustBorderColor:!1,color:"#ffffff"},bullet:"round",bulletBorderAlpha:1,bulletColor:"#FFFFFF",bulletSize:5,useLineColorForBulletBorder:!0,valueField:"Some_Distance"}],categoryField:"Year",categoryAxis:{parseDates:!0,dashLength:1,minorGridEnabled:!0},export:{enabled:!0},dataProvider:this.annualFilteredStateData})}}}),O=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"hello"},[r("h1",[t._v(t._s(t.msg))]),t._v("\n  "+t._s(t.eventsHash)+"\n  "),t._m(0),t._v(" "),r("div",{attrs:{id:"chartdiv"}})])},N=[function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"grid-container"},[r("div",{staticClass:"half-width"},[r("div",{staticStyle:{height:"300px"},attrs:{id:"linechart"}})])])}],$={render:O,staticRenderFns:N},R=$,Y=r("VU/8"),G=o,U=Y(P,R,!1,G,"data-v-2caa8940",null),q=U.exports,W={name:"Students",data:function(){return{msg:"Innovate LLP Students",localFilter:"",cohortFilter:"All",majorFilter:"All"}},computed:{records:function(){return console.log(this.$parent.records),this.$parent.records},localList:function(){var t=this,e=this.records;"All"!==this.cohortFilter&&(e=e.filter(function(e){return t.cohortFilter===e.userCohort})),"All"!==this.majorFilter&&(e=e.filter(function(e){return t.majorFilter===e.userMajor}));var r=this.localFilter;return""===r?e:e.filter(function(t){for(var e in t)if(t.hasOwnProperty(e)&&null!==t[e]&&void 0!==t[e]&&t[e].toLowerCase().includes(r.toLowerCase()))return!0;return!1})},studentsList:function(){var t={};this.localList.forEach(function(e){t[e.userEmail]?t[e.userEmail].records.push(e):(t[e.userEmail]={userEmail:e.userEmail,major:e.userMajor,cohort:e.userCohort,totalHours:0,records:[]},t[e.userEmail].records.push(e))});for(var e in t)t[e].totalHours=t[e].records.reduce(function(t,e){return t+parseInt(e.eventHours)},0);return t},serialList:function(){var t=[];return this.localList.forEach(function(e){var r={postDate:e.postDate.split(" ")[0],value:1},n=!1;0===t.length?t.push(r):(t.forEach(function(t){t.postDate===r.postDate&&(t.value++,n=!0)}),n||t.push(r))}),t.sort(function(t,e){return new Date(t.postDate)-new Date(e.postDate)}),t}},created:function(){},updated:function(){this.makeSerialChart()},methods:{makeSerialChart:function(){function t(){e.zoomToIndexes(e.dataProvider.length-40,e.dataProvider.length-1)}var e=window.AmCharts.makeChart("chartDiv",{type:"serial",theme:"light",marginRight:40,marginLeft:40,autoMarginOffset:20,dataDateFormat:"YYYY-MM-DD",titles:[{text:"Reflection Submissions Over Time",size:15}],valueAxes:[{id:"v1",axisAlpha:0,position:"left",ignoreAxisWidth:!0}],balloon:{borderThickness:1,shadowAlpha:0},graphs:[{id:"g1",balloon:{drop:!0,adjustBorderColor:!1,color:"#ffffff"},bullet:"round",bulletBorderAlpha:1,bulletColor:"#FFFFFF",bulletSize:5,hideBulletsCount:50,lineThickness:2,title:"red line",useLineColorForBulletBorder:!0,valueField:"value",balloonText:'<span style="font-size:18px;">[[value]]</span>'}],chartScrollbar:{graph:"g1",oppositeAxis:!1,offset:30,scrollbarHeight:80,backgroundAlpha:0,selectedBackgroundAlpha:.1,selectedBackgroundColor:"#888888",graphFillAlpha:0,graphLineAlpha:.5,selectedGraphFillAlpha:0,selectedGraphLineAlpha:1,autoGridCount:!0,color:"#AAAAAA"},chartCursor:{pan:!0,valueLineEnabled:!0,valueLineBalloonEnabled:!0,cursorAlpha:1,cursorColor:"#258cbb",limitToGraph:"g1",valueLineAlpha:.2,valueZoomable:!0},categoryField:"postDate",categoryAxis:{parseDates:!0,dashLength:1,minorGridEnabled:!0},export:{enabled:!0},dataProvider:this.serialList});e.addListener("rendered",t),t()}}},Z=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-lg-12"},[r("h1",[t._v(t._s(t.msg))]),t._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-lg-3"},[r("h3",[t._v("Data Filters")]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"filter"}},[t._v("Text Filter")]),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.localFilter,expression:"localFilter"}],staticClass:"form-control",attrs:{type:"text",name:"filter"},domProps:{value:t.localFilter},on:{input:function(e){e.target.composing||(t.localFilter=e.target.value)}}})]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"cohortFilter"}},[t._v("Cohort Filter")]),t._v(" "),r("select",{directives:[{name:"model",rawName:"v-model",value:t.cohortFilter,expression:"cohortFilter"}],staticClass:"form-control",attrs:{name:"cohortFilter"},on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.cohortFilter=e.target.multiple?r:r[0]}}},[r("option",{attrs:{value:"All"}},[t._v("All")]),t._v(" "),r("option",{attrs:{value:"2016 – 2018"}},[t._v("2016 - 2018")]),t._v(" "),r("option",{attrs:{value:"2017 – 2019"}},[t._v("2017 - 2019")])])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"majorFilter"}},[t._v("Major Filter")]),t._v(" "),r("select",{directives:[{name:"model",rawName:"v-model",value:t.majorFilter,expression:"majorFilter"}],staticClass:"form-control",attrs:{name:"majorFilter"},on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.majorFilter=e.target.multiple?r:r[0]}}},[r("option",{attrs:{value:"All"}},[t._v("All")]),t._v(" "),r("option",{attrs:{value:"Engineering"}},[t._v("Engineering")]),t._v(" "),r("option",{attrs:{value:"Business"}},[t._v("Business")]),t._v(" "),r("option",{attrs:{value:"Arts"}},[t._v("Arts")]),t._v(" "),r("option",{attrs:{value:"Humanities and Sciences"}},[t._v("Humanities and Sciences")]),t._v(" "),r("option",{attrs:{value:"Other"}},[t._v("Other")])])])]),t._v(" "),t._m(0)]),t._v(" "),r("table",{staticClass:"table table-striped table-responsive"},[t._m(1),t._v(" "),r("tbody",t._l(t.studentsList,function(e){return r("tr",{key:e.userEmail},[r("th",{attrs:{scope:"row"}},[r("img",{staticClass:"img-fluid avatar-img",attrs:{src:"http://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png"}}),t._v(" "),r("router-link",{attrs:{to:{path:"/students/"+e.userEmail}}},[t._v(t._s(e.userEmail))])],1),t._v(" "),r("td",{staticClass:"assignment"},[t._v(t._s(e.records.length))]),t._v(" "),r("td",{staticClass:"assignment"},[t._v(t._s(e.totalHours))]),t._v(" "),r("td",{staticClass:"assignment"},[t._v(t._s(e.major))]),t._v(" "),r("td",{staticClass:"assignment"},[t._v(t._s(e.cohort))]),t._v(" "),r("td",{staticClass:"assignment"},[r("div",{staticClass:"progress"},[r("div",{staticClass:"progress-bar",style:{width:e.totalHours/65*100+"%"},attrs:{role:"progressbar","aria-valuenow":"25","aria-valuemin":"0","aria-valuemax":"100"}})])])])}))])])])])},J=[function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"col-lg-9"},[r("div",{attrs:{id:"chartDiv"}})])},function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("thead",{staticClass:"thead-inverse"},[r("tr",[r("th",[t._v("Student")]),t._v(" "),r("th",[t._v("Total Events")]),t._v(" "),r("th",[t._v("Total Hours")]),t._v(" "),r("th",[t._v("Major")]),t._v(" "),r("th",[t._v("Cohort")]),t._v(" "),r("th",[t._v("Progress")])])])}],K={render:Z,staticRenderFns:J},Q=K,X=r("VU/8"),tt=i,et=X(W,Q,!1,tt,"data-v-06c605d7",null),rt=et.exports,nt={name:"individualStudent",data:function(){return{msg:"Explore Schools"}},computed:{},created:function(){},update:function(){},methods:{}},at=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"hello"},[r("h1",[t._v(t._s(t.msg))]),t._v(" "),r("h2",[t._v(t._s(t.$route.params.id))])])},st=[],ot={render:at,staticRenderFns:st},it=ot,lt=r("VU/8"),ct=l,ut=lt(nt,it,!1,ct,"data-v-059c5c01",null),dt=ut.exports;c.a.use(x.a);var ht=new x.a({routes:[{path:"/",name:"Index",component:D},{path:"/program",name:"Program",component:j},{path:"/events",name:"Events",component:q},{path:"/students",name:"students",component:rt},{path:"/students/:id",name:"individualStudent",component:dt}]});c.a.config.productionTip=!1,new c.a({el:"#app",router:ht,template:"<App/>",components:{App:_}})},WVht:function(t,e){},hHOE:function(t,e){},qb6w:function(t,e){}},["NHnr"]);
//# sourceMappingURL=app.12f9922d175c967347ce.js.map