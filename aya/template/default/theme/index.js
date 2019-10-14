jQuery(document)
		.ready(
				function($) {

					$("#switcher-handle > #handle").click(function() {
						var fix=$.cookie("fix_diynavbar");
						
						if ($(this).hasClass('out')) {
							$.cookie('fix_diynavbar', '1', { path:'/' });
							
							$('#switcher-handle').animate({
								left : '-212px'
							}, {
								queue : false,
								duration : 200
							});
							$(this).removeClass('out');
						} else {

							$.cookie('fix_diynavbar', '', { path:'/' });
							$('#switcher-handle').animate({
								left : '0px'
							}, {
								queue : false,
								duration : 200
							});
							$(this).addClass('out');
						}
					});

					$('#style-switcher a.color-box').each(function(i) {
						var a = $(this);
						var color = $(this).attr('data-rel');
						a.css({
							backgroundColor : '#' + color,
							backgroundRepeat : "repeat",
							backgroundPosition : "49% 50%"
						});

					}).click(
							function(e) {
								var color = $(this).attr('data-rel');
								$('#theme_css').attr(
										'href',
										AYA_TURL + "aya/css/theme-" + color
												+ ".css");

								T_theme_css = "theme-" + color + ".css";
								return false;

							});

					$('#style-switcher select').change(
							function() {
								var b = $(this).children(":selected").val();
								if (b == 'boxed') {
									$(".container").attr('style', '');
									T_container = '';
								} else if (b == 'wide') {
									$(".container").attr('style',
											'max-width:100%;margin:0;');
									T_container = 'max-width:100%;margin:0;';
								}
							});

					$('#style-switcher a.bg-box').each(
							function(i) {
								var rel = $(this).attr('data-rel');
								if (rel != '') {
									var backgroundUrl = 'url(' + AYA_TURL
											+ 'theme/bg/' + rel + '.png)';
									var a = $(this);
									a.css({
										backgroundImage : backgroundUrl,
										backgroundRepeat : "repeat",
										backgroundAttachment : "local",
										backgroundSize : "auto"
									})
								}
							}).click(
							function(e) {
								e.preventDefault();
								var rel = $(this).attr('data-rel');
								if (rel != '') {
									var patternUrl = 'url(' + AYA_TURL
											+ 'theme/bg/' + rel + '.png)';
									$('body').css({
										backgroundImage : patternUrl,
										backgroundRepeat : "repeat"
									});

									T_body = 'background-image: ' + patternUrl
											+ '; background-repeat: repeat;';
								} else {
									$('body').removeAttr("style");
									T_body = '';
								}

							});

					$('#style-switcher a.bgimg-box')
							.each(
									function(i) {
										var rel = $(this).attr('data-rel');
										if (rel != '') {
											var backgroundUrl = 'url('
													+ AYA_TURL + 'theme/bg/'
													+ rel + '.jpg)';
											var a = $(this);
											a
													.css({
														backgroundImage : backgroundUrl,
														backgroundRepeat : "no-repeat",
														backgroundAttachment : "fixed",
														backgroundSize : "cover",
														backgroundPosition : "49% 50%"
													})
										}
									})
							.click(
									function(e) {
										e.preventDefault();
										var rel = $(this).attr('data-rel');
										if (rel != '') {
											var backgroundUrl = 'url('
													+ AYA_TURL + 'theme/bg/'
													+ $(this).attr('data-rel')
													+ '.jpg)';
											$('body')
													.css(
															{
																backgroundImage : backgroundUrl,
																backgroundRepeat : "no-repeat",
																backgroundAttachment : "fixed",
																backgroundSize : "cover",
																backgroundPosition : "49% 50%"

															});

											T_body = 'background-image: '
													+ backgroundUrl
													+ '; background-attachment: fixed; background-size: cover; background-position: 49% 50%; background-repeat: no-repeat;';
										} else {
											$('body').removeAttr("style");
											T_body = '';
										}

									});

				});
