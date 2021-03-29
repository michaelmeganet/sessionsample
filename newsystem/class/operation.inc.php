<?php

Class OPERATION {

    Protected $opid;
    Protected $opname;

    function __construct($opid) {
        $this->opid = $opid;
        $this->opname = $this->parse_operationName($opid);
    }

    function parse_operationName($opid) {
        switch ($opid) {
            case '1':
                $opname = 'CJ';
                break;
            case '2':
                $opname = 'PU';
                break;
            case '4':
                $opname = 'CJ-PU';
                break;
            default:
                $opname = 'NONE';
                break;
        }
        return $opname;
    }

    function get_opid() {
        return $this->opid;
    }

    Protected function set_opid($input) {
        $this->opid = $input;
    }

    function get_opname() {
        return $this->opname;
    }

    Protected function set_opname($input) {
        $this->opname = $input;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

