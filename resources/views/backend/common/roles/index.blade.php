@extends('backend.layouts.master')
@section('title', 'Roles')
@push('css')
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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
                                <h5 class="mb-0">All Roles</h5>
                                <p class="text-sm mb-0">
                                     data.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{route(Request::segment(1).'.roles.create')}}"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Role</a>
                                 
                            </div>
                        </div>
                      </div>
                        <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table id="datatable-basic" class="table table-flush" id="products-list">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sl</th>
                                    <th>Role Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Role Name</th>
                                        <th>Permission</th>
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
       <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
     <script>
        $(document).ready(function () {
       
            $('#datatable-basic').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                dom: 'Bflrtip',
                lengthMenu :
                [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                language: {
                    'paginate': {
                        'previous': '<strong><<strong>',
                        'next': '<strong>><strong>'
                    }
                },
                buttons: [
                    {
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
                ajax: "{{ route(Request::segment(1).'.roles.index') }}",
                columns: [
                    {data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                   },
                    {data: 'name', name: 'name'},
                    {data: 'permission'},
                    {data: 'action', name: 'action', orderable: false, searchable: true},
                ]
            });

            

        });
        

    </script>
    @endpush