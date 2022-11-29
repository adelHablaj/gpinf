@extends('layouts.app')
@section('pageTitle', __('Not Paid'))
@push('datatable-css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990')}}" />
@endpush
@section('content')
{{-- {{ dd($inputs['nom_fr']) }} --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-head  card-head-xs style-accent-bright">
                <header>{{__('Students Does not have payement')}}</header>
            </div>
            <div class="card-body">
                @if(isset($eleves) && count($eleves) > 0)
                <div class="table-responsive">
                    <table id="elevesTbl" class="table  table-hover table-striped no-margin">
                        <thead>
                            <tr>
                                <tr>
                                    <th></th>
                                    <th>{{ __('Massar') }}</th>
                                    <th>{{ __('Nom') }}</th>
                                    <th>{{ __('Prenom') }}</th>
                                    <th>{{ __('Genre') }}</th>
                                    <th>{{ __('Date de Naissance') }}</th>
                                    <th>{{ __('Niveau') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eleves as $eleve)
                            <tr>
                                <td>
                                    <img class="img-circle width-1"  src="{{ asset('images\students\small-'.$eleve->avatar) }}" alt="">
                                </td>
                                <td>{{ $eleve->massar }}</td>
                                <td>{{ $eleve->nom_fr }}</td>
                                <td>{{ $eleve->prenom_fr }}</td>
                                <td>{{ $eleve->genre }}</td>
                                <td>{{ $eleve->date_nais }}</td>
                                <td>{{ $eleve->Niveau->nom }}</td>
                                <td class="text-right">
                                    <a href="{{route('eleves.edit', $eleve->id)}}" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('Edit row')}}"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('eleves.destroy', $eleve->id)}}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $eleve->id }}').submit();" class="btn btn-icon-toggle" data-method="delete" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('Delete row')}}"><i class="fa fa-trash-o"></i></a>
                                    <form id="delete-form-{{ $eleve->id }}"  action="{{ route('eleves.destroy', $eleve->id) }}" method="post">@csrf @method('delete')</form>
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
{{--$eleves->links()--}}
@endsection
@push('datatable-js')
    <script src="{{ asset('js/libs/DataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js')}}"></script>
    <script src="{{ asset('js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
@endpush
@push('datatable-init-js')
<script>
    $(document).ready(function() {

        $('#elevesTbl').DataTable({
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
        $('#niveau').select2();
    });
    </script>
@endpush

