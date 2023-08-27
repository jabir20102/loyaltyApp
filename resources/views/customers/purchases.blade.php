@extends('layouts.app')

@section('content')
    <div class="container">
        <p><strong>Customer Name:</strong> {{ $customer->name }}</p>
        <p><strong>Customer Code:</strong> {{ $customer->customer_code }}</p>
        <p><strong>Customer Phone No:</strong> {{ $customer->tel1 }}</p>
        <p><strong>Customer Phone No 2:</strong> {{ $customer->tel2 }}</p>
        <h2>Purchases</h2>
        <table class="table table-bordered  table-striped" id="purchasesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through purchases data and display it here -->
                @foreach ($purchases as $purchase)
                    <tr class="clickable-row" data-purchase-id="{{ $purchase->id }}"
                        style="cursor: pointer;"
                        onmouseover="this.style.backgroundColor='#e1e1e1'"
                        onmouseout="this.style.backgroundColor='#f5f5f5'">
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->purchase_date }}</td>
                        <td>{{ $purchase->total_amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Purchased Item </h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barcode</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price Per Item</th>
                    <th>Price with VAT</th>
                </tr>
            </thead>
            <tbody id="purchasedItemsModalBody">
                <!-- Purchased items data will be loaded here dynamically -->
            </tbody>
        </table>
    </div>

</div>

    <!-- Modal for displaying purchased items -->
        <div class="modal fade" id="purchasedItemsModal" tabindex="-1" role="dialog" aria-labelledby="purchasedItemsModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchasedItemsModalLabel">Purchased Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                   
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price Per Item</th>
                                <th>Price with VAT</th>
                            </tr>
                        </thead>
                        <tbody id="purchasedItemsModalBodyx">
                            <!-- Purchased items data will be loaded here dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // JavaScript code to handle click event on purchase rows
        document.addEventListener('DOMContentLoaded', function() {
            const purchaseRows = document.querySelectorAll('#purchasesTable tbody tr');
            purchaseRows.forEach(row => {
                row.addEventListener('click', () => {
                    const purchaseId = row.dataset.purchaseId;
                    fetchPurchasedItems(purchaseId);
                });
            });

            function fetchPurchasedItems(purchaseId) {
                // Make an AJAX request to fetch purchased items data using the purchaseId
                fetch(`/customer/purchased-items/${purchaseId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate the purchased items data into the modal
                        const purchasedItemsModalBody = document.getElementById('purchasedItemsModalBody');
                        purchasedItemsModalBody.innerHTML = '';
                        data.forEach(item => {
                            const row = `
                                <tr>
                                    <td>${item.id}</td>
                                    <td>${item.item_barcode}</td>
                                    <td>${item.item_name}</td>
                                    <td>${item.quantity}</td>
                                    <td>${item.price_per_unit}</td>
                                    <td>${item.total_pricewithvat}</td>
                                </tr>
                            `;
                            purchasedItemsModalBody.insertAdjacentHTML('beforeend', row);
                        });

                        // Show the modal
                        // $('#purchasedItemsModal').modal('show');
                    })
                    .catch(error => console.error(error));
            }
        });
    </script>
@endsection

