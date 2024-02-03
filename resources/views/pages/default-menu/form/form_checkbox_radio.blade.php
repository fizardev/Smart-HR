@extends('inc.layout')
@section('title','Checkbox & Radio')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        @include('inc.breadcrumb',['bcrumb' => 'bc_level_dua','bc_1'=>'Form Stuff'])
        <div class="subheader">
            @component('inc.subheader',['subheader_title'=>'st_type_2'])
            @slot('sh_icon') edit @endslot
            @slot('sh_descipt') Default input elements for forms @endslot
            @endcomponent            
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Checkbox <span class="fw-300"><i>inputs</i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="panel-tag">
                                Add <code>.custom-control</code> and <code>.custom-checkbox</code> wrapper to your <code>input</code> and <code>label</code> to create a custom checkbox component. You can add <code>.custom-checkbox-circle</code> to change it to a circular checkbox
                            </div>
                            <button id="js-checkbox-toggle" data-toggle="button" class="btn btn-outline-danger mb-g" onclick="toggleCheckbox();">Change to CIRCLE</button>
                            <h5 class="frame-heading">Block alignment</h5>
                            <div class="frame-wrap">
                                <div class="demo">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                                        <label class="custom-control-label" for="defaultUnchecked">Unchecked</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="defaultChecked" checked="">
                                        <label class="custom-control-label" for="defaultChecked">Checked</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="defaultIndeterminate" checked="">
                                        <label class="custom-control-label" for="defaultIndeterminate">Indeterminate</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="defaultUncheckedDisabled" disabled="">
                                        <label class="custom-control-label" for="defaultUncheckedDisabled">Unchecked & disabled</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="defaultCheckedDisabled" checked="" disabled="">
                                        <label class="custom-control-label" for="defaultCheckedDisabled">Checked & disabled</label>
                                    </div>
                                </div>
                            </div>
                            <h5 class="frame-heading">Inline alignment</h5>
                            <div class="frame-wrap">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="defaultInline1">
                                    <label class="custom-control-label" for="defaultInline1">Unchecked</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="defaultInline2" checked="">
                                    <label class="custom-control-label" for="defaultInline2">Checked</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="defaultInlined" disabled="">
                                    <label class="custom-control-label" for="defaultInlined">Disabled</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="defaultInline3" checked="" disabled="">
                                    <label class="custom-control-label" for="defaultInline3">Checked & disabled</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div id="panel-2" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Radio <span class="fw-300"><i>inputs</i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="panel-tag">
                                Add <code>.custom-control</code> and <code>.custom-radio</code> wrapper to your <code>input</code> and <code>label</code> to create a custom radio component. You can add <code>.custom-radio-rounded</code> to change it to a rounded radio
                            </div>
                            <button id="js-radio-toggle" data-toggle="button" class="btn btn-outline-danger mb-g" onclick="toggleRadio();">Change to ROUNDED</button>
                            <h5 class="frame-heading">Block alignment</h5>
                            <div class="frame-wrap">
                                <div class="demo">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="defaultUncheckedRadio" name="defaultExampleRadios">
                                        <label class="custom-control-label" for="defaultUncheckedRadio">Unchecked</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="defaultCheckedRadio" name="defaultExampleRadios" checked="">
                                        <label class="custom-control-label" for="defaultCheckedRadio">Checked</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input active" id="defaultUncheckedRadio2" name="defaultExampleRadios">
                                        <label class="custom-control-label" for="defaultUncheckedRadio2">Unchecked</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="defaultUncheckedDisabledRadio2" name="defaultExampleRadios1" disabled="">
                                        <label class="custom-control-label" for="defaultUncheckedDisabledRadio2">Disabled</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="defaultCheckedDisabledRadio2" name="defaultCheckedDisabledRadio2" checked="" disabled="">
                                        <label class="custom-control-label" for="defaultCheckedDisabledRadio2">Checked & disabled</label>
                                    </div>
                                </div>
                            </div>
                            <h5 class="frame-heading">Inline alignment</h5>
                            <div class="frame-wrap">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="defaultInline1Radio" name="inlineDefaultRadiosExample">
                                    <label class="custom-control-label" for="defaultInline1Radio">Unchecked</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="defaultInline2Radio" name="inlineDefaultRadiosExample" checked="">
                                    <label class="custom-control-label" for="defaultInline2Radio">Checked</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="defaultInline4Radio" name="inlineDefaultRadiosExample2" disabled="">
                                    <label class="custom-control-label" for="defaultInline4Radio">Disabled</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="defaultInline3Radio" name="inlineDefaultRadiosExample2" checked="" disabled="">
                                    <label class="custom-control-label" for="defaultInline3Radio">Checked & disabled</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div id="panel-3" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Switch <span class="fw-300"><i>radio and checkbox</i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="panel-tag">
                                A switch has the markup of a custom checkbox but uses the <code>.custom-switch</code> class to render a toggle switch. Switches also support the <code>disabled</code> attribute
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <h5 class="frame-heading">
                                        Switch checkbox
                                    </h5>
                                    <div class="frame-wrap demo">
                                        <div class="demo">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1">Unchecked</label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch2" checked="">
                                                <label class="custom-control-label" for="customSwitch2">Checked</label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" disabled id="customSwitchd">
                                                <label class="custom-control-label" for="customSwitchd">Disabled</label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked="" disabled="">
                                                <label class="custom-control-label" for="customSwitch3">Checked & disabled</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h5 class="frame-heading">Switch Radio</h5>
                                    <div class="frame-wrap demo">
                                        <div class="demo">
                                            <div class="custom-control custom-switch">
                                                <input type="radio" class="custom-control-input" id="customSwitch1radio" name="defaultSwitchRadioExample">
                                                <label class="custom-control-label" for="customSwitch1radio">Unchecked</label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="radio" class="custom-control-input" id="customSwitch2radio" checked="" name="defaultSwitchRadioExample">
                                                <label class="custom-control-label" for="customSwitch2radio">Checked</label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="radio" class="custom-control-input" disabled id="customSwitchdradio" name="defaultSwitchRadioExample2">
                                                <label class="custom-control-label" for="customSwitchdradio">Disabled</label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="radio" class="custom-control-input" id="customSwitch3radio" checked="" disabled="" name="defaultSwitchRadioExample2">
                                                <label class="custom-control-label" for="customSwitch3radio">Checked & disabled</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('plugin')
        <script type="text/javascript">
            $('#defaultIndeterminate').prop('indeterminate', true)

            var toggleCheckbox = function()
            {
                $('#js-checkbox-toggle').toggleText('Change to CIRCLE', 'Change back to default');
                $('.frame-wrap .custom-checkbox').toggleClass('custom-checkbox-circle');
            }

            var toggleRadio = function()
            {
                $('#js-radio-toggle').toggleText('Change to ROUNDED', 'Change back to default');
                $('.frame-wrap .custom-radio').toggleClass('custom-radio-rounded');
            }

        </script>
@endsection
