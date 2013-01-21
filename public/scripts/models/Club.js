define(function(require) {
	var Club = Backbone.Model.extend({
		urlRoot: '/clubs',

		defaults: {
			id : "",
			name: "",
			foundationDate : "",
			overall: "",
			captain: 0,
			firstTeam: [],
			reserveTeam: []
		},

		initialize: function () {
		}
	});

	return Club;
});