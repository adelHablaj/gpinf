@extends('layouts.app')
@section('pageTitle', __('Etablissements List'))
@push('datatable-css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990')}}" />
@endpush
@section('content')
{{-- {{ dd($etabs) }} --}}
<div class="row">
    <div class="col-lg-12">
        <form class="form form-validate floating-label" action="{{ route('etabs.index')}}" method="get">
            @csrf
            <div class="card">
                <div class="card-head card-head-xs style-primary">
                    <header>{{__('Find Etablissements')}}</header>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="form-label">{{__('Provinces')}}</label>
                            <select id="province" name="province_id" class="default-select form-control" required aria-required="true">
                                <option value></option>
                                @foreach ($provinces as $indx => $province )
                                    <option {{ isset($province_id) && $province_id == $indx?'selected="selected"':''}}  value="{{$indx}}">{{$province}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="form-label">{{__('Communes')}}</label>
                                <select id="commune" name="commune_id" class="default-select form-control" required aria-required="true">
                                    <option value></option>
                                    @if (isset($communes))
                                        @foreach ($communes as $indx => $commune )
                                            <option {{ isset($commune_id) && $commune_id == $indx?'selected="selected"':''}}  value="{{$indx}}">{{$commune}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="form-label">{{__('Cycles')}}</label>
                                <select id="cycle" name="cycle_id" class="default-select form-control" required aria-required="true">
                                    <option value></option>
                                    <option {{ isset($cycle_id) && $cycle_id == 1?'selected="selected"':''}} value="1">{{ ('Prescolaire') }}</option>
                                    <option {{ isset($cycle_id) && $cycle_id == 2?'selected="selected"':''}} value="2">{{ ('Primaire') }}</option>
                                    <option {{ isset($cycle_id) && $cycle_id == 3?'selected="selected"':''}} value="3">{{ ('Collégiale') }}</option>
                                    <option {{ isset($cycle_id) && $cycle_id == 4?'selected="selected"':''}} value="4">{{ ('Qualifiant') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-actionbar">
                    <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-primary ink-reaction btn-raised">{{ __('Find')}}</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-head  card-head-xs style-accent-bright">
                <header>{{__('Etablissements List')}}</header>
            </div>
            <div class="card-body">
                @if(isset($etabs) && count($etabs) > 0)
                <div class="table-responsive">
                    <table id="etabsTbl" class="table  table-hover table-striped no-margin">
                        <thead>
                            <tr>
                                <tr>
                                    <th></th>
                                    <th>{{ __('GRESA') }}</th>
                                    <th>{{ __('Nom Français') }}</th>
                                    <th>{{ __('Nom Arabe') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($etabs as $key => $etab)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $etab->cd_etab }}</td>
                                <td>{{ $etab->nom_etabl }}</td>
                                <td>{{ $etab->nom_etaba }}</td>
                                <td>{{ $natures[$etab->cd_netab] }}</td>
                                <td class="text-right">
                                    <a href="{{route('etabs.show', $etab->cd_etab)}}" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('Afficher Etablissement')}}"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('etabs.edit', $etab->cd_etab)}}" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('Edit row')}}"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-icon-toggle delete-btn" id="delete-{{ $etab->cd_etab }}" data-toggle="modal" data-target="#suppmodal" data-delete-action="{{ route('etabs.destroy', $etab->cd_etab) }}" data-method="delete" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('Delete row')}}"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--end .table-responsive -->
                @else
                    <div class="text-center">
                        {{ __('No Results for the requested informations')}}
                    </div>
                @endif
            </div><!--end .card-body -->
        </div><!--end .card -->
    </div><!--end .col -->
</div><!--end .row -->
{{--$etabs->links()--}}

@endsection
@push('datatable-js')
@include('includes.etabmodals')
    <script src="{{ asset('js/libs/DataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js')}}"></script>
    <script src="{{ asset('js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
@endpush
@push('datatable-init-js')
<script>
    $(document).ready(function() {

        $('#etabsTbl').DataTable({
            "dom": 'lCfrtip',
            "order": [],
            "colVis": {
                "buttonText": "{{__('Columns')}}",
                "overlayFade": 0,
                "align": "right"
            },
            "language": {
                "lengthMenu": "_MENU_ {{__('entries per page')}}",
                "search": '<i class="fa fa-search"></i>',
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            }
        });
        // =========================================================================

    }); // pass in (namespace, jQuery):

</script>
@endpush
@push('form-css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/select2/select2.css?1424887856')}}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/jquery-ui/jquery-ui-theme.css?1423393666')}}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858')}}" />
@endpush
@push('jq-ui-js')
<script src="{{ asset('js/libs/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush
@push('form-js')
<script src="{{ asset('js/libs/select2/select2.min.js')}}"></script>
<script src="{{ asset('js/libs/moment/moment.min.js')}}"></script>
<script src="{{ asset('js/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.fr.js')}}"></script>
<script src="{{ asset('js/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/libs/jquery-validation/dist/additional-methods.min.js')}}"></script>
@endpush
@push('form-init-js')
    <script>
    $(document).ready(function(){
        // date Picker set default options
        $.fn.datepicker.defaults.autoclose = true;
        $.fn.datepicker.defaults.language = 'fr';

        // date Picker initialize
        $('#date_nais').datepicker({
            endDate: '0d',
            format : "yyyy/mm/dd",
        });

        // Select2 initialize
        $('#province').select2();
    });

    //send delete route to the modal form action
    $('.delete-btn').on('click', function (e) {
        $('#deleteetabForm').attr('action',$(this).data('delete-action'));
    })

    $('#province').on('change', function(e) {
                e.preventDefault();
                let token = $('meta[name="csrf-token"]').attr('content');

                // let FData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('communes.getcommunes') }}",
                    data: {cd_prov: this.value, '_token': token},
                    dataType: 'json',
                    success: function(response) {
                        $('#commune').empty();
                        let option = new Option('Choisir une Commune','');
                        $('#commune').append(option);
                        $.each(response, function(k, v){
                            let option = new Option(v,k);
                            $('#commune').append(option);
                        });
                    },
                    error: function(response) {
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
    </script>
@endpush

