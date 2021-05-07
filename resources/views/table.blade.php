@extends('layout.app')

@section('content')
    <div class="container">
        <div class="text-center">
                <form id="sort" method="get" action="{{route('table')}}">
                    <div class="row g-3">
                        <input type="hidden" id="order" name="order" value="@isset($orderFieldValue) {{$orderFieldValue}} @endisset">
                        <input type="hidden" id="direction" name="direction" value="@isset($orderFieldDirection) {{$orderFieldDirection}} @endisset">
                        <div class="col-auto">
                            <label for="search" class="col-form-label">Search</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="search" name="search" class="form-control" value="@isset($searchFieldValue) {{$searchFieldValue}} @endisset">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('table')}}"><i class="fas fa-sync"></i></a>
                        </div>
                    </div>
                </form>
            <table id="example" class="table table-hover">
                <thead>
                <tr>
                    @include('tables.tableTop')
                </tr>
                </thead>
                <tbody>
                @forelse($data as $d)
                    @include('tables.tableBottom', ['d' => $d])
                @empty
                    @include('tables.tableEmpty')
                @endforelse
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    {{ $data->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#makeUp').click(function (event){
            event.preventDefault();
            $('#order').val(1);
            $('#direction').val("asc");
            $('#sort').submit();
        });
        $('#makeDown').click(function (event){
            event.preventDefault();
            $('#order').val(1);
            $('#direction').val("desc");
            $('#sort').submit();
        });
        $('#yearUp').click(function (event){
            event.preventDefault();
            $('#order').val(2);
            $('#direction').val("asc");
            $('#sort').submit();
        });
        $('#yearDown').click(function (event){
            event.preventDefault();
            $('#order').val(2);
            $('#direction').val("desc");
            $('#sort').submit();
        });
        $('#nameSurnameUp').click(function (event){
            event.preventDefault();
            $('#order').val(3);
            $('#direction').val("asc");
            $('#sort').submit();
        });
        $('#nameSurnameDown').click(function (event){
            event.preventDefault();
            $('#order').val(3);
            $('#direction').val("desc");
            $('#sort').submit();
        });
        $('#ownerCountUp').click(function (event){
            event.preventDefault();
            $('#order').val(4);
            $('#direction').val("asc");
            $('#sort').submit();
        });
        $('#ownerCountDown').click(function (event){
            event.preventDefault();
            $('#order').val(4);
            $('#direction').val("desc");
            $('#sort').submit();
        });
    </script>
@endsection
