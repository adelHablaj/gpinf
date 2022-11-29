<div class="modal fade" id="submodal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">{{ __('Complete to continue')}}</h4>
			</div>
			<form class="form-validate floating-label" action="{{ route('preinscriptions.subscribe', $preinscription->id)}}" role="form" method="POST">
                @csrf
				<div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="massar" class="control-label"></label>
                                </div>
                                <div class="padding-1 col-sm-10">
                                    <input type="text" class="form-control" id="massar" name="massar" value="{{ isset($inputs['massar'])?$inputs['massar']:''}}" data-rule-pattern="^[A-Za-z]{1}[0-9]{9}$" data-rule-maxlength="10" data-msg-pattern="{{ __('Massar code MUST be like : X000000000')}}" required>
                                    <label for="massar">{{__('Massar')}}</label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group text-center">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btrad btn-xs ink-reaction btn-primary {{ old('genre') == 'Masculin'?'active':((isset($eleve->genre)?$eleve->genre:'')== 'Masculin'?'active':'')}} ">
                                        <input type="radio" value="Masculin" name="genre" id="male" {{ old('genre') == 'Masculin'?'checked=checked':((isset($eleve->genre)?$eleve->genre:'')== 'Masculin'?'checked=checked':'')}}><i class="fa fa-male fa-fw"></i> {{ __('Male')}}
                                    </label>
                                    <label class="btn btrad btn-xs ink-reaction btn-primary {{ old('genre')?'active':((isset($eleve->genre)?$eleve->genre:'')== 'Féminin'?'active':'')}}">
                                        <input type="radio" value="Féminin" name="genre" id="female" {{ old('genre')?'checked=checked':((isset($eleve->genre)?$eleve->genre:'')== 'Féminin'?'checked=checked':'')}}><i class="fa fa-female fa-fw"></i> {{ __('Female')}}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-2 text-right">
                                    <label class="checkbox-inline checkbox-styled checkbox-success">
                                        <input type="checkbox" id="subvalidation" value="1" name="subvalidation" required>
                                    </label>
                                </div>
                                <div id="validation" class="col-xs-10">
                                    <span  class="text-left text-lg text-bold">{{ __('Click HERE and VALIDATE to confirme subscription') }}</span>
                                </div>
                            </div>
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
<div class="modal fade" id="rejectmodal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">{{ __('Complete to continue')}}</h4>
			</div>
			<form class="form-horizontal form-validate floating-label" action="{{ route('preinscriptions.reject', $preinscription->id)}}" role="form" method="POST">
                @csrf
				<div class="modal-body">
                    <div class="form-group">
                        <div class="col-xs-3">
                            <label class="form-label">{{__('Justification for rejected student')}}</label>
                        </div>
                        <div class="col-xs-9">
                            <textarea class="form-control control-3-rows" id="observation" name="observation" data-rule-minlength="100" required data-msg-minlength="{{__('A justification for rejected student is needed (50 letters at least)')}}" data-msg-required="{{__('A justification for rejected student is needed (50 letters at least)')}}">{{ old('observation')?old('observation'):''}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2 text-right">
                            <label class="checkbox-inline checkbox-styled checkbox-success">
                                <input type="checkbox" id="rejectvalidation" value="1" name="rejectvalidation" required>
                            </label>
                        </div>
                        <div id="validation" class="col-xs-10">
                            <span  class="text-left text-lg text-bold">{{ __('Click HERE an VALIDATE to Reject Preinscription') }}</span>
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
<div class="modal fade" id="unrejectmodal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">{{ __('Complete to continue')}}</h4>
			</div>
			<form class="form-horizontal form-validate floating-label" action="{{ route('preinscriptions.unreject', $preinscription->id)}}" role="form" method="POST">
                @csrf
				<div class="modal-body">
                    <div class="form-group">
                        <div class="col-xs-2 text-right">
                            <label class="checkbox-inline checkbox-styled checkbox-success">
                                <input type="checkbox" id="unrejectvalidation" value="1" name="unrejectvalidation" required>
                            </label>
                        </div>
                        <div id="validation" class="col-xs-10">
                            <span  class="text-left text-lg text-bold">{{ __('Click HERE and VALIDATE to UnReject') }}</span>
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
