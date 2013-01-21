define(['text!templates/clubs/index.html' , 'text!templates/clubs/_entry.html'], function (indexTemplate, _entry) {
	var ClubsView = Backbone.View.extend({
		el: $('#content'),

		initialize: function() {
			this.collection.on('reset', this.renderCollection, this);
		},

		render: function() {
			this.$el.html(indexTemplate);
		},

		renderCollection: function (collection) {
			var clubsList = $('#clubs-list');
			collection.each(function(club) {

				var overall = club.toJSON().overall;

				if (overall >= 240) {
					club.set({progressColor: 'green'});
				} else if (overall <= 150) {
					club.set({progressColor: 'red'});
				} else {
					club.set({progressColor: 'yellow'});
				}

				var club = _.template(_entry, club.toJSON());
				clubsList.append(club);
			});
		}
	});

	return ClubsView;
});