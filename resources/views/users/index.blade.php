@extends('layouts.app')
@section('pageTitle', __('Users List'))
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
                <header>{{__('Users List')}}</header>
            </div>
            <div class="card-body">
                @if(isset($users) && count($users) > 0)
                <div class="table-responsive">
                    <table id="usersTbl" class="table  table-hover table-striped no-margin">
                        <thead>
                            <tr>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Photo') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img class="img-circle size-1"  src="{{ asset('images/admin/'.str_replace('profile','tiny',$user->avatar)) }}" alt="">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->nom }}</td>
                                <td class="text-right">
                                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('Edit row')}}"><i class="fa fa-pencil"></i></a>
                                    <button data-delete-action="{{ route('users.destroy', $user->id) }}" class="btn btn-icon-toggle delete-btn" data-target="#suppmodal" data-toggle="modal" data-placement="top" data-original-title="{{ __('Delete row')}}"><i class="fa fa-trash-o"></i></a>
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
{{--$users->links()--}}
@endsection
@include('users.modals')
@push('datatable-js')
    <script src="{{ asset('js/libs/DataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js')}}"></script>
    <script src="{{ asset('js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
@endpush
@push('datatable-init-js')
<script>
    $(document).ready(function() {

        $('#usersTbl').DataTable({
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

        //send delete route to the modal form action
    $('.delete-btn').on('click', function (e) {
        e.preventDefault();
        $('#deleteuserForm').attr('action',$(this).data('delete-action'));
    })

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


