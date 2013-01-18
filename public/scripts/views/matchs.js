define(['text!templates/matchs.html',], function (matchsTemplate) {
	var matchsView = Backbone.View.extend({
		el: $('#content'),

		render: function () {
			this.$el.html(matchsTemplate);
		}
	});
	return matchsView;
});