@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css') }}">
@endpush

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-fixedheader/js/fixedHeader.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-rowreorder/js/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-rowreorder/js/rowReorder.bootstrap4.min.js') }}"></script>
@endpush
