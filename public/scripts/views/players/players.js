define(['text!templates/players/index.html' , 'text!templates/players/_entry.html'], function (indexTemplate, _entry) {
	var playersView = Backbone.View.extend({
		el: $('#content'),

		initialize: function() {
			this.collection.on('reset', this.renderCollection, this);
		},

		render: function() {
			this.$el.html(indexTemplate);
		},

		renderCollection: function (collection) {
			var playerList = $('#players-list');

			collection.each(function(player) {

				var overall = player.toJSON().overall;

				if (overall >= 40) {
					player.set({progressColor: 'green'});
				} else if (overall <= 30) {
					player.set({progressColor: 'red'});
				} else {
					player.set({progressColor: 'yellow'});
				}


				var player = _.template(_entry, player.toJSON());
				playerList.append(player);
			});
		}
	});

	return playersView;
});