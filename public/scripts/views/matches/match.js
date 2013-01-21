define(['text!templates/matches/show.html'], function (showTemplate) {
	var matchView = Backbone.View.extend({
		el: $('#content'),

		initialize: function() {
			this.model.on('change', this.render, this);
		},

		render: function () {
			this.$el.html(_.template(showTemplate, this.model.toJSON()));
		}
	});

	return matchView;
});