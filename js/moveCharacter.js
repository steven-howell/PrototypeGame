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
        $('#character_img').attr("src", 'https://dev.skycore.com:8012/platform/test/ProtoTypeGame/images/King-Left.png');
        break;
    case 38:
        $('#character').css('top', $('#character').offset().top - 10);
        $('#character_img').attr("src", 'https://dev.skycore.com:8012/platform/test/ProtoTypeGame/images/King-Rear.png');
        break;
    case 39:
        $('#character').css('left', $('#character').offset().left + 10);
        $('#character_img').attr("src", 'https://dev.skycore.com:8012/platform/test/ProtoTypeGame/images/King-Right.png');
        break;
    case 40:
        $('#character').css('top', $('#character').offset().top + 10);
        $('#character_img').attr("src", 'https://dev.skycore.com:8012/platform/test/ProtoTypeGame/images/King.png');
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
            callAction(elem);            
        }
    }
});



function callAction(elem) {
    
    var elementClass = $(elem).attr('class');
    var elementId = elem.id
    var elementWorld = $(elem).attr('data-world');
    
    var scriptCall = "https://dev.skycore.com:8012/platform/test/ProtoTypeGame/actions/" + elementClass + ".php?id=" + elementId + "&world_id=" + elementWorld;

    $.get(scriptCall, function(data) {
        
        var returnData = jQuery.parseJSON(data);
        
        if (returnData.action == 'obtain_item') {

            $("#consoleCurrentHealth").html(returnData.health);
            $("#consoleCurrentArmor").html(returnData.armor);
            $("#consoleGold").html(returnData.gold);
            $("#"+elementId).remove();
            
        } else if (returnData.action == 'goto_url') {
            window.location.href = returnData.url;
        } else if (returnData.action == 'interact') {
          
            // Add the message to the message console and show it
            $("#messages").html(returnData.message);
            
            showMessageConsole();
        }
    });      
}


function showMessageConsole()
{        
    // Show the message console
    $("#messages").show();
    
    // Fade out the messaging console after 5 seconds delay
    setTimeout(function() {
        $('#messages').fadeOut(600);
    }, 5000);
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