$.validator.addMethod
(
	"greaterThanZero", 
	function( value, element )
	{
		return this.optional( element ) || ( parseFloat( value ) > 0 );
	},
	"* Amount must be greater than zero"
);