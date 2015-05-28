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
        function ajaxSearch() {
            var input_data = $('#member').val();        // uzmi vrednost sa inputa
            if (input_data.length === 0) {              // ako nema nista sakrij predloge
                $('#suggestions').hide();
            } else {                                    // u suprotnom postavi parametar member
                var post_data = {
                    'member': input_data,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                };

                $.ajax({
                    type: "POST",
                    //url: "<?php echo base_url(); ?>index.php/NewGroupController/autocomplete/",
                    url: "http://localhost/CodeIgniter/index.php/NewGroupController/autocomplete",
                    data: post_data,
                    success: function(data) {   // ako je funkcija kontrolera uspesna
                        // return success    
                        if (data.length > 0) {
                            $('#suggestions').show();
                            $('#autoSuggestionsList').addClass('auto_list');
                            $('#autoSuggestionsList').html(data);
                        }
                    }
                });

            }
        }
        
        function chooseMember(member) {
            document.getElementById("member").value = member;
            $('#suggestions').hide();
            
            var input_data = $('#member').val();
            var post_data = {
                    'member': input_data,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                };

            $.ajax({
                    type: "POST",
                    //url: "<?php echo base_url(); ?>index.php/NewGroupController/addMember/",
                    url: "http://localhost/CodeIgniter/index.php/NewGroupController/addMember",
                    data: post_data,
                    success: function(data) {
                        // return success    
                        if (data.length > 0) {
                            $('#members').show();
                            //$('#members').addClass('auto_list');
                            //$('#members').html(data);
                            $('ol').append(data);
                        }
                    }
                });

        }