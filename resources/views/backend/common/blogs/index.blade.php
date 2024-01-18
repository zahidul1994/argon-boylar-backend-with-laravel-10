@extends('backend.layouts.master')
@section('title', 'Blogs')
@push('css')
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="{{ asset('lightbox/css/lightbox.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">All blogs</h5>
                                <p class="text-sm mb-0">
                                Blog data.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route(Request::segment(1) . '.blogs.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Blog</a>
                                    
                               
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table id="datatable-basic" class="table table-flush" id="products-list">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                         <th>Title</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
    @push('js')
        <script src="{{ asset('lightbox/js/lightbox.js') }}"></script> 
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                lightbox.option({
                    'resizeDuration': 200,
                    'wrapAround': true
                });

                $('#datatable-basic').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    dom: 'Bflrtip',
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    language: {
                        'paginate': {
                            'previous': '<strong><<strong>',
                            'next': '<strong>><strong>'
                        }
                    },
                    buttons: [{
                            extend: 'csv',
                            text: 'Excel',
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            text: 'PDF',
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        'colvis'
                    ],
                    ajax: "{{ route(Request::segment(1) . '.blogs.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        
                        {
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'link'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: true
                        },
                    ]
                });
            });

            function updateStatus(el) {
                if (el.checked) {
                    var status = 1;
                } else {
                    var status = 0;
                }
                $.post("{{ route(Request::segment(1) . '.blogStatus') }}", {
                        _token: '{{ csrf_token() }}',
                        id: el.value,
                        status: status
                    },
                    function(data) {
                        if (data == 1) {
                            toastr.success('success', 'Blog Status updated successfully');
                        } else {
                            toastr.danger('danger', 'Something went wrong');
                        }
                    });
            }
        </script>
    @endpush
