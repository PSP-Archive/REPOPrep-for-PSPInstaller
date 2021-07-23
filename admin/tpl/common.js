var permanentDeleteMessage = "WARNING\r\n\r\nYou are about to delete this file permanently. It can not be recovered after this.\r\n\r\nAre you absolutely sure you want to continue?";
var changeAccountMessage = "WARNING\r\n\r\nYou are about to change the account info.\r\n\r\nIt can not be restored after this. You will be logged out, and have to log in with the new information!\r\n\r\nAre you absolutely sure you want to continue?";
var changeRegistrationMessage = "WARNING\r\n\r\nYou are about to send the changed registration to the Master List for review.\r\n\r\nIt can not be cancelled after this. Your changes will be reviewed before they are updated in the Master List, and visible on the PSPInstaller. Untill they are, your old information will remain in use.\r\n\r\nAre you absolutely sure you want to continue?";
var forfeitkeyMessage = "WARNING\r\n\r\nYou are about to unregister this RepoPrep from the Master List.\r\n\r\nThis can not be restored after this. If this RepoPrep was registered with the Master List previously, that registration will be lost. You will have to re-register the RepoPrep with the Master List after unregistering.\r\n\r\nAre you absolutely sure you want to continue?";
$(document).ready(function () {
	$("#logintable input").each(function() {
		if (this.value.length == 0) {
			this.focus();
			return false;
		}
	});
	$('input.toggleAll').click(function() {
		var c = this.checked;
		$('input[type=checkbox]', $(this).parents('table')).each(function() {
			this.checked = c;
		});
	});
	$("div.statusmsg").slideDown("fast");
	$("div.success").delay(20000).slideUp("fast");
	$("div.statusmsg div.close").click(function() {
		$(this).parents("div.statusmsg").stop().slideUp("fast");
	});
	$("#email").blur(fixEmailLink);
	$("#uploadlink a").click(function() {
		$("#uploadlink").slideUp("fast");
		$("#uploadbox").slideDown("fast");
	});
	$("#uploadbox a").click(function() {
		$("#uploadbox").slideUp("fast");
		$("#uploadlink").slideDown("fast");
	});
	$("input.delete-button").click(function() {
		if (confirm(permanentDeleteMessage)) {
			$("#act").val("deletepermanently").parents("form").submit();
		}
	});
	autoFill('#search-query', 'Search for file(s)');
	setInterval(function() {
		$("a.timelink").each(function() {
			var o = $(this);
			var url = o.attr('href');
			o.attr('href',
				   url.substr(0, url.lastIndexOf('=')+1) +
				   parseInt(url.substr(url.lastIndexOf('=')+1)) + 60 );
		});
	}, 60000);
	$("#newstuff input[type=password]").val('');
	$("a.change-account").click(function() {
		$("#newstuff,input.save-button").slideDown('normal');
		$("#change").slideUp('normal');
		$("input.save-button").click(function() {
			if (confirm(changeAccountMessage)) {
				$("#act").val("changeaccount").parents("form").submit();
			} else {
				return false;
			}
		});
	});
	$("a.change-registration").click(function() {
		$("#newstuff,input.save-button").slideDown('normal');
		$("#change").slideUp('normal');
		$("input.save-button").click(function() {
			if (confirm(changeRegistrationMessage)) {
				$("#act").val("changeregistration").parents("form").submit();
			} else {
				return false;
			}
		});
	});
	$("a.forfeitkey").click(function() {
		if (confirm(forfeitkeyMessage)) {
			var s = this.href.toString();
			document.location = 'config.php?' + s.substr(s.indexOf('#')+1);
		} else {
			return false;
		}
	});
	
});

function headsupClick(action, obj) {
	if (action != 'delete' || (action == 'delete' && confirm(permanentDeleteMessage))) {
		var o = $(obj);
		$('#files input[type=checkbox]').each(function() {
			this.checked = false;
		});
		$('input[type=checkbox]', o.parents('tr')).get(0).checked = true;
		$('#files select').each(function() {
			this.value = action;
		});
		$("#files .apply-button:first").click();
	}
}

function autoFill(selector, text) {
    $(selector).focus(function() { 
		if($(this).val()==text){ $(this).val(""); }}).blur(function(){
		if($(this).val()==""){ $(this).val(text); }}).each(function() {
		if($(this).val()==""){ $(this).attr({ value: text }); }})
}


function fixEmailLink() {
	var reg = new RegExp("^([0-9a-zA-Z]([-.\\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\\w]*[0-9a-zA-Z]\\.)+[a-zA-Z]{2,9})$");
	var val = $("#email").val();
	if (reg.test(val)) {
		$('#emaillink').show().attr('href', 'mailto:' + val);
	} else {
		$('#emaillink').hide();
	}
}