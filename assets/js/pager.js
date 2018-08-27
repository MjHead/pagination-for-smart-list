( function( $ ) {

	"use strict";

	var JetSmartListPager = {

		init: function() {
			$( document ).on( 'jet-blog-smart-list/init', JetSmartListPager.addPagerHandler );
		},

		addPagerHandler: function( event, $scope, JetBlog ) {
			$scope.on( 'click.JetSmartListPager', '.jet-smart-list-pager__page', function( event ) {

				var $this       = $( this ),
					$wrapper    = $this.closest( '.jet-smart-listing-wrap' ),
					currentTerm = parseInt( $wrapper.data( 'term' ), 10 ),
					currentPage = $this.data( 'page' );

				JetBlog.requestPosts( $this, { term: currentTerm, paged: currentPage } );

			} );
		}

	};

	JetSmartListPager.init();

}( jQuery ) );