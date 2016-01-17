$("#JeuAg").jScratchcard({
	opacity: 0.50,
	color: '#8AA4EC',
	stepx: 17,
	stepy: 17,
	mousedown: false
});

jQuery(function($){
    
    var launch = new Date(2012, 6-1, 19, 9, 00, 00);
    var days = $('#days');
    var hours = $('#hours');
    var min = $('#min');
    var sec = $('#sec');
    
    setDate();
    function setDate(){
        var now = new Date();
        var s = (launch.getTime() - now.getTime())/1000;
        var d = Math.floor(s/86400);
        days.html('<strong>' + d + '</strong><span class="DateText">Jour' + (d>1?'s</span>':'</span>'));
        s -= d*86400;
        
        var h = Math.floor(s/3600);
        hours.html('<strong>' + h + '</strong><span class="DateText">Heure' + (h>1?'s</span>':'</span>'));
        s -= h*3600;
        
        var m = Math.floor(s/60);
        min.html('<strong>' + m + '</strong><span class="DateText">Minute' + (m>1?'s</span>':'</span>'));
        s -= m*60;
        
        s = Math.floor(s);
        sec.html('<strong>' + s + '</strong><span class="DateText">Seconde' + (s>1?'s</span>':'</span>'));
        
        setTimeout(setDate, 1000);
    }
});

jQuery(document).ready(function() {
        jQuery('#mycarousel').jcarousel({
                // Configuration goes here
                vertical:false,
                rtl:false,	//Specifies wether the carousel appears in RTL (Right-To-Left) mode.
                start:1,	//The index of the item to start with.
                offset:1, //The index of the first available item at initialisation.
                size:10, //Number of existing <li> elements if size is not passed explicitly	The number of total items.
                scroll:2, //The number of items to scroll by.
                visible:3, //If passed, the width/height of the items will be calculated and set depending on the width/height of the clipping, so that exactly that number of items will be visible.
                animation:3000, //The speed of the scroll animation as string in jQuery terms ("slow" or "fast") or milliseconds as integer (See jQuery Documentation). If set to 0, animation is turned off.
                easing:null, //The name of the easing effect that you want to use (See jQuery Documentation).
                auto:5, //Specifies how many seconds to periodically autoscroll the content. If set to 0 (default) then autoscrolling is turned off.
                wrap:"both", //Specifies whether to wrap at the first/last item (or both) and jump back to the start/end. Options are "first", "last", "both" or "circular" as string. If set to null, wrapping is turned off (default).
                initCallback:null, //JavaScript function that is called right after initialisation of the carousel. Two parameters are passed: The instance of the requesting carousel and the state of the carousel initialisation (init, reset or reload).
                setupCallback:null, //JavaScript function that is called right after the carousel is completely setup. One parameter is passed: The instance of the requesting carousel.
                buttonNextHTML:"<div></div>",
                buttonPrevHTML:"<div></div>",
                buttonNextEvent:"click",
                buttonPrevEvent:"click",
                itemFallbackDimension:460
        });
});

 var iniSize = document.getElementById('global').offsetLeft;

function resi()
{
	var img = document.getElementById("JeuAg");
	var l = img.offsetLeft;
	var correct = document.getElementById('global').offsetLeft;
	
	for (i=0;i<34;i+=1) 
	{
		for (j=0;j<26;j+=1) 
		{
			try
			{
				var el = document.getElementById("e"+i+"_"+j);
				el.style.left = i*17 + correct + 30 + "px";
			}
			catch (err)
			{}
		}
	}
}
		