(function($j) {



	$j.fn.speedbumpLinks = function(excludedDomains, customText) {



		var myHostname = window.location.hostname;

			

		this.each(function() {

			if ($j(this).is('a')) {

				var $jlink       = $j(this).attr('href'),

					regExtract  = new RegExp(

						'^(http|ftp|https)://([a-zA-Z0-9-\._]*)', 'gi'),

					rep         = regExtract.exec($jlink);



				if (rep !== null && rep[2] !== myHostname) {



					rep[2]=(rep[2]).replace("www.","");



					if($j.inArray(rep[2],excludedDomains)==-1) {

						$j(this).click(function( event ) {

							var replaceText = customText.replace("[link]","<a class='outbound-link' target='blank' href='" + $jlink + "'>" + $jlink + "</a>");

							console.log(replaceText);

	  						event.preventDefault();

	  						$j( "<div class='overlay hide'>" ).hide()

						    .append( "<div class='overlay-content'><i class='overlay-close-btn hide'>X</i>" +

						    	replaceText +

						    	"<a class='outbound-link' target='blank' href='" + $jlink + "'>" +
						    	"<button class='uk-button uk-button-success'>Go to external link</button></a><br/><br />" +

						    	"<a class='overlay-hide' href='#'><button class='uk-button uk-button-danger'>Close window</button></a></div>" )

						    .appendTo( 'body' )

						    .fadeIn();



						    $j('.hide').click(function() {

						        $j('.overlay').hide();

							});

	  					});

					}

				}

			}

		});

	};



	// Close lightbox when clicking escape button

    document.onkeydown = function (e) {

        var keycode = '';

        $joverlay = $j( '.overlay');



        if (e === null) { // ie

            keycode = event.keyCode;

        } else { // mozilla

            keycode = e.which;

        }

        if (keycode === 27) { // escape, close box

            $joverlay.hide();

        }

    };



    $j.fn.closeOverlay = function() {

    	$jcloseBtn = $j( '.overlay-close-btn');



    	$jcloseBtn.click(function() {

	        $j('.overlay').hide();

		});

    }





})(jQuery);