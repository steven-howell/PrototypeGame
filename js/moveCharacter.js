$(document).ready(function() {

    var char_pos_left = getCookie('char_pos_left');
    var char_pos_top = getCookie('char_pos_top');
    
    if (char_pos_left == '' || char_pos_top == '') {
        
        document.cookie="char_pos_left=0";
        document.cookie="char_pos_top=200";  
        
        var char_pos_left = 0;
        var char_pos_left = 200;
    }

    $("#character").css({top: char_pos_top, left: char_pos_left});
    
});

$(document).keydown(function(e) {
    
    switch (e.which) {
    case 37:
        $('#character').css('left', $('#character').offset().left - 10);
        break;
    case 38:
        $('#character').css('top', $('#character').offset().top - 10);
        break;
    case 39:
        $('#character').css('left', $('#character').offset().left + 10);
        break;
    case 40:
        $('#character').css('top', $('#character').offset().top + 10);
        break;
    }
    
    // Update position cookies
    var position = $("#character").position();
    
    document.cookie="char_pos_left=" + position.left;
    document.cookie="char_pos_top=" + position.top;    
});


$(document).keypress(function(e) {
    if (e.which == 13) {
        
        var position = $("#character").position();
        
        var pos_left = position.left + 25;
        var pos_top = position.top + 25;
        
        var elem = document.elementFromPoint(pos_left, pos_top);

        if (elem.id != "character" && elem.id != "") {
        
            callAction($(elem).attr('class'), elem.id);            
        }
    }
});



function callAction(elementClass, elementId) {
    
    var element = elementId.split("_");
    
    var scriptCall = "actions/" + elementClass + ".php?id=" + elementId;
    
    $.get(scriptCall, function(data) {
        
        var returnData = jQuery.parseJSON(data);
        
        if (returnData.action == 'obtain_item') {
            $("#"+elementId).remove();
        } else if (returnData.action == 'goto_url') {
            window.location.href = returnData.url;
        }
        
        if (returnData.outcome == "success") {
            $("#"+elementId).remove();
        }
    });      
}


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}