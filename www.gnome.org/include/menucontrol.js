function dropdown_tasks() {
  show_hide_layers('document.layers[\'menutasks\']','document.all[\'menutasks\']','document.getElementById(\'menutasks\')','show','document.layers[\'menusections\']','document.all[\'menusections\']','document.getElementById(\'menusections\')','hide','document.layers[\'menucontact\']','document.all[\'menucontact\']','document.getElementById(\'menucontact\')','hide');
}

function dropdown_sections() {
  show_hide_layers('document.layers[\'menutasks\']','document.all[\'menutasks\']','document.getElementById(\'menutasks\')','hide','document.layers[\'menusections\']','document.all[\'menusections\']','document.getElementById(\'menusections\')','show','document.layers[\'menucontact\']','document.all[\'menucontact\']','document.getElementById(\'menucontact\')','hide');
}

function dropdown_contact() {
  show_hide_layers('document.layers[\'menutasks\']','document.all[\'menutasks\']','document.getElementById(\'menutasks\')','hide','document.layers[\'menusections\']','document.all[\'menusections\']','document.getElementById(\'menusections\')','hide','document.layers[\'menucontact\']','document.all[\'menucontact\']','document.getElementById(\'menucontact\')','show');
}

function pullup_tasks() {
  show_hide_layers('document.layers[\'menutasks\']','document.all[\'menutasks\']','document.getElementById(\'menutasks\')','hide');
}

function pullup_sections() {
  show_hide_layers('document.layers[\'menusections\']','document.all[\'menusections\']','document.getElementById(\'menusections\')','hide');
}

function pullup_contact() {
  show_hide_layers('document.layers[\'menucontact\']','document.all[\'menucontact\']','document.getElementById(\'menucontact\')','hide');
}

function show_hide_layers() {
  var i, visStr, args, theObj;
  args = show_hide_layers.arguments;
  for (i=0; i<(args.length-3); i+=4) { //with arg quads (objNS,objIE,objStd,visStr)
    visStr   = args[i+3];
    if ((navigator.appName == 'Netscape') && document.layers != null) {
      theObj = eval(args[i]);
      if (theObj) theObj.visibility = visStr;
    } else if (document.all != null) { //IE
      if (visStr == 'show') visStr = 'visible';
      if (visStr == 'hide') visStr = 'hidden';
      theObj = eval(args[i+1]);
      if (theObj) theObj.style.visibility = visStr;
    } else {
      if (visStr == 'show') visStr = 'visible';
      if (visStr == 'hide') visStr = 'hidden';
      theObj = eval(args[i+2]);
      if (theObj) theObj.style.visibility = visStr;
    }
 }
}
