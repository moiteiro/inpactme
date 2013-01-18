define(['models/Player'], function (Player) {
	var PlayerCollection = Backbone.Collection.extend({
		url: '/players',
		model: Player,

		initialize: function () {
		}
	});

	return PlayerCollection;
});