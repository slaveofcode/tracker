<div class="action-control-container" v-bind:data-id="action.id">
    <a href="#" data-toggle="tooltip" data-placement="top" title="Start working on this action" v-on:click="start(action.id, $event)">
        <span class="glyphicon glyphicon-play"></span>
    </a>
    <a href="#" data-toggle="tooltip" data-placement="top" title="Stop working on this action" v-on:click="stop(action.id, $event)">
        <span class="glyphicon glyphicon-stop"></span>
    </a>
</div>