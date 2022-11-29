@extends('layouts.app')
@section('pageTitle', __('Create Student'))
@section('content')
    {{-- {dd($eleve);}} --}}
    <div class="row">
        <!-- BEGIN LAYOUT LEFT SIDEBAR -->
        <div class="col-md-12">
            <form method="POST" class="form form-validate floating-label" action="{{ route('eleves.store') }}">
                @csrf
                <div class="card tabs-left">
                    <div class="card-head style-primary card-head-xs">
                        <header>{{ __('Create Student') }}</header>
                    </div>
                    <div class="card-body tab-content style-default-bright">
                        <div class="tab-pane active" id="profile">
                            <div
                                class="row margin-1 text-center-md style-accent-bright text-center border-gray  margin-bottom-xxl">
                                <div class="form-group col-md-2">
                                    <img src="{{ asset('images/students/student-default-avatar.png') }}" alt=""
                                        class="img-circle  border-white border-xl size-3">
                                </div>
                                <div class="form-group col-md-5 text-lg">
                                    <div class="input-group padding-1">
                                        <span class="input-group-addon"><i class="fa fa-2x fa-phone"></i></span>
                                        <div class="input-group-content">
                                            <input type="phone" required name="phone_urgence" id="phone_urgence"
                                                class="form-control input-lg min-width-5 text-bold"
                                                value="{{ old('phone_urgence') ? old('phone_urgence') : '' }}">
                                            <label class="form-label">{{ __('Emergency Phone') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5 text-lg">
                                    <div class="input-group padding-1">
                                        <div class="input-group-content">
                                            <input type="text" class="form-control input-lg min-width-4" id="newmassar"
                                                name="massar" value="{{ old('massar') ? old('massar') : '' }}"
                                                data-rule-pattern="^[A-Za-z]{1}[0-9]{9}$" data-rule-maxlength="10"
                                                data-msg-pattern="{{ __('Massar code MUST be like : X000000000') }}"
                                                required aria-required="true">
                                            <label class="form-label">{{ __('Massar Code') }}</label>
                                        </div>
                                        <div id="edit-massar" class="input-group-addon"><i class="md md-create md-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 margin-bottom-xxl">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" id="prenom_fr" name="prenom_fr"
                                        value="{{ old('prenom_fr') ? old('prenom_fr') : '' }}" data-rule-minlength="2"
                                        maxlength="100" required aria-required="true">
                                    <label class="form-label">{{ __('First Name Français') }}</label>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" id="nom_fr" name="nom_fr"
                                        value="{{ old('nom_fr') ? old('nom_fr') : '' }}" data-rule-minlength="2"
                                        maxlength="100" required aria-required="true">
                                    <label class="form-label">{{ __('Last Name Français') }}</label>
                                </div>
                            </div>
                            <div class="col-xs-12  margin-bottom-xxl">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control text-right" id="prenom_ar" name="prenom_ar"
                                        value="{{ old('prenom_ar') ? old('prenom_ar') : '' }}" data-rule-minlength="2"
                                        maxlength="200" required aria-required="true">
                                    <label class="form-label text-center">{{ __('First Name Arabe') }}</label>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control text-right" id="nom_ar" name="nom_ar"
                                        value="{{ old('nom_ar') ? old('nom_ar') : '' }}" data-rule-minlength="2"
                                        maxlength="200" required aria-required="true">
                                    <label class="form-label text-center">{{ __('Last Name Arabe') }}</label>
                                </div>
                            </div>
                            <div class="col-xs-12  margin-bottom-xxl">
                                <div class="form-group text-center col-sm-6">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label
                                            class="btn btrad btn-xs ink-reaction btn-primary {{ old('genre') == 'Masculin' ? 'active' : '' }} ">
                                            <input type="radio" value="Masculin" name="genre" id="male"
                                                {{ old('genre') == 'Masculin' ? 'checked=checked' : '' }}><i
                                                class="fa fa-male fa-fw"></i> {{ __('Male') }}
                                        </label>
                                        <label
                                            class="btn btrad btn-xs ink-reaction btn-primary {{ old('genre') == 'Féminin' ? 'active' : '' }}">
                                            <input type="radio" value="Féminin" name="genre" id="female"
                                                {{ old('genre') == 'Féminin' ? 'checked=checked' : '' }}><i
                                                class="fa fa-female fa-fw"></i> {{ __('Female') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-content">
                                            <input type="date" class="form-control datepicker" id="date_nais"
                                                name="date_nais"
                                                value="{{ old('date_nais') ? old('date_nais') : now()->format('Y-m-d') }}"
                                                data-rule-date="true" required aria-required="true">
                                            <label for="date_nais">{{ __('Birth Date') }}</label>
                                        </div>
                                        <div class="input-group-addon">
                                            <div id="agelabel" class="btn btn-sm btn-primary ">
                                                {{ old('age') ? old('age') : '0 Years old' }}</div>
                                            <input id="age" type="hidden" name="age"
                                                value="{{ old('age') ? old('age') : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12  margin-bottom-xxl">
                                <div class="form-group col-sm-6">
                                    <label class="form-label">{{ __('Nationality') }}</label>
                                    <select id="nationalite" name="nationalite_id" class="default-select form-control"
                                        required aria-required="true">
                                        <option value>{{ __('Select a Nationality') }}</option>
                                        @foreach ($nationalites as $indx => $nationalite)
                                            <option {{ old('nationalite_id') == $indx ? 'selected=selected' : '' }}
                                                value="{{ $indx }}">{{ $nationalite }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <textarea class="form-control control-3-rows" id="adresse" name="adresse" required aria-required="true">{{ old('adresse') ? old('adresse') : '' }}</textarea>
                                    <label class="form-label">{{ __('Adress') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-bottom-xxl">
                            <div class="form-group col-sm-4">
                                <label class="form-label">{{ __('School Level') }}</label>
                                <select id="niveau" name="niveau_id" class="default-select form-control" required
                                    aria-required="true">
                                    <option value>{{ __('Select Class') }}</option>
                                    @foreach ($niveaux as $indx => $niveau)
                                        <option {{ old('niveau_id') == $indx ? 'selected=selected' : '' }}
                                            value="{{ $indx }}">{{ $niveau }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control" id="prevenance" name="prevenance"
                                    value="{{ old('prevenance') ? old('prevenance') : '' }}" data-rule-minlength="2"
                                    maxlength="200" required aria-required="true">
                                <label for="prevenance">{{ __('Origin') }}</label>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="date" name="date_inscription" class="form-control datepicker"
                                    id="date_inscription"
                                    value="{{ old('date_inscription') ? old('date_inscription') : now()->format('Y-m-d') }}"
                                    required aria-required="true">
                                <label for="date_inscription">{{ __('Subscription Date') }}</label>
                            </div>
                        </div>
                        <div class="row margin-bottom-xxl">
                            <div class="form-group">
                                <textarea class="form-control control-12-rows" id="observation" name="observation">{{ old('observation') ? old('observation') : '' }}</textarea>
                                <label class="form-label">{{ __('Observation') }}</label>
                            </div>
                        </div>
                    </div>
                    <!--end .card-body -->
                    <br>
                    <br>
                    <div class="card-actionbar stick-bottom-right hieght-4">
                        <div class="card-actionbar-row form-footer">
                            <button type="submit"
                                class="btn btn-primary ink-reaction btn-raised">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
                <!--end .card -->
            </form>
        </div>
        <!--end .col -->
        <!-- END LAYOUT LEFT SIDEBAR -->
    </div>
@endsection
@include('includes.fieldsasset')
@push('form-init-js')
    <script>
        $(document).ready(function() {

            // date Picker initialize

            $('#date_inscription').datepicker({
                startDate: '+0d',
                format: "yyyy-mm-dd",
            })

            // Select2 initialize
            $('#genre').select2();
            $('#niveau').select2();
            $('#nationalite').select2();

            $(':input').inputmask();
            $('#edit-massar').on('click', (e) => {
                $('#massar').attr('readonly', false);
            })

            $('#massar').on('blur', (e) => {
                $('#massar').attr('readonly', true);
            })
        });
    </script>
@endpush
