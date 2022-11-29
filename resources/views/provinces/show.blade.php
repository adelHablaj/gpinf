@extends('layouts.app')
@section('pageTitle', __('DP ').$province->ll_prov)
@push('print-css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/materialadmin_print.css?1419847669') }}" media="print">
@endpush
@section('content')
    {{-- {{dd($province);}} --}}
    <div class="section card-printable">
            <div class="row">
                <div class="card style-primary-dark">
                    <div class="card-body text-default-light ">
                        <div class="col-xs-4" role="alert">
                            <span>{{ __('Direction Provinciale') }}</span>
                                <p class="text-bold text-default-bright text-xxl"><strong>{{ str_replace('Province: ','', $province->ll_prov) }}</strong></p>
                            </div>
                        <div class="col-xs-4" role="alert">
                            <span>{{ __('Nombre Communes') }}</span>
                                <p class="text-bold text-default-bright text-xxl"><strong>{{ $province->commune_count }}</strong></p>
                            </div>
                        <div class="col-xs-4" role="alert">
                            <span>{{ __('Nombre Etablissements') }}</span>
                                <p class="text-ultra-bold text-default-bright text-xxl"><strong>{{ $province->etabs_count }}</strong></p>
                            </div>
                    </div><!--end .card-body -->
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-head card-head-xs style-primary-bright">
                        <header>{{ __('Information de l\'provincelissement') }}</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a class="btn btn-floating-action btn-primary" href="javascript:void(0);" onclick="javascript:window.print();"><i class="md md-print"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-info no-margin">
                                            <h1 class="pull-right text-info"><i class="md md-2 md-location-city"></i></h1>
                                            <strong class="text-xxl">{{ str_replace('إقليم: ','', $province->la_prov) }}</strong><br>
                                            <span class="opacity-50">{{ __('Nom Arabe') }}</span>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                            <div class="col-xs-6">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-success no-margin">
                                            <h1 class="pull-right text-success"><i class="md md-2 md-people"></i></h1>
                                            <strong class="text-xl">{{ intval($details['nbr_eleves']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Nombre d\'élèves') }}</span>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-head card-head-xs style-primary-light">
                        <header>{{ __('Détails Equipements de l\'provincelissement') }}</header>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-info no-margin">
                                            <h1 class="pull-right text-info"><i class="md md-2 md-desktop-windows"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['pc_nbr']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Nombre d\'Ordinateur') }}</span>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-danger no-margin">
                                            <h1 class="pull-right text-danger"><i class="md md-2 md-laptop"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['enseignemant_manque']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Manque d\'Ordinateur d\'enseignement') }}</span>
                                            <div class="stick-bottom-left-right">
                                                <div class="progress progress-hairline no-margin">
                                                    <div class="progress-bar progress-bar-danger" style="width:{{ floor(100 - ((intval($details['enseignemant_manque'])/(intval($details['enseignemant_manque'])+intval($details['pc_nbr'])))*100)) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-warning no-margin">
                                            <h1 class="pull-right text-warning"><i class="md md-2 md-desktop-mac"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['admin_manque']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Manque d\'Ordinateur d\'administration') }}</span>
                                            <div class="stick-bottom-left-right">
                                                <div class="progress progress-hairline no-margin">
                                                    <div class="progress-bar progress-bar-danger" style="width:{{ floor(100 - ((intval($details['admin_manque'])/(intval($details['admin_manque'])+intval($details['pc_nbr'])))*100)) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-info no-margin">
                                            <h1 class="pull-right text-info"><i class="md md-2 md-play-shopping-bag"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['vmm']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Nombre de Valises Multimédias') }}</span>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-danger no-margin">
                                            <h1 class="pull-right text-danger"><i class="md md-2 md-wallet-travel"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['vmm_manque']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Manque de Valises Multimédias') }}</span>
                                            <div class="stick-bottom-left-right">
                                                <div class="progress progress-hairline no-margin">
                                                    <div class="progress-bar progress-bar-danger" style="width:{{ floor(100 - ((intval($details['vmm_manque'])/(intval($details['vmm_manque'])+intval($details['vmm'])))*100)) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-info no-margin">
                                            <h1 class="pull-right text-info"><i class="md md-2 md-account-balance"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['smm']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Nombre des Salles Multimédias') }}</span>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-danger no-margin">
                                            <h1 class="pull-right text-danger"><i class="md md-2 md-account-balance"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['smm_manque']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Manque Salles Multimédias') }}</span>
                                            <div class="stick-bottom-left-right">
                                                <div class="progress progress-hairline no-margin">
                                                    <div class="progress-bar progress-bar-danger" style="width:{{ (intval($details['smm_manque']) != 0 || intval($details['smm']) != 0)?floor(100 - ((intval($details['smm_manque'])/(intval($details['smm_manque'])+intval($details['smm'])))*100)):0 }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout {{ intval($details['rac_internet']) != 'non'?'text-success':'text-danger' }} no-margin">
                                            <h1 class="pull-right {{ intval($details['rac_internet']) != 'non'?'text-success':'text-danger' }}"><i class="md md-2 md-{{ intval($details['rac_internet']) != 'non'?'signal-wifi-4-bar':'signal-wifi-off' }}"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['rac_internet']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Raccordement Internet') }}</span>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-info no-margin">
                                            <h1 class="pull-right text-info"><i class="md md-2 md-cast-connected"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['vp']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Nombre des Vidéos Projecteurs') }}</span>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                            <div class="col-xs-4">
                                <div class="card">
                                    <div class="card-body no-padding">
                                        <div class="alert alert-callout alert-danger no-margin">
                                            <h1 class="pull-right text-danger"><i class="md md-2 md-cast"></i></h1>
                                            <strong class="text-xxl">{{ intval($details['vp_manque']) }}</strong><br>
                                            <span class="opacity-50">{{ __('Manque Vidéos Projecteurs') }}</span>
                                            <div class="stick-bottom-left-right">
                                                <div class="progress progress-hairline no-margin">
                                                    <div class="progress-bar progress-bar-danger" style="width:{{ (intval($details['vp_manque']) != 0 || intval($details['vp']) != 0)?floor(100 - ((intval($details['vp_manque'])/(intval($details['vp_manque'])+intval($details['vp'])))*100)):0 }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end .card-body -->
                                </div><!--end .card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@include('includes.provincemodals')
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



        });
    </script>
@endpush
