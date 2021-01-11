<?php

/* SOURCE CODES FOR SQL */

class Main_model extends CI_Model {
    /* QUERY FOR USER LOGIN */

    function can_login($username, $password) {
        /* SELECT * FROM users WHERE username='$username' ANBD password = '$password' */

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $row = $query->row();
        $data = array();
        if (!empty($row)) {
            $hash = $row->password;
            if (password_verify($password, $hash)) {
                $data['nameofuser'] = $row->fname . " " . $row->lname;
                $data['sessionid'] = $row->userid;
                $data['usertype'] = $row->usertype;
                $data['ppa_signature'] = $row->signature;
                $data['pp'] = $row->pp;
                $this->session->set_userdata($data);            // SET SESSION FOR THE NAME OF USER AND SESSION ID BASED ON DATABASE USER ID COLUMN
                return true;
            } else {
                return false;
            }
        }
    }

    /* QUERY FOR USER INFORMATION */

    function user_info($userid) {
        /* SELECT * FROM users WHERE userid = '$userid' */
        $this->db->where('userid', $userid);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    /* QUERY FOR GETTING ALL USERS IN DATABASE  */

    function get_clients() {
        /* SELECT * FROM users WHERE users='client' */
        $this->db->where('usertype', 'client');
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    /* QUERY TO GET ALL VESSEL NAMES FROM vessel_details DATABASE */

    function vessel_names() {
        /* SELECT * FROM vessel_details order by vesselid DESC */
        //  $this->db->group_by('vesselname');
        $this->db->order_by('vesselid', 'DESC');
        $query = $this->db->get('vessel_details');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO GET ALL VESSEL NAMES FROM vessel_details DATABASE GROUP BY vesselname */

    function group_vessels() {
        $this->db->group_by('vesselname');
        $this->db->order_by('vesselid', 'DESC');
        $query = $this->db->get('vessel_details');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO GET VESSEL PARTICULARS USING SCN */

    // function getparticulars($voyageno, $vesselname) {
    function getparticulars($vesselname) {
        /* SELECT * FROM vessel_details WHERE vesselname=$vesselname */
        //    $this->db->where("voyageno", $voyageno);
        $this->db->where("vesselname", $vesselname);
        $this->db->limit(1);
        $query = $this->db->get('vessel_details');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO GET SPECIFIC DATA FROM VESSEL DETAILS */

    function view_details($vesselid) {
        /* SELECT * FROM vessel_details WHERE vesselid=$vesselid */
        $this->db->where("vesselid", $vesselid);
        $query = $this->db->get('vessel_details');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO INSERT DATA TO vessel_details DATABASE */

    function save_vessel($data) {
        $this->db->where("scn", $data['scn']);
        $query = $this->db->get('vessel_details');
        if ($query->num_rows() == 0) {
            $result = $this->db->insert('vessel_details', $data);
            return true;
        } else {
            return false;
        }
    }

    /* QUERY TO UPDATE THE SPECIFIC DATA FROM THE vessel_details DATABASE BASED ON THE DATABASE vesselid COLUMN */

    function update_details($data, $vesselid) {
        $this->db->set('scn', $data['scn']);
        $this->db->set('vesselcode', $data['vesselcode']);
        $this->db->set('vesselname', $data['vesselname']);
        $this->db->set('voyageno', $data['voyageno']);
        $this->db->set('grt', $data['grt']);
        $this->db->set('nrt', $data['nrt']);
        $this->db->set('dwt', $data['dwt']);
        $this->db->set('beam', $data['beam']);
        $this->db->set('loa', $data['loa']);
        $this->db->set('draft', $data['draft']);
        $this->db->where('vesselid', $vesselid);
        if ($this->db->update('vessel_details')) {
            return true;
        } else {
            return false;
        }
    }

    /* QUERY TO GET ALL VESSEL TRANSACTIONS FROM vessel_transaction DATABASE */

    function vessel_transactions() {
        /* SELECT * FROM 
          vessel_transaction vt
          LEFT JOIN vessel_details vd ON vd.`vesselid` = vt.`vesselid`
          LEFT JOIN users uc ON vt.`client_signature` = uc.`userid`
          LEFT JOIN users up ON vt.`ppa_signature` = up.`userid`
          LEFT JOIN users ac ON vt.`client_addstaysign` = ac.`userid`
          LEFT JOIN users ap ON vt.`ppa_addstaysign` = ap.`userid`
          ORDER BY vt.`id` DESC */
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get('vessel_transaction vt');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO COUNT ALL TRANSACTIONS FOR BASEPORT OR PRIVATEPORTS FROM THE vessel_transcations  function get_transactions($typeofport){
      $this->db->select('COUNT(*) as count_transaction');
      $this->db->from('vessel_transaction vt');
      $this->db->where('vt.`typeofport`', $typeofport);
      $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
      $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
      $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
      $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
      $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
      return $query->result();
      } else {
      return false;
      }
      } */

    /* QUERY TO DISPLAY ALL THE DATA FOR BASEPORT OR PRIVATEPORTS FROM THE vessel_transaction DATABASE IN A DESCENDING ORDER */

    function display_transactions($typeofport) {
        /* SELECT 
          vt.id,
          vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
          vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
          vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
          vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
          vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
          uc.`signature` AS client_signature,
          up.`signature` AS ppa_signature,
          vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
          ac.`signature` AS client_addstaysign,
          ap.`signature` AS ppa_addstaysign
          FROM
          vessel_transaction vt
          LEFT JOIN vessel_details vd ON vd.`vesselid` = vt.`vesselid`
          LEFT JOIN users uc ON vt.`client_signature` = uc.`userid`
          LEFT JOIN users up ON vt.`ppa_signature` = up.`userid`
          LEFT JOIN users ac ON vt.`client_addstaysign` = ac.`userid`
          LEFT JOIN users ap ON vt.`ppa_addstaysign` = ap.`userid`
          WHERE typeofport = $typeofport
          ORDER BY vt.`id` DESC */

        $this->db->select('vt.id,
          vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
          vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
          vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
          vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
          vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
          uc.`signature` AS client_signature,
          up.`signature` AS ppa_signature,
          vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
          ac.`signature` AS client_addstaysign,
          ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO DISPLAY THE SPECIFIC DATA FROM THE vessel_transaction DATABASE BASED ON THE DATABASE vesselid COLUMN FOR UPDATING DBASE */

    function display_spectransac($id, $typeofport) {
        /* SELECT 
          vt.id,
          vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
          vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
          vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
          vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
          vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
          uc.`userid` AS client_id, uc.`signature` AS client_signature,
          up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
          vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
          ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
          ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign
          FROM
          vessel_transaction vt
          LEFT JOIN vessel_details vd ON vd.`vesselid` = vt.`vesselid`
          LEFT JOIN users uc ON vt.`client_signature` = uc.`userid`
          LEFT JOIN users up ON vt.`ppa_signature` = up.`userid`
          LEFT JOIN users ac ON vt.`client_addstaysign` = ac.`userid`
          LEFT JOIN users ap ON vt.`ppa_addstaysign` = ap.`userid`
          WHERE vt.`vesselid` = $vesselid
          ORDER BY vt.`id` DESC */
        $this->db->select('vt.id,
          vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
          vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
          vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
          vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
          vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
          uc.`userid` AS client_id, uc.`signature` AS client_signature,
          up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
          vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
          ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
          ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`id`', $id);
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO DISPLAY ALL DATA BASED ON MOVEMENT OF VESSEL (ANCHORAGE/BERTH) */

    function view_typeofmovement($typeofport, $typeofmovement) {
        /* SELECT 
          vt.id,
          vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
          vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
          vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
          vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
          vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
          uc.`userid` AS client_id, uc.`signature` AS client_signature,
          up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
          vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
          ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
          ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign
          FROM
          vessel_transaction vt
          LEFT JOIN vessel_details vd ON vd.`vesselid` = vt.`vesselid`
          LEFT JOIN users uc ON vt.`client_signature` = uc.`userid`
          LEFT JOIN users up ON vt.`ppa_signature` = up.`userid`
          LEFT JOIN users ac ON vt.`client_addstaysign` = ac.`userid`
          LEFT JOIN users ap ON vt.`ppa_addstaysign` = ap.`userid`
          WHERE
         * FOR ANCHORAGE *
          vt.`anchor_ata` IS NOT NULL
          OR vt.`anchor_atd` IS NULL
         * FOR BERTH * 
          OR vt.`berth_ata` IS NOT NULL
          OR vt.`berth_etd` IS NOT NULL
          OR vt.`berth_atd` IS NOT NULL
          AND vt.`typeofport` = $typeofport
          ORDER BY vt.`id` DESC */

        $this->db->select('vt.id,
          vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
          vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
          vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
          vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
          vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
          uc.`userid` AS client_id, uc.`signature` AS client_signature,
          up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
          vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
          ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
          ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        if ($typeofmovement == "anchorage") {
            $this->db->where('vt.`anchor_ata` IS NOT NULL AND vt.`anchor_atd` IS NULL');
        } else if ($typeofmovement == "berth") {
            $this->db->where('vt.`berth_ata` IS NOT NULL AND vt.`berth_etd` IS NOT NULL AND vt.`berth_atd` IS NULL ');
        }
        $this->db->where('vt.`status`', 'pending');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO SPECIFIC DATA BASED ON MOVEMENT OF VESSEL (ANCHORAGE/BERTH) AND ATA */

    function view_ata($typeofport, $typeofmovement, $ata) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        if ($typeofmovement == "anchorage") {
            $this->db->where('STR_TO_DATE(anchor_ata, "%Y-%m-%d") =', $ata);
        } else if ($typeofmovement == "berth") {
            $this->db->where('STR_TO_DATE(berth_ata, "%Y-%m-%d") =', $ata);
        }
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO SPECIFIC DATA BASED ON MOVEMENT OF VESSEL (ANCHORAGE/BERTH) AND ETD */

    function view_etd($typeofport, $typeofmovement, $etd) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        if ($typeofmovement == "berth") {
            $this->db->where('STR_TO_DATE(berth_etd, "%Y-%m-%d") =', $etd);
        }
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO SPECIFIC DATA BASED ON MOVEMENT OF VESSEL (ANCHORAGE/BERTH) AND ATD */

    function view_atd($typeofport, $typeofmovement, $atd) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        if ($typeofmovement == "anchorage") {
            $this->db->where('STR_TO_DATE(anchor_atd, "%Y-%m-%d") =', $atd);
        } else if ($typeofmovement == "berth") {
            $this->db->where('STR_TO_DATE(berth_atd, "%Y-%m-%d") =', $atd);
        }
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function view_all($typeofport){
        /* SELECT 
          vt.id,
          vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
          vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
          vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
          vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
          vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
          uc.`signature` AS client_signature,
          up.`signature` AS ppa_signature,
          vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
          ac.`signature` AS client_addstaysign,
          ap.`signature` AS ppa_addstaysign
          FROM
          vessel_transaction vt
          LEFT JOIN vessel_details vd ON vd.`vesselid` = vt.`vesselid`
          LEFT JOIN users uc ON vt.`client_signature` = uc.`userid`
          LEFT JOIN users up ON vt.`ppa_signature` = up.`userid`
          LEFT JOIN users ac ON vt.`client_addstaysign` = ac.`userid`
          LEFT JOIN users ap ON vt.`ppa_addstaysign` = ap.`userid`
          WHERE typeofport = $typeofport
          ORDER BY vt.`id` DESC */

        $this->db->select('vt.id,
          vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
          vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
          vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
          vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
          vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
          uc.`signature` AS client_signature,
          up.`signature` AS ppa_signature,
          vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
          ac.`signature` AS client_addstaysign,
          ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    /* QUERY TO DISPLAY SPECIFIC DATA BASED ON TRANSACTION DATE */

    function view_transactiondate($typeofport, $transaction_date) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('STR_TO_DATE(vt.`transaction_date`, "%Y-%m-%d") =', $transaction_date);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO DISPLAY SPECIFIC DATA BASED ON STATUS */

    function view_status($typeofport, $status) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('vt.`status`', $status);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO DISPLAY SPECIFIC DATA BASED ON WEEK RANGE */

    function view_weekly($typeofport, $weekly_from, $weekly_to) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('STR_TO_DATE(vt.`transaction_date`, "%Y-%m-%d")>=', $weekly_from);
        $this->db->where('STR_TO_DATE(vt.`transaction_date`, "%Y-%m-%d")<=', $weekly_to);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO DISPLAY SPECIFIC DATA BASED ON SPECIFIC MONTH */

    function view_monthly($typeofport, $month, $year) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('MONTH(vt.`transaction_date`) =', $month);
        $this->db->where('YEAR(vt.`transaction_date`) =', $year);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO DISPLAY SPECIFIC DATA BASED ON SPECIFIC YEAR */

    function view_yearly($typeofport, $year) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('YEAR(vt.`transaction_date`) =', $year);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO GENERATE - DAILY REPORT */

    function report_daily($typeofport, $dailyreport) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('STR_TO_DATE(vt.`transaction_date`, "%Y-%m-%d") =', $dailyreport);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO GENERATE - WEEKLY REPORT */

    function report_weekly($typeofport, $weekly_from, $weekly_to) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('STR_TO_DATE(vt.`transaction_date`, "%Y-%m-%d")>=', $weekly_from);
        $this->db->where('STR_TO_DATE(vt.`transaction_date`, "%Y-%m-%d")<=', $weekly_to);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO GENERATE - MONTHLY REPORT */

    function report_monthly($typeofport, $month, $year) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('MONTH(vt.`transaction_date`) =', $month);
        $this->db->where('YEAR(vt.`transaction_date`) =', $year);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO GENERATE - YEARLY REPORT */

    function report_yearly($typeofport, $year) {
        $this->db->select('vt.id,
            vt.`status`,vt.`transaction_date`,vt.`transaction_id`,vd.`scn`,vd.`vesselname`,vd.`voyageno`,
            vd.`vesselid` AS vesselid, vt.`anchor_ata`,vt.`anchor_atd`,
            vt.`berth_ata`,vt.`berth_etd`,vt.`berth_atd`,
            vt.`berth_assignment`, vd.`grt`,vd.`nrt`,vd.`dwt`,vd.`beam`,vd.`loa`,vd.`draft`,
            vt.`lastport`,vt.`nextport`,vt.`passengerin`,vt.`passengerout`,vt.`ornum`,vt.`payment`,
            uc.`userid` AS client_id, uc.`signature` AS client_signature,
            up.`userid` AS ppa_id,up.`signature` AS ppa_signature,
            vt.`addnumstay`,vt.`ornum_addstay`,vt.`payment_addstay`,
            ac.`userid` AS client_idaddstay,  ac.`signature` AS client_addstaysign,
            ap.`userid` AS ppa_idaddstay,ap.`signature` AS ppa_addstaysign');
        $this->db->from('vessel_transaction vt');
        $this->db->where('vt.`typeofport`', $typeofport);
        $this->db->where('YEAR(vt.`transaction_date`) =', $year);
        $this->db->join('vessel_details vd', 'vt.vesselid = vd.vesselid', 'left');
        $this->db->join('users uc', 'vt.`client_signature` = uc.`userid`', 'left');
        $this->db->join('users up', 'vt.`ppa_signature` = up.`userid`', 'left');
        $this->db->join('users ac', 'vt.`client_addstaysign` = ac.`userid`', 'left');
        $this->db->join('users ap', 'vt.`ppa_addstaysign` = ap.`userid`', 'left');
        $this->db->order_by('vt.`id`', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO UPDATE THE SPECIFIC DATA FROM THE vessel_transaction DATABASE BASED ON THE DATABASE vesselid COLUMN */

    function update_spectransac($data, $id) {
        /* UPDATE VESSEL TRANSACTION  */
        $this->db->set('berth_assignment', $data['berth_assignment']);
        $this->db->set('transaction_date', $data['transaction_datetime']);
        $this->db->set('anchor_ata', $data['anchor_ata']);
        $this->db->set('anchor_atd', $data['anchor_atd']);
        $this->db->set('berth_ata', $data['berth_ata']);
        $this->db->set('berth_etd', $data['berth_etd']);
        $this->db->set('berth_atd', $data['berth_atd']);
        $this->db->set('lastport', $data['lastport']);
        $this->db->set('nextport', $data['nextport']);
        $this->db->set('passengerin', $data['passengerin']);
        $this->db->set('passengerout', $data['passengerout']);
        $this->db->set('ornum', $data['ornum']);
        $this->db->set('payment', $data['payment']);
        $this->db->set('ppa_signature', $data['ppa_signature']);
        $this->db->set('addnumstay', $data['addnumstay']);
        $this->db->set('ornum_addstay', $data['ornum_addstay']);
        $this->db->set('payment_addstay', $data['payment_addstay']);
        $this->db->set('ppa_addstaysign', $data['ppa_addstaysign']);
        $this->db->set('status', $data['status']);
        $this->db->where('id', $id);
        if ($this->db->update('vessel_transaction')) {
            return true;
        } else {
            return false;
        }
    }

    /* QUERY TO INSERT DATA INTO THE users DATABASE */

    function save_user($data) {
        $this->db->where("username", $data['username']);
        $this->db->where("company_id", $data['company_id']);
        $query = $this->db->get('users');
        if ($query->num_rows() == 0) {
            $result = $this->db->insert('users', $data);
            return true;
        } else {
            return false;
        }
    }

    /* QUERY TO DISPLAY ALL USER DATA FROM THE users DATABASE */

    function display_users() {
        $this->db->where('usertype = "hoo" OR usertype="client"');
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO DISPLAY SPECIFIC USER DATA */

    function display_specuser($userid) {
        $this->db->where('userid', $userid);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /* QUERY TO CHANGE USER PASSWORD */

    function update_password($userid, $newpassword) {
        /* UPDATE users SET password = '$newpassword' WHERE id='$userid' */
        $this->db->set('password', $newpassword);
        $this->db->where('userid', $userid);
        if ($this->db->update('users')) {
            return true;
        } else {
            return false;
        }
    }

    /* QUERY TO UPDATE USER INFORMATION */

    function update_info($username, $userid, $firstname, $middlename, $lastname, $company_id) {
        /* UPDATE users SET fname = '$firstname', mname = '$middlename', lname='$lastname', company_id='$company_id' WHERE id='$userid' */
        $this->db->set('username', $username);
        $this->db->set('fname', $firstname);
        $this->db->set('mname', $middlename);
        $this->db->set('lname', $lastname);
        $this->db->set('company_id', $company_id);
        $this->db->where('userid', $userid);
        if ($this->db->update('users')) {
            return true;
        } else {
            return false;
        }
    }

    /* QUERY TO UPDATE USER PROFILE PICTURE */

    function update_profilepic($userid, $profilepic) {
        /* UPDATE users SET pp = '$profilepic' WHERE id='$userid' */
        $this->db->set('pp', $profilepic);
        $this->db->where('userid', $userid);
        if ($this->db->update('users')) {
            return true;
        } else {
            return false;
        }
    }

    /* QUERY TO UPDATE USER SIGNATURE */

    function update_signature($userid, $signature) {
        /* UPDATE users SET signature = '$signature' WHERE id='$userid' */
        $this->db->set('signature', $signature);
        $this->db->where('userid', $userid);
        if ($this->db->update('users')) {
            return true;
        } else {
            return false;
        }
    }

}
