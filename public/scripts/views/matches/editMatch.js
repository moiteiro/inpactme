define(['models/Match', 'text!templates/matches/edit.html'], function(Match, EditForm) {
	var AddMatchView = Backbone.View.extend({
    	el: $('#content'),

		events: {
			"submit form": "alter"
		},

		initialize: function() {
			this.model.on('change', this.render, this);
		},

		alter: function() {
			//$.post('/matches', this.$('form').serialize(), function (data) {});
			
			$.ajax({
				url: '/matches',
				type: 'PUT',
				data: this.$('form').serialize()
			}).done(function (data) {
				window.location = '#matches';
			});
			console.log(this.model.toJSON());
			return false;
		},

	    render: function() {
	    	this.$el.html(_.template(EditForm, this.model.toJSON()));
	    }
	});

  return AddMatchView;
});
