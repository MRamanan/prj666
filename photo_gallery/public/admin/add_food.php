<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php");}
?>
<html>
	<head>
	<title>Dietican Homepage</title>
	<link href= "../stylesheets/main.css" media-"all" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
		</script>
		
		<script>
			var saved_search_result;
			var p_hits = [];
			p_hits.Session_id = ("<?php echo $_SESSION['user_id'] ?>");
			var pagination=0;
			var page = 1;
			var num_of_search = 0;
		
			function titleCase(str) {
			  if(str != ""){
			  	str = str.trim();
				return str
					.toLowerCase()
					.split(' ')
					.map(function(word) {
						return word[0].toUpperCase() + word.substr(1);
										})
					.join(' ');
			 	}
			}
			
			function searchText(){
				var xhr = new XMLHttpRequest();
				var url = 'https://api.nutritionix.com/v1_1/search/';
				var food_searched = $("#food_search").val();
				var food_searched_raw = food_searched;
				var Brand_name = $("#brand_search").val();
				if(Brand_name == "")
					Brand_name = "USDA"
				//food_searched = food_searched.replace(/ /g,"%20");
				food_searched = titleCase(food_searched);
				food_searched = encodeURI(food_searched);
				console.log(food_searched);
				//url += 'Bagel%20Cream%20Cheese%20Tim%20Horton';
				url += food_searched;
				url += '?results=0%3A50&fields=item_name%2Citem_id%2Cbrand_name%2Cnf_calories%2Cnf_total_fat&appId=c77a537e&appKey=da91f1d0b2f2ddf643535178dca4ba7e';
				url = "https://api.nutritionix.com/v1_1/search";
				$.ajax({
					type:"POST",
					url: url,
					data:{
						
						  "appId":"c77a537e",
						  "appKey":"da91f1d0b2f2ddf643535178dca4ba7e",
						  "fields":["item_name","brand_name","nf_calories","nf_total_fat","nf_sodium","item_type"],
						   "offset": pagination,
						  "limit": 10,
						  "queries":{
						    "item_name":food_searched_raw,
						    "brand_name": Brand_name
						  }
						
					},
					async: true,
					dataType: 'json',
					success: function(data){
						console.log(data);
						console.log("we on page: " + page);
						//console.log($("#food_search").val());
						var return_text = "";
						saved_search_result = data;
						var counter = pagination;
						for(var i = 0; i <data.hits.length ; i++){
							// console.log(data.hits[i].fields.brand_name + " : " + data.hits[i].fields.item_name + "calories: "+ data.hits[i].fields.nf_calories + " fat: " + data.hits[i].fields.nf_total_fat);
							return_text += "<input type=\"button\"  value=\"" + (counter+1) + ") " + data.hits[i].fields.brand_name + " : " + data.hits[i].fields.item_name + "  calories: "+ data.hits[i].fields.nf_calories + " fat: " + data.hits[i].fields.nf_total_fat +"\" "+ " onclick=\"Food_Item_Button_Action(this);\""  + "style=\"border:none; background: none; padding:0;\" />"+ "<input type=\"checkbox\" id="+ i + "_checkbox  value=" + i+1  + ">  </br>";
							counter++;
						}
						
						$("#return_message").html(return_text);
						
						
						for(i = 0; i < p_hits.length; i ++){
							console.log(p_hits[i].ParentPage, p_hits[i].ParentArrayKey);
							if(  p_hits[i].Search_Count == num_of_search &&  page == p_hits[i].ParentPage){
								var check = "#"+p_hits[i].ParentArrayKey + "_checkbox";
								$(check).prop('checked', true);
							}
						}

					},
					error: function(jqXHR, textStatus, error) {}
				
				
			});
			}
			
			function ButtonClicked(){
				switch (this.id){
				 case "ajax-button":
				   pagination = 0;
				   page = 1;
				   num_of_search ++;
				   break;
				 case "previous-button":
				   if(pagination > 0){
			 		saveText();
					pagination -= 10;
					page --;
				   }
				   break;
				 case "next-button":
					if(saved_search_result.total > (pagination + 10)) {
						saveText();
						pagination += 10;
						page ++;
					}
					break;
				}
				
				searchText();
			}
			
			function Food_Item_Button_Action(obj){
				console.log("Hello");
				console.log(saved_search_result);
				var check = (obj.value).replace(/(^\d+)(.+$)/i,'$1');
				if(check > 10)
					check = (check -1)%10;
				else 
					check -= 1;
				var check1 = "#"+check+ "_checkbox";
				console.log(check);
				var removed = false;
				for(var x = 0; x < p_hits.length; x++){
						if(p_hits[x].ParentPage == page && p_hits[x].ParentArrayKey == check  && p_hits[x].Search_Count == num_of_search){
							p_hits.splice(x,1);
							removed = true;
						}	
					}
				$(check1).prop('checked', false);
				if(!removed){
				$(check1).prop('checked', true);
				saved_search_result.hits[check].fields.ParentArrayKey = check;
				saved_search_result.hits[check].fields.ParentPage = page;
				saved_search_result.hits[check].fields.Search_Count = num_of_search;
				p_hits.push(saved_search_result.hits[check].fields);
				}
				

				console.log(p_hits);

			}
			
			function saveText(){
			  for(var xn = 0; xn < p_hits.length; xn++)
				{
					p_hits[xn].mealTime = getSelectedText(xn + 'time_of_day');
				}
			  for (var i =0; i < saved_search_result.hits.length; i++){
			  	 var not_found = true;
				 var checboxid = '#'+ i + '_checkbox';
				 if($(checboxid).prop('checked')){
					for(var x = 0; x < p_hits.length; x++){
						if(p_hits[x].ParentPage == page && p_hits[x].ParentArrayKey == i && p_hits[x].Search_Count == num_of_search )
							not_found = false;
					}
					if(not_found){
						saved_search_result.hits[i].fields.ParentArrayKey = i;
						saved_search_result.hits[i].fields.ParentPage = page;
						saved_search_result.hits[i].fields.Search_Count = num_of_search;
						p_hits.push(saved_search_result.hits[i].fields);
					}
				  }
				  else {//if (p_hits[x].Search_Count == num_of_search) {
					for(var x = 0; x < p_hits.length; x++){
						if(p_hits[x].ParentPage == page && p_hits[x].ParentArrayKey == i && p_hits[x].Search_Count == num_of_search){
							p_hits.splice(x,1);
						}	
					}
				  }
				  
				}
				console.log(p_hits);
				p_counter = 0;
				return_text2 = "</br></br></br>";
				for(var i = 0; i <p_hits.length ; i++){
							// console.log(data.hits[i].fields.brand_name + " : " + data.hits[i].fields.item_name + "calories: "+ data.hits[i].fields.nf_calories + " fat: " + data.hits[i].fields.nf_total_fat);
							return_text2 += "<input type=\"button\" value=\"" + (p_counter+1) + ") " + p_hits[i].brand_name + " : " + p_hits[i].item_name + "  calories: "+ p_hits[i].nf_calories + " fat: " + p_hits[i].nf_total_fat + "\" style=\"border:none; background: none; padding:0;\" />"+ "<select id=" +i+"time_of_day><option value=\"breakfast\">breakfast</option><option value=\"lunch\">Lunch</option><option value=\"dinner\">Dinner</option><option value=\"snack\">Snack</option></select>" +"<input type=\"button\" id="+ i + "_checkboxInnerBox  value=" + 'X' + " onclick=\"DeleteItem(" +i+");\""  + ">  </br>";
							p_counter++;
						}
				var text_of_saved_items = 
				$("#items_saved").html(return_text2);
				for(var g = 0; g <p_hits.length ; g++){
					if(p_hits[g].mealTime != null){
						$("#"+g+"time_of_day").val(p_hits[g].mealTime.toLowerCase()).change();
					}
				}
				
			}

			function jsObj2phpObj(object){
				var json = "{"
				for(property in object){
					var value = object[property];
					console.log(typeof(value));
					if(typeof(value) == "string" || typeof(value) == "integer" || typeof(value) == "number"){
						json += '"' + property + '":"' + value +'",'
					} else{
						if(!value[0]){ // if its an associative array
							json += '"' + property + '":' + jsObj2phpObj(value) + ',';
						} else{
							json += '"'+ property + '":[';
							for(prop in value) {
								json+= '"' + value[prop]+ '",';
								json = json.substr(0,json.length-1) + "],";
							}
							
						}
					}
				}
				return json.substr(0, json.length-1) + "}";
				//return json+ "}";
			}

			function transferFoodChoiceToPhp(){
				var text = getSelectedText('0time_of_day');
				for(var xn = 0; xn < p_hits.length; xn++)
				{
					p_hits[xn].mealTime = getSelectedText(xn + 'time_of_day');
				}
				console.log(p_hits);
				var json = jsObj2phpObj(p_hits);
				

				$.post("json.php",{json:json}, function(data){
					console.log(data);
				});
			}
			function getSelectedText(elementId) {
    			var elt = document.getElementById(elementId);
    			if (elt == null || elt.selectedIndex == -1)
        			return null;
    			//return elt.options[elt.selectedIndex].text;
				return $("#"+elementId+" option:selected").text();
			}

			function DeleteItem(p_id){
				console.log(p_id);
				p_hits.splice(p_id,1);
				console.log(p_hits);
				return_text2 = "</br></br></br>";
				for(var i = 0; i <p_hits.length ; i++){
							// console.log(data.hits[i].fields.brand_name + " : " + data.hits[i].fields.item_name + "calories: "+ data.hits[i].fields.nf_calories + " fat: " + data.hits[i].fields.nf_total_fat);
							return_text2 +=  (p_counter+1) + ") " + p_hits[i].brand_name + " : <b> " + p_hits[i].item_name + "</b>  calories: "+ p_hits[i].nf_calories + " fat: " + p_hits[i].nf_total_fat+ "<input type=\"button\" id="+ i + "_checkboxInnerBox  value=" + 'X' + " onclick=\"DeleteItem(" +i+");\""  + ">  </br>";
							p_counter++;
						}
				var text_of_saved_items = 
				$("#items_saved").html(return_text2);
			}
		 </script>
	</head>
	<body>
		<div id="header">
		  <h1>Client Add Food</h1>
		  </div>
		  <div id="main">
		  <h2>Client</h2>
		  <li><a href="logout.php">Logout</a></li>
		   <?php 
		  //$user = User2::find_by_id($_SESSION['user_id']);
		  $userContact = Contact_information::find_by_id($_SESSION['user_id']);
		  echo "<h2>Welcome " . $userContact->full_name() . "</h2>";
		   ?>
		   This is the original text when the page first loads <br /><br />
		 	Brand Name: <input type="text" name="brand_search" id="brand_search" size="30"><br>
		 	Food to search: <input type="text" name="food_search" id="food_search" size="60"><br>
		 	<button id="ajax-button" type="button">Food Search</button>
			<button id="checkbox-button" type="button">Checkbox Return</button>
			<button id="previous-button" type="button">Previous Page</button>
			<button id="next-button" type="button">Next Page</button>	
			<button id="sendToPhp" type="button">SendToPhp</button>	
		 	<div id="return_message"></div>
		 	<div id="items_saved"></div>
		   <ul>
		   <li><a href="index.php">back to main page</a></li>
		   <li><a href="logout.php">Logout</a></li>
		   </ul>
		  


		  </div>


		  <p></p>

	<script type="text/javascript">
			var button = document.getElementById("ajax-button");
			var buttonNext = document.getElementById("next-button");
			var buttonPrev = document.getElementById("previous-button");
			var button2 = document.getElementById("checkbox-button");
			var button_sendTo_Php = document.getElementById("sendToPhp");
			button_sendTo_Php.addEventListener("click",transferFoodChoiceToPhp);
			button.addEventListener("click", ButtonClicked);
			button2.addEventListener("click", saveText);
			buttonPrev.addEventListener("click", ButtonClicked);
			buttonNext.addEventListener("click", ButtonClicked);
			$("#food_search").val("Cream Cheese Bagel");
			$("#brand_search").val("Tim Horton")

		</script>
	</body>
</html><!-- 
if(isset($database)) {echo "true";} else {echo "false";}
echo "<br />";
echo "Is this working";
echo "<br />";
$user = User::find_by_id(3);
echo $user->full_name();
// echo $found_user['username'];
// echo "<br />";
// echo $found_user['last_name'];
echo "<hr />";

$users = User::find_all();
foreach($users as $user){
	echo "UserID: ". $user->username . "<br />";
	echo "Full_name: ". $user->full_name() . "<br /><br />";
}

?> -->