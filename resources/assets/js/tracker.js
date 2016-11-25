
if ($('.tracker-item-create').length > 0) {
    new Vue({
        el: '.tracker-item-create',
        data: {
            content: undefined
        },
        methods: {
            checkContent: function($event) {
                var submit = $(this.$el).find('#tracker-submit-content');
                if (typeof this.content !== 'undefined' && $.trim(this.content).length > 0) {
                    submit.prop('disabled', false);
                } else {
                    submit.prop('disabled', true);
                }
            },
            submitAction: function($event) {
                if (typeof this.content !== 'undefined') {
                    if ($.trim(this.content).length > 0) {
                        $.post('/action-item/create', {
                            content: this.content
                        }, function(r) {

                        }, 'json');
                    }
                }
            }
        }
    });

    autosize($('#tracker-input-content'));
}