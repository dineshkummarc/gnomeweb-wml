function ul (f)
{
	f.style.textDecoration='underline';
}

function noul (f)
{
	f.style.textDecoration='none';
}

function findTableParent(node) {
  while(node.tagName.toUpperCase() != 'TABLE')
    node = node.parentNode;
  return node;
}
function createRowsArray(table) {
  var rows = new Array();
  var r = 0;
  if(table.tHead == null && table.tFoot == null)
    for(var r1 = 0; r1 < table.rows.length; r1++, r++)
      rows[r] = table.rows[r1];
  else
    for(var t = 0; t < table.tBodies.length; t++)
      for(var r1 = 0; r1 < table.tBodies[t].rows.length; r1++, r++)
        rows[r] = table.tBodies[t].rows[r1];
  return rows;
}
function insertSortedRows(table, rows) {
  if(document.all) var rowsCopy = new Array(rows.length)
  for(var r = 0; r < rows.length; r++) {
    if(document.all) rowsCopy[r] = rows[r].cloneNode(true);
    table.deleteRow(rows[r].rowIndex);
  }
  var tableSection = table.tBodies[table.tBodies.length - 1];
  for(var r = 0; r < rows.length; r++) {
    var row = document.all ? rowsCopy[r] : rows[r];
    tableSection.appendChild(row);
  }
}
function sortTable(table, sortFun) {
  var rows = createRowsArray(table);
  if(rows.length > 0) {
    rows.sort(sortFun);
    insertSortedRows(table, rows);
  }
}
function compareAlessThanB(A,B){
  return A < B ? - 1 :(A == B ? 0 : 1);
}
function compareBlessThanA(A,B){
  return B < A ? - 1 :(A == B ? 0 : 1);
}
function sortRowsAlpha(row1 , row2) {
  var column = sortRowsAlpha.col;
  var cell1 = row1.cells[column].firstChild.nodeValue;
  var cell2 = row2.cells[column].firstChild.nodeValue;
  return sortRowsAlpha.compare(cell1,cell2);
}
function sortRowsCustom(row1 , row2) {
  var column = sortRowsCustom.col;
  var cell1 = sortRowsCustom.getValue(row1.cells[column].firstChild);
  var cell2 = sortRowsCustom.getValue(row2.cells[column].firstChild);
  return sortRowsCustom.compare(cell1,cell2);
}
function sortRowsNumber(row1 , row2) {
  var column = sortRowsNumber.col;
  var cell1 = parseFloat(row1.cells[column].firstChild.nodeValue);
  var cell2 = parseFloat(row2.cells[column].firstChild.nodeValue);
  return sortRowsNumber.compare(cell1,cell2);
}
function sortRowsMoney(row1 , row2) {
  var column = sortRowsMoney.col;
  var cell1 = parseFloat(row1.cells[column].firstChild.nodeValue.substr (1));
  var cell2 = parseFloat(row2.cells[column].firstChild.nodeValue.substr (1));
  return sortRowsMoney.compare(cell1,cell2);
}
/*
  Sort a table column alphabetically.
  @param table The table to be sorted.
  @param col The column to sorted upon.
  @param direction Cause ascending order ('a' first) if null or false.
  @returns <tt>!direction</tt> so that repeated calls of the form 
<tt>direction=doSortTable(a,b,direction);</tt> cause the table column 
to alternate between ascending and descending order.
*/
function doSortTable(table, col, direction) {
  sortRowsAlpha.col = col;
  if( direction == true ){
    sortRowsAlpha.compare = compareBlessThanA;
  }
  else {
    sortRowsAlpha.compare = compareAlessThanB;
  }
  sortTable(table, sortRowsAlpha);
  return direction = (direction!=true)?true:false;
}
/*
  Sort a table column based on a custom numerical 'order' criteria of 
the cell.
  @param table The table to be sorted.
  @param col The column to sorted upon.
  @param customFunction Provides an order value given the contence of 
the cell.
  @param direction Cause ascending order if null or false.
  @returns <tt>!direction</tt> so that repeated calls of the form 
<tt>direction=doSortTable(a,b,direction);</tt> cause the table column 
to alternate between ascending and descending order.
*/
function doSortTableCustom(table, col, customFunction, direction) {
  sortRowsCustom.col = col;
  sortRowsCustom.getValue = customFunction;
  if( direction == true ){
    sortRowsCustom.compare = compareBlessThanA;
  }
  else {
    sortRowsCustom.compare = compareAlessThanB;
  }
  sortTable(table, sortRowsCustom);
  return direction = (direction!=true)?true:false;
}
/*
  Sort a table column numerically.
  @param table The table to be sorted.
  @param col The column to sorted upon.
  @param direction Cause ascending order ('1' first) if null or false.
  @returns <tt>!direction</tt> so that repeated calls of the form 
<tt>direction=doSortTable(a,b,direction);</tt> cause the table column 
to alternate between ascending and descending order.
*/
function doSortTableNumerical(table, col, direction) {
  sortRowsNumber.col = col;
  if( direction == true ){
    sortRowsNumber.compare = compareBlessThanA;
  }
  else {
    sortRowsNumber.compare = compareAlessThanB;
  }
  sortTable(table, sortRowsNumber);
  return direction = (direction!=true)?true:false;
}

function doSortTableMoney (table, col, direction) {
  sortRowsMoney.col = col;
  if( direction == true ){
    sortRowsMoney.compare = compareBlessThanA;
  }
  else {
    sortRowsMoney.compare = compareAlessThanB;
  }
  sortTable(table, sortRowsMoney);
  return direction = (direction!=true)?true:false;
}

function pipelineValue(node){
  text = node.data;

  if (text == 'Easy') {
     return 2;
  } else if (text == 'Medium') {
     return 4;
  } else if (text == 'Hard') {
     return 5;
  } else {
     return 10;
  }
}

function doSortTableByDifficulty(table, col, direction) {
  doSortTableCustom(table, col, pipelineValue, direction);
  return direction = (direction!=true)?true:false;
}

/*
  The customized function returns an order value based on some property 
of the what was found in the table cell. In this case it is based on 
the color attribute of the node. We could just as easily be sorting 
based on the name of an image found in the table cell or any other 
custom criteria.
*/
function getOrderBasedOnColor(coloredNode){
  var color = coloredNode.getAttribute('color');
  var order = 0;
  if( color.indexOf('#ffa500') != -1 ){
    order = 3;
  }
  else if( color.indexOf('#ff0000') != -1 ){
    order = 5;
  }
  else if( color.indexOf('#00ff00') != -1 ){
    order = 1;
  }
  else {
    order = 0;
  }
  return order;
}

function tableSort (cell, sortType) {

    var table = findTableParent (cell);

    if (table.tHead != null) {
	var row = table.tHead.rows[0].cells;

	for (var c = 0; c < row.length; c ++) {
	    if (c != cell.cellIndex) {
		row[c].style.color = "#ffffff";
	    }
	}
    }

    cell.style.color="#bbbbff";

    if (sortType == "Number") {
	cell.direction =
	    doSortTableNumerical (findTableParent (cell), cell.cellIndex, cell.direction);
    }
    else if (sortType == "Money") {
	cell.direction =
	    doSortTableMoney (findTableParent (cell), cell.cellIndex, cell.direction);
    }
    else if (sortType == "Text") {
	cell.direction =
	    doSortTable (findTableParent (cell), cell.cellIndex, cell.direction);
    }
    else if (sortType == "Difficulty") {
	cell.direction =
	    doSortTableByDifficulty (findTableParent (cell), cell.cellIndex, cell.direction);
    }
}
