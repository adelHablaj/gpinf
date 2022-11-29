@extends('layouts.app')
@section('pageTitle', __('Etab Modification'))
@section('content')
    {{-- {{dd($etab);}} --}}
    <div class="row">

        <!-- BEGIN LAYOUT LEFT SIDEBAR -->
        <div class="col-md-12">
            <form method="POST" class="form form-validate floating-label" action="{{ route('etabs.update', $etab->cd_etab) }}">
                @csrf
                @method('PUT')
                <div class="card tabs-left">
                    <div class="card-head style-primary card-head-xs">
                        <header>{{ __('Etab Modification') }}&nbsp;&nbsp;:&nbsp;&nbsp;<samp
                                class="text-light hidden-xs">{{ $etab->prenom_fr . ' ' . $etab->nom_fr }}</samp>&nbsp;&nbsp;<strong>{{ $etab->massar }}</strong>
                        </header>
                    </div>
                    <ul class="card-head tabs-left nav nav-tabs text-center  hidden-xs" data-toggle="tabs">
                        <li class="active"><a href="#profile"><i class="md md-assignment-ind md-2x"></i>
                                <h4>{{ __('Profile') }}<br /><small>{{ __('Personal details') }}</small></h4>
                            </a></li>
                        <li><a href="#school"><i class="md md-school md-2x"></i>
                                <h4>{{ __('Education') }}<br /><small>{{ __('Schoolar details') }}</small></h4>
                            </a></li>
                        <li><a href="#tutors"><i class="md md-account-child md-2x"></i>
                                <h4>{{ __('Tutors') }}<br /><small>{{ __('Tutors details') }}</small></h4>
                            </a></li>
                        <li><a href="#documents"><i class="md md-insert-drive-file md-2x"></i>
                                <h4>{{ __('Documents') }}<br /><small>{{ __('Required Documents') }}</small></h4>
                            </a></li>
                        <li><a href="#paiement"><i class="fa fa-dollar fa-2x"></i>
                                <h4>{{ __('Paiement') }}<br /><small>{{ __('Paiements and Invoice') }}</small></h4>
                            </a></li>
                        <li><a href="#report"><i class="md md-flag md-2x"></i>
                                <h4>{{ 'Report' }}<br /><small>{{ 'Reports and Notes' }}</small></h4>
                            </a></li>
                    </ul>
                    <ul class="card-head nav-justified nav nav-tabs text-left visible-xs" data-toggle="tabs">
                        <li class="active"><a href="#profile">
                                <h4 class="text-left"><i class="md-assignment-ind"></i>&nbsp;&nbsp;{{ __('Profile') }}</h4>
                            </a></li>
                        <li><a href="#school">
                                <h4 class="text-left"><i class="md-school"></i>&nbsp;&nbsp;{{ __('Education') }}</h4>
                            </a></li>
                        <li><a href="#tutors">
                                <h4 class="text-left"><i class="md-account-child"></i>&nbsp;&nbsp;{{ __('Tutors') }}</h4>
                            </a></li>
                        <li><a href="#documents">
                                <h4 class="text-left"><i class="md-insert-drive-file"></i>&nbsp;&nbsp;{{ __('Documents') }}
                                </h4>
                            </a></li>
                        <li><a href="#paiement">
                                <h4 class="text-left"><i class="fa fa-dollar"></i>&nbsp;&nbsp;{{ __('Paiement') }}</h4>
                            </a></li>
                        <li><a href="#report">
                                <h4 class="text-left"><i class="md-flag"></i>&nbsp;&nbsp;{{ 'Report' }}</h4>
                            </a></li>
                    </ul>
                    <div class="card-body tab-content style-default-bright">
                        <div class="tab-pane  active" id="profile">
                            <div class="row margin-1 text-center style-accent-bright border-gray  margin-bottom-xxl">
                                <div class="form-group col-md-2">
                                    <img id="photo-profile" src="{{ asset('images/students/' . $etab->avatar) }}"
                                        alt="" class="img-circle  border-white border-xl size-3">
                                    <button type="button" id="profile-img-container"
                                        class="btn btn-xs ink-reaction btn-floating-action btn-primary-bright profile-img"><i
                                            class="fa fa-camera"></i></button>
                                </div>
                                <div class="form-group col-md-5">
                                    <h3 class="text-light text-left col-lg-12">
                                        {{ strtoupper($etab->prenom_fr) . ' ' . strtoupper($etab->nom_fr) }}</strong></h3>
                                    <div class="input-group padding-1">
                                        <div class="input-group-content">
                                            <input type="text" readonly class="form-control input-lg min-width-4"
                                                id="massar" name="massar"
                                                value="{{ old('massar') ? old('massar') : (isset($etab->massar) ? $etab->massar : '') }}"
                                                data-rule-pattern="^[A-Za-z]{1}[0-9]{9}$" data-rule-maxlength="10"
                                                data-msg-pattern="{{ __('Massar code MUST be like : X000000000') }}"
                                                required aria-required="true">
                                            <label class="text-left form-label">{{ __('Massar Code') }}</label>
                                            <input type="hidden" value="{{ $etab->cd_etab }}" name="cd_etab"
                                                id="cd_etab">
                                        </div>
                                        <div id="edit-massar" class="input-group-addon"><i class="md md-create md-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5 text-lg">
                                    <div class="col-lg-12"></div>
                                    <div class="input-group padding-1 col-lg-12 style-warning border">
                                        <span class="input-group-addon"><i
                                                class="margin-bottom-lg md md-4x md-phone"></i></span>
                                        <div class="input-group-content">
                                            <input name="phone_urgence" id="phone_urgence"
                                                class="form-control input-lg min-width-4 text-bold"
                                                value="{{ $etab->phone_urgence }}">
                                            <label class="text-left form-label">{{ __('Emerency Phone') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 margin-bottom-xxl">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" id="prenom_fr" name="prenom_fr"
                                        value="{{ old('prenom_fr') ? old('prenom_fr') : (isset($etab->prenom_fr) ? $etab->prenom_fr : '') }}"
                                        data-rule-minlength="2" maxlength="100" required aria-required="true">
                                    <label class="form-label">{{ __('First Name Français') }}</label>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" id="nom_fr" name="nom_fr"
                                        value="{{ old('nom_fr') ? old('nom_fr') : (isset($etab->nom_fr) ? $etab->nom_fr : '') }}"
                                        data-rule-minlength="2" maxlength="100" required aria-required="true">
                                    <label class="form-label">{{ __('Last Name Français') }}</label>
                                </div>
                            </div>
                            <div class="col-xs-12  margin-bottom-xxl">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control text-right" id="prenom_ar"
                                        name="prenom_ar"
                                        value="{{ old('prenom_ar') ? old('prenom_ar') : (isset($etab->prenom_ar) ? $etab->prenom_ar : '') }}"
                                        data-rule-minlength="2" maxlength="200" required aria-required="true">
                                    <label class="form-label text-center">{{ __('First Name Arabe') }}</label>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control text-right" id="nom_ar" name="nom_ar"
                                        value="{{ old('nom_ar') ? old('nom_ar') : (isset($etab->nom_ar) ? $etab->nom_ar : '') }}"
                                        data-rule-minlength="2" maxlength="200" required aria-required="true">
                                    <label class="form-label text-center">{{ __('Last Name Arabe') }}</label>
                                </div>
                            </div>
                            <div class="col-xs-12  margin-bottom-xxl">
                                <div class="form-group text-center col-sm-6">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label
                                            class="btn btrad btn-xs ink-reaction btn-primary {{ old('genre') == 'Masculin' ? 'active' : ((isset($etab->genre) ? $etab->genre : '') == 'Masculin' ? 'active' : '') }} ">
                                            <input type="radio" value="Masculin" name="genre" id="male"
                                                {{ old('genre') == 'Masculin' ? 'checked=checked' : ((isset($etab->genre) ? $etab->genre : '') == 'Masculin' ? 'checked=checked' : '') }}><i
                                                class="fa fa-male fa-fw"></i> {{ __('Male') }}
                                        </label>
                                        <label
                                            class="btn btrad btn-xs ink-reaction btn-primary {{ old('genre') ? 'active' : ((isset($etab->genre) ? $etab->genre : '') == 'Féminin' ? 'active' : '') }}">
                                            <input type="radio" value="Féminin" name="genre" id="female"
                                                {{ old('genre') ? 'checked=checked' : ((isset($etab->genre) ? $etab->genre : '') == 'Féminin' ? 'checked=checked' : '') }}><i
                                                class="fa fa-female fa-fw"></i> {{ __('Female') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-content">
                                            <input type="date" class="form-control datepicker" id="date_nais"
                                                name="date_nais"
                                                value="{{ old('date_nais') ? old('date_nais') : (isset($etab->date_nais) ? $etab->date_nais : now()->format('Y-m-d')) }}"
                                                data-rule-date="true" required aria-required="true">
                                            <label for="date_nais">{{ __('Date de Naissance') }}</label>
                                        </div>
                                        <div class="input-group-addon">
                                            <div id="agelabel" class="btn btn-sm btn-primary ">
                                                {{ old('age') ? old('age') : (isset($etab->age) ? $etab->age . __(' Years old') : '') }}
                                            </div>
                                            <input id="age" type="hidden" name="age"
                                                value="{{ old('age') ? old('age') : (isset($etab->age) ? $etab->age : '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12  margin-bottom-xxl">
                                <div class="form-group col-sm-6">
                                    <label class="form-label">{{ __('Nationalité') }}</label>
                                    <select id="nationaliteEtab" name="nationalite_id"
                                        class="nationalite default-select form-control" required aria-required="true">
                                        <option value>{{ __('Select a Nationality') }}</option>
                                        @foreach ($nationalites as $indx => $nationalite)
                                            <option
                                                {{ old('nationalite_id') == $indx ? 'selected=selected' : ((isset($etab->nationalite_id) ? $etab->nationalite_id : '') == $indx ? 'selected=selected' : '') }}
                                                value="{{ $indx }}">{{ $nationalite }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <textarea class="form-control control-3-rows" id="adresse" name="adresse" required aria-required="true">{{ old('adresse') ? old('adresse') : (isset($etab->adresse) ? $etab->adresse : '') }}</textarea>
                                    <label class="form-label">{{ __('Adress') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="school">
                            <div class="row margin-bottom-xxl">
                                <div class="form-group col-sm-4">
                                    <label class="form-label">{{ __('Niveau') }}</label>
                                    <select id="niveau" name="niveau_id" class="default-select form-control" required
                                        aria-required="true">
                                        <option value>{{ __('Select Class') }}</option>
                                        @foreach ($etab->niveaux as $indx => $niveau)
                                            <option
                                                {{ old('niveau_id') == $indx ? 'selected=selected' : ((isset($etab->niveau_id) ? $etab->niveau_id : '') == $indx ? 'selected=selected' : '') }}
                                                value="{{ $indx }}">{{ $niveau }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="text" class="form-control" id="prevenance" name="prevenance"
                                        value="{{ old('prevenance') ? old('prevenance') : (isset($etab->prevenance) ? $etab->prevenance : '') }}"
                                        data-rule-minlength="2" maxlength="200" required aria-required="true">
                                    <label for="prevenance">{{ __('Provenance') }}</label>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="date" name="date_inscription" class="form-control datepicker"
                                        id="date_inscription"
                                        value="{{ old('date_inscription') ? old('date_inscription') : (isset($etab->date_inscription) ? $etab->date_inscription : now()->format('Y-m-d')) }}"
                                        required aria-required="true">
                                    <label for="date_inscription">{{ __('Date d\'Inscription') }}</label>
                                </div>
                            </div>
                            <div class="row margin-bottom-xxl">
                                <div class="form-group">
                                    <textarea class="form-control control-6-rows" id="observation" name="observation">{{ old('observation') ? old('observation') : (isset($etab->observation) ? $etab->observation : '') }}</textarea>
                                    <label class="form-label">{{ __('Observation') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tutors">
                            <div class="card">
                                <div class="card-head card-head-xs style-primary-bright">
                                    <header>{{ __('Tutor and Preferences') }}</header>
                                    <div class="tools">
                                        <div class="btn-group">
                                            <a class="btn btn-icon-toggle btn-collapse"><i
                                                    class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body no-padding">
                                    <div class="row text-center">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="form-group col-sm-10">
                                            <div class="btn-group col-lg-12 text-center" data-toggle="buttons">
                                                @foreach ($etab->tuteurs as $tuteur)
                                                    <label
                                                        class="btn btn-sm ink-reaction btn-primary {{ $tuteur->pivot->tutortype == 'tuteur' ? 'active' : '' }}">
                                                        <input type="radio" id="settutor" name="settutor"
                                                            {{ $tuteur->pivot->tutortype == 'tuteur' ? 'checked' : '' }}
                                                            value="{{ $tuteur->id }}"><span>{{ $tuteur->prenom_fr . ' ' . $tuteur->nom_fr }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!--end .form-group -->
                                        <div class="col-sm-2">
                                            <button type="button" data-toggle="modal" data-target="#addtutor"
                                                class="btn ink-reaction btn-floating-action btn-primary"
                                                id="addtutor-btn">
                                                <i class="md md-2x md-person-add"></i>
                                            </button>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row col-lg-12">
                                        <div class="form-group">
                                            <div class="list divider-full-bleed col-lg-12">
                                                <div class="col-md-6">
                                                    <div class="tile col-lg-12">
                                                        <a class="btn ink-reaction checkbox checkbox-styled">
                                                            <label><input
                                                                    name="aut_quit_dej"
                                                                    id="aut_quit_dej"
                                                                    type="checkbox" value="1"
                                                                    {{ old('aut_quit_dej') == 1 ? 'checked' : (isset($etab->aut_quit_dej) && $etab->aut_quit_dej == 1 ? 'checked' : 0) }}>
                                                            </label>
                                                        </a>
                                                        <a class="tile-content ink-reaction">
                                                            <div class="tile-icon">
                                                                <i class="fa fa-pause"></i>
                                                            </div>
                                                            <div class="tile-text">
                                                                <span>{{ __('Leaving In Launch break') }} : </span>
                                                                <small>{{ __('Authorized to Leave school In Launch Time') }}</small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="tile col-lg-12">
                                                        <a class="btn ink-reaction checkbox checkbox-styled">
                                                            <label><input name="aut_quit_fin_cours"
                                                                    id="aut_quit_fin_cours" type="checkbox"
                                                                    value="1"
                                                                    {{ old('aut_quit_fin_cours') == 1 ? 'checked' : (isset($etab->aut_quit_fin_cours) && $etab->aut_quit_fin_cours == 1 ? 'checked' : 0) }}></label>
                                                        </a>
                                                        <a class="tile-content ink-reaction">
                                                            <div class="tile-icon">
                                                                <i class="fa fa-stop"></i>
                                                            </div>
                                                            <div class="tile-text">
                                                                <span>{{ __('Leaving after class') }} : </span>
                                                                <small>{{ __('Authorized to Leave at the end of class') }}</small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-head card-head-xs style-primary-bright">
                                    <header>{{ __('Tutors list') }}</header>
                                    <div class="tools">
                                        <div class="btn-group">
                                            <a class="btn btn-icon-toggle btn-collapse"><i
                                                    class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel-group" id="tutors-panel">
                                        @foreach ($etab->tuteurs as $key => $tuteur)
                                            <div class="card panel">
                                                <input type="hidden" name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][id]"
                                                    value="{{ $tuteur->pivot->tuteur_id }}">
                                                <div class="card-head card-head-xs {{ $tuteur->pivot->tutortype == 'tuteur' ? 'style-primary-bright' : 'collapsed' }}"
                                                    data-toggle="collapse"
                                                    data-parent="#{{ $tuteur->pivot->tutorrelation . '-' . $key }}"
                                                    data-target="#{{ $tuteur->pivot->tutorrelation . '-' . $key }}-2">
                                                    <header>
                                                        {{ $tuteur->pivot->tutorrelation == 'pere' ? __('Father') : ($tuteur->pivot->tutorrelation == 'mere' ? __('Mother') : __('Tutor')) }}
                                                        {{ $tuteur->pivot->tutortype == 'tuteur' ? ' - ' . __('Tutor') : '' }}
                                                    </header>
                                                    <div class="tools">
                                                        <a class="btn btn-icon-toggle"><i
                                                                class="fa fa-chevron-down"></i></a>
                                                    </div>
                                                </div>
                                                <div id="{{ $tuteur->pivot->tutorrelation . '-' . $key }}-2"
                                                    class="collapse {{ $tuteur->pivot->tutortype == 'tuteur' ? 'in' : '' }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <input type="text"
                                                                    class="form-control input-lg text-bold"
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][cin]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][cin]"
                                                                    value="{{ old('tuteur[cin]') ? old('tuteur[cin]') : (isset($tuteur->cin) ? $tuteur->cin : '') }}"
                                                                    data-rule-pattern="^[A-Za-z]+[0-9]+$"
                                                                    data-rule-maxlength="20"
                                                                    data-msg-pattern="{{ __('C.I.N. N° MUST be a valide cin numbre') }}"
                                                                    required aria-required="true">
                                                                <label class="form-label">{{ __('C.I.N.') }}</label>
                                                            </div>
                                                            <div class="form-group col-sm-6 text-right">
                                                                <input type="hidden" class="form-control"
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][tuteurtype]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][tuteurtype]"
                                                                    value="{{ old('tuteur[tuteurtype]') ? old('tuteur[tuteurtype]') : (isset($tuteur->pivot->tutorrelation) ? $tuteur->pivot->tutorrelation : '') }}">
                                                                <button type="button"
                                                                    class="btn btn-danger delete-btn ink-reaction btn-raised"
                                                                    data-toggle="modal" data-target="#supptutormodal"
                                                                    data-delete-action="{{ route('tuteurs.destroy', $tuteur->pivot->tuteur_id) }}"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <input type="text" class="form-control"
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][prenom_fr]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][prenom_fr]"
                                                                    value="{{ old('tuteur[prenom_fr]') ? old('tuteur[prenom_fr]') : (isset($tuteur->prenom_fr) ? $tuteur->prenom_fr : '') }}"
                                                                    data-rule-minlength="2" maxlength="100" required
                                                                    aria-required="true">
                                                                <label
                                                                    class="form-label">{{ __('First Name Français') }}</label>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <input type="text" class="form-control"
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][nom_fr]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][nom_fr]"
                                                                    value="{{ old('tuteur[nom_fr]') ? old('tuteur[nom_fr]') : (isset($tuteur->nom_fr) ? $tuteur->nom_fr : '') }}"
                                                                    data-rule-minlength="2" maxlength="100" required
                                                                    aria-required="true">
                                                                <label
                                                                    class="form-label">{{ __('Last Name Français') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <input type="text" class="form-control"
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][prenom_ar]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][prenom_ar]"
                                                                    value="{{ old('tuteur[prenom_ar]') ? old('tuteur[prenom_ar]') : (isset($tuteur->prenom_ar) ? $tuteur->prenom_ar : '') }}"
                                                                    data-rule-minlength="2" maxlength="100" required
                                                                    aria-required="true">
                                                                <label
                                                                    class="form-label">{{ __('First Name Arabe') }}</label>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <input type="text" class="form-control"
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][nom_ar]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][nom_ar]"
                                                                    value="{{ old('tuteur[nom_ar]') ? old('tuteur[nom_ar]') : (isset($tuteur->nom_ar) ? $tuteur->nom_ar : '') }}"
                                                                    data-rule-minlength="2" maxlength="100" required
                                                                    aria-required="true">
                                                                <label
                                                                    class="form-label">{{ __('Last Name Arabe') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <input type="phone" class="form-control"
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][phone]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][phone]"
                                                                    value="{{ old('tuteur[phone]') ? old('tuteur[phone]') : (isset($tuteur->phone) ? $tuteur->phone : '') }}"
                                                                    data-inputmask="'mask': '99-99-99-99-99'" required
                                                                    aria-required="true">
                                                                <label class="form-label">{{ __('Phone') }}</label>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <input type="email" class="form-control"
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][email]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][email]"
                                                                    value="{{ old('tuteur[email]') ? old('tuteur[email]') : (isset($tuteur->email) ? $tuteur->email : '') }}"
                                                                    data-rule-pattern="^[a-zA-Z0-9._-]{2,}@[a-zA-Z0-9-]{2,}\.[a-zA-Z0-9-]{2,6}$"
                                                                    maxlength="200" required aria-required="true"
                                                                    data-msg-pattern="{{ __('Invalid Email') }}">
                                                                <label class="form-label">{{ __('email') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <textarea class="form-control control-3-rows" id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][adresse]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][adresse]" required aria-required="true">{{ old('tuteur[adresse]') ? old('tuteur[adresse]') : (isset($tuteur->adresse) ? $tuteur->adresse : '') }}</textarea>
                                                                <label class="form-label">{{ __('Adress') }}</label>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label class="form-label">{{ __('Nationalité') }}</label>
                                                                <select
                                                                    id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][nationalite]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][nationalite_id]"
                                                                    class="nationalite default-select form-control"
                                                                    required aria-required="true">
                                                                    <option value>{{ __('Select Class') }}</option>
                                                                    @foreach ($nationalites as $indx => $nationalite)
                                                                        <option
                                                                            {{ old('tuteur[nationalite_id]') ? old('tuteur[nationalite_id]') : ((isset($tuteur->nationalite_id) ? $tuteur->nationalite_id : '') == $indx ? 'selected=selected' : '') }}
                                                                            value="{{ $indx }}">
                                                                            {{ $nationalite }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <textarea class="form-control control-3-rows" id="tuteurs[{{ $tuteur->pivot->tuteur_id }}][observation]"
                                                                    name="tuteurs[{{ $tuteur->pivot->tuteur_id }}][observation]">{{ old('tuteur[observation]') ? old('tuteur[observation]') : (isset($tuteur->observation) ? $tuteur->observation : '') }}</textarea>
                                                                <label class="form-label">{{ __('Observation') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="documents">
                            <h3 class="text-light">{{ __('Provided Registration Documents: ') }}</h3>
                            <div class="row col-sm-6">
                                <div class="form-group">
                                    <ul class="list divider-full-bleed">
                                        <li class="tile">
                                            <a class="btn ink-reaction checkbox checkbox-styled">
                                                <label><input name="photo" id="photo" type="checkbox"
                                                        value="1"
                                                        {{ old('photo') == 1 ? 'checked' : (isset($etab->photo) && $etab->photo == 1 ? 'checked' : 0) }}></label>
                                            </a>
                                            <a class="tile-content ink-reaction">
                                                <div class="tile-icon">
                                                    <i class="fa fa-camera"></i>
                                                </div>
                                                <div class="tile-text">
                                                    <span>2 Photos : </span>
                                                    <small>format 3,5 X 4,5 cm</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="tile">
                                            <a class="btn ink-reaction checkbox checkbox-styled">
                                                <label><input name="extrait" id="extrait" type="checkbox"
                                                        value="1"
                                                        {{ old('extrait') == 1 ? 'checked' : (isset($etab->extrait) && $etab->extrait == 1 ? 'checked' : 0) }}></label>
                                            </a>
                                            <a class="tile-content ink-reaction">
                                                <div class="tile-icon">
                                                    <i class="fa fa-newspaper-o"></i>
                                                </div>
                                                <div class="tile-text">
                                                    <span>{{ __('Birth Act') }} : </span>
                                                    <small>{{ __('Full Name in Latin Letters') }}</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <div class="form-group">
                                    <ul class="list divider-full-bleed">
                                        <li class="tile">
                                            <a class="btn ink-reaction checkbox checkbox-styled">
                                                <label><input name="cert_depart" id="cert_depart" type="checkbox"
                                                        value="1"
                                                        {{ old('cert_depart') == 1 ? 'checked' : (isset($etab->cert_depart) && $etab->cert_depart == 1 ? 'checked' : 0) }}></label>
                                            </a>
                                            <a class="tile-content ink-reaction">
                                                <div class="tile-icon">
                                                    <i class="fa fa-file-text"></i>
                                                </div>
                                                <div class="tile-text">
                                                    <span>{{ __('Departure Certificate') }} : </span>
                                                    <small>{{ __('Issued by the School of Origin') }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="tile">
                                            <a class="btn ink-reaction checkbox checkbox-styled">
                                                <label><input name="ri_etab" id="ri_etab" type="checkbox"
                                                        value="1"
                                                        {{ old('ri_etab') == 1 ? 'checked' : (isset($etab->ri_etab) && $etab->ri_etab == 1 ? 'checked' : 0) }}></label>
                                            </a>
                                            <a class="tile-content ink-reaction">
                                                <div class="tile-icon">
                                                    <i class="fa fa-legal"></i>
                                                </div>
                                                <div class="tile-text">
                                                    <span>{{ __('School Internal Rules') }} : </span>
                                                    <small>{{ __('signed by the student\'s tutor') }}</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <div class="form-group">
                                    <ul class="list divider-full-bleed">
                                        <li class="tile">
                                            <a class="btn ink-reaction checkbox checkbox-styled">
                                                <label><input name="enveloppe" id="enveloppe" type="checkbox"
                                                        value="1"
                                                        {{ old('enveloppe') == 1 ? 'checked' : (isset($etab->enveloppe) && $etab->enveloppe == 1 ? 'checked' : 0) }}></label>
                                            </a>
                                            <a class="tile-content ink-reaction">
                                                <div class="tile-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <div class="tile-text">
                                                    <span>{{ __('3 Envelopes') }} : </span>
                                                    <small>{{ __('For mailling') }}</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="tile">
                                            <a class="btn ink-reaction checkbox checkbox-styled">
                                                <label><input name="dossier" id="dossier" type="checkbox"
                                                        value="1"
                                                        {{ old('dossier') == 1 ? 'checked' : (isset($etab->dossier) && $etab->dossier == 1 ? 'checked' : 0) }}></label>
                                            </a>
                                            <a class="tile-content ink-reaction">
                                                <div class="tile-icon">
                                                    <i class="fa fa-folder-open"></i>
                                                </div>
                                                <div class="tile-text">
                                                    <span>{{ __('Education History File') }} : </span>
                                                    <small>{{ __('History File from old School') }}</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="paiement">
                            <div class="card">
                                <div class="card-head card-head-xs style-primary-bright">
                                    <header>{{ __('Paiement responsable') }}</header>
                                    <div class="tools">
                                        <div class="btn-group">
                                            <a class="btn btn-icon-toggle btn-collapse"><i
                                                    class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body no-padding">
                                    <div class="form-group text-center col-lg-12">
                                        <div class="btn-group col-lg-12 text-center" data-toggle="buttons">
                                            @foreach ($etab->tuteurs as $tuteur)
                                                <label
                                                    class="btn btn-sm ink-reaction btn-primary {{ $tuteur->pivot->paietype == 'resppay' ? 'active' : '' }}">
                                                    <input type="radio" id="setresppay" name="setresppay"
                                                        {{ $tuteur->pivot->paietype == 'resppay' ? 'checked' : '' }}
                                                        value="{{ $tuteur->id }}"><span>{{ $tuteur->prenom_fr . ' ' . $tuteur->nom_fr }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end .form-group -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <ul class="list divider-full-bleed">
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction col-xs-9">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-users"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span>{{ __('Number of Brothers') }}</span>
                                                            <small>{{ __('Number of Brothers in our school') }}</small>
                                                        </div>
                                                    </a>
                                                    <div class="form-group col-xs-3">
                                                        <input type="text" class="form-control" id="nbr_frere"
                                                            name="nbr_frere"
                                                            value="{{ old('nbr_frere') ? old('nbr_frere') : (isset($etab->nbr_frere) ? $etab->nbr_frere : '') }}"
                                                            data-rule-minlength="1" maxlength="2">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-head card-head-xs style-primary-bright">
                                    <header>{{ __('Paiement Amounts') }}</header>
                                    <div class="tools">
                                        <div class="btn-group">
                                            <a class="btn btn-icon-toggle btn-collapse"><i
                                                    class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body no-padding">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <ul class="list divider-full-bleed">
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction col-xs-9">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-paste"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span>{{ __('Subscription amount') }}</span>
                                                            <small>{{ __('Amount payed for subscription') }}</small>
                                                        </div>
                                                    </a>
                                                    <div class="form-group col-xs-3">
                                                        <input type="text" class="form-control" id="inscription"
                                                            name="inscription"
                                                            value="{{ old('inscription') ? old('inscription') : (isset($etab->inscription) ? $etab->inscription : '') }}"
                                                            data-rule-minlength="1" maxlength="100" required
                                                            aria-required="true">
                                                    </div>
                                                </li>
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction col-xs-9">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-calendar-o"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span>{{ __('Monthly Payment') }} : </span>
                                                            <small>{{ __('Amount of monthly payment') }}</small>
                                                        </div>
                                                    </a>
                                                    <div class="form-group col-xs-3">
                                                        <input type="text" class="form-control" id="mensualite"
                                                            name="mensualite"
                                                            value="{{ old('mensualite') ? old('mensualite') : (isset($etab->mensualite) ? $etab->mensualite : '') }}"
                                                            data-rule-minlength="1" maxlength="100" required
                                                            aria-required="true">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <ul class="list divider-full-bleed">
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction col-xs-9">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-bus"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span>{{ __('Bus payment') }}</span>
                                                            <small>{{ __('Amount payed for subscription') }}</small>
                                                        </div>
                                                    </a>
                                                    <div class="form-group col-xs-3">
                                                        <input type="text" class="form-control" id="bus"
                                                            name="bus"
                                                            value="{{ old('bus') ? old('bus') : (isset($etab->bus) ? $etab->bus : '') }}"
                                                            data-rule-minlength="1" maxlength="100" required
                                                            aria-required="true">
                                                    </div>
                                                </li>
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction col-xs-9">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-child"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span>{{ __('Daycare') }} : </span>
                                                            <small>{{ __('Amount of school daycare') }}</small>
                                                        </div>
                                                    </a>
                                                    <div class="form-group col-xs-3">
                                                        <input type="text" class="form-control" id="garde"
                                                            name="garde"
                                                            value="{{ old('garde') ? old('garde') : (isset($etab->garde) ? $etab->garde : '') }}"
                                                            data-rule-minlength="1" maxlength="100" required
                                                            aria-required="true">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-head card-head-xs style-primary-bright">
                                    <header>{{ __('Paiement Details') }}</header>
                                    <div class="tools">
                                        <div class="btn-group">
                                            <a class="btn btn-icon-toggle btn-collapse"><i
                                                    class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-center no-padding">
                                    <div class="row margin-02">
                                        <div class="col-sm-05 col-sm-offset-1"><span
                                                for="">{{ __('SUBS') }}</span><button type="button"
                                                class="btn btn-block btn-xs {{ $etab->sumPayed >= $etab->inscription && $etab->inscription != 0 ? 'btn-success' : 'btn-danger' }}">{{ $etab['inscriptionPayer'] ? $etab['inscriptionPayer'] : 0 }}</button>
                                        </div>
                                        @foreach ($etab['moisPayables'] as $mois => $montant)
                                            <div class="col-sm-05"><span
                                                    for="">{{ $mois }}</span><button type="button"
                                                    class="btn btn-block btn-xs {{ $montant != 0 ? ($montant < $etab->aPayerParMois ? 'btn-warning' : 'btn-success') : 'btn-danger' }}">{{ $montant }}</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                    <div class="row no-margin">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-banded">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center">{{ __('Operation\'s Date') }}</th>
                                                        <th class="text-center">{{ 'Amount' }}</th>
                                                        <th class="text-center">{{ 'Payement Mode' }}</th>
                                                        <th class="text-center">{{ 'Due Date' }}</th>
                                                        <th class="text-center">{{ 'Actions' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($etab->paiement as $ipay => $paiement)
                                                        <tr>
                                                            <td>{{ $ipay + 1 }}</td>
                                                            <td>{{ $paiement->date }}</td>
                                                            <td class="text-right"><span
                                                                    class="text-bold">{{ $paiement->montant }},00</span>
                                                                DH</td>
                                                            <td class="text-center">{{ $paiement->mode }}</td>
                                                            <td>{{ $paiement->mode == 'Espèce' ? '-' : $paiement->date_echeance }}
                                                            </td>
                                                            <td class="text-left">
                                                                <a href="{{ route('paiements.print', $paiement->id) }}"
                                                                    class="btn btn-icon-toggle" data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    data-original-title="{{ __('Edit row') }}"><i
                                                                        class="fa fa-print"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="info text-bold text-lg text-info">
                                                        <td class="text-center" colspan="2">{{ __('Total') }}</td>
                                                        <td class="text-right"><span
                                                                class="text-bold">{{ $etab->sumPayed }},00</span> DH
                                                        </td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="report">
                            <div class="card">
                                <div class="card-head card-head-xs style-primary-bright">
                                    <header>{{ __('Paiement reports') }}</header>
                                    <div class="tools">
                                        <div class="btn-group">
                                            <a class="btn btn-icon-toggle btn-collapse"><i
                                                    class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-center no-padding">
                                    repports text here
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end .card-body -->
                    <br>
                    <br>
                    <div class="card-actionbar stick-bottom-right hieght-4">
                        <div class="card-actionbar-row form-footer">
                            <button type="submit"
                                class="btn btn-primary ink-reaction btn-raised">{{ __('Update') }}</button>
                            <button type="button"
                                onclick="event.preventDefault(); document.getElementById('print-form-{{ $etab->cd_etab }}').submit();"
                                class="btn btn-success ink-reaction btn-raised"><i class="fa fa-print"></i>&nbsp;<span
                                    class="hidden-xs">{{ __('Print') }}</span></button>
                            <button type="button" class="btn btn-danger ink-reaction btn-raised" data-toggle="modal"
                                data-target="#suppmodal"><i class="fa fa-trash"></i>&nbsp;<span
                                    class="hidden-xs">{{ __('Delete') }}</span></button>
                        </div>
                    </div>
                </div>
                <!--end .card -->
            </form>
            <form id="print-form-{{ $etab->cd_etab }}"
                action="{{ route('etabs.print', [$etab->cd_etab, 'certificate']) }}" method="get">@csrf</form>
            <form id="avatar-edit" action="{{ route('etabs.uploadavatar') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input id="avatarfile" type="file" name="avatar" class="hide">
                <input id="etab_id" type="hidden" name="etab_id" value="{{ $etab->cd_etab }}">
            </form>
        </div>
        <!--end .col -->
        <!-- END LAYOUT LEFT SIDEBAR -->
    </div>
    @include('includes.etabmodals')
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


            $(':input').inputmask();
            $('#edit-massar').on('click', (e) => {
                $('#massar').attr('readonly', false);
            })

            $('#massar').on('blur', (e) => {
                $('#massar').attr('readonly', true);
            })

            $('.delete-btn').on('click', function(e) {
                $('#deleteTutorForm').attr('action', $(this).data('delete-action'));
                console.log($('#deleteTutorForm').attr('action'));
            })

            $('#deleteTutor').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "delete",
                    url: $('#deleteTutorForm').attr('action'),
                    data: $('#deleteTutorForm').serialize(),
                    dataType: "json",
                    success: function(response) {
                        toastr.success("<div class='text-lg text-bold col-xs-12' >" + response
                            .message + "</div><br>", 'success', {
                                "positionClass": "toast-top-center",
                                "closeButton": true,
                                "timeOut": 0
                            });
                        location.reload(true);
                    },
                    error: function(response) {
                        // console.log(response.responseJSON != undefined);
                        let message = response.responseJSON.message;
                        let errors = response.responseJSON.errors;
                        let messages = '';

                        for (const error in errors) {
                            for (const msgs of errors[error]) {
                                messages += "<strong>" + error +
                                    "</strong> : <div class='text-lg text-bold col-xs-12' >" +
                                    msgs + "</div ><br>";
                            }
                        }
                        if (message == 'CSRF token mismatch.') {
                            message = "{{ __('Maybe you are loged out, You must Login') }}!";
                        }
                        toastr.error(message + " : <br>" + messages, 'Errors', {
                            "positionClass": "toast-top-center",
                            "closeButton": true,
                            "timeOut": 0
                        })
                    }
                });
            })
            $('#storeTutor').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{ route('tuteurs.store') }}",
                    data: $('#addTutorForm').serialize(),
                    dataType: "json",
                    success: function(response) {
                        toastr.success(response.message, 'success', {
                            "positionClass": "toast-top-center",
                            "closeButton": true,
                            "timeOut": 0
                        });
                        location.reload(true);
                    },
                    error: function(response) {
                        // console.log(response.responseJSON != undefined);
                        let message = response.responseJSON.message;
                        let errors = response.responseJSON.errors;
                        let messages = '';

                        for (const error in errors) {
                            for (const msgs of errors[error]) {
                                messages += "<strong>" + error +
                                    "</strong> : <div class='text-lg text-bold col-xs-12' >" +
                                    msgs + "</div ><br>";
                            }
                        }
                        if (message == 'CSRF token mismatch.') {
                            message = "{{ __('Maybe you are loged out, You must Login') }}!";
                        }
                        toastr.error(message + " : <br>" + messages, 'Errors', {
                            "positionClass": "toast-top-center",
                            "closeButton": true,
                            "timeOut": 0
                        })
                    }
                });
            })


            $('#profile-img-container').on('click', function(e) {
                $('#avatarfile').trigger('click');
            });

            $('#avatarfile').on('change', function(e) {
                $('#avatar-edit').submit();
            });
            $('#avatar-edit').on('submit', function(e) {
                e.preventDefault();
                console.log(this);
                let FData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('etabs.uploadavatar') }}",
                    data: FData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#photo-profile').attr('src', "{{ asset('images/students/') }}" +
                            '/' + response[0]);
                        toastr.success("<div class='text-lg text-bold col-xs-12' >" + response
                            .message + "</div><br>", 'Success', {
                                "positionClass": "toast-top-center",
                                "closeButton": true,
                                "timeOut": 0
                            });
                    },
                    error: function(response) {
                        // console.log(response.responseJSON != undefined);
                        let message = response.responseJSON.message;
                        let errors = response.responseJSON.errors;
                        let messages = '';

                        for (const error in errors) {
                            for (const msgs of errors[error]) {
                                messages += "<strong>" + error +
                                    "</strong> : <div class='text-lg text-bold col-xs-12' >" +
                                    msgs + "</div ><br>";
                            }
                        }
                        if (message == 'CSRF token mismatch.') {
                            message = "{{ __('Maybe you are loged out, You must Login') }}!";
                        }
                        toastr.error(message + " : <br>" + messages, 'Errors', {
                            "positionClass": "toast-top-center",
                            "closeButton": true,
                            "timeOut": 0
                        })
                    }
                });
            })

        });
    </script>
@endpush
