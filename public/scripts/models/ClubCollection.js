define(['models/Club'], function (Club) {
	var ClubCollection = Backbone.Collection.extend({
		url: '/clubs',
		model: Club,

		initialize: function () {
		}
	});

	return ClubCollection;
});