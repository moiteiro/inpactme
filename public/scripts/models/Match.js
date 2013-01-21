define(function(require) {
	var Match = Backbone.Model.extend({
		urlRoot: '/matches',

		defaults: {
			id: "",
			host: {
				id : "",
				name: "",
				score: ""
			},
			guest: {
				id : "",
				name: "",
				score: ""
			},
			date: "",
			time: "",
			location: "",
			status:""
		},

		initialize: function () {
		}
	});

	return Match;
});