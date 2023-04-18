@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ORDER MASUK</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="vorder container-fluid">

        </div>
        <!-- Modal -->
        <div class="modal fade" id="detailorder" tabindex="-1" aria-labelledby="detailorder" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="vdetail_order">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        $(document).ready(function() {
            ambildataorderan()
        });

        function ambildataorderan() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambildataorderan') ?>',
                    success: function(response) {
                        spinner.hide();
                        $('.vorder').html(response);
                    }
                });
            }
    </script>
@endsection
