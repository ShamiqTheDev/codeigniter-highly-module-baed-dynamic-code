<!DOCTYPE html>
<html>
<head>
    <title>Agreement Letter</title>
    <style>
        .letter-table table, .letter-table td,.letter-table th {
            border: 1px solid black;
        }

        .letter-table{
            border-collapse: collapse;
        }

        .letter-table th,.letter-table td{
            padding: 10px;
        }

        #printbtn {
            color: #fff;
            background-color: #63b947;
            border-color: #63b947;
            display: inline-block;
            font-weight: normal;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.65rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25;
            border-radius: 3px;
            transition: all 0.15s ease-in-out;
        }
        @media print {
            #printbtn {
                display :  none;
            }
        }

        .right {
            float: right;
        }
        .center {
            float: center;
        }

        .agr-number {
            float: left;
            text-decoration: underline;
            font-weight: bold;

        }

        .agr-date {
            float: right;
            text-decoration: underline;
            font-weight: bold;
        }

    </style>
    <style type="text/css" media="screen">
        .agr-number {
            padding-left: 115px;
            float: left;
            text-decoration: underline;
            font-weight: bold;
        }

        .agr-date {
            padding-right: 115px;
            float: right;
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
$date = new DateTime($agrResponse->agreementDate);
$date = $date->format('F, dS Y');
?>
<button id="printbtn" class="right" onclick="window.print()">Print Letter</button>
<?php
$rejectedCount = 0;
$allRejected = false;

foreach ($treatyDetails as $detail)
{
    $treatyStatus_check = $detail->treatyStatus;
    $TotalRecords = count($treatyDetails);

    if ($treatyStatus_check != 'true') {
        $rejectedCount++;
    }
    if ($TotalRecords == $rejectedCount) {
        $allRejected = true;
    }

    $cedentData = $treatyDetails[0]->treatyStatisticsDTO->cedentDTO;
}
$rows='<tr>
	            <th>S #</b></th>
	            <th>Treaty Name</th>
	            <th>Cedent</th>
	            <th>Treaty Type</th>
	            <th>PRCL Share Previous Year</th>
	            <th>Proposed PRCL Share </th>
	            <th>Approved PRCL Share </th>
	            <th>Currency</th>
	            <th>Status</th>
	          </tr>';
$contentTable = '
			
			
			<center>
			<h3>Treaty and Business Development Department</h3>
			<span>*****</span>	
			<div class="center">
			<table style="width: 100%">
			        <tr>
			        <td></td>
			        <td>'.date("d F Y").'</td>
			        </tr>
			        <tr><td>'.$cedentData->customerName.',<br>'.$cedentData->address.'</td><td></td></tr>
			        <tr><td colspan="2">Attention:- '.$agrResponse->cedentOfficialsName.'</td></tr>
			        <tr><td colspan="2"><b>Subject:<b>: <b style="text-decoration: underline;">Treaty Arrangments '.$agrResponse->statisticsYear.'</b></td></tr>
			        <tr><td colspan="2">Dear Sir:</td></tr>
			        <tr><td colspan="2"><p style="margin: 0px 0px 0px 60px;">Refrence to our email dated '.date("m-d-Y",strtotime($agrResponse->meetingDate)).' on the subject matter.</p></td></tr>
			        <tr><td colspan="2">&nbsp;</td></tr>';
        if ($allRejected)
        {
            $contentTable .= '<tr><td colspan="2">2 &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;We regret to inform you that, PRCL is not willing to participate in the following treaty proposed by you vide the agreement # <b>'.$agrResponse->agreementNumber.'</b> Dated: <b>'.$date.'</b>.</td></tr>';
        } else
        {
            $contentTable .= '<tr><td colspan="2">2 &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;We are pleased to confirm PRCL\'s share participation in your treaties for the year '.$treatyDetails[0]->treatyStatisticsDTO->currentYear.'
on the terms and conditions as agreed by the lead reinsurer as follows </td></tr> ';

        }

$contentTable .= '</table></div>
		<br><br>
		<table class="letter-table">';
$sn = 1;

// dd($treatyDetails);
foreach ($treatyDetails as $detail)
{
    // dd($detail);

    $name 				= $detail->name;
    $prePreviousShare 	= $detail->prePreviousShare;
    $preProposedShare 	= $detail->preProposedShare;
    $preApprovedShare 	= $detail->preApprovedShare;
    $currencyCode     	= $detail->currencyCode;
    $statsId          	= $detail->treatyStatisticsDTO->id;
    $treatyStatus     	= $detail->treatyStatus;
    $cedentName 		= $detail->treatyStatisticsDTO->cedentDTO->customerName;
    $treatyCat 			= $detail->treatyStatisticsDTO->treatyCategoryDTO->name;
    $currency 			= '';

    foreach ($currRespData as $cur) {
        if ($cur->id == $currencyCode) {
            $currency = $cur->code;
        }
    }
    // dd($treatyStatus);
    if ($treatyStatus == 'true') {
        $letterType = 'Acceptance';
    }else{
        $letterType = 'Rejection';
    }

    $rows .= "<tr>";
    $rows .= "<td>{$sn}</td>";
    $rows .= "<td>{$name}</td>";
    $rows .= "<td>{$cedentName}</td>";
    $rows .= "<td>{$treatyCat}</td>";
    $rows .= "<td>{$prePreviousShare}</td>";
    $rows .= "<td>{$preProposedShare}</td>";
    $rows .= "<td>{$preApprovedShare}</td>";
    $rows .= "<td>{$currency}</td>";
    $rows .= "<td>{$letterType}</td>";
    $rows .= "</tr>";

    $sn++;
}
$contentTable .= $rows;
$contentTable .= '</table><p>Note 1: Company will retain 100% Health Business on its net account</p></center>';
$html = str_replace('{CONTENT}', $contentTable,$html);


?>
<?php echo  $html ?>
</body>
</html>