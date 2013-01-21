define(['models/Match'], function (Match) {
	var MatchCollection = Backbone.Collection.extend({
		url: '/matches',
		model: Match,

		initialize: function () {
		}
	});

	return MatchCollection;
});