@extends('layout.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <table id="example" class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Make</th>
                    <th scope="col">Year</th>
                    <th scope="col">Owner name & surname</th>
                    <th scope="col">Owners count</th>
                    <th scope="col">Comment</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ route('table') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false
                    },
                    {
                        targets: 5,
                        orderable: false
                    },
                ],
            });
        });
    </script>
@endsection
