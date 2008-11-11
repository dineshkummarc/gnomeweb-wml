// JavaScript Document


//------- PAYPAL CART SCRIPT FOR : chronojump --------------/////


function CalculateOrder(form)
{
	// 1 chronopic: 80gr
	// sobre pequeño 0.80 euros

	// ATENCIO: per mes de 4 chronopics caldra sobre + gran!! i mes car. Mirar tarifes, pag 11
	//sobre pequeño 0.80 (1-6 chronopics)
	//sobre mediano 1 (7-12 chronopics)
	//sobre grande 1.75 (13-24 chronopics)

	// alert("Please, select total number of Chronopics");
/*	
if (form.quantity.index == 0 || form.quantity.index == -1) {
	 alert("Please, select total number of Chronopics");
	 return false;
}
*/
		
if(form.lang.value == "en") {
	form.item_name.value = "Ship Chronopics"
	form.on0.value = "place"
	form.on1.value = "rate of"
} else if (form.lang.value == "es") {
	form.item_name.value = "Enviar Chronopics"
	form.on0.value = "lugar"
	form.on1.value = "tarifa de"
} else if (form.lang.value == "ca") {
	form.item_name.value = "Enviar Chronopics"
	form.on0.value = "lloc"
	form.on1.value = "tarifa de"
}


if (form.place[0].checked)
 {
	 form.os0.value = "Spain"
		 
	 /* 
	  * tarifes nacionals correus 2008 cartes certificades (llibret Tarifes)
	  * 1 chronopic >50-100gr 3.20 + sobre.p = 4
	  * 2 | >100-200gr 3.60 + sobre.p = 4.4
	  * 3-4 | >200-350gr 4.50 + sobre.p = 5.3
	  * 5-6 | >350-500gr 6 + sobre.p = 6.8
	  * 7-12 | >500-1000gr 6.50 + sobre.m = 7.5
	  * 13-18 | >1000-1500gr 6.95 + sobre.g = 8.7
	  * 19-24 | >1500-2000gr 7.30 + sobre.g = 9.05
	  */
	 if (form.quantity_pre.value == 1) {
		 form.os1.value = "1 chronopic"
		 form.amount.value = 4
	 } else if (form.quantity_pre.value == 2) {
		 form.os1.value = "2 chronopics"
		 form.amount.value = 4.4
	 } else if (form.quantity_pre.value == 3) {
		 form.os1.value = "3 chronopics"
		 form.amount.value = 5.3
	 } else if (form.quantity_pre.value == 4) { //different than above for the "handling" at end of file
		 form.os1.value = "4 chronopics"
		 form.amount.value = 5.3
	 } else if (form.quantity_pre.value >= 5 && form.quantity_pre.value <= 6) {
		 form.os1.value = "5-6 chronopics"
		 form.amount.value = 6.8
	 } else if (form.quantity_pre.value >= 7 && form.quantity_pre.value <= 12) {
		 form.os1.value = "7-12 chronopics"
		 form.amount.value = 7.5
	 } else if (form.quantity_pre.value >= 13 && form.quantity_pre.value <= 18) {
		 form.os1.value = "13-18 chronopics"
		 form.amount.value = 8.7
	 } else if (form.quantity_pre.value >= 19 && form.quantity_pre.value <= 24) {
		 form.os1.value = "19-24 chronopics"
		 form.amount.value = 9.05
	 }

 }

//else if (form.os0.value == "europe")
else if (form.place[1].checked)
 {
	 form.os0.value = "Europe and Groenland"
		 
	 /* 
	  * tarifes europa, groenlandia correus 2008 cartes certificades (llibret Tarifes)
	  * 1 chronopic >50-100gr 4.40 + sobre.p = 5.2
	  * 2 | >100-200gr 6.25 + sobre.p = 7.05
	  * 3-4 | >200-350gr 9.40 + sobre.p = 10.2
	  * 5-6 | >350-500gr 12.10 + sobre.p = 12.9
	  * 7-12 | >500-1000gr 13.75 + sobre.m = 14.75
	  * 13-18 | >1000-1500gr 19.45 + sobre.g = 21.2
	  * 19-24 | >1500-2000gr 21.90 + sobre.g = 23.65
	  */
	 if (form.quantity_pre.value == 1) {
		 form.os1.value = "1 chronopic"
		 form.amount.value = 5.2
	 } else if (form.quantity_pre.value == 2) {
		 form.os1.value = "2 chronopics"
		 form.amount.value = 7.05
	 } else if (form.quantity_pre.value == 3) {
		 form.os1.value = "3 chronopics"
		 form.amount.value = 10.2
	 } else if (form.quantity_pre.value == 4) { //different than above for the "handling" at end of file
		 form.os1.value = "4 chronopics"
		 form.amount.value = 10.2
	 } else if (form.quantity_pre.value >= 5 && form.quantity_pre.value <= 6) {
		 form.os1.value = "5-6 chronopics"
		 form.amount.value = 12.9
	 } else if (form.quantity_pre.value >= 7 && form.quantity_pre.value <= 12) {
		 form.os1.value = "7-12 chronopics"
		 form.amount.value = 14.75
	 } else if (form.quantity_pre.value >= 13 && form.quantity_pre.value <= 18) {
		 form.os1.value = "13-18 chronopics"
		 form.amount.value = 21.2
	 } else if (form.quantity_pre.value >= 19 && form.quantity_pre.value <= 24) {
		 form.os1.value = "19-24 chronopics"
		 form.amount.value = 23.65
	 }
 }

//if (form.os0.value == "world")
else if (form.place[2].checked)
 {
	 form.os0.value = "Rest of the World"
	 
		 /* 
	  * tarifes resta del mon correus 2008 cartes certificades (llibret Tarifes)
	  * 1 chronopic >50-100gr 4.74 + sobre.p = 5.54
	  * 2 | >100-200gr 7.29 + sobre.p = 8.09
	  * 3-4 | >200-350gr 11.54 + sobre.p = 12.34
	  * 5-6 | >350-500gr 18.24 + sobre.p = 19.04
	  * 7-12 | >500-1000gr 20.99 + sobre.m = 21.99
	  * 13-18 | >1000-1500gr 33.24 + sobre.g = 34.99
	  * 19-24 | >1500-2000gr 37.99 + sobre.g = 39.64
	  */
	 if (form.quantity_pre.value == 1) {
		 form.os1.value = "1 chronopic"
		 form.amount.value = 5.54
	 } else if (form.quantity_pre.value == 2) {
		 form.os1.value = "2 chronopics"
		 form.amount.value = 8.09
	 } else if (form.quantity_pre.value == 3) {
		 form.os1.value = "3 chronopics"
		 form.amount.value = 12.34
	 } else if (form.quantity_pre.value == 4) { //different than above for the "handling" at end of file
		 form.os1.value = "4 chronopics"
		 form.amount.value = 12.34
	 } else if (form.quantity_pre.value >= 5 && form.quantity_pre.value <= 6) {
		 form.os1.value = "5-6 chronopics"
		 form.amount.value = 19.04
	 } else if (form.quantity_pre.value >= 7 && form.quantity_pre.value <= 12) {
		 form.os1.value = "7-12 chronopics"
		 form.amount.value = 21.99
	 } else if (form.quantity_pre.value >= 13 && form.quantity_pre.value <= 18) {
		 form.os1.value = "13-18 chronopics"
		 form.amount.value = 34.99
	 } else if (form.quantity_pre.value >= 19 && form.quantity_pre.value <= 24) {
		 form.os1.value = "19-24 chronopics"
		 form.amount.value = 39.64
	 }

 }

if(form.lang.value == "en") {
	 form.os1.value = form.os1.value + ". Note: next column \"Quantity\" should be 1"
} else if (form.lang.value == "es") {
	 form.os1.value = form.os1.value + ". Nota: la siguiente columna \"Cantidad\" debe ser 1"
} else if (form.lang.value == "ca") {
	 form.os1.value = form.os1.value + ". Nota: la següent columna \"Quantitat\" ha de ser 1"
}

//manage handling
a = form.amount.value;

if (form.quantity_pre.value == 1) {
	b = 1.6;
} else if (form.quantity_pre.value == 2) {
	b = 2.8;
} else if (form.quantity_pre.value == 3) {
	b = 4;
} else {
	b = 5;
}  

var a2 = a*1;
var b2 = b*1;

form.amount.value = (a2+b2);

}

//--------------------------------------------------------------//
