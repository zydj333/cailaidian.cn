<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_image_model
 *
 * @createtime 2014-10-22 14:30:53
 *
 * @author ZhangPing'an
 *
 * @todo the file use for?
 *
 *
 *
 */
class admin_image_model extends CI_Model {

    /**
     *
     * @todo 保存图片信息
     *
     * @param 要保存的信息
     *
     * @return 返回一个int类型的整数
     *
     */
    function saveImg($data) {
        $this->db->insert('db_image', $data);
        return $this->db->insert_id();
    }

}

?>
