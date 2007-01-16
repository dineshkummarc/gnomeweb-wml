// Formatted last-modified date
// Using the javascript to do in a smart way
if (Date.parse(document.lastModified) != 0) {
  var modiDate = new Date(document.lastModified);
  var monthName = new Array("January", "February", "March", "April", "May", 
   "June", "July", "August", "September", "October", "November", "December");
  document.write("Last modified: " + monthName[modiDate.getMonth()] + " ");
  document.write(modiDate.getDate() + ", " + modiDate.getFullYear());
  }
  