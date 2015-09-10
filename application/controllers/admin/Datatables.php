<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Datatables
 */
class Datatables extends CI_Controller
{
    const DT_INDEX_COLUMN = 'id';
    const DT_TABLE = 'datatables';
    const DT_BUTTON_VIEW = 'admin/datatables_button';

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
        $this->page_settings = $this->settings_model->get_page_settings();
    }

    /**
     * Provides data for data for datatables
     *
     */
    public function album_data()
    {
        $aInput = $this->input->get();
        $aColumns = array('name', 'date', 'place', 'hits', 'cnt', 'id');

        // limit for table
        $sLimit = $this->_prep_limit($aInput);
        $sOrder = $this->_prep_ordering($aInput,$aColumns);
        $iColumnCount = count($aColumns);
        $sWhere = $this->_prep_filtering($aInput,$aColumns,$iColumnCount);

        $aQueryColumns = array();
        foreach ($aColumns as $col) {
            if ($col != ' ') {
                $aQueryColumns[] = $col;
            }
        }

        $sQuery = "
                    SELECT SQL_CALC_FOUND_ROWS `" . implode("`, `", $aQueryColumns) . "`
                    FROM `" . self::DT_TABLE . "`" . $sWhere . $sOrder . $sLimit;

        $rResult = $this->db->query($sQuery) or die($this->db->error);

        // Data set length after filtering
        $sQuery = "SELECT FOUND_ROWS()";
        $rResultFilterTotal = $this->db->query($sQuery) or die($this->db->error);
        list($iFilteredTotal) = $rResultFilterTotal->result_array();

        // Total data set length
        $sQuery = "SELECT COUNT(`" . self::DT_INDEX_COLUMN . "`) as cnt FROM `" . self::DT_TABLE . "`";
        $rResultTotal = $this->db->query($sQuery) or die($this->db->error);
        list($iTotal) = $rResultTotal->result_array();


        /**
         * Output
         */
        $aOutput = array(
            "sEcho" => intval(@$aInput['sEcho']),
            "iTotalRecords" => $iTotal['cnt'],
            "iTotalDisplayRecords" => $iFilteredTotal['FOUND_ROWS()'],
            "aaData" => array(),
        );
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            for ($i = 0; $i < $iColumnCount; $i++) {
                if ($aColumns[$i] == 'id') {
                    $row[] = $this->generate_datalink($aRow[$aColumns[$i]]);
                } else {
                    if ($aColumns[$i] == 'date') {
                        $row[] = date('d.m.Y', strtotime(@$aRow[$aColumns[$i]]));
                    } else {
                        $row[] = @$aRow[$aColumns[$i]];
                    }
                }
            }
            $aOutput['aaData'][] = $row;
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($aOutput));
    }

    /**
     * @param array $aInput
     * @return string
     */
    private function _prep_limit($aInput)
    {
        $sLimit = "";
        if (isset($aInput['start']) && $aInput['length'] != '-1') {
            $sLimit = " LIMIT " . intval($aInput['start']) . ", " . intval($aInput['length']);
        }
        return $sLimit;
    }

    /**
     * @param $aInput
     * @param $aColumns
     * @return string
     */
    private function _prep_ordering($aInput,$aColumns)
    {
        //ordering
        $aOrderingRules = array();
        if (isset($aInput['order'])) {
            $aOrderingRules[] = "`" . $aColumns[intval($aInput['order'][0]['column'])] . "` "
                . $aInput['order'][0]['dir'];
        }

        if (!empty($aOrderingRules)) {
            return " ORDER BY " . implode(", ", $aOrderingRules);
        } else {
            return "";
        }
    }

    /**
     * @param $aInput
     * @param $aColumns
     * @param $iColumnCount
     * @return string
     */
    private function _prep_filtering($aInput,$aColumns,$iColumnCount){
        if (isset($aInput['search']) && $aInput['search'] != "") {
            $aFilteringRules = array();
            for ($i = 0; $i < $iColumnCount; $i++) {
                $aFilteringRules[] = "`" . $aColumns[$i] . "` LIKE '%" . $aInput['search']['value'] . "%'";
            }
            if (!empty($aFilteringRules)) {
                $aFilteringRules = array('(' . implode(" OR ", $aFilteringRules) . ')');
            }
        }

        // user filtering by user
        if (!empty($aFilteringRules)) {
            return " WHERE " . implode(" AND ",
                    $aFilteringRules) . "AND id_user=" . $this->authentication->get_user_id();
        } else {
            return "";
        }
    }

    /**
     * Returns button html
     * @return string view for button
     */
    public function generate_datalink($id)
    {
        $this->data['id_album'] = $id;
        return $this->load->view(self::DT_BUTTON_VIEW, $this->data, true);
    }
}