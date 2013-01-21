define(['models/Player', 'text!templates/players/form.html'], function(Player, EditForm) {
	var AddPlayerView = Backbone.View.extend({
    	el: $('#content'),

		events: {
			"submit form": "alter"
		},

		initialize: function() {
			this.model.on('change', this.render, this);
		},

		alter: function() {
			//$.post('/players', this.$('form').serialize(), function (data) {});
			
			$.ajax({
				url: '/players',
				type: 'PUT',
				data: this.$('form').serialize()
			}).done(function (data) {
				window.location = '#players';
			});
			return false;
		},

	    render: function() {
	    	var player = this.model.toJSON();
	    	this.$el.html(_.template(EditForm, player));
	    	$('select[name=gender]').val(player.gender);
	    	$('select[name=position]').val(player.fieldPosition);
	    	$('select').chosen();
	    }
	});

  return AddPlayerView;
});
