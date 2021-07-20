<?php 
/*
  /******Class to export excel********************
  '	By	 	 : Indrani Biswas	'
  '	On	 	 : 25-Jan-2021          '
  ' This is used to export the data in excel format

 */
include_once(APPPATH."Excel/Writer.php");

//include_once("controller/commonClass.php");
class clsExcelImport extends Model {
  
  //Function to export dealer receipt by indrani on::26-01-2021 
  public function exportExcelForDealerCustomer($action,$dealerId,$customerId,$transactionId,$createdOn,$createdBy,$query,$payAmt,$rto,$vehicleNo,$receiptNo,$txtFromDate,$txtToDate,$strAttr1,$strAttr2,$intAttr1,$intAttr2) {
        include_once(APPPATH."controller/clsManageDealerDashboard.php");
        $objDealer    = new clsManageDealerDashboard;
        $xlsResult = $objDealer->manageDealerDashboard($action,$dealerId,$customerId,$transactionId,$createdOn,$createdBy,$query,$payAmt,$rto,$vehicleNo,$receiptNo,$txtFromDate,$txtToDate,$strAttr1,$strAttr2,$intAttr1,$intAttr2);
          
        $fileName = "CustomerDet_" . date("d-m-Y_H_i_s") . ".xls";
        $workbook = new Spreadsheet_Excel_Writer('temp/' . $fileName);
        $workbook->setVersion(8);
        $worksheet =$workbook->addWorksheet('Customer Details');
        $worksheet->setInputEncoding('utf-8');
        $format_border =$workbook->addFormat(array('right' => 1, 'bottom' => 1, 'pattern' => 1, 'bordercolor' => 'black', 'fgcolor' => 'white'));
        $format_bold = $workbook->addFormat();
        $format_bold->setBold();
        $format_title = $workbook->addFormat();
        $format_title->setBold();
        $format_title->setColor('yellow');
        $format_title->setPattern(1);
        $format_title->setFgColor('blue');
        $format_bold->setBorderColor('blue');
        $ctr = 0;

        $worksheet->write(0, 0, 'SL No.', $format_title);     
        $worksheet->write(0, 1, 'Vehicle No. Class of Vechicle', $format_title);
        $worksheet->write(0, 2, 'Name', $format_title);
        $worksheet->write(0, 3, 'Donation', $format_title);
        $worksheet->write(0, 4, 'Donation Date', $format_title);
        $worksheet->write(0, 5, 'Reciept No.', $format_title);

        while ($row = $xlsResult->fetch_array()) 
        {         
          $ctr ++;
          $vehicleNo              = htmlspecialchars_decode($row['vchVehicleNo'],ENT_NOQUOTES);
          $vehicleCls             = ($row['intVehicleClass']==1)?'Two wheeler':'Four wheeler';
          $custName               = ucwords(strtolower(htmlspecialchars_decode($row['vchName'],ENT_NOQUOTES)));
          $amount                 = $row['decAmount'];
          $donationDate           = $row['stmCreatedOn'];
          $receiptNo              = htmlspecialchars_decode($row['vchReceiptNo'],ENT_NOQUOTES);

          $worksheet->write($ctr, 0, $ctr, $format_border);                  
          $worksheet->write($ctr, 1, $vehicleNo.' '.$vehicleCls, $format_border);
          $worksheet->write($ctr, 2, $custName, $format_border);
          $worksheet->write($ctr, 3, $amount, $format_border);
          $worksheet->write($ctr, 4, $donationDate, $format_border);
          $worksheet->write($ctr, 5, $receiptNo, $format_border);
        }
       
        $workbook->close();
         
        ob_end_clean(); 
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment;filename=$fileName");
        readfile(SITEPATH.'/temp/' . $fileName);
  
        exit();
        
    }//End of function exportExcelForDealerCustomer

    //Function to export dealer report by indrani on::27-01-2021
    public function exportExcelForDealerCustomerReport($action,$dealerId,$customerId,$transactionId,$createdOn,$createdBy,$query,$payAmt,$rto,$vehicleNo,$receiptNo,$txtFromDate,$txtToDate,$strAttr1,$strAttr2,$intAttr1,$intAttr2) {
        include_once(APPPATH."controller/clsManageDealerDashboard.php");
        $objDealer    = new clsManageDealerDashboard;
        $xlsResult = $objDealer->manageDealerDashboard($action,$dealerId,$customerId,$transactionId,$createdOn,$createdBy,$query,$payAmt,$rto,$vehicleNo,$receiptNo,$txtFromDate,$txtToDate,$strAttr1,$strAttr2,$intAttr1,$intAttr2);
          
        $fileName = "CustomerReport_" . date("d-m-Y_H_i_s") . ".xls";
        $workbook = new Spreadsheet_Excel_Writer('temp/' . $fileName);
        $workbook->setVersion(8);
        $worksheet =$workbook->addWorksheet('Customer Details Report');
        $worksheet->setInputEncoding('utf-8');
        $format_border =$workbook->addFormat(array('right' => 1, 'bottom' => 1, 'pattern' => 1, 'bordercolor' => 'black', 'fgcolor' => 'white'));
        $format_bold = $workbook->addFormat();
        $format_bold->setBold();
        $format_title = $workbook->addFormat();
        $format_title->setBold();
        $format_title->setColor('yellow');
        $format_title->setPattern(1);
        $format_title->setFgColor('blue');
        $format_bold->setBorderColor('blue');
        $ctr = 0;

        $worksheet->write(0, 0, 'SL No.', $format_title);     
        $worksheet->write(0, 1, 'Vehicle No. Class of Vechicle', $format_title);
        $worksheet->write(0, 2, 'Name', $format_title);
        $worksheet->write(0, 3, 'Donation', $format_title);
        $worksheet->write(0, 4, 'Donation Date', $format_title);
        $worksheet->write(0, 5, 'Reciept No.', $format_title);

        while ($row = $xlsResult->fetch_array()) 
        {         
          $ctr ++;
          $vehicleNo              = htmlspecialchars_decode($row['vchVehicleNo'],ENT_NOQUOTES);
          $vehicleCls             = ($row['intVehicleClass']==1)?'Two wheeler':'Four wheeler';
          $custName               = ucwords(strtolower(htmlspecialchars_decode($row['vchName'],ENT_NOQUOTES)));
          $amount                 = $row['decAmount'];
          $donationDate           = $row['stmCreatedOn'];
          $receiptNo              = htmlspecialchars_decode($row['vchReceiptNo'],ENT_NOQUOTES);

          $worksheet->write($ctr, 0, $ctr, $format_border);                  
          $worksheet->write($ctr, 1, $vehicleNo.' '.$vehicleCls, $format_border);
          $worksheet->write($ctr, 2, $custName, $format_border);
          $worksheet->write($ctr, 3, $amount, $format_border);
          $worksheet->write($ctr, 4, $donationDate, $format_border);
          $worksheet->write($ctr, 5, $receiptNo, $format_border);
        }
       
        $workbook->close();
         
        ob_end_clean(); 
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment;filename=$fileName");
        readfile(SITEPATH.'/temp/' . $fileName);
  
        exit();
        
    }//End of function exportExcelForDealerCustomerReport

     //Function to export dealer transaction report by indrani on::03-02-2021
    public function exportExcelForDealerTransactionReport($strAction,$id,$dealerCode,$stateCode,$officeCode,$dealerName,$dRegdNo,$dAddress1,$dAddress2,$dPinCode,$validUptoDate,$enteredBy,$enteredOn,$tinNo,$contactNo,$email,$maker,$dClass,$userId,$dealerPassword,$createdBy,$attr1,$intattr1) {
        include_once(APPPATH."controller/clsDealer.php");
        $obj        = new clsDealer();
        $xlsResult = $obj->manageDealerLoginDashboard($strAction,$id,$dealerCode,$stateCode,$officeCode,$dealerName,$dRegdNo,$dAddress1,$dAddress2,$dPinCode,$validUptoDate,$enteredBy,$enteredOn,$tinNo,$contactNo,$email,$maker,$dClass,$userId,$dealerPassword,$createdBy,0,0,$attr1,$intattr1);
          
        $fileName = "DealerTransactionReport_" . date("d-m-Y_H_i_s") . ".xls";
        $workbook = new Spreadsheet_Excel_Writer('temp/' . $fileName);
        $workbook->setVersion(8);
        $worksheet =$workbook->addWorksheet('Dealer Transaction Report');
        $worksheet->setInputEncoding('utf-8');
        $format_border =$workbook->addFormat(array('right' => 1, 'bottom' => 1, 'pattern' => 1, 'bordercolor' => 'black', 'fgcolor' => 'white'));
        $format_bold = $workbook->addFormat();
        $format_bold->setBold();
        $format_title = $workbook->addFormat();
        $format_title->setBold();
        $format_title->setColor('yellow');
        $format_title->setPattern(1);
        $format_title->setFgColor('blue');
        $format_bold->setBorderColor('blue');
        $ctr = 0;

        $worksheet->write(0, 0, 'SL No.', $format_title);     
        $worksheet->write(0, 1, 'Date', $format_title);
        $worksheet->write(0, 2, 'Credit', $format_title);
        $worksheet->write(0, 3, 'Debit', $format_title);
        $worksheet->write(0, 4, 'Ledger Balance', $format_title);

        while ($row = $xlsResult->fetch_array()) 
        {         
          $ctr ++;
          $creditAmt = '';
          $debitAmt ='';
           $transactionDate   = (strtotime($row['stmCreatedOn'])!=0)?date('d-M-Y h:i A',strtotime($row['stmCreatedOn'])):'--';
           if($row['intTransactionType']==1)
           {
              $creditAmt = $row['decAmount'];
           }
           if($row['intTransactionType']==2)
           {
              $debitAmt = $row['decAmount'];
           }

           (float)$ledgbal = 0.00; 
            if($row['intTransactionType']==1)
            {
              $ledgbal= (float)$row['decAmount']+(float)$row['decLastUpdtAmt'];
            }
            else if($row['intTransactionType']==2)
            {
              $ledgbal= (float)$row['decLastUpdtAmt']-(float)$row['decAmount'];
            }


          $worksheet->write($ctr, 0, $ctr, $format_border);                  
          $worksheet->write($ctr, 1, $transactionDate, $format_border);
          $worksheet->write($ctr, 2, $creditAmt, $format_border);
          $worksheet->write($ctr, 3, $debitAmt, $format_border);
          $worksheet->write($ctr, 4, $ledgbal, $format_border);
        }
       
        $workbook->close();
         
        ob_end_clean(); 
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment;filename=$fileName");
        readfile(SITEPATH.'/temp/' . $fileName);
  
        exit();
        
    }//End of function exportExcelForDealerTransactionReport
    
}//End of class

if ($page == 'dealer-view') {
    if (isset($_REQUEST['hdn_qs']) && $_REQUEST['hdn_qs'] != '') {
        $objExcel = new clsExcelImport;
        $ddlRto         = (isset($_REQUEST['selRto'])&& $_REQUEST['selRto']!='')?trim(htmlspecialchars($_REQUEST['selRto'],ENT_QUOTES)):0;
        $txtVehicleNo   = (isset($_REQUEST['vehicleNo'])&& $_REQUEST['vehicleNo']!='')?trim(htmlspecialchars($_REQUEST['vehicleNo'],ENT_QUOTES)):'';
        $txtReceiptNo   = (isset($_REQUEST['receiptNo'])&& $_REQUEST['receiptNo']!='')?trim(htmlspecialchars($_REQUEST['receiptNo'],ENT_QUOTES)):'';
        
        $openFlag = ($ddlRto > 0 || $txtVehicleNo != '' || $txtReceiptNo != '') ? 'S' : '';
        $qs = $_REQUEST['hdn_qs'];
        if ($qs == 'export')   { 
            $Result = $objExcel->exportExcelForDealerCustomer('VC',0,0,'','',0,'','',$ddlRto,$txtVehicleNo,$txtReceiptNo,'','','','',$dealerId,0);
          
        }
    }
}

if ($page == 'dealer-receipt') {
    if (isset($_REQUEST['hdn_qs']) && $_REQUEST['hdn_qs'] != '') {
        $objExcel = new clsExcelImport;
        $ddlRto         = (isset($_REQUEST['selRto'])&& $_REQUEST['selRto']!='')?trim(htmlspecialchars($_REQUEST['selRto'],ENT_QUOTES)):0;
        $txtVehicleNo   = (isset($_REQUEST['vehicleNo'])&& $_REQUEST['vehicleNo']!='')?trim(htmlspecialchars($_REQUEST['vehicleNo'],ENT_QUOTES)):'';
        $txtReceiptNo   = (isset($_REQUEST['receiptNo'])&& $_REQUEST['receiptNo']!='')?trim(htmlspecialchars($_REQUEST['receiptNo'],ENT_QUOTES)):'';
        $txtFromDate    = (isset($_REQUEST['frmDate'])&& $_REQUEST['frmDate']!='')?trim(htmlspecialchars($_REQUEST['frmDate'],ENT_QUOTES)):'';
        $txtToDate      = (isset($_REQUEST['toDate'])&& $_REQUEST['toDate']!='')?trim(htmlspecialchars($_REQUEST['toDate'],ENT_QUOTES)):'';
        
        $openFlag = ($ddlRto > 0 || $txtVehicleNo != '' || $txtReceiptNo != '' || $txtFromDate != '' || $txtToDate != '') ? 'S' : '';
        $qs = $_REQUEST['hdn_qs'];
        if ($qs == 'export')   { 
            $Result = $objExcel->exportExcelForDealerCustomerReport('VR',0,0,'','',0,'','',$ddlRto,$txtVehicleNo,$txtReceiptNo,$txtFromDate,$txtToDate,'','',$dealerId,0);
          
        }
    }
}

if ($page == 'dealerTransaction') {
    if (isset($_REQUEST['hdn_qs']) && $_REQUEST['hdn_qs'] != '') {
        $objExcel = new clsExcelImport;
        $dealerId       = $_SESSION['ORSSD']['roadSafety_DealerID'];
        $txtFromDate    = (isset($_REQUEST['frmDate'])&& $_REQUEST['frmDate']!='')?trim(htmlspecialchars($_REQUEST['frmDate'],ENT_QUOTES)):'';
        $txtToDate      = (isset($_REQUEST['toDate'])&& $_REQUEST['toDate']!='')?trim(htmlspecialchars($_REQUEST['toDate'],ENT_QUOTES)):'';
        
        $openFlag = ($txtFromDate != '' || $txtToDate != '') ? 'S' : '';
        $qs = $_REQUEST['hdn_qs'];
        if ($qs == 'export')   { 
            $Result = $objExcel->exportExcelForDealerTransactionReport('VWT',0,'','','','','','','','',$txtFromDate,'',$txtToDate,0,'','','','','','',$dealerId,'',0);
          
        }
    }
}

