<div class="modal fade" tabindex="-1" role="dialog" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="modal-object-info" value="0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="modal-delete-title" class="modal-title">Information</h4>
            </div>
            <div id="modal-info-body" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="modal-object-delete" value="0">
            <input type="hidden" id="modal-type-delete" value="0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="modal-delete-title" class="modal-title">Supprimer</h4>
            </div>
            <div id="modal-delete-body" class="modal-body">
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
    <div class="modal-dialog modal-search">
        <div class="modal-content">
            <input type="hidden" id="modal-search-object" value="0">
            <input type="hidden" id="modal-search-callback-id" value="0">
            <input type="hidden" id="modal-search-callback-url" value="">
            <input type="hidden" id="modal-search-callback-fn" value="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="modal-search-title" class="modal-title">Recherche</h4>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal-feedback">
    <div class="modal-dialog modal-feedback">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="modal-feedback-title" class="modal-title">Action</h4>
            </div>
            <div id="modal-feedback-body" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" id="modal-feedback-btn" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->