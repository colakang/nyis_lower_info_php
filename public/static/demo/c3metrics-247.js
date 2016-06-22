/**
 * C3 Metrics
 *
 * http://www.c3metrics.com
 * http://www.c3tag.com
 *
 * Copyright (c) 2008 - 2013 C3 Metrics, Inc. All Rights Reserved
 * Patent Pending
 */
(function(window, undefined){
function indexOf(needle,haystack){if(haystack.length!==undefined){if(Array.prototype.indexOf){return haystack.indexOf(needle)}else{for(var i=0;i<haystack.length;i++){if(haystack[i]===needle){return i}}return -1}}return -1};
var oValidApiParamKeys=['c3api','c3apiks','c3apidt','c3apimn','c3apibg','c3apimx'], oValidClientParamKeys=['c3placement','c3creative','c3size','c3ad','c3adid','c3advertiser','c3campaign'], nidlbl={}, oClientParams=[], xnidLabels={}, reservedNids={}, c3Labels={}, gaLabels={}, labelPriority=[];
var _0x825f=["\x28\x5E\x7C\x3B\x29\x20\x3F\x43\x33\x55\x49\x44\x2D","\x3D\x28\x5B\x5E\x3B\x5D\x2A\x29\x28\x3B\x7C\x29","\x6D\x61\x74\x63\x68","\x63\x6F\x6F\x6B\x69\x65","\x28\x5E\x7C\x3B\x29\x20\x3F\x43\x33\x53\x2D","\x77\x69\x64\x74\x68","\x68\x65\x69\x67\x68\x74","\x31","\x61","\x63\x72\x65\x61\x74\x65\x45\x6C\x65\x6D\x65\x6E\x74","","\x68\x72\x65\x66","\x72\x65\x66\x65\x72\x72\x65\x72","\x68\x6F\x73\x74\x6E\x61\x6D\x65","\x3A","\x73\x70\x6C\x69\x74","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x70\x61\x72\x65\x6E\x74","\x64\x6F\x6D\x61\x69\x6E","\x73\x65\x6F\x2D","\x74\x6F\x4C\x6F\x77\x65\x72\x43\x61\x73\x65","\x73\x65\x61\x72\x63\x68","\x73\x6C\x69\x63\x65","\x26","\x2C","\x6C\x65\x6E\x67\x74\x68","\x3D","\x63\x68\x61\x6E\x6E\x65\x6C","\x78\x6E\x69\x64\x5F\x6C\x61\x62\x65\x6C","\x63\x33\x63\x68","\x63\x33\x6E\x69\x64","\x25\x70\x61\x72\x61\x6D\x25","\x6E\x69\x64","\x75\x6E\x64\x65\x66\x69\x6E\x65\x64","\x61\x70\x69","\x72\x65\x73\x65\x72\x76\x65\x64\x5F\x6E\x69\x64","\x55\x6E\x63\x61\x74\x65\x67\x6F\x72\x69\x7A\x65\x64","\x64\x65\x6C\x69\x6D\x69\x74\x65\x72","\x70\x6F\x73\x69\x74\x69\x6F\x6E","\x6E\x75\x6D\x62\x65\x72","\x73\x69\x74\x65\x69\x64","\x2F","\x72\x65\x70\x6C\x61\x63\x65","\x2A","\x78\x6E\x69\x64","\x27","\x63\x69\x64","\x63\x33\x5F\x6C\x61\x62\x65\x6C","\x67\x6C\x75\x65","\x63\x6C\x69\x65\x6E\x74\x5F\x63\x72\x65\x61\x74\x69\x76\x65","\x63\x6C\x69\x65\x6E\x74\x5F\x70\x6C\x61\x63\x65\x6D\x65\x6E\x74","\x63\x6C\x69\x65\x6E\x74\x5F\x73\x69\x7A\x65","\x6D\x61\x70","\x67\x61\x5F\x6E\x69\x64","\x78\x2D\x6E\x69\x64\x3A","\x3C\x2D\x63\x68\x2D\x6E\x69\x64\x2D\x3E","\x63\x33\x2D\x6C\x61\x62\x65\x6C","\x67\x61\x2D\x6E\x69\x64\x3A\x20","\x67\x6F\x6F\x67\x6C\x65\x2D\x61\x6E\x61\x6C\x79\x74\x69\x63\x73","\x72\x65\x73\x65\x72\x76\x65\x64\x2D\x6E\x69\x64","\x78\x6E\x69\x64\x2D\x6C\x61\x62\x65\x6C","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x2E","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x43\x33\x53\x2D","\x3D\x6F\x6E","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x3B\x70\x61\x74\x68\x3D\x2F\x3B\x64\x6F\x6D\x61\x69\x6E\x3D","\x3B","\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","\x3F\x69\x4E\x3D","\x26\x6E\x69\x64\x3D","\x26\x63\x69\x64\x3D","\x26\x63\x33\x75\x69\x64\x31\x3D","\x26\x63\x33\x75\x69\x64\x32\x3D","\x26\x74\x6C\x64\x3D","\x68\x61\x73\x4F\x77\x6E\x50\x72\x6F\x70\x65\x72\x74\x79","\x26\x63\x33\x70\x61\x72\x61\x6D\x73\x5B","\x5D\x3D","\x26\x63\x33\x61\x63\x69\x64\x3D\x31","\x26\x75\x66\x63\x5F\x69\x64\x3D","\x26\x75\x66\x63\x5F\x74\x73\x3D","\x26\x77\x3D","\x26\x68\x3D","\x26\x6F\x73\x3D","\x73\x63\x72\x69\x70\x74","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x73\x42\x79\x54\x61\x67\x4E\x61\x6D\x65","\x73\x72\x63","\x69\x64","\x63\x33\x63\x74","\x74\x79\x70\x65","\x74\x65\x78\x74\x2F\x6A\x61\x76\x61\x73\x63\x72\x69\x70\x74","\x69\x6E\x73\x65\x72\x74\x42\x65\x66\x6F\x72\x65","\x70\x61\x72\x65\x6E\x74\x4E\x6F\x64\x65"];function c3CTJScall(_0x5940x2,_0x5940x3,_0x5940x4,_0x5940x5,_0x5940x6,_0x5940x7,_0x5940x8,_0x5940x9,_0x5940xa,_0x5940xb,_0x5940xc,_0x5940xd,_0x5940xe,_0x5940xf,_0x5940x10,_0x5940x11,_0x5940x12){var _0x5940x13=document[_0x825f[3]][_0x825f[2]](_0x825f[0]+_0x5940x3+_0x825f[1]),_0x5940x14=document[_0x825f[3]][_0x825f[2]](_0x825f[4]+_0x5940x3+_0x825f[1]),_0x5940x15=screen[_0x825f[5]],_0x5940x16=screen[_0x825f[6]],_0x5940x17=_0x825f[7],_0x5940x18=document[_0x825f[9]](_0x825f[8]),_0x5940x19=_0x825f[10];_0x5940x18[_0x825f[11]]=document[_0x825f[12]];if(_0x5940x18[_0x825f[13]]){_0x5940x19=_0x5940x18[_0x825f[13]][_0x825f[2]](/([0-9A-Za-z\-]{2,}\.[0-9A-Za-z\-]{2,3}\.[0-9A-Za-z\-]{2,3}|[0-9A-Za-z\-]{2,}\.[0-9A-Za-z\-]{2,3})$/)[0][_0x825f[15]](_0x825f[14])[0];} ;if(_0x5940x5){_0x5940x17=_0x5940x5;} else {if(document[_0x825f[12]]){var _0x5940x1a=window[_0x825f[16]]!==window[_0x825f[17]][_0x825f[16]],_0x5940x1b;if(_0x5940x1a){_0x5940x1b=document[_0x825f[12]];} else {if(_0x5940x19!=document[_0x825f[18]][_0x825f[2]](/([0-9A-Za-z\-]{2,}\.[0-9A-Za-z\-]{2,3}\.[0-9A-Za-z\-]{2,3}|[0-9A-Za-z\-]{2,}\.[0-9A-Za-z\-]{2,3})$/)[0]){_0x5940x17=_0x825f[19]+_0x5940x19[_0x825f[20]]();} else {return null;} ;} ;var _0x5940x1c;if(_0x5940x1b){_0x5940x18[_0x825f[11]]=_0x5940x1b;if(_0x5940x18[_0x825f[21]]){var _0x5940x1d=decodeURI(_0x5940x18[_0x825f[21]][_0x825f[22]](1)),_0x5940x1e=_0x5940x1d[_0x825f[15]](_0x825f[23]),_0x5940x1f=_0x5940x8[_0x825f[15]](_0x825f[24]),_0x5940x20={},_0x5940x21=0,_0x5940x22={api:_0x825f[10],cid:_0x825f[10],c3_label:{channel:_0x825f[10],nid:_0x825f[10]},ga_nid:_0x825f[10],reserved_nid:{channel:_0x825f[10],nid:_0x825f[10]},xnid:{channel:_0x825f[10],nid:_0x825f[10]},xnid_label:{channel:_0x825f[10],nid:_0x825f[10]}},_0x5940x23=_0x825f[10];for(var _0x5940x24=0;_0x5940x24<_0x5940x1e[_0x825f[25]];_0x5940x24++){var _0x5940x25=_0x5940x1e[_0x5940x24][_0x825f[15]](_0x825f[26]),_0x5940x26=_0x5940x25[0][_0x825f[20]](),_0x5940x27=_0x5940x25[1];if(_0x5940x27){if(_0x5940xb[_0x5940x26]){_0x5940x22[_0x825f[28]][_0x825f[27]]=_0x5940xb[_0x5940x26][_0x825f[29]];if(_0x5940x27&&_0x5940xb[_0x5940x26][_0x825f[30]]===_0x825f[31]){_0x5940x22[_0x825f[28]][_0x825f[32]]=_0x5940x27;} else {_0x5940x22[_0x825f[28]][_0x825f[32]]=_0x5940xb[_0x5940x26][_0x825f[30]];} ;} ;if( typeof _0x5940x9[_0x5940x26]!==_0x825f[33]){_0x5940x26=_0x5940x9[_0x5940x26];} ;if(indexOf(_0x5940x26,oValidClientParamKeys)!==-1){_0x5940xa[_0x5940x26]=_0x5940x27;} ;if(indexOf(_0x5940x26,oValidApiParamKeys)!==-1){if(_0x5940x27){_0x5940x22[_0x825f[34]]=_0x5940x26+_0x825f[14]+_0x5940x27;} ;} ;if( typeof _0x5940xc[_0x5940x26]!==_0x825f[33]){var _0x5940x28=_0x5940xc[_0x5940x26];_0x5940x22[_0x825f[35]][_0x825f[27]]=_0x825f[36];if(_0x5940x27){_0x5940x22[_0x825f[35]][_0x825f[32]]=_0x5940x27;} ;if( typeof _0x5940x28[_0x825f[27]]!==_0x825f[33]){_0x5940x22[_0x825f[35]][_0x825f[27]]=_0x5940x28[_0x825f[27]];} ;if( typeof _0x5940x28[_0x825f[37]]!==_0x825f[33]&& typeof _0x5940x28[_0x825f[38]]==_0x825f[39]){var _0x5940x29=_0x5940x27[_0x825f[15]](_0x5940x28[_0x825f[37]]);_0x5940x22[_0x825f[35]][_0x825f[32]]=_0x5940x29[_0x5940x28[_0x825f[38]]];} ;if(_0x5940x26==_0x825f[40]){_0x5940x22[_0x825f[35]][_0x825f[32]]=_0x5940x22[_0x825f[35]][_0x825f[32]][_0x825f[42]](/\./g,_0x825f[43])[_0x825f[42]](/_/g,_0x825f[41]);} ;} ;if(_0x5940x26==_0x825f[29]){_0x5940x22[_0x825f[44]][_0x825f[27]]=_0x5940x27;} ;if(_0x5940x26==_0x825f[30]){if(_0x5940x27){_0x5940x22[_0x825f[44]][_0x825f[32]]=_0x5940x27;} ;} ;if(indexOf(_0x825f[45]+_0x5940x26+_0x825f[45],_0x5940x1f)!==-1){if(_0x5940x22[_0x825f[46]][_0x825f[25]]){_0x5940x22[_0x825f[46]]+=_0x825f[24];} ;if(_0x5940x27){_0x5940x22[_0x825f[46]]+=_0x5940x27;} ;} ;if( typeof _0x5940xd[_0x5940x26]!==_0x825f[33]){var _0x5940x2a=_0x5940xd[_0x5940x26];if(_0x5940x27){var _0x5940x2b=_0x5940x27[_0x825f[15]](_0x5940x2a[_0x825f[37]]);if(_0x5940x2b[_0x825f[25]]>1||(_0x5940x2b[_0x825f[25]]===1&&_0x5940x2b[0])){for(var _0x5940x2c=0,_0x5940x2d=_0x5940x2b[_0x825f[25]];_0x5940x2c<_0x5940x2d;_0x5940x2c++){switch(_0x5940x2a[_0x825f[52]][_0x5940x2c]){case _0x825f[27]:_0x5940x22[_0x825f[47]][_0x825f[27]]=_0x5940x2b[_0x5940x2c];break ;;case _0x825f[32]:if(_0x5940x22[_0x825f[47]][_0x825f[32]][_0x825f[25]]>0){_0x5940x22[_0x825f[47]][_0x825f[32]]+=(_0x5940x2a[_0x825f[48]]?_0x5940x2a[_0x825f[48]]:_0x825f[24]);} ;_0x5940x22[_0x825f[47]][_0x825f[32]]+=_0x5940x2b[_0x5940x2c];break ;;case _0x825f[49]:break ;;case _0x825f[50]:break ;;case _0x825f[51]:break ;;} ;} ;} ;} ;} ;if(_0x5940xe[_0x825f[25]]&&indexOf(_0x825f[45]+_0x5940x26+_0x825f[45],_0x5940xe)!==-1){_0x5940x20[_0x825f[45]+_0x5940x26+_0x825f[45]]=_0x5940x27;_0x5940x21++;} ;} ;} ;if(_0x5940x21&&_0x5940xe[_0x825f[25]]){for(var _0x5940x24=0,_0x5940x2d=_0x5940xe[_0x825f[25]];_0x5940x24<_0x5940x2d;_0x5940x24++){if( typeof _0x5940x20[_0x5940xe[_0x5940x24]]!==undefined){if(_0x5940x22[_0x825f[53]][_0x825f[25]]){_0x5940x22[_0x825f[53]]+=_0x825f[24];} ;_0x5940x22[_0x825f[53]]+=_0x5940x20[_0x5940xe[_0x5940x24]];} ;} ;} ;if(_0x5940xf[_0x825f[25]]){for(var _0x5940x24=0,_0x5940x2d=_0x5940xf[_0x825f[25]];_0x5940x24<_0x5940x2d;_0x5940x24++){switch(_0x5940xf[_0x5940x24]){case _0x825f[34]:if(_0x5940x22[_0x825f[34]]!==_0x825f[10]){_0x5940x23=_0x5940x22[_0x825f[34]];} ;break ;;case _0x825f[56]:if(_0x5940x22[_0x825f[47]][_0x825f[32]]!==_0x825f[10]){_0x5940x23=_0x5940x22[_0x825f[47]][_0x825f[32]];if(_0x5940x22[_0x825f[47]][_0x825f[27]]!==_0x825f[10]){_0x5940x23=_0x825f[54]+_0x5940x22[_0x825f[47]][_0x825f[27]]+_0x825f[55]+_0x5940x22[_0x825f[47]][_0x825f[32]];} ;} ;break ;;case _0x825f[46]:if(_0x5940x22[_0x825f[46]]!==_0x825f[10]){_0x5940x23=_0x5940x22[_0x825f[46]];} ;break ;;case _0x825f[58]:if(_0x5940x22[_0x825f[53]]!==_0x825f[10]){_0x5940x23=_0x825f[57]+_0x5940x22[_0x825f[53]];} ;break ;;case _0x825f[59]:if(_0x5940x22[_0x825f[35]][_0x825f[32]]!==_0x825f[10]&&_0x5940x22[_0x825f[35]][_0x825f[27]]!==_0x825f[10]){_0x5940x23=_0x825f[54]+_0x5940x22[_0x825f[35]][_0x825f[27]]+_0x825f[55]+_0x5940x22[_0x825f[35]][_0x825f[32]];} ;break ;;case _0x825f[44]:if(_0x5940x22[_0x825f[44]][_0x825f[32]]!==_0x825f[10]&&_0x5940x22[_0x825f[44]][_0x825f[27]]!==_0x825f[10]){_0x5940x23=_0x825f[54]+_0x5940x22[_0x825f[44]][_0x825f[27]]+_0x825f[55]+_0x5940x22[_0x825f[44]][_0x825f[32]];} ;break ;;case _0x825f[60]:if(_0x5940x22[_0x825f[28]][_0x825f[32]]!==_0x825f[10]&&_0x5940x22[_0x825f[28]][_0x825f[27]]!==_0x825f[10]){_0x5940x23=_0x825f[54]+_0x5940x22[_0x825f[28]][_0x825f[27]]+_0x825f[55]+_0x5940x22[_0x825f[28]][_0x825f[32]];} ;break ;;} ;} ;} else {if(_0x5940x22[_0x825f[28]][_0x825f[32]]!==_0x825f[10]&&_0x5940x22[_0x825f[28]][_0x825f[27]]!==_0x825f[10]){_0x5940x23=_0x825f[54]+_0x5940x22[_0x825f[28]][_0x825f[27]]+_0x825f[55]+_0x5940x22[_0x825f[28]][_0x825f[32]];} ;if(_0x5940x22[_0x825f[46]]!==_0x825f[10]){_0x5940x23=_0x5940x22[_0x825f[46]];} ;if(_0x5940x22[_0x825f[53]]!==_0x825f[10]){_0x5940x23=_0x825f[57]+_0x5940x22[_0x825f[53]];} ;if(_0x5940x22[_0x825f[47]][_0x825f[32]]!==_0x825f[10]){_0x5940x23=_0x5940x22[_0x825f[47]][_0x825f[32]];if(_0x5940x22[_0x825f[47]][_0x825f[27]]!==_0x825f[10]){_0x5940x23=_0x825f[54]+_0x5940x22[_0x825f[47]][_0x825f[27]]+_0x825f[55]+_0x5940x22[_0x825f[47]][_0x825f[32]];} ;} ;if(_0x5940x22[_0x825f[35]][_0x825f[32]]!==_0x825f[10]&&_0x5940x22[_0x825f[35]][_0x825f[27]]!==_0x825f[10]){_0x5940x23=_0x825f[54]+_0x5940x22[_0x825f[35]][_0x825f[27]]+_0x825f[55]+_0x5940x22[_0x825f[35]][_0x825f[32]];} ;if(_0x5940x22[_0x825f[34]]!==_0x825f[10]){_0x5940x23=_0x5940x22[_0x825f[34]];} ;if(_0x5940x22[_0x825f[44]][_0x825f[32]]!==_0x825f[10]&&_0x5940x22[_0x825f[44]][_0x825f[27]]!==_0x825f[10]){_0x5940x23=_0x825f[54]+_0x5940x22[_0x825f[44]][_0x825f[27]]+_0x825f[55]+_0x5940x22[_0x825f[44]][_0x825f[32]];} ;} ;if(_0x5940x23){_0x5940x17=_0x5940x23;} ;} ;} ;} ;} ;if(_0x5940x14&&_0x5940x13&&_0x5940x17==1&&(_0x5940x10==0||_0x5940x13[2]==_0x5940x4)){return null;} ;if(_0x5940x13){var _0x5940x2e= new Date(),_0x5940x2f=_0x5940x2e[_0x825f[62]](_0x5940x2e[_0x825f[61]]()+(_0x5940x2*60*1000)),_0x5940x30=document[_0x825f[18]][_0x825f[15]](_0x825f[63]),_0x5940x31=_0x5940x30[_0x825f[25]],_0x5940x32=_0x825f[63]+_0x5940x30[_0x5940x31-2]+_0x825f[63]+_0x5940x30[_0x5940x31-1];_0x5940x13=_0x5940x13[2];_0x5940x2f=_0x5940x2e[_0x825f[64]]();document[_0x825f[3]]=_0x825f[65]+_0x5940x3+_0x825f[66]+_0x825f[67]+_0x5940x2f+_0x825f[68]+_0x5940x32+_0x825f[69];} ;var _0x5940x33=Math[_0x825f[71]]((Math[_0x825f[70]]()*10000)+1),_0x5940x6=_0x5940x6+_0x825f[72]+_0x5940x33,_0x5940x34=_0x825f[73]+escape(_0x5940x17)+_0x825f[74]+escape(_0x5940x3)+_0x825f[75]+escape(_0x5940x13)+_0x825f[76]+escape(_0x5940x4);if(_0x5940x19){_0x5940x34+=_0x825f[77]+_0x5940x19;} ;for(var _0x5940x24 in _0x5940xa){if(_0x5940xa[_0x825f[78]](_0x5940x24)&&_0x5940xa[_0x5940x24]){_0x5940x34+=_0x825f[79]+_0x5940x24+_0x825f[80]+escape(_0x5940xa[_0x5940x24]);} ;} ;if(_0x5940x10!=0){_0x5940x34+=_0x825f[81];} ;if(_0x5940x11&&_0x5940x12){_0x5940x34+=_0x825f[82]+_0x5940x11+_0x825f[83]+_0x5940x12;} ;var _0x5940x6=_0x5940x6+_0x5940x34+_0x825f[84]+escape(_0x5940x15)+_0x825f[85]+escape(_0x5940x16)+_0x825f[86]+escape(_0x5940x7),_0x5940x35=document[_0x825f[88]](_0x825f[87])[0],_0x5940x36=document[_0x825f[9]](_0x825f[87]);_0x5940x36[_0x825f[89]]=_0x5940x6;_0x5940x36[_0x825f[90]]=_0x825f[91]+_0x5940x33;_0x5940x36[_0x825f[92]]=_0x825f[93];_0x5940x35[_0x825f[95]][_0x825f[94]](_0x5940x36,_0x5940x35);} ;
c3CTJScall(30, '247', '9752722901466042831', '', '//247-ct.c3tag.com/ctv4/ctcall.php', 'Windows 7', "'c3'", nidlbl, oClientParams, xnidLabels, reservedNids, c3Labels, gaLabels, labelPriority, '0', '', '');
})(this);