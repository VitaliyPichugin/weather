(function( $ ) {
	'use strict';

    $( window ).load(function() {
        $('#day1, #day2, #day3').live('click', function (e) {
			e.preventDefault();
            $.ajax({
                type: "POST",
                url: MyAjax.ajaxurl,
                data: {
					type: $(this).attr('id'),
                    action: 'get_data'
				},
                beforeSend: function () {
                    $('.weather').css({
                        textAlign : 'center'
                    }).html('<div id="loadFacebookG">\n' +
                        '\t<div id="blockG_1" class="facebook_blockG"></div>\n' +
                        '\t<div id="blockG_2" class="facebook_blockG"></div>\n' +
                        '\t<div id="blockG_3" class="facebook_blockG"></div>\n' +
                        '</div>');
                },
                success: function (html) {
                    $('.weather').css('text-align', 'inherit').html(html);
                },
                error: function (e) {
                    console.log(e);
                }

			});
        });
     });

})( jQuery );
