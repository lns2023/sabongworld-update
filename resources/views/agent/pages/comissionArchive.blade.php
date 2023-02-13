@extends('layouts.appAgent')
@section('content')
    @include('layouts.agentNavbars.headers.cardsComissionArchive')
    {{-- {{dd(url()->full())}} --}}
    <div class="container-fluid mt--7">
        <div class="container-fluid mt--6">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="row">

                                {{--<div class="col-sm-12 col-md-12">
                                    <div class="col-sm-12">
                                        <form class="form-inline float-right">
                                            <div class="form-group">
                                                <label for="example-date-input" class="form-control-label">{{__('Date From')}}
                                                    &nbsp;</label>
                                                <input class="form-control" type="date" id="date-from"
                                                    placeholder="Date from">
                                            </div>
                                            <div class="form-group">
                                                <label for="example-date-input" class="form-control-label">{{__('Date To')}}
                                                    &nbsp;</label>
                                                <input class="form-control" type="date" id="date-to"
                                                    placeholder="Date to">&nbsp;
                                            </div>
                                            <div class="form-group mr-2">&nbsp; <button class="btn btn-outline-primary"
                                                    style="z-index: 0;" onclick="search()" type="button"
                                                    id="button-addon2"><i class="fa fa-search"></i> {{__('Search')}}</button></div>
                                            <div class="form-group mr-2"> <a class="btn btn-outline-danger"
                                                    style="z-index: 0;" href="{{ url()->current() }}"
                                                    id="button-addon2"><i class="fa fa-ban"></i> {{__('Clear')}}</a></div>
                                        </form>
                                    </div>
                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card card-stats">
                                        <div class="card-header"><i class="fa fa-money-bill"></i> {{__('AGENT INCOME')}}
                                            <div class="card-header-actions float-right">
                                                <div role="group" class="btn-group">
                                                    <div role="group" class="btn-group">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-responsive table-bordered mb-0" id="example">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>User Type</th> --}}
                                                        <th>{{__('Date')}}</th>
                                                        <th>{{__('From')}}</th>
                                                        <th>{{__('To')}}</th>
                                                        <th>{{__('Amount')}}</th>
                                                        <th>{{__('Transaction Type')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($comission_logs as $comission_log)
                                                        <tr>
                                                            {{-- <td>{{ @$comission_log->from->user_level }}</td> --}}
                                                            <td>{{ @date_format($comission_log->created_at, 'F d, Y') }}
                                                            </td>
                                                            <td>{{ @$comission_log->from->name }}</td>
                                                            <td>{{ @$comission_log->to->name }}</td>
                                                            <td>{{ number_format(@$comission_log->amount, 2, '.', ',') }}
                                                            </td>
                                                            <td>{{ @strtoupper($comission_log->transaction_type) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{-- <nav aria-label="Page navigation example" class="mt-3 "
                                                style="overflow-y: hidden; overflow-x: scroll">
                                                <ul class="pagination">
                                                    <li class="page-item {{ $current_page == 1 ? 'disabled ' : '' }}">
                                                        <a class="page-link" onclick="search('{{ $current_page - 1 }}')"
                                                            aria-label="Previous">
                                                            <i class="fas fa-angle-left"></i>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    @for ($i = 1; $i <= $total_page; $i++)
                                                        <li class="page-item {{ $current_page == $i ? 'active' : '' }}">
                                                            <button class="page-link"
                                                                onclick="search('{{ $i }}')">

                                                                {{ $i }}</button>
                                                    @endfor
                                                    <li
                                                        class="page-item {{ $current_page == $total_page ? 'disabled' : '' }}">
                                                        <button class="page-link"
                                                            onclick="search('{{ $current_page + 1 }}')"
                                                            aria-label="Next">
                                                            <i class="fas fa-angle-right"></i>
                                                            <span class="sr-only">Next</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </nav> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    @endsection

    <script>

        const parseParams = (querystring) => {

            // parse query string
            const params = new URLSearchParams(querystring);

            const obj = {};

            // iterate over all keys
            for (const key of params.keys()) {
                if (params.getAll(key).length > 1) {
                    obj[key] = params.getAll(key);
                } else {
                    obj[key] = params.get(key);
                }
            }

            return obj;
        };

        function search(page = 1) {
            // create new URL object
            let dateTo = document.getElementById('date-to').value;
            let dateFrom = document.getElementById('date-from').value;
            //    const url = new URL('{{ url()->full() }}');
            //     let link = parseParams(url.search)
            var search = location.search.substring(1);
            let link = {};
            let params = {};
            if (search) {
                link = JSON.parse('{"' + search.replace(/&/g, '","').replace(/=/g, '":"') + '"}', function(key, value) {
                    return key === "" ? value : decodeURIComponent(value)
                })
                console.log(link);
            }
            params = {
                page: page ? page : "1",
                date_to: dateTo != '' ? dateTo : (link.date_to ? link.date_to : ''),
                date_from: dateFrom != '' ? dateFrom : (link.date_from ? link.date_from : ''),
            }

            let seachParams = $.param(params)
            console.log(seachParams);
            window.location.href = `{{ url()->current() }}?${seachParams}`;
        }

    </script>
    @push('js')

    @endpush
</div>
