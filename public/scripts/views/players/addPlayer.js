define(['models/Player', 'text!templates/players/form.html'], function(Player, NewForm) {
	var AddPlayerView = Backbone.View.extend({
    	el: $('#content'),

		events: {
			"submit form": "create"
		},

		create: function() {
			$.post('/players', this.$('form').serialize(), function (data) {
				window.location = '#players';
			});
			return false;
		},

	    render: function() {
	    	this.$el.html(_.template(NewForm, this.model.toJSON()));
	    	$('select').chosen();
	    }
	});

  return AddPlayerView;
});
