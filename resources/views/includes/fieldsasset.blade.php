@push('form-css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/select2/select2.css?1424887856')}}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/jquery-ui/jquery-ui-theme.css?1423393666')}}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858')}}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/summernote/summernote.css') }}">
@endpush
@push('jq-ui-js')
<script src="{{ asset('js/libs/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush
@push('form-js')
<script src="{{ asset('js/libs/select2/select2.min.js')}}"></script>
<script src="{{ asset('js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ asset('js/libs/inputmask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{ asset('js/libs/moment/moment.min.js')}}"></script>
<script src="{{ asset('js/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.fr.js')}}"></script>
<script src="{{ asset('js/libs/inputmask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{ asset('js/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/libs/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script src="{{ asset('js/libs/summernote/summernote.min.js') }}"></script>
@endpush
@push('form-init-js')
<script>
$(document).ready(function(){
    // date Picker set default options
    $.fn.datepicker.defaults.autoclose = true;
    $.fn.datepicker.defaults.language = 'fr';

    // date Picker initialize
    $('#date_nais').datepicker({
        endDate: '-4y',
        format : "yyyy-mm-dd"
    });

    $('#date_nais').on('change', function(){
        dob = new Date(this.value);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#agelabel').html(age+"{{__(' Years old')}}");
        $('#age').val(age);
    })
    $('#date_nais').trigger('change');


    // Select2 initialize
    $('#niveau').select2();
    $('.nationalite').select2();

    $(':input').inputmask();

    //radio checkers

    @foreach ($errors->getMessages() as $type => $er)
        errorInput = $('#{{$type}}');
        @if ($type === 'subvalidation' || $type === 'suppvalidation')
            $('#validation').append('<span id="{{$type}}-error" style="position:absolute;" class="help-block">@error($type){{$message}}@enderror</span>');
            $('#validation').addClass("has-error");
        @else
            errorInput.after('<span id="{{$type}}-error" class="help-block">@error($type){{$message}}@enderror</span>');
            errorInput.parent().addClass("has-error");
        @endif
            errorInput.attr("aria-invalid", "true");
            errorInput.attr("aria-describedby","{{$type}}-error");
    @endforeach

    $('#observation').summernote({ height: 450});
});
</script>
@endpush
