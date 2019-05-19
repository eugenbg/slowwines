jQuery(document).ready(function(){

    var s = skrollr.init({
		edgeStrategy: 'set',
        smoothScrolling: true,
		easing: {
			WTF: Math.random,
			inverted: function(p) {
				return 1-p;
			}
		}
	});


}); // close out script