<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Imports extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'imports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['f_enr_vir_term_id',
                            'cde_bto_acct_nbr',
                            'nme_bto_acct_name',
                            'nme_bto_acct_adr',
                            'nme_bto_acct_cty',
                            'cde_bto_acct_postal_code',
                            'dsc_bto_acct_country',
                            'cde_tid_nbr',
                            'cde_sto_acct_nbr',
                            'nme_sto_acct_name',
                            'nme_sto_acct_adr',
                            'nme_sto_acct_cty',
                            'cde_sto_acct_postal_code',
                            'dsc_sto_acct_country',
                            'transaction_date_time',
                            'f_enr_tra_tx_amt_eur',
                            'f_enr_avh_card_pan_id1',
                            'transaction_date',
                            'terminal_period',
                            'curr_currency_desc',
                            'terminal_id',
                            'site_number',
                            'onus_brand_name',
                            'onus_trx_date_trunc',
                            'cde_party_nb',
                            'nme_party_name',
                            'term_bank_account',
                            'f_enr_tra_free_ref',
                            'f_enr_tra_tx_cancel_amt_eur',
                            'f_enr_tra_tx_cancel_flag',
                            'cde_tid_status'
                        ];

    public function generateReports($id, $isAdmin, $date = false) {
        if($isAdmin && !$date) {
            $terminals = $this->getTerminals($id);
            $rawReports = $this->getReports($terminals);
        } else {
            $date = $isAdmin ? $date : $this->calculateReportDefaultDate();
            $terminals = $this->getTerminalsWithDate($id, $date);
            $rawReports = $this->getReports($terminals, $date);
        }

        $reports = [];

        if(!empty($rawReports)) {
            foreach($rawReports as $rawReport) {
                foreach($rawReport as $value) {
                    $reports[] = $value;
                }
            }
        }

        return $reports;
    }

    public function generateSummary($id, $isAdmin, $date = false) {
        if($isAdmin && !$date) {
            $terminals = $this->getTerminals($id);
        } else {
            $date = $isAdmin ? $date : $this->calculateReportDefaultDate();
            $terminals = $this->getTerminalsWithDate($id, $date);
        }

        $results = [];
        $summary = [];
        foreach($terminals as $terminal) {
            $query = $this
                ->select(\DB::raw('COUNT(*) as transactions, SUM(f_enr_tra_tx_amt_eur) as sum_trans, transaction_date'))
                ->where('terminal_id', '=', $terminal->terminal_id)
                ->whereBetween('transaction_date_time', ($date ? $date : [$terminal->from, $terminal->to]))
                ->groupBy('transaction_date')
                ->get();

            if(!$query->isEmpty()) {
                $results[] = $query;
            }
        }

        if(!empty($results)) {
            foreach($results as $result) {
                foreach($result as $value) {
                    $summary[] = $value;
                }
            }
        }

        return $summary;
    }

    public function generateTotal($id, $isAdmin, $date = false) {
        if($isAdmin && !$date) {
            $terminals = $this->getTerminals($id);
        } else {
            $date = $isAdmin ? $date : $this->calculateReportDefaultDate();
            $terminals = $this->getTerminalsWithDate($id, $date);
        }

        $results = [];
        foreach($terminals as $terminal) {
            $query = $this
                ->select(\DB::raw('COUNT(*) as transactions, SUM(f_enr_tra_tx_amt_eur) as sum_trans'))
                ->where('terminal_id', '=', $terminal->terminal_id)
                ->whereBetween('transaction_date_time', ($date ? $date : [$terminal->from, $terminal->to]))
                ->get();

            if(!$query->isEmpty()) {
                $results[] = $query;
            }
        }

        $totalTransactions = 0;
        $totalAmount = 0;
        $total = [];
        if(!empty($results)) {
            foreach($results as $result) {
                foreach($result as $value) {
                    $totalTransactions += $value->transactions;
                    $totalAmount += (float)$value->sum_trans;
                    $total = ['totalTransactions' => $totalTransactions, 'totalAmount' => $totalAmount];
                }
            }
        }

        return $total;
    }

    protected function getTerminals($id) {
        $terminals = \DB::table('user_terminals')
            ->where('user_id', $id)
            ->get();

        return $terminals;
    }

    protected function getTerminalsWithDate($id, $date) {
        $terminals = \DB::table('user_terminals')
            ->where('user_id', $id)
            ->where('from', '>=', $date[0])
            ->where('to', '<', $date[1])
            ->get();

        return $terminals;
    }

    protected function getReports($terminals, $date = false) {
        $reports = [];
        foreach($terminals as $terminal) {
            $results = $this
                ->where('terminal_id', '=', $terminal->terminal_id)
                ->whereBetween('transaction_date_time', ($date ? $date : [$terminal->from, $terminal->to]))
                ->get();

            if(!$results->isEmpty()) {
                $reports[] = $results;
            }
        }

        return $reports;
    }

    protected function calculateReportDefaultDate() {
        $currentDay = date('w', time());
        $previousWeek = $currentDay > 1 ? '1' : '2' ;

        $week = date("W", strtotime("-{$previousWeek} week"));
        $week = '12';
        $year = date('Y', time());

        $timestamp = mktime( 0, 0, 0, 1, 1,  $year ) + ( $week * 7 * 24 * 60 * 60 );
        $timestampForStartDate = $timestamp - 86400 * ( date( 'N', $timestamp ) - 2);
        $startDate = date( 'Y-m-d', $timestampForStartDate );

        $endDate = date('Y-m-d', strtotime(date("Y-m-d", strtotime($startDate)) . " +1 week"));

        $defaultReportDate = [$startDate, $endDate];
        //$defaultReportDate = ['2015-03-24', '2015-03-31'];
        dump($defaultReportDate);
        return $defaultReportDate;
    }

}
