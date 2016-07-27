@extends('app')

@section('content')
    <!-- Default box -->
    @if(!empty($reports))
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Transaction Summary</h3>
            </div><!-- /.box-header -->
            <div class="box-body">

                <table id="list_user_summary_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Transaction Date</th>
                            <th>Number of Transactions</th>
                            <th>Total Payment Amount (EUR)</th>
                            <th>Cost 0.30€ / trx</th>
                            <th>Net</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>TOTAL</td>
                            <td>{{ $total['totalTransactions'] }}</td>
                            <td>{{ number_format((float) $total['totalAmount'], 2) }}</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </tfoot>
                    <tbody>
                    @foreach($summary as $sum)
                        <tr>
                            <td>{{ Carbon::parse($sum->transaction_date)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $sum->transactions }}</td>
                            <td>{{ number_format((float) $sum->sum_trans, 2) }}</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div><!-- /.box-body -->

        </div><!-- /.box -->

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Transaction Details</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="list_user_reports_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Transaction Date Time</th>
                            <th>Terminal ID</th>
                            <th>Transaction Amount</th>
                            <th>Card Brand</th>
                            <th>Card Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{ Carbon::parse($report->transaction_date_time)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $report->terminal_id }}</td>
                            <td>{{ number_format((float) $report->f_enr_tra_tx_amt_eur, 2) }}</td>
                            <td>{{ $report->onus_brand_name }}</td>
                            <td>{{ $report->f_enr_avh_card_pan_id1 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    @else
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Transaction</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <p>No summary / details to display!</p>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    @endif
@endsection
