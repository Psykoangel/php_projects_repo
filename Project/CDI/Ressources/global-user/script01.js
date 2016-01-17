//Begin of the jquery "After-Page-load" function
$(document).ready((function() {
    
    var $elements = $("#borrowed").children().length; //Element's number in the shopping cart
    
    //function that verify if there are less than 3 items in the shopping cart
    //it disable the droppable ability of the cart if the 3 items are already present
    function test($elem)
    {
        if($elem == 1)
        {
            $( "#left ul" ).find( ".placeholder" ).show('slow');
        }
        else
        {
            if($elem >= 4)
            {
                $( "#left ul" ).droppable('option', 'disabled', true);
                $('#error01').css('display', 'block');
            }
            else
            {
                $( "#left ul" ).droppable('option', 'disabled', false);
                $('#error01').css('display', 'none');
            }
        }
    }    
    
    test($elements);
    
    //function that open a Detail jquery window of a selected book without deleting the focused div
     $('h5').click(function(){
            var divDialog = $( this ).next('div');
            var clone =divDialog.clone();
            clone.attr({'id':'clone'});
            clone.appendTo('#dial');
            
            var $dialog = clone.dialog({
                                autoOpen: true,
                                draggable: false,
								modal: true,
                                title: "Détails du média : ",
                                close : function(event, ui) 
                                    {
                                    $("#clone").remove();
                                    }})
           $dialog.dialog('open');
        });
                            

    
    //the next function let the list items of the main list of books be draggable
		$( "#main ul li" ).draggable({
			appendTo: "body",
                        containment: "window",
			helper: "original",
                        opacity: 0.6,
                        revert: true,
                        drag: function(event, ui) {
                            $(".ui-draggable-dragging").parent().parent().css("overflow", "visible");
                            $("footer").css("display", "none");
                            $("#main").css("-moz-transition", "2s");
                            $("#main").css("min-height", "380");
                        },
                        stop: function(event, ui){
                            $(".ui-draggable-dragging").parent().parent().css("overflow-y", "scroll");
                            $("footer").css("display", "block");
                            $("#main").css("-moz-transition", "2s");
                            $("#main").css("min-height", "300");             
                        }
		});
          
     //idem than the previous function
                $( "#left ul li" ).draggable({
                        revert: true
                });
                
     //function that let the unordonnated list of the shopping cart be droppable and sortable
		$( "#left ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper, .placeholder)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).hide('slow');
				$( "<li></li>" ).text( ui.draggable.find('h5').text() )
                                                .attr({'id':'BookName' + $elements})
                                                .appendTo( this );
                                
                                var $splitted = ui.draggable.find('p:first-child').text().split(' ');
                                $( "<input />" ).attr({'type':'hidden', 'id': 'BookName' + $elements,  'name':'Id' + $elements,'value': parseInt($splitted[1])}).appendTo('#left form');
                                                
                                $elements = $( this ).children().length;
                                test($elements);
			}
		}).sortable({
			items: "li:not(.placeholder)",
			sort: function() {
                        $( this ).removeClass( "ui-state-default" );
			}
		});
                
     //function that let the main div be droppable           
                $( "#main" ).droppable({
                        accept: ":not(.books, .placeholder)",
                        drop: function( event, ui ) {
                                $elements -= 1;
                                ui.draggable.remove();
                                $('#' + ui.draggable.attr('id')).remove();
                                test($elements);
                    }
                });
}));