define(['models/Club', 'text!templates/clubs/form.html'], function(Club, EditForm) {
	var AddClubView = Backbone.View.extend({
    	el: $('#content'),

		events: {
			"submit form": "alter"
		},

		initialize: function() {
			this.model.on('change', this.render, this);
			this.options.playerCollection.on("reset", this.renderPlayersSelect, this);
		},

		alter: function() {
			$.ajax({
				url: '/clubs',
				type: 'PUT',
				data: this.$('form').serialize()
			}).done(function (data) {
				window.location = '#clubs';
			});			
			return false;
		},

	    render: function() {
			model = this.model.toJSON();
			this.$el.html(_.template(EditForm, model));
	    },

	    renderPlayersSelect: function () {
	    	var club = this.model.toJSON();
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

			captain.val(club.captain);
			firstTeam.val(club.firstTeam);
			reserveTeam.val(club.reserveTeam);

			$("select").chosen();
		}
	});

  return AddClubView;
});
