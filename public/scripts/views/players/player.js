define(['text!templates/players/show.html'], function (showTemplate) {
	var playerView = Backbone.View.extend({
		el: $('#content'),

		initialize: function() {
			this.model.on('change', this.render, this);
		},

		render: function () {
			var player = this.model.toJSON();

			// Setting the Progress Bar color
			this.model.set({accelerationColor: this.setProgressColor(player.characteristics.acceleration)});
			this.model.set({staminaColor: this.setProgressColor(player.characteristics.stamina)});
			this.model.set({aggressionColor: this.setProgressColor(player.characteristics.aggression)});
			this.model.set({markingColor: this.setProgressColor(player.characteristics.marking)});
			this.model.set({balanceColor: this.setProgressColor(player.characteristics.balance)});

			var player = this.model.toJSON();

			this.$el.html(_.template(showTemplate, player ));
		},

		setProgressColor: function (ability) {
			if (ability >= 8) {
				var color = 'green';
			} else if (ability < 6) {
				var color = 'red';
			} else {
				var color = 'yellow';
			}

			return color;
		}
	});

	return playerView;
});