/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	//LIVE HTML
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-logo-link a' ).html( newval );
		} );
	} );

	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( to ) {

			if ( to ) {

				$( 'h1.site-title' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});

			} else {

				// Give it a few ms to remove the image before we show the title back.
				setTimeout( function() {
					$( 'h1.site-title' ).css({
						clip: 'auto',
						position: 'relative'
					});

					$( 'h1.site-title' ).removeClass( 'hidden' );
				}, 900 );
			}
		} );
	} );

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="custom_logo_max_width">@media (min-width: 600px) { body .custom-logo-link img.custom-logo { width: ' + to + 'px; } }</style>';

			el =  $( '.custom_logo_max_width' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

    wp.customize( 'body_secondary_typography_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="secondary-typography-color">body .post-meta a, body .post-meta span, body .post-meta span:before, body .project-meta p, body .project-meta p:before, body .widget_bean_tweets a.twitter-time-stamp { color: ' + newval + '!important; }</style>';

            el =  $( '.secondary-typography-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'body_typography_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="body-typography-color">body,body button,body input,body select,body textarea, p a:hover,body #content a:hover, body .widget-area a:hover, body #modal-content a:hover,body .tagcloud > a, body .tagcloud > a:hover, body .post-meta a:hover, body .project-meta a:hover { color: ' + newval + '!important; } body blockquote { border-color: ' + newval + '!important; }</style>';

            el =  $( '.body-typography-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'background_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="background-color">body.logged-in, body .site-header, body .site-footer { background: ' + newval + '!important; }</style>';

            el =  $( '.background-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'mark_project_modal', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="project-modal">body .modal-content--show { background: ' + newval + '; }</style>';

            el =  $( '.project-modal' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'mark_sitetitle_color', function( value ) {
        value.bind( function( newval ) {
            $('body h1.site-logo-link').css('color', newval );
        } );
    } );

    wp.customize( 'header_typography_color', function( value ) {
        value.bind( function( newval ) {
            $('body h1, body h2, body h3, body h4, body h5, body .main-navigation a').css('color', newval );
        } );
    } );

    wp.customize( 'mark_sidebarsocial_color', function( value ) {
        value.bind( function( newval ) {
            $('body .sidebar .social-navigation a').css('background', newval );
        } );
    } );

    wp.customize( 'mark_sitetitlehover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="site-logo-link-a-hover">body h1.site-logo-link a:hover { color: ' + newval + '!important; }</style>';

            el =  $( '.site-logo-link-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'mark_navigationicon_color', function( value ) {
        value.bind( function( newval ) {
            $('body .button--close span, body .mobile-menu-toggle span').css('background', newval );
        } );
    } );

    wp.customize( 'mark_navigationiconhover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="mobile-menu-toggle-a-hover">body .button--close:hover span, body .mobile-menu-toggle:hover span { background-color: ' + newval + '; }</style>';

            el =  $( '.mobile-menu-toggle-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'mark_project_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="project--color-std-js">body .project--color-std, body .projects .pagination a.next { background: ' + newval + '; }</style>';

            el =  $( '.project--color-std-js' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'mark_projecthover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="project--color-a-hover">body .project--color-hover, body .projects .pagination a.next:hover { background-color: ' + newval + '; }</style>';

            el =  $( '.project--color-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'mark_footertext_color', function( value ) {
        value.bind( function( newval ) {
            $('body .site-footer').css('color', newval );
        } );
    } );

    wp.customize( 'mark_footertexthover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="site-footer-a-hover">body #colophon.site-footer span:not(.badge--hire-me) a:hover { color: ' + newval + '; }</style>';

            el =  $( '.site-footer-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'mark_footersocial_color', function( value ) {
        value.bind( function( newval ) {
            $('body .site-footer .social-navigation a').css('background', newval );
        } );
    } );

    wp.customize( 'mark_badge_color', function( value ) {
        value.bind( function( newval ) {
            $('body .badge--hire-me a').css('border-color', newval );
            $('body .badge--hire-me a').css('color', newval );

            var style, el;
            style = '<style class="badge--hire-me-a-hover">body .badge--hire-me a:hover { background-color: ' + newval + '; }</style>';

            el =  $( '.badge--hire-me-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'mark_hireme_badge_shake', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.badge--hire-me a' ).addClass( 'animation--shake' );
            } else {
                $( '.badge--hire-me a' ).removeClass( 'animation--shake' );
            }
        } );
    } );

    wp.customize( 'powered_by_mark', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.site-theme' ).removeClass( 'hidden' );
            } else {
                $( '.site-theme' ).addClass( 'hidden' );
            }
        } );
    } );

    wp.customize( 'powered_by_wordpress', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.powered-by' ).removeClass( 'hidden' );
            } else {
                $( '.powered-by' ).addClass( 'hidden' );
            }
        } );
    } );

    wp.customize( 'mark_hireme_badge', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.badge--hire-me' ).removeClass( 'hidden' );
            } else {
                $( '.badge--hire-me' ).addClass( 'hidden' );
            }
        } );
    } );

    wp.customize( 'mark_hireme_badge_text', function( value ) {
        value.bind( function( newval ) {
            $( '.badge--hire-me a' ).html( newval );
        } );
    } );

    wp.customize( 'mark_hireme_badge_url', function( value ) {
        value.bind( function( newval ) {
            $( '.badge--hire-me a' ).attr( 'href', newval );
        } );
    } );

    wp.customize( 'nav_social_icons', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.sidebar .sidebar-social' ).removeClass( 'hidden' );
            } else {
                $( '.sidebar .sidebar-social' ).addClass( 'hidden' );
            }
        } );
    } );

	wp.customize( 'portfolio_cta_button', function( value ) {
		value.bind( function( newval ) {
			$( '.project-form .button' ).html( newval );
		} );
	} );

	wp.customize( 'portfolio_cta_email', function( value ) { } );

} )( jQuery );