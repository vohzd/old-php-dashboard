// root domain
var rootDomain = "http://localhost/";
//var rootDomain = "http://intheon.uk";

// determine if offline mode should be used - not implemented yet
var internetStatus = (navigator.onLine ? true : false);

// My own little plugin to interact with the rest api
var UserManager = {

 	ajaxHandler: function(method, endpoint, payload, callback, authorisation)
	{
	/*
		Because at the end of the day, the server still is king!
		@method - whether get, post, put, or delete.
		@endpoint - where abouts on the api you want to fire the request to.
		@payload - any data you want to send to the server.
		@callback - the function to handle the server response
		@authorisation - our cookie of a token to reidentify the user
	*/
		$.ajax({
			type: 	method, 
			url: 	rootDomain + endpoint,
			headers:{
				Authorization: authorisation
			},
			data: 	{
				payload: 	payload
			},
			success: function(response){
				callback(response);
			},
			error: function(response)
			{
				console.log("server sez: ", response);
				if (response.status == 401) window.location = "login.php";
			},
			statusCode: function(status)
			{
				console.log(status);
			}
		});
	},

	usersAuth: function()
	{
		var cookie = JSON.parse($.cookie("authToken"));
		var cookieString = $.cookie("authToken");

		document.title = "Welcome home, " + cookie.username;
		$("#userName").html(cookie.username);

		return {
			cookie: cookie,
			cookieString: cookieString
		}
	},

	getUsersProfile: function()
	{
		var auth = UserManager.usersAuth();
		UserManager.ajaxHandler("GET", "rest-backend/api/user/" + auth.cookie.username, null, UserManager.parseUsersProfile, auth.cookieString);
	},

	getUsersWidgets: function(wCallback)
	{
		var auth = UserManager.usersAuth();
		UserManager.ajaxHandler("GET", "rest-backend/api/widget" + auth.cookie.username, null, wCallback, auth.cookieString);
	},

	parseUsersProfile: function(profile)
	{
		if (profile == "nowidgets") UserManager.introduction()
		else
		{
			var asObj = JSON.parse(profile);
			for (item in asObj) UserManager.loadWidget(asObj[item]);
		}
	},

	/////fugiohjkiuytsduio

	loadWidget: function(widgetInformation, numItems, counter)
	{
		// load main content panels
		$("#content-here").append("<div class='row full-page-panel' id='"+widgetInformation.widgetName+"-widget' data-widget="+widgetInformation.widgetName+"><div class='column-3'>&nbsp;</div><div class='column-9 content-area'></div></div>");
		$("#" + widgetInformation.widgetName + "-widget .content-area").load("../homepage" + widgetInformation.widgetPath);

		// load navigation
		$("#navigation-here").append("<div class='navigation-item'>"+ widgetInformation.widgetName+ "</div>");

		// make the panels scrollable
		UserManager.applyScrollify();
	},

	applyScrollify: function()
	{
		$.scrollify({
			section: 		".full-page-panel",
			sectionName: 	"widget",
			easing: 		"easeOutExpo",
			scrollSpeed: 	1000,
			offset : 		0,
			scrollbars: 	false,
			before: 		function(event){
				// event is just the number of the panel
				var integer = event;
			}
		});
	},

	introduction: function(returned)
	{
		var auth = UserManager.usersAuth();
		if (!returned)
		{
			UserManager.ajaxHandler("GET", "rest-backend/api/widget", null, UserManager.introduction, auth.cookieString);
		}
		else
		{
			var username = auth.cookie.username;
			var modalHeader = "Howdy," + username;
			var parsed = JSON.parse(returned);
			var modalContent = "<div class='widget-selector'><div class='widget-header'>Widgets are the things that make this site useful. Select some to start: </div>";

			for (item = 0; item < parsed.length; item++)
			{

				modalContent+= "<div class='widget-selector-item row'><div class='widget-name ui toggle checkbox column-4'><input type='checkbox' name='public' tabindex='0' class='hidden'><label>"+parsed[item].w_name+"</label></div><div class='widget-desc column-6'>"+ parsed[item].w_desc +"</div></div>"
			}

			modalContent+= "</div>";

			UserManager.createModal(auth, modalHeader, modalContent);
		}
	},

	convertJSONtoHTML: function(arrayOfJSON, label)
	{
		var html = "<div class='widget-selector-item' >"+ label +"</div>";
	},

	createModal: function(info, modalHeader, modalContent)
	{
		$("body").prepend("<div class='ui modal' id='modal'>\
			<i class='close icon'></i>\
			<div class='header modal-header'>" + modalHeader + "</div>\
			<div class='modal-content'>" + modalContent +"</div>\
			<div class='actions'>\
				<div class='ui green button' id='add-item-modal'>Cool</div>\
			</div>\
		</div>");

		$('.ui.checkbox').checkbox();
		$('.ui.modal').modal('show');
	},


}

// GO!
$(document).ready(function() {

	// all requests are authenticated by the api (tokenAuth.php is middleware which runs on each request)
	UserManager.getUsersProfile();

});

	
	/*

	// now, the meat

	// flow
	// get users metadata
	// if they are new, say hello, and prompt an introduction on how to add plugins
	// ascertain what plugins are needed
	// render
	// bind listeners / create navigation

	var UserMan = {

		// because at the end of the day, the server still is king
 		ajaxHandler: function(method, type, payload)
		{
			$.ajax({
				type: 	method,
				url: 	rootUrl + "/php/module_manage_credentials.php",
				data: 	{
					type: 		type,
					payload: 	JSON.stringify(payload)
				},
				success: function(response){
					console.log(response);
					//LoginModule.parseServerResponse(response);
				}
			});
		},

		getUserId: function()
		{
			var usr = $("#user-name-hidden").html();
			UserMan.ajaxHandler("GET", "getUserId", usr);
		},

		getUserProfile: function(id)
		{
			var fakePayload = [
			{
				name: "Calendar"
			},
			{
				name: "Todo"
			},
			{
				name: "News"
			}];

			NavigationHandler.addModules(fakePayload);
			MainContentHandler.addModules(fakePayload);
		}
	};

	var NavigationHandler = {
		addModules: function(payload){
			console.log("omg this works");
			console.log(payload);
		};	
	};

	var MainContentHandler = {
		addModules: function(payload){
			console.log("well hot piss");
		};
	};


	UserMan.getUserProfile();
*/






