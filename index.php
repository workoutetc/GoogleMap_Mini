<!DOCTYPE html>
<html>
  <head>
    <title>$.geocomplete()</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <style type="text/css" media="screen">
      form { width: 500px; }
      fieldset { width: 320px; margin-top: 20px}
      fieldset strong { display: block; margin: 0.5em 0 0em; }
      fieldset input { width: 95%; }
      #msg-history{display:none;}
	  input[type=text]{ padding:5px 5px;}
	  input[type=button]{  background:#1A8CFF; color:#FFFFFF; border:none; padding:5px 5px;}
	  ul#box li{ cursor:hand; cursor:pointer;border-bottom:1px solid #CCC;}
	  ul#box li:hover{ cursor:hand; cursor:pointer; border-bottom:1px solid #CCC; background:#1A8CFF; color:#FFFFFF;}
      ul span { color: #999; }
    </style>
  </head>
  <body>
    
    <div class="map_canvas"></div>
    
    <form>
      <input id="geocomplete" type="text" placeholder="Type in an address" value="Bangkok Thailand," />
      <input id="find" type="button" value="SEARCH" />
	  <input id="btn-history" type="button" value="HISTORY" />
      
	  <div id="msg-history">
	  <ul id="box">
		 <li><a href="javascript:;">&gt; BACK TO THE TWEET AND DATE</a></li>
	  </ul>
	  </div>
	  
      <ul>
        <li>Location: <span data-geo="location"></span></li>
        <li>Route: <span data-geo="route"></span></li>
        <li>Street Number: <span data-geo="street_number"></span></li>
        <li>Postal Code: <span data-geo="postal_code"></span></li>
        <li>Locality: <span data-geo="locality"></span></li>
        <li>Country Code: <span data-geo="country_short"></span></li>
        <li>State: <span data-geo="administrative_area_level_1"></span></li>
      </ul>

    </form>
	

    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    
    <script src="jquery.geocomplete.js"></script>
    
    <script>
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form ul",
          detailsAttribute: "data-geo"
        }).bind("geocode:result", function(event, result){
    			console.log(result);
				// alert(result);
				
				$.post("history.php", { namePlace:$("#geocomplete").val(),BtnSearch:true})
					  .done(function( data ) {
						// alert( "Data Loaded: " + data );
						//$("#box").appendChild(data);
						
				});
				
				
  		});
		
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
		
		
	
		
		$("#box li").live( "click", function() {
  				// alert( "Goodbye!" ); // jQuery 1.3+
				// alert( $(this).text());
				// alert($(this)[0].text()));
				if ($(this).is(":first-child")){
					//alert("frist");
					$("#geocomplete").val($(this).next().text()).trigger("geocode");
					
				}else{
					$("#geocomplete").val($(this).text()).trigger("geocode");
				}
		})
		
		
			$("#btn-history").click(function() {
 			// alert($("div#msg-history").css('display'));
			 
			if($("div#msg-history").css('display')=='none'){
				$("div#msg-history").fadeIn('slow');
				$.post("history.php", { namePlace:$("#geocomplete").val(),findhistory:true})
					   .done(function( data ) {
					  	
						//alert( "Data Loaded: " + data );
						$("#box").append(data);
			 	});
				
				
				}else{$("div#msg-history").fadeOut('slow');}
			});
		
		
		
      });
    </script>
    <div>Mini Project GoogleMap Search , Developer By Kritspon </div>
  </body>
</html>

