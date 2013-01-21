define(['text!templates/clubs/show.html'], function (showTemplate) {
	var ClubView = Backbone.View.extend({
		el: $('#content'),

		initialize: function() {
			this.model.on('change', this.render, this);
			this.options.playerCollection.on("reset", this.renderPlayersList, this);

		},

		render: function () {
			var club = this.model;
			var overall = club.toJSON().overall;

			if (overall >= 240) {
				club.set({progressColor: 'green'});
			} else if (overall <= 150) {
				club.set({progressColor: 'red'});
			} else {
				club.set({progressColor: 'yellow'});
			}

			this.$el.html(_.template(showTemplate, club.toJSON()));
		},

		renderPlayersList: function () {
	    	var club = this.model.toJSON();
			var firstTeam = $('.first-team-list');
			var reserveTeam = $('.reserve-team-list');

			this.options.playerCollection.each(function (item) {
				var player = item.toJSON();
				var playersLastName = player.name.last.toUpperCase();
				$('<li>', {text: playersLastName + ", " + player.name.first}).appendTo(firstTeam);
				$('<li>', {text: playersLastName + ", " + player.name.first}).appendTo(reserveTeam);
			});
		}
	});

	return ClubView;
});