@extends('layouts.app')
@section('pageTitle', __('Create New User'))
@section('content')
{{--{dd($user);}} --}}
<div class="row">
    <!-- BEGIN LAYOUT LEFT SIDEBAR -->
    <div class="col-md-12">
        <form method="POST" class="form form-validate floating-label" action="{{ route('users.store')}}">
            @csrf
        <div class="card">
            <div class="card-head style-primary card-head-xs">
                <header>{{__('Create New User')}}&nbsp;&nbsp;:&nbsp;&nbsp;<samp class="text-light hidden-xs"></samp>&nbsp;&nbsp;<strong></strong></header>
            </div>
            <div class="card-body tab-content style-default-bright">
                <div class="row margin-1 text-center style-accent-bright border-gray  margin-bottom-xxl">
                    <div class="form-group col-md-2" >
                        <img id="photo-profile" src="{{ asset('images/admin/admin-default-avatar.png') }}" alt="" class="img-circle  border-white border-xl size-3">
                    </div>
                    <div class="form-group col-md-8 line-height-normal">
                        <h3 class="text-light text-left col-md-6"><strong id="namelabel"></strong></h3>
                        <h3 class="text-light text-left col-md-6"><strong id="emaillabel"></strong></h3>
                    </div>
                </div>
                <div class="col-xs-12 margin-bottom-xxl">
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name')?old('name'):''}}" data-rule-minlength="5" maxlength="30" required aria-required="true">
                        <label class="form-label">{{__('Full Name')}}</label>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email')?old('email'):''}}" data-rule-pattern="^[a-zA-Z0-9._-]{2,}@[a-zA-Z0-9-]{2,}\.[a-zA-Z0-9-]{2,6}$" maxlength="200" required aria-required="true" data-msg-pattern="{{ __('Invalid Email')}}">
                        <label class="form-label">{{__('Email')}}</label>
                    </div>
                </div>
                <div class="col-xs-12  margin-bottom-xxl">
                    <div class="form-group col-sm-6">
                        <label class="form-label">{{__('Role')}}</label>
                        <select id="roleUser" name="role_id" class="role default-select form-control" required aria-required="true">
                            <option value>{{ __('Select a role')}}</option>
                            @foreach ($roles as $indx => $role )
                                <option {{ old('role_id')== $indx?'selected=selected':''}}  value="{{$indx}}">{{$role}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div><!--end .card-body -->
            <br>
            <br>
            <div class="card-actionbar stick-bottom-right hieght-4">
                <div class="card-actionbar-row form-footer">
                    <button type="submit" class="btn btn-primary ink-reaction btn-raised">{{ __('Save')}}</button>
                </div>
            </div>
        </div><!--end .card -->
        </form>
    </div><!--end .col -->
    <!-- END LAYOUT LEFT SIDEBAR -->
</div>
@endsection
@include('includes.fieldsasset')
@push('form-init-js')
<script>
$(document).ready(function(){

    // date Picker initialize


    // Select2 initialize
    $('#role').select2();

    $(':input').inputmask();
    $('#name').keyup(function(e){
        $('#namelabel').html(this.value);
    })
    $('#email').keyup(function(e){
        $('#emaillabel').html(this.value);
    })

    $('#cin').on('blur', (e) => {
        $('#cin').attr('readonly', true);
    })

});
</script>
@endpush
