var showMenu3 = true;
var showMenu4 = true;

	function  menuClick(menu) {
		if ((showMenu3 && menu == "3") || (showMenu4 && menu == "4")) {
			showMenu(menu);
			if (menu == "3")
				showMenu3 = false;
			else
				showMenu4 = false;
			} else {
				hideMenu(menu)
				if (menu == "3")
					showMenu3 = true;
				else
					showMenu4 = true;
			}
	}
		
	function showMenu(menu) {
		
		if (menu == 4) {
			document.getElementById(menu).style.width = "400px";	// 
			document.getElementById(menu).style.height = "400%";	// izvlaci traku s notifikacijama
		} else {
			document.getElementById(menu-2).style.transform = "rotate(135deg)";	// rotira dugme
			document.getElementById(menu).style.top = "110%";	// izvlaci meni
		}
	}
		
	function hideMenu(menu) {
			
		if (menu == 4) {
			document.getElementById(menu).style.width = "0";	//
			document.getElementById(menu).style.height = "0";	// sakriva traku s notifikacijama
		} else {
			document.getElementById(menu-2).style.transform = "rotate(0deg)";	// rotira dugme
			document.getElementById(menu).style.top = "-300%";	// sakriva meni
		}	
	}
	
	
	/* **		SEARCH BAR		** */
	function showResult(str) {
		if (str.length==0) { 
			document.getElementById("livesearch").innerHTML="";
			document.getElementById("livesearch").style.border="0px";
			return;
		}
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
				document.getElementById("livesearch").style.border="1px solid #A5ACB2";
			}
		}
		  xmlhttp.open("GET","livesearch.php?q="+str,true);
		  xmlhttp.send();
		}