'use strict';

MoxieLean.Behaviors.Base = Essential.Behaviors.extend({

  init: function() {
    this.$el = $(this.el);
    if (this.initialize) {
      this.initialize();
    }
  },

});
