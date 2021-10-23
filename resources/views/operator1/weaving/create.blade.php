@extends('layouts.operator1.operator1')
@section('title', 'Operator | Buat Weaving')
@section('content')
    <div class="col-md-9 col-sm-9 pt-2">
        <!-- general form elements disabled -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-white">Buat Weaving</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form id="sacon_form" method="POST" action="{{ route('weaving.store') }}" role="form">
                    {{ csrf_field() }}
                    @if ($errors->any())
                        <div class="alert alert-danger">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-2 col-2">
                            <label>KP</label>
                        </div>
                        <div class="col-sm-10 col-10">
                            <label>{{ ': ' . $sacon->kp }}</label>
                        </div>
                        <div class="col-sm-2 col-2">
                            <label>Item</label>
                        </div>
                        <div class="col-sm-10 col-10">
                            <label>{{ ': ' . $sacon->item }}</label>
                        </div>
                    </div>
                    <input type="hidden" name="item" value="{{ $sacon->item }}">
                    <input type="hidden" name="id" value="{{ $sacon->id }}">
                    <div class="text-primary d-flex justify-content-center"><b>Data {{ $datas->count() + 1 }}</b></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>P Item</label>
                                <input type="text" id="pitem" name="pitem" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('pitem') }}"
                                    placeholder="{{ $sacon->item }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>LOT</label>
                                <input type="text" id="lot" name="lot" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('lot') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>MC</label>
                                <input type="text" id="mc" name="mc" class="form-control" style="text-transform: uppercase"
                                    value="{{ old('mc') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>No Beam</label>
                                <select type="number" id="nb" name="nb" class="form-control"
                                    style="text-transform: uppercase">
                                    @foreach ($indigo as $item)
                                        @if ($item->nb == $nb)
                                        <option selected value="{{ $item->nb }}"> {{ $item->nb }}</option>
                                        @else
                                        <option value="{{ $item->nb }}"> {{ $item->nb }}</option>
                                        @endif
                                            
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Pakan</label>
                                <input type="text" id="pakan" name="pakan" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('pakan') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Pick</label>
                                <input type="text" id="pick" name="pick" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('pick') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Sisir</label>
                                <input type="text" id="sisir" name="sisir" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('sisir') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Anyaman</label>
                                <input type="text" id="anyaman" name="anyaman" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('anyaman') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Potongan</label>
                                <input type="text" id="potongan" name="potongan" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('potongan') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Panjang</label>
                                <input type="number" id="p" name="p" class="form-control" style="text-transform: uppercase"
                                    value="{{ old('p') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Berat</label>
                                <input type="number" id="b" name="b" class="form-control" style="text-transform: uppercase"
                                    value="{{ old('b') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>OPR</label>
                                <input type="text" id="opr" name="opr" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('opr') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Shift</label>
                                <input type="text" id="shift" name="shift" class="form-control"
                                    style="text-transform: uppercase" value="{{ old('shift') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>SN</label>
                                <input type="text" id="sn" name="sn" class="form-control" style="text-transform: uppercase"
                                    value="{{ old('sn') }}" required>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="float-right">
                        <button type="submit" name="btnstatus" value="stop" class="btn btn-primary ">SUBMIT</button>
                        <button type="submit" name="btnstatus" value="next" class="btn btn-success ">SUBMIT NEXT</button>
                    </div>
                    <div class="float-left">
                        <button onclick="return backurl();" class="btn btn-danger ">BACK</button>
                    </div>
            </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

    <script src="{{ asset('/../plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/../plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $('#sacon_form').validate({
            rules: {
                lot: {
                    required: true,
                },
                mc: {
                    required: true,
                },
                nb: {
                    required: true,
                },
                pakan: {
                    required: true,
                },
                pick: {
                    required: true,
                },
                sisir: {
                    required: true,
                },
                anyaman: {
                    required: true,
                },
                potongan: {
                    required: true,
                },
                p: {
                    required: true,
                },
                b: {
                    required: true,
                },
                shift: {
                    required: true,
                },
                opr: {
                    required: true,
                },
                sn: {
                    required: true,
                }
            },
            messages: {
                lot: {
                    required: ""
                },
                mc: {
                    required: ""
                },
                nb: {
                    required: ""
                },
                pakan: {
                    required: ""
                },
                pick: {
                    required: ""
                },
                sisir: {
                    required: ""
                },
                anyaman: {
                    required: ""
                },
                potongan: {
                    required: ""
                },
                p: {
                    required: ""
                },
                b: {
                    required: ""
                },
                shift: {
                    required: ""
                },
                opr: {
                    required: ""
                },
                sn: {
                    required: ""
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        function backurl() {
            var url_string = window.location.href;
            var url = new URL(url_string);
            var kp = url.searchParams.get("kp");

            window.open('/weaving?kp=' + kp, '_self')

            return false;
        }

    </script>
@endsection
