<div class="tracker-action-item-list" data-actions="{{ $actionItemValues }}">
    
    <div class="tracker-action-item" v-for="action in actionItems">
        <div class="tracker-action-main">
            <div class="row">
                <div class="col-xs-12 col-md-10">@{{ action.content }}</div>
                <div class="col-xs-12 col-md-2">
                    @include('components.action-control')
                    @include('components.action-menu')
                </div>
            </div>
        </div>
        <div class="tracker-action-history hidden">
            <div class="action-history-item">
                <div class="action-history-info">
                    <span>Started at:</span><span>13 June 2016 00:00:00</span>
                    <span>Finished at:</span><span>13 June 2016 00:00:00</span>
                </div>
                <div class="action-history-description">
                    Comment: hjdsdsd
                </div>
            </div>
        </div>
    </div>

</div>