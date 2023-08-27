@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Customer Management</h1>

        <div class="mb-3">
            
            <button id="export-selected2" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Customers 2</button>

            <a href="{{ route('customers.create') }}" class="btn btn-success">
                <i class="fas fa-user-plus"></i>Add Customer</a>

        </div>
        <div class="accordion" id="filterAccordion">
            <div class="card">
                <div class="card-header" id="filterHeader">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterContent" aria-expanded="true" aria-controls="filterContent">
                            Filters
                        </button>
                    </h2>
                </div>

                <div id="filterContent" class="collapse" aria-labelledby="filterHeader" data-bs-parent="#filterAccordion">
                    <div class="card-body row">
                        <div class="col-4 mb-3">
                            <form class="filterForm">
                                <label for="cardNumber" class="form-label">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" placeholder="Enter Card Number">
                                <button class="btn btn-primary">Serach</button>
                            </form>
                        </div>
                        <div class="col-4 mb-3">
                            <form class="filterForm">
                                <div class="col">
                                    <label for="cardRangeStart" class="form-label">Card Range Start</label>
                                    <input type="text" class="form-control" id="cardRangeStart" placeholder="Start">
                                </div>
                                <div class="col">
                                    <label for="cardRangeEnd" class="form-label">Card Range End</label>
                                    <input type="text" class="form-control" id="cardRangeEnd" placeholder="End">
                                </div>
                                <button class="btn btn-primary">Serach</button>
                            </form>
                        </div>
                        <div class="col-4 mb-3">
                            <form id="filterRemaingPoint">
                                <div class="col">
                                    <label for="remainingPointStart" class="form-label">Remaining Point Start</label>
                                    <input type="text" class="form-control" id="remainingPointStart" placeholder="Start">
                                </div>
                                <div class="col">
                                    <label for="remainingPointEnd" class="form-label">Remaining Point End</label>
                                    <input type="text" class="form-control" id="remainingPointEnd" placeholder="End">
                                </div>
                                <button class="btn btn-primary">Serach</button>
                            </form>
                        </div>
                        <div class="col-4 mb-3">
                            <form id="filterTotalPoint">
                                <div class="col">
                                    <label for="totalPointStart" class="form-label">Total Point Start</label>
                                    <input type="text" class="form-control" id="totalPointStart" placeholder="Start">
                                </div>
                                <div class="col">
                                    <label for="totalPointEnd" class="form-label">Total Point End</label>
                                    <input type="text" class="form-control" id="totalPointEnd" placeholder="End">
                                </div>
                                <button class="btn btn-primary">Serach</button>
                            </form>
                        </div>
                        <div class="col-4 mb-3">
                            <form id="filterUsedPoint">
                                <div class="col">
                                    <label for="usedPointStart" class="form-label">Used Point Start</label>
                                    <input type="text" class="form-control" id="usedPointStart" placeholder="Start">
                                </div>
                                <div class="col">
                                    <label for="usedPointEnd" class="form-label">Used Point End</label>
                                    <input type="text" class="form-control" id="usedPointEnd" placeholder="End">
                                </div>
                                <button class="btn btn-primary">Serach</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <table class="table table-striped table-bordered" id="customersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Customer Code</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Address</th>
                    <th>Tel 1</th>
                    <th>Tel 2</th>
                    <th>Email</th>

                    <th>Created At</th>
                    <th>Total Points</th>
                    <th>Used Points</th>
                    <th>Remaining Points</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
        <!-- The modal -->
        <div class="modal" id="downloadModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Download File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Your file is ready for download. Click the button below to download:</p>
                        <a href="{{ route('download.excel') }}" class="btn btn-success">Download Excel File</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#customersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('customers.index') }}",
                    data: function(data) {
                        data.cardNumber = $('#cardNumber').val();
                        data.cardRangeStart = $('#cardRangeStart').val();
                        data.cardRangeEnd = $('#cardRangeEnd').val();
                        data.remainingPointStart = $('#remainingPointStart').val();
                        data.remainingPointEnd = $('#remainingPointEnd').val();
                        data.usedPointStart = $('#usedPointStart').val();
                        data.usedPointEnd = $('#usedPointEnd').val();
                        data.totalPointStart = $('#totalPointStart').val();
                        data.totalPointEnd = $('#totalPointEnd').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'surname',
                        name: 'surname'
                    },
                    {
                        data: 'customer_code',
                        name: 'customer_code'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'birthdate',
                        name: 'birthdate'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'tel1',
                        name: 'tel1'
                    },
                    {
                        data: 'tel2',
                        name: 'tel2'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'total_points',
                        name: 'total_points'
                    },
                    {
                        data: 'used_points',
                        name: 'used_points'
                    },
                    {
                        data: 'remaining_points',
                        name: 'remaining_points'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).attr('data-id', data.id);
                },
                "columnDefs": [{

                    "targets": [5, 10, 14], // Indexes of the "dates" column
                    "render": function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment(data).format(
                                'DD/MM/YYYY'); // Use your desired date format
                        }
                        return data;
                    }
                }],
            });

            $('.filterForm').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
                $("#filterContent").collapse("toggle");
            });

        });
        //   for  download excel  
        const button = document.getElementById('export-selected2');
        button.addEventListener('click', () => {
            var customerIds =  $('#customersTable').DataTable().column(0).data().toArray();
            var queryString = 'customer_ids=' + encodeURIComponent(JSON.stringify(customerIds));

            fetch('/customers/export-excel?'+queryString)
                .then(response => response.json())
                .then(data => {
                    $('#downloadModal').modal('show');                 

                    
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
