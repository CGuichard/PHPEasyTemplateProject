/**
 * @file phpeasytemplate.js
 * This file contain javascript functions needed in all pages
 * of the website.
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 *
 * @requires jquery-3.0.0 or up
 * @requires bootstrap-4.0.0 or up
 * @requires mdb-free-4.0.0 or up (mdb-pro-4.0.0 is also good)
 *
 * @see {@link https://jquery.com/|JQuery 3}
 * @see {@link https://getbootstrap.com/|Bootstrap 4}
 * @see {@link https://mdbootstrap.com/|Material Design for Bootstrap 4}
 * @see {@link https://fontawesome.com/|Font Awesome}
 *
 */

/* ===================== MAIN SCRIPT OF PHPEASYTEMPLATE ===================== */

/**
 * This function send an AJAX request to submit a form
 *
 * This function submit a form through AJAX request, but this function
 * use a particular format, with a boostrap alert block having an id, and it
 * title and message block having an id too. The submit button must have an
 * id too. Please take a look to existing examples in the website.
 *
 * @since 1.0
 *
 * @global
 *
 * @function send_ajax
 * @param {string} form_id - Form id
 * @param {string} btn_form_id - Submit button id
 * @param {string} alert_block_id - Alert div id
 * @param {string} alert_title_id - Alert title div id
 * @param {string} alert_text_id - Alert text div id
 * @param {function} next_function - Function to use when the request is
 *																	 a success
 *
 * @return {void}
 *
 */
function send_ajax(form_id, btn_form_id, alert_block_id, alert_title_id, alert_text_id, next_function) {
	const form = $("#"+form_id);
	const btn_form = $("#"+btn_form_id);
	const alert_block = $("#"+alert_block_id);
	const alert_title = $("#"+alert_title_id);
	const alert_text = $("#"+alert_text_id);
	alert_block.prop('hidden', true);
	form.submit(function(event){
		event.preventDefault();
		const formData = form.serialize();
		const btncontent = btn_form.html();
		btn_form.html("<i class='fas fa-spinner fa-lg fa-pulse'></i>");
		alert_block.prop('hidden', true);
		$.ajax({
			type: 'POST',
			url: form.attr('action'),
			data: formData,
			dataType: 'JSON',
			success: function(rep) {
				if (rep["success"] == 200) {
					if(next_function != null)
						next_function();
					else
						window.location.href = "";
				} else {
					if(rep["success"] == 500) {
						if(alert_block.hasClass("alert-success"))
							alert_block.removeClass("alert-success");
						if(alert_block.hasClass("alert-warning"))
							alert_block.removeClass("alert-warning");
						if(!alert_block.hasClass("alert-danger"))
							alert_block.addClass("alert-danger");
					} else if(rep["success"] == 404) {
						if(alert_block.hasClass("alert-success"))
							alert_block.removeClass("alert-success");
						if(alert_block.hasClass("alert-danger"))
							alert_block.removeClass("alert-danger");
						if(!alert_block.hasClass("alert-warning"))
							alert_block.addClass("alert-warning");
					}
					alert_title.text(rep["title"]);
					alert_text.text(rep["response"]);
					alert_block.prop('hidden', false);
					btn_form.html(btncontent);
				}
			},
			error: function(req, status, err) {
				if(alert_block.hasClass("alert-success"))
					alert_block.removeClass("alert-success");
				if(alert_block.hasClass("alert-warning"))
					alert_block.removeClass("alert-warning");
				if(!alert_block.hasClass("alert-danger"))
					alert_block.addClass("alert-danger");
				alert_title.text("ERROR");
				if(err == "") err = "Cannot connect to the server"
				alert_text.text(err);
				alert_block.prop('hidden', false);
				btn_form.html(btncontent);
			}
		});
	});
}


/**
 * This function trigger the welcome modal if it exist
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_connection_modal
 *
 * @return {void}
 *
 */
function manage_connection_modal() {
	if($("#modal-connection-success").length) {
		$("#modal-connection-success").modal();
	}
}

/**
 * This function define the sending of AJAX request for login submit
 *
 * This function redefine the sign in form submit event to send an AJAX request
 * and handle the
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_sign_in
 *
 * @return {void}
 *
 */
function manage_sign_in() {
	if($("#form-connec").length) {
		send_ajax("form-connec", "btnlogin", "alert-connec", "alert-connec-title", "alert-connec-msg", function() {
			window.location.href = $("#form-connec-next").val();
		});
	}
}


/**
 * Handle the header display
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_header_display
 * @param {int} current_scroll_top - Current distance in pixel from the top
 *																	 of the page view
 *
 * @return {void}
 *
 */
function manage_header_display(current_scroll_top) {
	const page_padding = 0;
	const in_a = "rotateIn";
	const out_a = "rotateOut";
	const header_height = $('#header-block').height();
	const navbar_height = $('#navbar').height();
	if(current_scroll_top > header_height) {
    $('#navbar-title').show();
		$('#top-arrow').show();
		$('#top-arrow').removeClass('animated '+out_a);
		$('#top-arrow').addClass('animated '+in_a);
		$('#navbar').addClass('fixed-top');
		$('#navbar').addClass('z-depth-2');
		$('header').css('margin-bottom', (page_padding+navbar_height+16)+'px');
	} else {
    $('#navbar-title').hide();
		$('#top-arrow').removeClass('animated '+in_a);
		$('#top-arrow').addClass('animated '+out_a);
		$('#navbar').removeClass('fixed-top');
		$('#navbar').removeClass('z-depth-2');
		$('header').css('margin-bottom', page_padding+'px');
	}
}


/**
 * Handle the top arrow display
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_top_arrow_display
 * @param {int} current_scroll_bot - Current distance in pixel from the bottom
 *																	 of the page view
 *
 * @return {void}
 *
 */
function manage_top_arrow_display(current_scroll_bot) {
	const footer_height = $('#footer').height();
	if(current_scroll_bot > footer_height) {
		$('#top-arrow').css("bottom", "10px");
	} else {
		$('#top-arrow').css("bottom", (footer_height-current_scroll_bot+15)+"px");
	}
}

/**
 * Manage the smooth scroll when click event on the top arrow
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_scroll
 *
 * @return {void}
 *
 */
function manage_scroll() {
	$(document).on('click', 'a[href^="#"]', async function (e) {
		// target element id
		const id = $(this).attr('href');
		// target element
		const $id = $(id);
		// if there is no element corresponding to the id stop the function
		if ($id.length === 0) { return; }
		// prevent standard hash navigation (avoid blinking in IE)
		e.preventDefault();
		// top position relative to the document
		const pos = $id.offset().top;
		// animated top scrolling
		$('body, html').animate(
			{scrollTop: pos-80},
			{duration: 1000}
		);
	});
}

/**
 * Manage the smooth dropdown
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_dropdown
 *
 * @return {void}
 *
 */
function manage_dropdown() {
	// Add slideDown animation to Bootstrap dropdown when expanding.
	$('#navbar-right .dropdown').on('show.bs.dropdown', function() {
		$(this).find('.dropdown-menu').first().stop(true, true).slideDown("400");
	});
	// Add slideUp animation to Bootstrap dropdown when collapsing.
	$('#navbar-right .dropdown').on('hide.bs.dropdown', function() {
		$(this).find('.dropdown-menu').first().stop(true, true).slideUp("400");
	});

	$("#navbar-left .dropdown").hover(
			function() {
					$('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
					$(this).toggleClass('open');
			},
			function() {
					$('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
					$(this).toggleClass('open');
			}
	);
}

/**
 * Manage jarallax initialization when it exist
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_jarallax
 *
 * @return {void}
 *
 */
function manage_jarallax() {
	if(typeof jarallax != 'undefined') {
		jarallax(document.querySelectorAll('.jarallax'), {
		  disableParallax: /iPad|iPhone|iPod|Android/,
		  disableVideo: /iPad|iPhone|iPod|Android/
		});
		$('.jarallax').jarallax({
			speed: 0.5,
			imgPosition: "0% 0%",
			imgSize: "cover",
		});
	} else {
		// console.log("jarallax not loaded");
	}
}

/**
 * Manage the display of the footer, the header, and the top-arrow
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_display
 *
 * @return {void}
 *
 */
function manage_display() {
	$('#top-arrow').hide();
	if($(window).height() == $(document).height()) {
		$(".page-footer").addClass("fixed-bottom");
	}
	const navlinks = $(".navbar .nav-link");
	const actual = $("#page-section")[0].innerText;
	for (link of navlinks)
		if(link.innerText === actual)
			$(link).addClass("active");
	let posTop = $(window).scrollTop();
	let posBot = $(document).height() - $(window).height() - posTop;
	manage_header_display(posTop);
	manage_top_arrow_display(posBot);
	$(window).scroll(function() {
		posTop = $(window).scrollTop();
		posBot = $(document).height() - $(window).height() - posTop;
		manage_header_display(posTop);
		manage_top_arrow_display(posBot);
	});
}

/**
 * Main function, call all needed functions
 *
 * @since 1.0
 *
 * @global
 *
 * @function manage_display
 *
 * @return {void}
 *
 */
function main() {
	new WOW().init();
	manage_display();
	manage_scroll();
	manage_dropdown();
	manage_jarallax();

	manage_sign_in();
	manage_connection_modal();
}

main(); // Load all functions
