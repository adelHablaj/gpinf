<div class="modal fade" id="suppmodal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">{{ __('Complete to continue')}}</h4>
			</div>
			<form id="deleteprovinceForm" class="form-horizontal" action="{{ route('provinces.destroy', isset($province->id)?$province->id:0) }}" role="form" method="POST">
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
</div><!-- /.modal province suppression -->

<div class="modal fade" id="supptutormodal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">{{ __('Complete to continue')}}</h4>
			</div>
			<form id="deleteTutorForm" class="form-horizontal" action="" role="form" method="POST">
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
					<button type="button" id="deleteTutor" class="btn btn-primary">{{ __('Validate')}}</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal tutor suppression -->
@if (isset($province->id) && isset($nationalites))

<div class="modal fade" id="addtutor" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title style-primary padding-05" id="formModalLabel">
                    <header>{{__('Create Tutor')}}</header>
                </h4>
			</div>
            <form method="POST" id="addTutorForm" class="form form-validate floating-label" action="{{ route('tuteurs.store')}}">
                @csrf
                <input type="hidden" name="province_id" value="{{ $province->id }}">
            <div class="card">
                <div class="card-body style-default-bright">
                    <div class="col-xs-12 margin-bottom-xxl">
                        <div class="form-group col-sm-4">
                            <input type="text" class="form-control" id="cin" name="cin" value="{{ old('cin')?old('cin'):''}}" data-rule-pattern="^[A-Za-z]+[0-9]+$" data-rule-maxlength="20" data-msg-pattern="{{ __('C.I.N. N° MUST be a valide cin numbre')}}" required aria-required="true">
                            <label class="form-label">{{__('C.I.N. N°')}}</label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="phone" name="phone" id="phone" class="form-control" value="{{ old('phone')?old('phone'):'' }}" data-rule-minlength="10" maxlength="15" required aria-required="true">
                            <label class="form-label">{{__('Phone')}}</label>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email')?old('email'):''}}" data-rule-pattern="^[a-zA-Z0-9._-]{2,}@[a-zA-Z0-9-]{2,}\.[a-zA-Z0-9-]{2,6}$" maxlength="200" required aria-required="true" data-msg-pattern="{{ __('Invalid Email')}}">
                            <label for="email">{{__('Email')}}</label>
                        </div>
                    </div>
                    <div class="col-xs-12 margin-bottom-xxl">
                        <div class="form-group col-sm-4">
                            <label class="form-label">{{__('Relationship')}}</label>
                            <select id="tutorrelation" name="tutorrelation" class="default-select form-control" required aria-required="true">
                                <option value>{{ __('Select a Relationship')}}</option>
                                <option {{ old('tutorrelation') == 'pere'?'selected=selected':'' }}  value="pere">{{ __('Father') }}</option>
                                <option {{ old('tutorrelation') == 'mere'?'selected=selected':'' }}  value="mere">{{ __('Mother') }}</option>
                                <option {{ old('tutorrelation') == 'tuteur'?'selected=selected':'' }}  value="tuteur">{{ __('Tutor') }}</option>
                                <option {{ old('tutorrelation') == 'resppay'?'selected=selected':'' }}  value="resppay">{{ __('Payement responsable') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="form-label">{{__('Tutor')}}</label>
                            <select id="tutortype" name="tutortype" class="default-select form-control" required aria-required="true">
                                <option value>{{ __('Select a Choice')}}</option>
                                <option {{ old('tutortype') == 'tuteur'?'selected=selected':'' }}  value="tuteur">{{ __('Is Tutor') }}</option>
                                <option {{ old('tutortype') == 'non tuteur'?'selected=selected':'' }}  value="non tuteur">{{ __('Is Not Tutor') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="form-label">{{__('Payement responsable')}}</label>
                            <select id="paietype" name="paietype" class="default-select form-control" required aria-required="true">
                                <option value>{{ __('Select a Choice')}}</option>
                                <option {{ old('paietype') == 'resppay'?'selected=selected':'' }}  value="resppay">{{ __('Is Payer') }}</option>
                                <option {{ old('paietype') == 'non resppay'?'selected=selected':'' }}  value="non resppay">{{ __('Is Not Payer') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 margin-bottom-xxl">
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control" id="prenom_fr" name="prenom_fr" value="{{ old('prenom_fr')?old('prenom_fr'):''}}" data-rule-minlength="2" maxlength="100" required aria-required="true">
                            <label class="form-label">{{__('First Name Français')}}</label>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control" id="nom_fr" name="nom_fr" value="{{ old('nom_fr')?old('nom_fr'):''}}" data-rule-minlength="2" maxlength="100" required aria-required="true">
                            <label class="form-label">{{__('Last Name Français')}}</label>
                        </div>
                    </div>
                    <div class="col-xs-12  margin-bottom-xxl">
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control text-right" id="prenom_ar" name="prenom_ar" value="{{ old('prenom_ar')?old('prenom_ar'):''}}" data-rule-minlength="2" maxlength="200" required aria-required="true">
                            <label class="form-label text-center">{{__('First Name Arabe')}}</label>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control text-right" id="nom_ar" name="nom_ar" value="{{ old('nom_ar')?old('nom_ar'):''}}" data-rule-minlength="2" maxlength="200" required aria-required="true">
                            <label class="form-label text-center">{{__('Last Name Arabe')}}</label>
                        </div>
                    </div>
                    <div class="col-xs-12 margin-bottom-xxl">

                        <div class="form-group col-sm-6">
                            <label class="form-label">{{__('Nationality')}}</label>
                            <select id="nationalite" name="nationalite_id" class="nationalite default-select form-control" required aria-required="true">
                                <option value>{{ __('Select a Nationality')}}</option>
                                @foreach ($nationalites as $indx => $nationalite )
                                    <option {{ old('nationalite_id') == $indx?'selected=selected':'' }}  value="{{$indx}}">{{$nationalite}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <textarea class="form-control control-3-rows" id="adresse" name="adresse" required aria-required="true" >{{ old('adresse')?old('adresse'):''}}</textarea>
                            <label class="form-label">{{__('Adress')}}</label>
                        </div>
                    </div>
                </div><!--end .card-body -->
                <br>
                <br>
                <div class="card-actionbar stick-bottom-right hieght-4">
                    <div class="card-actionbar-row form-footer">
                        <button type="button" id="storeTutor" class="btn btn-primary ink-reaction btn-raised">{{ __('Save')}}</button>
                    </div>
                </div>
            </div><!--end .card -->
            </form>
            {{-- @include('tuteurs.create') --}}
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endif
