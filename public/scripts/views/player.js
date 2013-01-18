define(['text!templates/player.html', '' , 'text!templates/_listPlayers.html'], function (playerTemplate, listTemplate) {
	var playerView = Backbone.View.extend({
		el: $('#content'),

		initialize: function() {
			this.collection.on('reset', this.renderCollection, this);
		},

		render: function () {

			//console.log(this.collection);
			if (this.model){
				this.$el.html(_.template(playerTemplate, this.model.toJSON()));		
			} else {
				
				//console.log(this.collection.models);
				//this.$el.html(_.each(listTemplate, this.collections.toJSON));
			}
		},

		renderCollection: function (collection) {
			collection.each(function(player) {
				
				console.dir(player.attributes);
			});
		}
	});

	return playerView;
});