jQuery(function ($) {

    // Do stuff here

    // stop dummy links
	$('a[href="#"]').click(function(e){
	  e.preventDefault();
	});


	// Clean document of empty nodes
	function clean(node)
	  {
	    for(var n = 0; n < node.childNodes.length; n ++)
	    {
	      var child = node.childNodes[n];
	      if
	      (
	        child.nodeType === 8 || (child.nodeType === 3 && !/\S/.test(child.nodeValue))
	      )
	      {
	        node.removeChild(child);
	        n --;
	      }
	      else if(child.nodeType === 1)
	      {
	        clean(child);
	      }
	    }
	  }
	clean(document);

	// Slick - Relationship Layout
	$('[data-id=slick-relationship]').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});

	// Slick - Posts Layout
	$('[data-id=slick-post-objects]').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});

	// Isotope Settings
	// init Isotope
	var $grid = $('.grid').isotope({
	  itemSelector: '.card',
	  layoutMode: 'fitRows',
	  getSortData: {
	    name: '.name', // text from querySelector
	  }
	});

	// filter functions
	var filterFns = {
	};

	// store filter for each group
	var filters = [];

	// change is-checked class on buttons
	$('.filters').on( 'click', 'button', function( event ) {
	  var $target = $( event.currentTarget );
	  $target.toggleClass('is-checked');
	  var isChecked = $target.hasClass('is-checked');
	  var filter = $target.attr('data-filter');
	  if ( isChecked ) {
	    addFilter( filter );
	  } else {
	    removeFilter( filter );
	  }
	  // filter isotope
	  // group filters together, inclusive
	  $grid.isotope({ filter: filters.join(',') });
	});
	  
	function addFilter( filter ) {
	  if ( filters.indexOf( filter ) == -1 ) {
	    filters.push( filter );
	  }
	}

	function removeFilter( filter ) {
	  var index = filters.indexOf( filter);
	  if ( index != -1 ) {
	    filters.splice( index, 1 );
	  }
	}

	// bind sort button click
	$('#sorts').on( 'change', function() {
		var sortByValue = this.value;
		$grid.isotope({ sortBy: sortByValue });
		$grid.isotope('updateSortData').isotope();
	});




}); // jQuery End
