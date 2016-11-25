<div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="tracker-action-item">
            <div class="tracker-item-create">
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                        <textarea id="tracker-input-content" v-model="content" v-on:keyup="checkContent()" placeholder="Type new action here..."></textarea>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <button class="btn btn-success btn-block" id="tracker-submit-content" v-on:click="submitAction($event)" disabled="disabled">
                            <span class="glyphicon glyphicon-plus"></span>
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3"></div>
</div>