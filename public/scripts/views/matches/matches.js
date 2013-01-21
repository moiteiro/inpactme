define(['text!templates/matches/index.html' , 'text!templates/matches/_entry.html'], function (indexTemplate, _entry) {
	var matchesView = Backbone.View.extend({
		el: $('#content'),

		initialize: function() {
			this.collection.on('reset', this.renderCollection, this);
		},

		render: function() {
			this.$el.html(indexTemplate);
		},

		renderCollection: function (collection) {
			var matchList = $('#matches-list');
			collection.each(function(match) {
				var match = _.template(_entry, match.toJSON());
				matchList.append(match);
			});
		}
	});

	return matchesView;
});