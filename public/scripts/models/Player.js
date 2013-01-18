define(function(require) {
	var Player = Backbone.Model.extend({
		urlRoot: '/players',

		defaults: {
			name: {
				first : "",
				last : ""
			},
			age : "",
			gender : "",
			fieldPosition: "",
			shirtNumber: "",
			characteristics : {
				acceleration: 0,
				stamina: 0,
				aggression: 0,
				marking: 0,
				balance: 0
			}
		},

		initialize: function () {
		}
	});

	return Player;
});