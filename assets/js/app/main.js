'use strict';

window.Lean = {};
window.Lean.Behaviors = {};

$(document).ready(function() {
  Essential.loadBehaviors({
    context: document,
    application: Lean.Behaviors,
  });
});

Lean.Behaviors.Base = Essential.Behavior.extend({

  init: function() {
    this.$el = $(this.el);
    if (this.initialize) {
      this.initialize();
    }
  },

});

for(var i=0;i<10;i++){
}
