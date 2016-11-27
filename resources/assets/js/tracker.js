
var actionItemList;
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
                var t = this;
                if (typeof this.content !== 'undefined') {
                    if ($.trim(this.content).length > 0) {
                        $.post('/action/create', {
                            tracker: trackerId,
                            content: this.content
                        }, function(r) {
                            if (typeof actionItemList !== 'undefined') {
                                actionItemList.$data.actionItems.unshift(r.action_item);
                                t.content = '';
                            }
                        }, 'json');
                    }
                }
            }
        }
    });

    actionItemList = new Vue({
        el: '.tracker-action-item-list',
        data: {
            actionItems: []
        },
        methods:{
            start: function(actionId, $evt){
                $.post('/action/start/' + actionId, {
                    comment: 'test start'
                }, function(r){
                    console.log(r);
                }, 'json');
                $evt.preventDefault();
            },
            stop: function(actionId, $evt){
                $.post('/action/stop/' + actionId, {
                    comment: 'test stop'
                }, function(r){
                    console.log(r);
                }, 'json');
                $evt.preventDefault();
            },
        },
        mounted: function(){
            this.actionItems = JSON.parse(this.$el.dataset.actions);
        }
    });

    autosize($('#tracker-input-content'));
}