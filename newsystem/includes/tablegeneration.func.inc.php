<?php

function checkTableExists_Origin($matTable) {
    $qr = "SHOW TABLES LIKE '$matTable'";
    $objSQL = new SQL($qr);
    $results = $objSQL->getResultOneRowArray();
    if (!empty($results)) {
        return 'YES';
    } else {
        return 'NO';
    }
}

//list of table needed :

/* Quotation
  quono_list v
  quotationnew_pst v
  quotationnew_delete_pst v
  quotation_remark v
 * 
 */

function generate_quonolist($period) {
    $tab = "quono_list";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `bid` INT(10) UNSIGNED NOT NULL,
                `currency` INT(10) NOT NULL,
                `quono` VARCHAR(20) NOT NULL,
                `quotab` VARCHAR(25) NOT NULL,
                `period` VARCHAR(5) NOT NULL,
                `Shape_Code` VARCHAR(20) NULL DEFAULT '',
                `Category` VARCHAR(20) NULL DEFAULT '',
                `specialShapeOrder` VARCHAR(20) NULL DEFAULT NULL,
                `tabletype` VARCHAR(20) NULL DEFAULT '',
                `company` VARCHAR(10) NOT NULL,
                `cusstatus` VARCHAR(10) NOT NULL,
                `custype` VARCHAR(15) NOT NULL,
                `pagetype` VARCHAR(15) NOT NULL,
                `cid` INT(10) UNSIGNED NOT NULL,
                `accno` VARCHAR(8) NULL DEFAULT NULL,
                `date` DATE NOT NULL,
                `terms` VARCHAR(30) NOT NULL,
                `item` INT(11) NOT NULL DEFAULT '0',
                `quantity` INT(10) NOT NULL,
                `grade` VARCHAR(30) NOT NULL,
                `mdt` VARCHAR(15) NULL DEFAULT NULL,
                `mdw` VARCHAR(15) NULL DEFAULT NULL,
                `mdl` VARCHAR(15) NULL DEFAULT NULL,
                `dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                `fdt` VARCHAR(15) NULL DEFAULT NULL,
                `fdw` VARCHAR(15) NULL DEFAULT NULL,
                `fdl` VARCHAR(15) NULL DEFAULT NULL,
                `finishing_dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                `process` VARCHAR(20) NULL DEFAULT NULL,
                `mat` DECIMAL(20,2) NOT NULL,
                `pmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `cncmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `other` DECIMAL(20,2) NULL DEFAULT NULL,
                `vat` DECIMAL(20,2) NULL DEFAULT NULL,
                `gst` DECIMAL(20,2) NULL DEFAULT NULL,
                `ftz` VARCHAR(5) NULL DEFAULT NULL,
                `amountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstother` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamount` DECIMAL(20,2) NOT NULL,
                `aid_quo` INT(10) UNSIGNED NOT NULL,
                `aid_cus` INT(10) UNSIGNED NOT NULL,
                `datetimeissue` DATETIME NOT NULL,
                `volumeperunit` FLOAT UNSIGNED NOT NULL DEFAULT '0',
                `weightperunit` FLOAT UNSIGNED NOT NULL DEFAULT '0',
                `totalweight` FLOAT UNSIGNED NOT NULL DEFAULT '0',
                `density` FLOAT UNSIGNED NOT NULL DEFAULT '0',
                `priceperKG` DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT '0',
                `odissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `issued_to_quotation` VARCHAR(10) NOT NULL DEFAULT 'no',
                `rev_parent` VARCHAR(20) NULL DEFAULT NULL,
                `rev_child` VARCHAR(20) NULL DEFAULT NULL,
                PRIMARY KEY (`id`)
        )
        COLLATE='latin1_swedish_ci'
        ENGINE=InnoDB
        ;

            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

function generate_quotation($period, $com) {
    $tab = "quotationnew_{$com}_$period";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `qid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `currency` INT(10) NOT NULL,
                    `quono` VARCHAR(20) NOT NULL,
                    `Shape_Code` VARCHAR(20) NOT NULL,
                    `Category` VARCHAR(20) NOT NULL,
                    `tabletype` VARCHAR(5) NOT NULL,
                    `specialShapeOrder` VARCHAR(20) NOT NULL,
                    `company` VARCHAR(10) NOT NULL,
                    `pagetype` VARCHAR(15) NOT NULL,
                    `custype` VARCHAR(15) NULL DEFAULT NULL,
                    `cusstatus` VARCHAR(10) NULL DEFAULT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL,
                    `accno` VARCHAR(8) NULL DEFAULT NULL,
                    `date` DATE NOT NULL,
                    `terms` VARCHAR(30) NOT NULL,
                    `item` VARCHAR(5) NOT NULL,
                    `quantity` INT(10) NOT NULL,
                    `grade` VARCHAR(30) NOT NULL,
                    `mdt` VARCHAR(15) NULL DEFAULT NULL,
                    `mdw` VARCHAR(15) NULL DEFAULT NULL,
                    `mdl` VARCHAR(15) NULL DEFAULT NULL,
                    `dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                    `fdt` VARCHAR(15) NULL DEFAULT NULL,
                    `fdw` VARCHAR(15) NULL DEFAULT NULL,
                    `fdl` VARCHAR(15) NULL DEFAULT NULL,
                    `finishing_dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                    `process` VARCHAR(20) NULL DEFAULT NULL,
                    `mat` DECIMAL(20,2) NOT NULL,
                    `pmach` DECIMAL(20,2) NULL DEFAULT NULL,
                    `cncmach` DECIMAL(20,2) NULL DEFAULT NULL,
                    `other` DECIMAL(20,2) NULL DEFAULT NULL,
                    `ftz` VARCHAR(5) NULL DEFAULT NULL,
                    `amountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamount` DECIMAL(20,2) NOT NULL,
                    `aid_quo` INT(10) UNSIGNED NOT NULL,
                    `aid_cus` INT(10) UNSIGNED NOT NULL,
                    `datetimeissue` DATETIME NOT NULL,
                    `odissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `rev_parent` VARCHAR(20) NULL DEFAULT NULL,
                    `rev_child` VARCHAR(20) NULL DEFAULT NULL,
                    PRIMARY KEY (`qid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ;
            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_quotation_delete($period, $com) {
    $tab = "quotationnew_delete_{$com}_$period";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE `$quonewtab` (
                    `qdid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `qid` INT(10) UNSIGNED NOT NULL,
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `currency` INT(10) NOT NULL,
                    `quono` VARCHAR(20) NOT NULL,
                    `Shape_Code` VARCHAR(20) NOT NULL,
                    `Category` VARCHAR(20) NOT NULL,
                    `specialShapeOrder` VARCHAR(20) NOT NULL,
                    `tabletype` VARCHAR(5) NOT NULL,
                    `company` VARCHAR(10) NOT NULL,
                    `pagetype` VARCHAR(15) NOT NULL,
                    `custype` VARCHAR(15) NULL DEFAULT NULL,
                    `cusstatus` VARCHAR(10) NULL DEFAULT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL,
                    `accno` VARCHAR(8) NULL DEFAULT NULL,
                    `date` DATE NOT NULL,
                    `terms` VARCHAR(30) NOT NULL,
                    `item` VARCHAR(5) NOT NULL,
                    `quantity` INT(10) NOT NULL,
                    `grade` VARCHAR(30) NOT NULL,
                    `mdt` VARCHAR(15) NULL DEFAULT NULL,
                    `mdw` VARCHAR(15) NULL DEFAULT NULL,
                    `mdl` VARCHAR(15) NULL DEFAULT NULL,
                    `dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                    `fdt` VARCHAR(15) NULL DEFAULT NULL,
                    `fdw` VARCHAR(15) NULL DEFAULT NULL,
                    `fdl` VARCHAR(15) NULL DEFAULT NULL,
                    `finishing_dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                    `process` VARCHAR(20) NULL DEFAULT NULL,
                    `mat` DECIMAL(20,2) NOT NULL,
                    `pmach` DECIMAL(20,2) NULL DEFAULT NULL,
                    `cncmach` DECIMAL(20,2) NULL DEFAULT NULL,
                    `other` DECIMAL(20,2) NULL DEFAULT NULL,
                    `ftz` VARCHAR(5) NULL DEFAULT NULL,
                    `amountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamount` DECIMAL(20,2) NOT NULL,
                    `aid_quo` INT(10) UNSIGNED NOT NULL,
                    `aid_cus` INT(10) UNSIGNED NOT NULL,
                    `datetimeissue` DATETIME NOT NULL,
                    `odissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `rev_parent` VARCHAR(20) NULL DEFAULT NULL,
                    `rev_child` VARCHAR(20) NULL DEFAULT NULL,
                    `remarks1` VARCHAR(100) NULL DEFAULT NULL,
                    `remarks2` VARCHAR(100) NULL DEFAULT NULL,
                    `remarks3` VARCHAR(100) NULL DEFAULT NULL,
                    `remarks4` VARCHAR(100) NULL DEFAULT NULL,
                    `deleteby` INT(10) UNSIGNED NOT NULL,
                    `datetimedelete_quo` DATE NOT NULL,
                    PRIMARY KEY (`qdid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ;

                ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_quotation_remark($period, $com) {
    $tab = "quotationnew_remarks_{$com}_$period";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `quono` VARCHAR(20) NOT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL,
                    `remarks1` VARCHAR(100) NULL DEFAULT NULL,
                    `remarks2` VARCHAR(100) NULL DEFAULT NULL,
                    `remarks3` VARCHAR(100) NULL DEFAULT NULL,
                    `remarks4` VARCHAR(100) NULL DEFAULT NULL
            )
            COLLATE='utf8_general_ci'
            ENGINE=MyISAM
            ;
            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

/* Orderlist
  orderlistnew_pst v
  ordercontrolcenter v
  runningno v
  runningno_serial v
  orderlistnew_delete v
 * 
 */

function generate_orderlist($period, $com) {
    $tab = "orderlistnew_{$com}_$period";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `oid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `currency` INT(10) NOT NULL,
                    `qid` INT(10) UNSIGNED NOT NULL,
                    `quono` VARCHAR(20) NOT NULL,
                    `company` VARCHAR(10) NOT NULL,
                    `cusstatus` VARCHAR(10) NOT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL,
                    `accno` VARCHAR(8) NOT NULL,
                    `date` DATE NOT NULL,
                    `terms` VARCHAR(30) NOT NULL,
                    `noposition` INT(10) UNSIGNED NOT NULL,
                    `item` VARCHAR(5) NOT NULL,
                    `quantity` INT(10) NOT NULL,
                    `grade` VARCHAR(30) NOT NULL,
                    `mdt` VARCHAR(15) NULL DEFAULT NULL,
                    `mdw` VARCHAR(15) NULL DEFAULT NULL,
                    `mdl` VARCHAR(15) NULL DEFAULT NULL,
                    `dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                    `fdt` VARCHAR(15) NULL DEFAULT NULL,
                    `fdw` VARCHAR(15) NULL DEFAULT NULL,
                    `fdl` VARCHAR(15) NULL DEFAULT NULL,
                    `finishing_dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                    `process` VARCHAR(20) NULL DEFAULT NULL,
                    `mat` DECIMAL(20,2) NOT NULL,
                    `pmach` DECIMAL(20,2) NULL DEFAULT NULL,
                    `cncmach` DECIMAL(20,2) NULL DEFAULT NULL,
                    `other` DECIMAL(20,2) NULL DEFAULT NULL,
                    `Shape_Code` VARCHAR(20) NULL DEFAULT '',
                    `specialShapeOrder` VARCHAR(20) NULL DEFAULT '',
                    `Category` VARCHAR(20) NULL DEFAULT '',
                    `tabletype` VARCHAR(5) NULL DEFAULT '',
                    `vat` DECIMAL(20,2) NULL DEFAULT NULL,
                    `gst` DECIMAL(20,2) NULL DEFAULT NULL,
                    `ftz` VARCHAR(5) NULL DEFAULT NULL,
                    `amountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                    `amountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `discountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `gstother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamountother` DECIMAL(10,2) NULL DEFAULT NULL,
                    `totalamount` DECIMAL(20,2) NOT NULL,
                    `status` VARCHAR(10) NOT NULL,
                    `aid_quo` INT(10) UNSIGNED NOT NULL,
                    `aid_cus` INT(10) UNSIGNED NOT NULL,
                    `datetimeissue_quo` DATETIME NOT NULL,
                    `olremarks` VARCHAR(100) NULL DEFAULT NULL,
                    `date_issue` DATE NOT NULL,
                    `completion_date` VARCHAR(15) NOT NULL,
                    `source` VARCHAR(10) NOT NULL,
                    `cuttingtype` VARCHAR(20) NOT NULL,
                    `tol_thkp` VARCHAR(4) NOT NULL,
                    `tol_thkm` VARCHAR(4) NOT NULL,
                    `tol_wdtp` VARCHAR(4) NOT NULL,
                    `tol_wdtm` VARCHAR(4) NOT NULL,
                    `tol_lghp` VARCHAR(4) NOT NULL,
                    `tol_lghm` VARCHAR(4) NOT NULL,
                    `chamfer` VARCHAR(5) NOT NULL,
                    `flatness` VARCHAR(5) NOT NULL,
                    `ihremarks` INT(10) NULL DEFAULT NULL,
                    `ivremarks` VARCHAR(30) NULL DEFAULT NULL,
                    `ivpono` VARCHAR(20) NULL DEFAULT NULL,
                    `custoolcode` VARCHAR(20) NULL DEFAULT NULL,
                    `runningno` VARCHAR(4) NOT NULL,
                    `jobno` VARCHAR(3) NOT NULL,
                    `ivdate` DATE NOT NULL,
                    `aid_ol` INT(10) UNSIGNED NOT NULL,
                    `datetimeissue_ol` DATETIME NOT NULL,
                    `jlissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `jlreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `jlreprintcount` INT(10) NOT NULL DEFAULT '0',
                    `docount` INT(10) NULL DEFAULT NULL,
                    `dodate` DATE NULL DEFAULT NULL,
                    `doissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `doreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `doreprintcount` VARCHAR(10) NOT NULL DEFAULT '0',
                    `driver` VARCHAR(10) NULL DEFAULT NULL,
                    `policyno` VARCHAR(20) NULL DEFAULT 'PST',
                    `aid_do` INT(10) UNSIGNED NULL DEFAULT NULL,
                    `stampsignature` VARCHAR(5) NOT NULL DEFAULT 'no',
                    `aid_stampsignature` INT(10) NULL DEFAULT NULL,
                    `datetime_stampsignature` DATETIME NULL DEFAULT NULL,
                    `ivissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `ivreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `ivreprintcount` INT(10) NOT NULL DEFAULT '0',
                    `operation` INT(3) NOT NULL DEFAULT '1',
                    `jcodeid` INT(11) NULL DEFAULT NULL,
                    PRIMARY KEY (`oid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ROW_FORMAT=DYNAMIC
            ;

            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

function generate_runningno_serial($period, $com) {
    $tab = "runningno_serial_$period";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `rsid` INT(11) NOT NULL AUTO_INCREMENT,
                    `runningno` INT(11) NOT NULL,
                    `instanceid` VARCHAR(18) NOT NULL,
                    `quono` VARCHAR(18) NOT NULL,
                    `aid_ol` INT(11) NOT NULL,
                    `datecreate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`rsid`),
                    INDEX `sid` (`rsid`)
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_runningno($period, $com) {
    $tab = "runningno_$period";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `rnid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `date_issue` DATE NOT NULL,
                    `runno` INT(10) UNSIGNED NOT NULL,
                    `todayorderno` INT(10) UNSIGNED NOT NULL,
                    `qid` INT(10) NOT NULL,
                    `quono` VARCHAR(20) NOT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL,
                    `company` VARCHAR(10) NOT NULL,
                    PRIMARY KEY (`rnid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ROW_FORMAT=DYNAMIC
            ;
            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_orderlist_delete($period, $com) {
    $tab = "orderlistnew_delete_" . $com . "_" . $period;
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                `odid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `oid` INT(10) UNSIGNED NOT NULL,
                `bid` INT(10) UNSIGNED NOT NULL,
                `currency` INT(10) NOT NULL,
                `qid` INT(10) UNSIGNED NOT NULL,
                `quono` VARCHAR(20) NOT NULL,
                `company` VARCHAR(10) NOT NULL,
                `cusstatus` VARCHAR(10) NOT NULL,
                `cid` INT(10) UNSIGNED NOT NULL,
                `accno` VARCHAR(8) NOT NULL,
                `date` DATE NOT NULL,
                `terms` VARCHAR(30) NOT NULL,
                `noposition` INT(10) UNSIGNED NOT NULL,
                `item` VARCHAR(5) NOT NULL,
                `quantity` INT(10) NOT NULL,
                `grade` VARCHAR(30) NOT NULL,
                `mdt` VARCHAR(15) NULL DEFAULT NULL,
                `mdw` VARCHAR(15) NULL DEFAULT NULL,
                `mdl` VARCHAR(15) NULL DEFAULT NULL,
                `dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                `fdt` VARCHAR(15) NULL DEFAULT NULL,
                `fdw` VARCHAR(15) NULL DEFAULT NULL,
                `fdl` VARCHAR(15) NULL DEFAULT NULL,
                `finishing_dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                `process` VARCHAR(20) NULL DEFAULT NULL,
                `mat` DECIMAL(20,2) NOT NULL,
                `pmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `cncmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `other` DECIMAL(20,2) NULL DEFAULT NULL,
                `Shape_Code` VARCHAR(20) NULL DEFAULT '',
                `specialShapeOrder` VARCHAR(20) NULL DEFAULT '',
                `Category` VARCHAR(20) NULL DEFAULT '',
                `tabletype` VARCHAR(5) NULL DEFAULT '',
                `vat` DECIMAL(20,2) NULL DEFAULT NULL,
                `gst` DECIMAL(20,2) NULL DEFAULT NULL,
                `ftz` VARCHAR(5) NULL DEFAULT NULL,
                `amountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstother` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamount` DECIMAL(20,2) NOT NULL,
                `status` VARCHAR(10) NOT NULL,
                `aid_quo` INT(10) UNSIGNED NOT NULL,
                `aid_cus` INT(10) UNSIGNED NOT NULL,
                `datetimeissue_quo` DATETIME NOT NULL,
                `olremarks` VARCHAR(100) NULL DEFAULT NULL,
                `date_issue` DATE NOT NULL,
                `completion_date` VARCHAR(15) NOT NULL,
                `source` VARCHAR(10) NOT NULL,
                `cuttingtype` VARCHAR(20) NOT NULL,
                `tol_thkp` VARCHAR(4) NOT NULL,
                `tol_thkm` VARCHAR(4) NOT NULL,
                `tol_wdtp` VARCHAR(4) NOT NULL,
                `tol_wdtm` VARCHAR(4) NOT NULL,
                `tol_lghp` VARCHAR(4) NOT NULL,
                `tol_lghm` VARCHAR(4) NOT NULL,
                `chamfer` VARCHAR(5) NOT NULL,
                `flatness` VARCHAR(5) NOT NULL,
                `ihremarks` INT(10) NULL DEFAULT NULL,
                `ivremarks` VARCHAR(30) NULL DEFAULT NULL,
                `ivpono` VARCHAR(20) NULL DEFAULT NULL,
                `custoolcode` VARCHAR(20) NULL DEFAULT NULL,
                `runningno` VARCHAR(4) NOT NULL,
                `jobno` VARCHAR(3) NOT NULL,
                `ivdate` DATE NOT NULL,
                `aid_ol` INT(10) UNSIGNED NOT NULL,
                `datetimeissue_ol` DATETIME NOT NULL,
                `jlissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `jlreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `jlreprintcount` INT(10) NOT NULL DEFAULT '0',
                `docount` INT(10) NULL DEFAULT NULL,
                `dodate` DATE NULL DEFAULT NULL,
                `doissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `doreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `doreprintcount` VARCHAR(10) NOT NULL DEFAULT '0',
                `driver` VARCHAR(10) NULL DEFAULT NULL,
                `policyno` VARCHAR(20) NULL DEFAULT 'PST',
                `aid_do` INT(10) UNSIGNED NULL DEFAULT NULL,
                `stampsignature` VARCHAR(5) NOT NULL DEFAULT 'no',
                `aid_stampsignature` INT(10) NULL DEFAULT NULL,
                `datetime_stampsignature` DATETIME NULL DEFAULT NULL,
                `ivissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `ivreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `ivreprintcount` INT(10) NOT NULL DEFAULT '0',
                `operation` INT(3) NOT NULL DEFAULT '1',
                `jcodeid` INT(11) NULL DEFAULT NULL,
                `requestby` INT(11) NOT NULL,
                `deleteby` INT(11) NOT NULL,
                `datetimedelete_ol` DATETIME NOT NULL,
                `remarks` TEXT NOT NULL,

                PRIMARY KEY (`odid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ROW_FORMAT=DYNAMIC
            ;
            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_order_control_center(){
    $tab = 'ordercontrolcenter';
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO'){
        $qr = "CREATE TABLE `$tab` (
                    `ocid` INT(11) NOT NULL AUTO_INCREMENT,
                    `oid` INT(11) NOT NULL,
                    `qid` INT(11) NOT NULL,
                    `quono` VARCHAR(15) NOT NULL,
                    `quono_period` VARCHAR(4) NOT NULL,
                    `orderlist_period` VARCHAR(4) NOT NULL,
                    `revisecount` INT(5) NOT NULL,
                    `remarks1` TEXT NULL DEFAULT NULL,
                    `remarks2` TEXT NULL DEFAULT NULL,
                    `ocid_parent` INT(11) NULL DEFAULT NULL,
                    `ocid_child` INT(11) NULL DEFAULT NULL,
                    INDEX `index` (`ocid`)
            )
            COMMENT='Orderlist Data /Revision Controller and Log'
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
            ";
        $objSQL = new SQL($qr);
        $execRes = $objSQL->ExecuteQuery();
        if ($execRes == 'execute ok!'){
            return 'ok';
        }else{
            return 'fail';
        }
    }else{
        return 'table already exists';
    }
}

/* Jblist
  production_scheduling v
  production_output v
  jobcodesid v
  joblist_work_status v
 * 
 */

function generate_production_scheduling($period, $com) {
    $tab = "production_scheduling_" . $period;
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                `sid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `omid` INT(10) NULL DEFAULT NULL,
                `bid` INT(10) UNSIGNED NOT NULL,
                `qid` INT(10) UNSIGNED NOT NULL,
                `quono` VARCHAR(20) NOT NULL,
                `company` VARCHAR(10) NOT NULL,
                `cid` INT(10) UNSIGNED NOT NULL,
                `aid_cus` INT(10) UNSIGNED NOT NULL,
                `quantity` INT(10) NOT NULL,
                `grade` VARCHAR(30) NOT NULL,
                `mdt` VARCHAR(15) NULL DEFAULT NULL,
                `mdw` VARCHAR(15) NULL DEFAULT NULL,
                `mdl` VARCHAR(15) NULL DEFAULT NULL,
                `fdt` VARCHAR(15) NULL DEFAULT NULL,
                `fdw` VARCHAR(15) NULL DEFAULT NULL,
                `fdl` VARCHAR(15) NULL DEFAULT NULL,
                `process` VARCHAR(20) NULL DEFAULT NULL,
                `source` VARCHAR(10) NULL DEFAULT NULL,
                `cuttingtype` VARCHAR(20) NULL DEFAULT NULL,
                `custoolcode` VARCHAR(20) NULL DEFAULT NULL,
                `cncmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `noposition` INT(10) UNSIGNED NOT NULL,
                `runningno` VARCHAR(4) NOT NULL,
                `jobno` VARCHAR(3) NOT NULL,
                `date_issue` DATE NOT NULL,
                `completion_date` DATE NOT NULL,
                `ivdate` DATE NOT NULL,
                `cst` VARCHAR(10) NULL DEFAULT NULL,
                `csw` VARCHAR(10) NULL DEFAULT NULL,
                `csl` VARCHAR(10) NULL DEFAULT NULL,
                `dateofcompletion` DATE NULL DEFAULT NULL,
                `additional` VARCHAR(20) NULL DEFAULT NULL,
                `jlfor` VARCHAR(5) NOT NULL,
                `status` VARCHAR(10) NOT NULL,
                `pcst` VARCHAR(10) NULL DEFAULT NULL,
                `pcsw` VARCHAR(10) NULL DEFAULT NULL,
                `pcsl` VARCHAR(10) NULL DEFAULT NULL,
                `pdateofcompletion` DATE NULL DEFAULT NULL,
                `datecncstart` DATE NULL DEFAULT NULL,
                `datecnccomplete` DATE NULL DEFAULT NULL,
                `checking` VARCHAR(5) NULL DEFAULT NULL,
                `date_start` DATE NULL DEFAULT NULL,
                `bandsawcut_start` DATETIME NULL DEFAULT NULL,
                `bandsawcut_startby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `bandsawcut_machine` INT(10) UNSIGNED NULL DEFAULT NULL,
                `bandsawcut_end` DATETIME NULL DEFAULT NULL,
                `bandsawcut_endby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `milling_start` DATETIME NULL DEFAULT NULL,
                `milling_startby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `milling_machine` INT(10) UNSIGNED NULL DEFAULT NULL,
                `milling_end` DATETIME NULL DEFAULT NULL,
                `milling_endby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `roughgrinding_start` DATETIME NULL DEFAULT NULL,
                `roughgrinding_startby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `roughgrinding_machine` INT(10) UNSIGNED NULL DEFAULT NULL,
                `roughgrinding_end` DATETIME NULL DEFAULT NULL,
                `roughgrinding_endby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `precisiongrinding_start` DATETIME NULL DEFAULT NULL,
                `precisiongrinding_startby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `precisiongrinding_machine` INT(10) UNSIGNED NULL DEFAULT NULL,
                `precisiongrinding_end` DATETIME NULL DEFAULT NULL,
                `precisiongrinding_endby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `cncmachining_start` DATETIME NULL DEFAULT NULL,
                `cncmachining_startby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `cncmachining_machine` INT(10) UNSIGNED NULL DEFAULT NULL,
                `cncmachining_end` DATETIME NULL DEFAULT NULL,
                `cncmachining_endby` INT(10) UNSIGNED NULL DEFAULT NULL,
                `packing` DATETIME NULL DEFAULT NULL,
                `delivery_out1` DATETIME NULL DEFAULT NULL,
                `delivery_in1` DATETIME NULL DEFAULT NULL,
                `delivery_out2` DATETIME NULL DEFAULT NULL,
                `delivery_in2` DATETIME NULL DEFAULT NULL,
                `delivery_out3` DATETIME NULL DEFAULT NULL,
                `delivery_in3` DATETIME NULL DEFAULT NULL,
                `ownremarks` VARCHAR(5) NULL DEFAULT NULL,
                `prodremarks` VARCHAR(100) NULL DEFAULT NULL,
                `stock_size` VARCHAR(5) NULL DEFAULT NULL,
                `stock_month` VARCHAR(10) NULL DEFAULT NULL,
                `operation` INT(3) NOT NULL DEFAULT '1',
                PRIMARY KEY (`sid`)
        )
        COLLATE='utf8_general_ci'
        ENGINE=InnoDB
        ;
            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

function generate_production_output($period, $com) {
    $tab = "production_output_" . $period;
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `poid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `sid` INT(10) UNSIGNED NOT NULL,
                    `jobtype` VARCHAR(20) NOT NULL,
                    `date_start` DATETIME NOT NULL,
                    `start_by` VARCHAR(50) NOT NULL,
                    `machine_id` INT(10) UNSIGNED NOT NULL,
                    `date_end` DATETIME NULL DEFAULT NULL,
                    `end_by` VARCHAR(50) NOT NULL,
                    `quantity` INT(10) UNSIGNED NULL DEFAULT NULL,
                    `totalquantity` INT(10) UNSIGNED NULL DEFAULT NULL,
                    `remainingquantity` INT(10) UNSIGNED NULL DEFAULT NULL,
                    PRIMARY KEY (`poid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=MyISAM
            ;

            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_jobcodesid() {
    $tab = 'jobcodesid';
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `jcodeid` INT(11) NOT NULL AUTO_INCREMENT,
                    `jobcode` VARCHAR(50) NOT NULL DEFAULT 'false',
                    `sid` INT(11) NOT NULL,
                    `oid` INT(11) NOT NULL,
                    `period` VARCHAR(4) NULL DEFAULT NULL,
                    `jlwsid` INT(11) UNSIGNED NOT NULL,
                    PRIMARY KEY (`jcodeid`)
            )
            COLLATE='latin1_swedish_ci'
            ENGINE=InnoDB
            ;

            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

function generate_joblist_work_status() {
    $tab = 'joblist_work_status';

    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `jlwsid` INT(11) NOT NULL AUTO_INCREMENT,
                    `jobcode` VARCHAR(50) NOT NULL DEFAULT 'false',
                    `cncmachining` VARCHAR(10) NOT NULL DEFAULT 'false',
                    `manual` VARCHAR(10) NOT NULL DEFAULT 'false',
                    `bandsaw` VARCHAR(10) NOT NULL DEFAULT 'false',
                    `milling` VARCHAR(10) NOT NULL DEFAULT 'false',
                    `millingwidth` VARCHAR(10) NOT NULL DEFAULT 'false',
                    `millinglength` VARCHAR(10) NOT NULL DEFAULT 'false',
                    `roughgrinding` VARCHAR(10) NOT NULL DEFAULT 'false',
                    `precisiongrinding` VARCHAR(10) NOT NULL DEFAULT 'false',
                    PRIMARY KEY (`jlwsid`)
            )
            COLLATE='latin1_swedish_ci'
            ENGINE=InnoDB
            ;

            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

/* Invoice
  dono_newsearch v
  invoiceno_pst v
  invoice_log_pst v
  invoice_reissue v
  invrunno v
  invrunno_log v
  invrunningno_serial v
  customer_payment_pst v
 * 
 */

function generate_dono_newsearch() {
    $tab = 'dono_newsearch';

    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
            `dosid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `bid` INT(10) UNSIGNED NOT NULL,
            `date_issue` DATE NOT NULL,
            `docotype` VARCHAR(4) NOT NULL,
            `dorunno` VARCHAR(10) NOT NULL,
            `docount` INT(10) NOT NULL,
            `qid` INT(10) NOT NULL,
            `quono` VARCHAR(20) NOT NULL,
            `cid` INT(10) UNSIGNED NOT NULL,
            `ivpono` VARCHAR(20) NULL DEFAULT NULL,
            `invoicedate` DATE NULL DEFAULT NULL,
            `policyno` VARCHAR(20) NOT NULL DEFAULT 'PST',
            PRIMARY KEY (`dosid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ;

            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_invoiceno($period, $com) {
    $tab = "invoiceno_" . $com . "_" . $period;
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
            `inid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `bid` INT(10) UNSIGNED NOT NULL,
            `date_issue` DATE NOT NULL,
            `invcotype` VARCHAR(4) NOT NULL,
            `invrunno` VARCHAR(10) NOT NULL,
            `qid` INT(10) NOT NULL,
            `quono` VARCHAR(20) NOT NULL,
            `cid` INT(10) UNSIGNED NOT NULL,
            `ivpono` VARCHAR(20) NULL DEFAULT NULL,
            `policyno` VARCHAR(20) NULL DEFAULT NULL,
            PRIMARY KEY (`inid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ;
            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

function generate_invoice_log($period, $com) {
    $tab = "invoice_log_" . $com . "_" . $period;
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `inid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `invcotype` VARCHAR(4) NOT NULL,
                    `invrunno` VARCHAR(10) NOT NULL,
                    `datetime_print` DATETIME NOT NULL,
                    `printby` INT(10) UNSIGNED NOT NULL,
                    `ivreprintcount` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                    PRIMARY KEY (`inid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=MyISAM
            ;

            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

function generate_invoice_reissue($period, $com) {
    $tab = "invoice_reissue_" . $period;
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `irid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `quono` VARCHAR(20) NOT NULL,
                    `company` VARCHAR(10) NOT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL,
                    `invcotype` VARCHAR(4) NOT NULL,
                    `invrunno` VARCHAR(10) NOT NULL,
                    `date_reissue` DATETIME NOT NULL,
                    `request_by` INT(10) UNSIGNED NOT NULL,
                    `reason` VARCHAR(255) NOT NULL,
                    `reissue_by` INT(10) UNSIGNED NOT NULL,
                    PRIMARY KEY (`irid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ;
            ";
        $objSQL = new SQL($qr);
        $execResult = $objSQL->ExecuteQuery();
        if ($execResult == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_invrunno($period, $com) {
    $tab = "invrunno_$period";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `inid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `period` VARCHAR(20) NULL DEFAULT NULL,
                    `invcotype` VARCHAR(4) NOT NULL,
                    `invrunno` VARCHAR(10) NOT NULL,
                    `qid` INT(10) NOT NULL DEFAULT '0',
                    `quono` VARCHAR(20) NOT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                    `ivpono` VARCHAR(20) NULL DEFAULT NULL,
                    `policyno` VARCHAR(20) NOT NULL DEFAULT 'PST',
                    `occupied` VARCHAR(10) NOT NULL DEFAULT 'no',
                    `timerecord` TIMESTAMP NULL DEFAULT NULL,
                    PRIMARY KEY (`inid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ;
            ";
        $objSQL = new SQL($qr);
        $execResult = $objSQL->ExecuteQuery();
        if ($execResult == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_invrunno_log() {
    $tab = 'invrunno_log';
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS `$tab` (
                    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `ip` VARCHAR(20) NOT NULL,
                    `date_time` DATETIME NOT NULL,
                    `invrunno` VARCHAR(45) NOT NULL,
                    `OPERATION` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci',
                    `SERVER_PATH` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
                    PRIMARY KEY (`id`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            AVG_ROW_LENGTH=51
            ;
            ";
        $objSQL = new SQL($qr);
        $execResult = $objSQL->ExecuteQuery();
        if ($execResult == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists.';
    }
}

function generate_invrunningno_serial($period, $com) {

    $tab = "invrunningno_serial_$period";
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS  `$tab` (
                    `ivrsid` INT(11) NOT NULL AUTO_INCREMENT,
                    `runningno` INT(11) NOT NULL,
                    `instanceid` VARCHAR(18) NOT NULL,
                    `quono` VARCHAR(18) NOT NULL,
                    `docount` INT(5) NOT NULL,
                    `aid_ol` INT(11) NOT NULL,
                    `datecreate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`ivrsid`),
                    INDEX `sid` (`ivrsid`)
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
            ";
        $objSQL = new SQLConnect($qr);
        $result = $objSQL->getExecute();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

function generate_customer_payment($period, $com) {
    $tab = "customer_payment_" . $com . "_" . $period;
    $chkTab = checkTableExists_Origin($tab);
    if ($chkTab == 'NO') {
        $qr = "CREATE TABLE IF NOT EXISTS  `$tab` (
                    `pid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `currency` INT(10) NOT NULL,
                    `cusstatus` VARCHAR(10) NULL DEFAULT NULL,
                    `accno` VARCHAR(8) NULL DEFAULT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL,
                    `aid_cus` INT(10) UNSIGNED NOT NULL,
                    `quono` VARCHAR(20) NOT NULL,
                    `company` VARCHAR(10) NOT NULL,
                    `invcotype` VARCHAR(4) NOT NULL,
                    `invno` VARCHAR(10) NOT NULL,
                    `invdate` DATE NULL DEFAULT NULL,
                    `invamount` DECIMAL(20,2) NULL DEFAULT NULL,
                    `vat` DECIMAL(20,2) NULL DEFAULT NULL,
                    `gst` DECIMAL(20,2) NULL DEFAULT NULL,
                    `invdatetime` DATETIME NULL DEFAULT NULL,
                    `ortype` VARCHAR(2) NULL DEFAULT NULL,
                    `orno` INT(10) UNSIGNED NULL DEFAULT NULL,
                    `accountpayment` INT(10) UNSIGNED NULL DEFAULT NULL,
                    `paymentdate` DATE NULL DEFAULT NULL,
                    `paymentamount` DECIMAL(20,2) NULL DEFAULT NULL,
                    `paymentmethod` INT(10) UNSIGNED NULL DEFAULT NULL,
                    `chequeno` VARCHAR(10) NULL DEFAULT NULL,
                    `remarks` VARCHAR(100) NULL DEFAULT NULL,
                    `aid_pay` INT(10) UNSIGNED NULL DEFAULT NULL,
                    `datetime` VARCHAR(14) NULL DEFAULT NULL,
                    `reference` VARCHAR(20) NULL DEFAULT NULL,
                    `docount` INT(10) NULL DEFAULT NULL,
                    PRIMARY KEY (`pid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ;
            ";
        $objSQL = new SQL($qr);
        $result = $objSQL->ExecuteQuery();
        #echo "qr = $qr\n";
        if ($result == 'execute ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
    } else {
        return 'table already exists';
    }
}

/*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    