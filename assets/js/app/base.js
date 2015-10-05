'use strict';

MoxieLean.Behaviors.Base = Essential.Behavior.extend({

  init: function() {
    this.$el = $(this.el);
    if (this.initialize) {
      this.initialize();
    }
  },

});
