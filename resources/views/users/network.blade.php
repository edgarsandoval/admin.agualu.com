@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Ver red
    @parent
@stop

{{-- page level styles --}}
@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/getorgchart/getorgchart.css')}}" />
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-users"></i>
                        Ver red
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users') }}">Usuarios</a>
                        </li>
                        <li class="breadcrumb-item active">Ver red</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Mi red multinivel
                </div>
                <div class="card-block m-t-25">
                    <div id="people"></div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
@stop

@section('scripts')
    <!-- plugin scripts-->
    <script type="text/javascript" src="{{asset('vendor/getorgchart/getorgchart.js')}}"></script>
    <!-- end of plugin scripts-->
    <script type="text/javascript">

        var orgchart = new getOrgChart(document.getElementById("people"), {
            theme: "vivian",
            color: "lightteal",
            enableEdit: false,
            enableDetailsView: false,
            expandToLevel: 7,
            primaryFields:  ["name", "distributorNumber", "level", "state", "consumption"],
            dataSource: {!! json_encode($network) !!},
            customize: {
                @foreach ($machinesId as $machineId)
                    {!! sprintf('"%s": { color: "darkred" },', $machineId) !!}
                @endforeach
            },
            clickNodeEvent: clickHandler,
        });

        function clickHandler(sender, args) {
            if(Number.isInteger(args.node.id))
                swal({
                    text: "¿Quieres visitar el perfil de este asociado?",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                    }).then(function () {
                        window.location.href = '{{ route('view_user', ':ID') }}'.replace(':ID', args.node.id);
                    }, function (dismiss) {
                        if (dismiss === 'cancel') {
                            orgchart.highlightNode(args.node.id);
                        }
                    })
                }
    </script>
@stop
