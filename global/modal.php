<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="modal-object-delete" value="0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="modal-title" class="modal-title">Supprimer</h4>
            </div>
            <div id="modal-body" class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="modalActionDelete();">Ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal-search">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="modal-search-object" value="0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="modal-title" class="modal-title">Recherche</h4>
            </div>
            <div id="modal-search-body" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="modalActionSearch();">Ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->