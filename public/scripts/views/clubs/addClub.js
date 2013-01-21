define(['models/Club', 'text!templates/clubs/form.html'], function(Club, NewForm) {
	var AddClubView = Backbone.View.extend({
		el: $('#content'),

		events: {
			"submit form": "create"
		},

		initialize: function () {
			this.options.playerCollection.on("reset", this.renderPlayersSelect, this);
		},

		create: function () {
			$.post('/clubs', this.$('form').serialize(), function (data) {
				window.location = '#clubs';
			});
			return false;
		},

		render: function () {
			this.$el.html(_.template(NewForm, this.model.toJSON()));
		},

		renderPlayersSelect: function () {
			var captain = $('#captain');
			var firstTeam = $('#first-team');
			var reserveTeam = $('#reserve-team');
			this.options.playerCollection.each(function (item) {
				var player = item.toJSON();
				var playersLastName = player.name.last.toUpperCase();

				$('<option>', {text: playersLastName + ", " + player.name.first, value: player.id}).appendTo(captain);
				$('<option>', {text: playersLastName + ", " + player.name.first, value: player.id}).appendTo(firstTeam);
				$('<option>', {text: playersLastName + ", " + player.name.first, value: player.id}).appendTo(reserveTeam);
			});
			$('select').chosen();
		}
	});

  return AddClubView;
});
