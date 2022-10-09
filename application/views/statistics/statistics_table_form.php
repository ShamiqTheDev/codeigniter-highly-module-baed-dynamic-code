
  <div class="br-section-wrapper mg-t-20">
    <h3>Statistics</h3>  
      <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" rowspan="2">Particulars</th>
                <th scope="col" colspan="5">Years</th>
                <th scope="col" rowspan="2">Total</th>
            </tr>
            <tr>
                <?php
                for ($i = $thisYear-4; $i <= ($thisYear) ; $i++) {
                    echo "<th scope='col'>$i</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>

        <?php
            $n = 0;

            foreach ($statistics as $state){
                $pName = strtoupper($state['particularName']);
                if ($pName == 'LOSSES INCURRED1' || $pName == 'LOSSES INCURRED2') {
                    $pName = 'LOSSES INCURRED';
                }
        ?>
            <tr>
                <td><?=$pName?></td>
                <?php

                    $yearVals = [];

                    $particular = strtolower($state['particularName']);
                    $particular = specialFormatting($particular);

                    $percent = false;
                    if ($particular == specialFormatting("pic's share") || $particular == specialFormatting('losses included ratio') || $particular == specialFormatting('netbalance') || $particular == specialFormatting('net balance ratio') ) { // To show % symbol and avg. for %
                        $percent = true;
                    }

                    $readOnly = '';
                    if (
                        $particular == specialFormatting('losses included ratio') || 
                        $particular == specialFormatting('net balance ratio') || 
                        $particular == "balance" || 
                        $particular == "net u/w balance" || 
                        $particular == "losses incurred1" ||
                        $particular == "losses incurred2"
                    ) {
                        $readOnly = 'readonly';
                    }

                    for ($i = $thisYear-4; $i <= ($thisYear) ; $i++)
                    {
                        $year = $yearVal = '';
                        $year = $i;

                        if (isset($state[$i])) {
                            $yearVal = $state[$i];
                            $yearVals[] = $yearVal;
                            if ($percent)
                            {
                                $yearVal = (float)$yearVal;
                                $yearVal = number_format($yearVal, 2, '.', '');

                                $yearVal .= $yearVal > 0?'%':'0%'; 
                            }
                            else{
                                $yearVal = round($yearVal);
                            }
                        }

                        $encParticular = base64_encode($particular);
                        $particularKey = specialFormatting($particular);
                        echo "<td>
                                <input type='hidden' name='particularsData[{$year}][{$particularKey}][pNameDev]' value='{$particularKey}'>
                                <input type='hidden' name='particularsData[{$year}][{$particularKey}][treatyYear]' value='{$year}'>
                                <input type='text' class='form-control no-border' name='particularsData[{$year}][{$particularKey}][statisticsValue]' value='{$yearVal}' {$readOnly}>
                                <input type='hidden' name='particularsData[{$year}][{$particularKey}][id]' value='{$state['particularId']}'>
                            </td>";
                    }
                    $total = array_sum($yearVals);

                    if ($percent)
                    {
                        $TotalPremium = $statistics['PREMIUM'];
                        unset($TotalPremium['particularName'],$TotalPremium['particularId']);
                        $TotalPremium = array_sum($TotalPremium);


                        if($particular =='lossesincludedratio')
                        {

                            $TotalLossesIncurred = $statistics['LOSSES INCURRED2'];
                            unset($TotalLossesIncurred['particularName'],$TotalLossesIncurred['particularId']);
                            $TotalLossesIncurred = array_sum($TotalLossesIncurred);

                            $LossesInclueded = ($TotalLossesIncurred !=0 AND $TotalPremium !=0)?$TotalLossesIncurred/$TotalPremium:0;
                            $total = round((float)$LossesInclueded * 100 );

                        }
                        else if($particular =='netbalance')
                        {

                            $TotalBalance = $statistics['BALANCE'];
                            unset($TotalBalance['particularName'],$TotalBalance['particularId']);
                            $TotalBalance = array_sum($TotalBalance);

                            $NetBalance = ($TotalBalance !=0 AND $TotalPremium !=0)?$TotalBalance/$TotalPremium:0;
                            $total = round((float)$NetBalance * 100 );
                        }

                        $total = number_format($total, 2, '.', '');
                        $total .= '%';


                    }

                    if($particular =='picsshare')
                    {
                        $total = '';

                    }

                ?>
                <td><?php echo $total?></td>
            </tr>
        <?php $n++; } // endforeach ?>
      </tbody>
    </table>
    <div class="form-group">
        <input type="button" id="calculate" class="btn btn-success" name="calculate" value="Calculate Stats">
    </div>
  </div>