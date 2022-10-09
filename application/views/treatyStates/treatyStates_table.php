  <div class="br-section-wrapper mg-t-20">
    <h3>Statistics</h3>  
<?php //dd($statistics) ?>
      <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" rowspan="2">Particulars</th>
                <th scope="col" colspan="5">Years</th>
                <th scope="col" rowspan="2">Total</th>
            </tr>
            <tr>

                <?php
                for ($i = $thisYear-5; $i < ($thisYear) ; $i++) {
                    echo "<th scope='col'>$i</th>";
                }
                ?>
                <!-- <th scope='col'></th> -->

            </tr>
        </thead>
        <tbody>
          <?php //dd($statistics); ?>
        <?php foreach ($statistics as $state){ ?>
            <tr>
                <td><?php echo $state['particularName']?></td>
                <?php

                    $yearVals = [];

                    $particular = strtolower($state['particularName']);

                    $percent = false;
                    if ($particular == "pic's share" || $particular == "ratio") { // To show % symbol and avg. for %
                        $percent = true;
                    }

                    // for ($i = $thisYear-1; $i > ($thisYear-6) ; $i--) {
                      for ($i = $thisYear-5; $i < ($thisYear) ; $i++) {
                        $yearVal ='';
                        if (isset($state[$i])) {
                            $yearVal = $state[$i];
                            $yearVals[] = $yearVal;

                            if ($percent) {
                                $yearVal .= '%'; 
                            }

                        }
                        echo "<td> {$yearVal} </td>";
                    }

                    $total = array_sum($yearVals);

                    if ($percent) {
                        if(count($yearVals)) {
                            $total = $total/count($yearVals);
                        }
                        $total = number_format($total, 2, '.', '');
                        $total .= '%';
                    }

                ?>
                <td><?php echo $total?></td>
                <!-- <td></td> -->
            </tr>
        <?php } // endforeach ?>



<!--         <tr>
          <td>PIC'S Share</td>
          <td>7.50%</td>
          <td>7.50%</td>
          <td>7.50%</td>
          <td>7.50%</td>
          <td>35.00%</td>
          <td>35.00%</td>
          <td></td>
        </tr> -->



<!--         <tr>
          <td>PORT PREMIUM</td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td>0</td>
        </tr>
        <tr>
          <td>PORT LOSSES</td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td><input type="text" class="form-control" value="0" /></td>
          <td>0</td>
        </tr>
        <tr>
          <td>PREMIUM</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>COMMISSION</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>PREMIUM RES. ADJ.</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>LOSSES INCURRED</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>RATIO</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>BALANCE</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>PROFIT COMM.</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>N/U BALANCE</td>
          <td>3,264,168</td>
          <td>2,269,310</td>
          <td>1,682,516</td>
          <td>432,857</td>
          <td>17,538,653</td>
          <td>-1,028,910</td>
          <td>24,158,594</td>
        </tr>
        <tr>
          <td>RATIO</td>
          <td>54.53%</td>
          <td>37.96%</td>
          <td>26.89%</td>
          <td>6.77%</td>
          <td>47.35%</td>
          <td>-3.70%</td>
          <td>27.01%</td>
        </tr>
        <tr>
          <td colspan="8"><strong>Break-up of Losses</strong></td>
        </tr>
        <tr>
          <td>Losses Paid During the Year</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>Plus: Losses O/S at the end of Year</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>Less: Losses O/S at the end of previous Year</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr>
        <tr>
          <td>Losses Incurred</td>
          <td><input type="text" class="form-control" value="5,985,769" /></td>
          <td><input type="text" class="form-control" value="5,977,854" /></td>
          <td><input type="text" class="form-control" value="6,256,509" /></td>
          <td><input type="text" class="form-control" value="6,392,913" /></td>
          <td><input type="text" class="form-control" value="37,038,630" /></td>
          <td><input type="text" class="form-control" value="27,787,468" /></td>
          <td>89,439,143</td>
        </tr> -->


      </tbody>
    </table>
  </div>