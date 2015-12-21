'use strict';

window.Leean = {};
window.Leean.Behaviors = {};

$(document).ready(function() {
  Essential.loadBehaviors({
    context: document,
    application: Leean.Behaviors,
  });
});

Leean.Behaviors.Base = Essential.Behavior.extend({

  init: function() {
    this.$el = $(this.el);
    if (this.initialize) {
      this.initialize();
    }
  },

});
