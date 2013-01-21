define(['models/Match', 'text!templates/matches/add.html'], function(Match, NewForm) {
	var AddMatchView = Backbone.View.extend({
    	el: $('#content'),

		events: {
			"submit form": "create"
		},

		initialize: function () {
			this.options.clubCollection.on("reset", this.renderClubsSelect, this);
		},

		create: function() {
			$.post('/matches', this.$('form').serialize(), function (data) {
				window.location = '#matches';
			});
			return false;
		},

	    render: function() {
	    	this.$el.html(NewForm);
	    },

	    renderClubsSelect: function () {
			var hostSelect = $('#host-select');
			var guestSelect = $('#guest-select');
			this.options.clubCollection.each(function (item) {
				var club = item.toJSON();
				$('<option>', {text: club.name, value: club.id}).appendTo(hostSelect);
				$('<option>', {text: club.name, value: club.id}).appendTo(guestSelect);
			});

			$('select').chosen();
		}
	});

  return AddMatchView;
});
