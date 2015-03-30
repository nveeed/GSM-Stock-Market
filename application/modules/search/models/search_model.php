<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Search_model extends MY_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table = 'search';

    }

    function search($terms, $start = 0, $results_per_page = 0)
    {
        if ($results_per_page > 0) {
            $limit = "LIMIT $start, $results_per_page";
        } else {
            $limit = '';
        }

        // Execute our SQL statement and return the result
        $sql = "SELECT url, name, main_content
                        FROM pages
                        WHERE MATCH (main_content) AGAINST (?) > 0
                        $limit";
        $query = $this->db->query($sql, array($terms, $terms));
        return $query->result();
    }


    function searchCompanies($terms, $b_sector, $countries, $region, $continent, $orderBy, $start = 0, $results_per_page = 0, $user)
    {
        if ($results_per_page > 0) {
            $limit = "LIMIT $start, $results_per_page";
        } else {
            $limit = '';
        }

        $sql = "SELECT c.id,c.admin_member_id, c.company_name, cnt.country, c.company_profile,m.email, ms.membership, c.admin_member_id, c.business_sector_1, c.business_sector_2, c.business_sector_3,
other_business,
                        COALESCE ((SELECT SUM(feedback_score) FROM feedback as f WHERE f.member_id = m.id AND authorised = 'yes'),0)  as rating
                        FROM company as c
                        INNER JOIN members as m
                        ON m.id = c.admin_member_id
                        INNER JOIN
                        membership as ms
                        ON m.membership = ms.id
                         INNER JOIN country as cnt
                        ON c.country = cnt.id
                        INNER JOIN
                        login as l
                        ON m.id = l.member_id
                        WHERE c.company_name LIKE ?
                        AND
                        (c.business_sector_1 LIKE ? OR c.business_sector_2 LIKE ? OR c.business_sector_3 LIKE ? OR other_business LIKE ?)
                        AND cnt.id LIKE ?
                        AND cnt.region LIKE ?
                         AND cnt.continent LIKE ?
                         AND m.id <> ?
                        GROUP BY l.member_id
                        ORDER BY (c.business_sector_1 LIKE ?) DESC, (c.business_sector_2 LIKE ?) DESC, (c.business_sector_3 LIKE ?) DESC, (c.other_business LIKE ?) DESC $orderBy
                        $limit";
        $query = $this->db->query($sql, array("%".$terms."%", $b_sector, $b_sector, $b_sector, "%".$b_sector."%", $countries, $region, $continent, $user, $b_sector, $b_sector, $b_sector, $b_sector));

        return $query->result();
    }

    function companiesCount($terms, $b_sector,  $countries, $region, $continent)
    {

        $sql = "SELECT COUNT(*) as count FROM company as c
                        INNER JOIN members as m
                        ON m.id = c.admin_member_id
                        INNER JOIN
                        membership as ms
                        ON m.membership = ms.id
                         INNER JOIN country as cnt
                        ON c.country = cnt.id
                        INNER JOIN
                        login as l
                        ON m.id = l.member_id
                        WHERE c.company_name LIKE ?
                        AND
                        (c.business_sector_1 LIKE ? OR c.business_sector_2 LIKE ? OR c.business_sector_3 LIKE ?  OR other_business LIKE ?) AND cnt.id LIKE ?
                        AND cnt.region LIKE ?
                         AND cnt.continent LIKE ?";
        $query = $this->db->query($sql, array("%".$terms."%", $b_sector, $b_sector, $b_sector, "%".$b_sector."%", $countries, $region, $continent));
        return $query->row()->count;
    }

    function search_email($category)
    {
        $q = $this->input->post('search');

        if ($category == 'sent') {

            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND member_id = '" . $this->session->userdata('members_id') . "') OR (body LIKE '%$q%' AND $category = 'yes' AND member_id = '" . $this->session->userdata('members_id') . "') OR (sent_member_name LIKE '%$q%' AND $category = 'yes' AND member_id = '" . $this->session->userdata('members_id') . "') ORDER BY datetime DESC";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

            } else {
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;

        } elseif ($category == 'important') {

            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND important_belong = '" . $this->session->userdata('members_id') . "') OR (body LIKE '%$q%' AND $category = 'yes' AND important_belong = '" . $this->session->userdata('members_id') . "') OR (member_name LIKE '%$q%' AND $category = 'yes' AND important_belong = '" . $this->session->userdata('members_id') . "') ORDER BY datetime DESC";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

            } else {
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        } elseif ($category == 'archive') {

            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND archive_belong = '" . $this->session->userdata('members_id') . "') OR (body LIKE '%$q%' AND $category = 'yes' AND archive_belong = '" . $this->session->userdata('members_id') . "') OR (member_name LIKE '%$q%' AND $category = 'yes' AND archive_belong = '" . $this->session->userdata('members_id') . "') ORDER BY datetime DESC";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

            } else {
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        } elseif ($category == 'draft') {

            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND member_id = '" . $this->session->userdata('members_id') . "') OR (body LIKE '%$q%' AND $category = 'yes' AND member_id = '" . $this->session->userdata('members_id') . "') OR (sent_member_name LIKE '%$q%' AND $category = 'yes' AND member_id = '" . $this->session->userdata('members_id') . "') ORDER BY datetime DESC";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

            } else {
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        } elseif ($category == 'trash') {

            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND trash_belong = '" . $this->session->userdata('members_id') . "') OR (body LIKE '%$q%' AND $category = 'yes' AND trash_belong = '" . $this->session->userdata('members_id') . "') OR (member_name LIKE '%$q%' AND $category = 'yes' AND trash_belong = '" . $this->session->userdata('members_id') . "') ORDER BY datetime DESC";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

            } else {
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        } elseif ($category == 'member' || $category == 'market' || $category == 'support') {

            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '" . $this->session->userdata('members_id') . "' AND sent_from = '" . $category . "') OR (body LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '" . $this->session->userdata('members_id') . "' AND sent_from = '" . $category . "') OR (member_name LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '" . $this->session->userdata('members_id') . "' AND sent_from = '" . $category . "') ORDER BY datetime DESC";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

            } else {
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        } else {

            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '" . $this->session->userdata('members_id') . "') OR (body LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '" . $this->session->userdata('members_id') . "') OR (member_name LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '" . $this->session->userdata('members_id') . "') ORDER BY datetime DESC";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

            } else {
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        }

//        $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND member_id = '".$this->session->userdata('members_id')."') OR (body LIKE '%$q%' AND $category = 'yes' AND member_id = '".$this->session->userdata('members_id')."')";
//        $query = $this->db->query($sql);
//        
//            if($query->num_rows() > 0){
//
//              foreach ($query->result() as $row)
//               {
//                       $data[] = $row;
//               }
//
//            }
//            else{
//                $data = 'NO RESULTS WERE FOUND!';
//            }
//            //echo json_encode($data);
//            return $data;
    }

    function count_search_results($terms)
    {
        // Run SQL to count the total number of search results
        $sql = "SELECT COUNT(*) AS count
                           FROM pages
                           WHERE MATCH (main_content) AGAINST (?)";
        $query = $this->db->query($sql, array($terms));
        return $query->row()->count;
    }

    function search_addressbook()
    {
        $q = $this->input->post('search');

        $this->load->model('country/country_model', 'country_model');

        $country = $this->country_model->get_where_multiple('country', $q);

        $cid = '';
        if ($country) {
            $cid = $country->id;
        }

        $sql = "SELECT DISTINCT address_member_id FROM addressbook WHERE (individual LIKE '%$q%' AND member_id = '" . $this->session->userdata('members_id') . "') OR (company LIKE '%$q%') OR (business_activities LIKE '%$q%' AND member_id = '" . $this->session->userdata('members_id') . "')";

        if (is_numeric($cid)) {
            $sql .= "OR (country = '" . $cid . "' AND member_id = '" . $this->session->userdata('members_id') . "')";
        }

        $sql .= " ORDER BY date DESC";

        $query = $this->db->query($sql);

        //echo '<pre>';
        //print_r($query);
        //echo $query->num_rows();
        //exit;

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {
                $data[] = $row;
            }

        } else {
            $data = 'No results found';
        }
        //echo json_encode($data);
        return $data;

    }
}

