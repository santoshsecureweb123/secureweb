$(document).ready(function() {
	$("#skills").select2({
    // tags: true,
    placeholder: "Select a skills",
    multiple:true,
    tokenSeparators: [',', ' ']
	})

	$("#team_member").select2({
    placeholder: "Select a Team",
    multiple:true,
    tokenSeparators: [',', ' ']
	})

});