@extends('layouts.app')
@section('pageTitle', __('User Modification'))
@section('content')
    {{-- {{dd($user);}} --}}
    <div class="row">

        <!-- BEGIN LAYOUT LEFT SIDEBAR -->
        <div class="col-md-12">
            <form method="POST" class="form form-validate floating-label" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-head style-primary card-head-xs">
                        <header>{{ __('User Modification') }}&nbsp;&nbsp;:&nbsp;&nbsp;<samp
                                class="text-light hidden-xs">{{ $user->name . ' ' . $user->email }}</samp>&nbsp;&nbsp;<strong>{{ $user->massar }}</strong>
                        </header>
                    </div>
                    <div class="card-body tab-content style-default-bright">
                        <div class="row margin-1 text-center style-accent-bright border-gray  margin-bottom-xxl">
                            <div class="form-group col-md-2">
                                <img id="photo-profile" src="{{ asset('images/admin/' . $user->avatar) }}" alt=""
                                    class="img-circle  border-white border-xl size-3">
                                <button type="button" id="profile-img-container"
                                    class="btn btn-xs ink-reaction btn-floating-action btn-primary-bright profile-img"><i
                                        class="fa fa-camera"></i></button>
                            </div>
                            <div class="form-group col-md-8 line-height-normal">
                                <h3 class="text-light text-left col-md-6">{{ strtoupper($user->name) }}</strong></h3>
                                <h3 class="text-light text-left col-md-6">{{ strtoupper($user->email) }}</strong></h3>
                            </div>
                        </div>
                        <div class="col-xs-12 margin-bottom-xxl">
                            <div class="form-group col-sm-6">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') ? old('name') : (isset($user->name) ? $user->name : '') }}"
                                    data-rule-minlength="2" maxlength="100" required aria-required="true">
                                <label class="form-label">{{ __('First Name Français') }}</label>
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ old('email') ? old('email') : (isset($user->email) ? $user->email : '') }}"
                                    data-rule-pattern="^[a-zA-Z0-9._-]{2,}@[a-zA-Z0-9-]{2,}\.[a-zA-Z0-9-]{2,6}$"
                                    maxlength="200" required aria-required="true"
                                    data-msg-pattern="{{ __('Invalid Email') }}">
                                <label class="form-label">{{ __('Last Name Français') }}</label>
                            </div>
                        </div>
                        <div class="col-xs-12  margin-bottom-xxl">
                            <div class="form-group col-sm-6">
                                <label class="form-label">{{ __('Role') }}</label>
                                <select id="roleUser" name="role_id" class="role default-select form-control" required
                                    aria-required="true">
                                    <option value>{{ __('Select a role') }}</option>
                                    @foreach ($roles as $indx => $role)
                                        <option
                                            {{ old('role_id') == $indx ? 'selected=selected' : ((isset($user->role_id) ? $user->role_id : '') == $indx ? 'selected=selected' : '') }}
                                            value="{{ $indx }}">{{ $role }}</option>
                                    @endforeach
                                </select>
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
                                onclick="event.preventDefault(); document.getElementById('print-form-{{ $user->id }}').submit();"
                                class="btn btn-success ink-reaction btn-raised"><i class="fa fa-print"></i>&nbsp;<span
                                    class="hidden-xs">{{ __('Print') }}</span></button>
                            <button type="button" class="btn btn-danger ink-reaction btn-raised delete-btn"
                                data-delete-action="{{ route('users.destroy', $user->id) }}" data-toggle="modal"
                                data-target="#suppmodal"><i class="fa fa-trash"></i>&nbsp;<span
                                    class="hidden-xs">{{ __('Delete') }}</span></button>
                        </div>
                    </div>
                </div>
                <!--end .card -->
            </form>
            <form id="print-form-{{ $user->id }}" action="{{ route('users.print', [$user->id, 'credentials']) }}"
                method="get">@csrf</form>
            <form id="avatar-edit" action="{{ route('users.uploadavatar') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input id="avatarfile" type="file" name="avatar" class="hide">
                <input id="user_id" type="hidden" name="user_id" value="{{ $user->id }}">
            </form>
        </div>
        <!--end .col -->
        <!-- END LAYOUT LEFT SIDEBAR -->
    </div>
    @include('users.modals')
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
                $('#deleteuserForm').attr('action', $(this).data('delete-action'));
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
                    url: "{{ route('users.uploadavatar') }}",
                    data: FData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#photo-profile').attr('src', "{{ asset('images/admin/') }}" + '/' +
                            response[0]);
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
