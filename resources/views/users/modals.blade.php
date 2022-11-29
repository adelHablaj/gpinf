<div class="modal fade" id="suppmodal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">{{ __('Complete to continue')}}</h4>
			</div>
			<form id="deleteuserForm" class="form-horizontal" action="" role="form" method="POST">
                @csrf
                @method('delete')
				<div class="modal-body">
					<div class="form-group">
						<div class="col-xs-2 text-right">
                            <label class="checkbox-inline checkbox-styled checkbox-success">
                                <input type="checkbox" id="suppvalidation" value="1" name="suppvalidation">
                            </label>
						</div>
						<div id="validation" class="col-xs-10">
                            <span  class="text-left text-lg text-bold">{{ __('Click HERE an VALIDATE to confirme Suppression') }}</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="cancel" class="btn btn-default" data-dismiss="modal">{{ __('Cancel')}}</button>
					<button type="submit" class="btn btn-primary">{{ __('Validate')}}</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
