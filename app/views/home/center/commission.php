<!--主栏-->
        <div class="yongjin_mn f-fr bg_ff">
            <div class="yongjin_mn_tt bg_ff">
                <p class="f-fl" style="border-bottom:3px solid #f1070a;">我的佣金</p>
                <div class="cb"></div>
            </div>
            <p class="yongjin_mn_total bg_f5">当前共（<span><?php echo bcadd($tender_log->total_count,0,0);?></span>）笔</p>
            <div class="yongjin_mn_cont bg_ff cb">
              <div class="f-fl">
                <p>投资本金合计</p>
                <p><span><?php echo $user_info->turnover;?></span>万元</p>
              </div>
              <!--<div class="f-fl">
                <p>预期收益</p>
                <p><span>0</span>元</p>
              </div>-->
              <div class="f-fl">
                <p>已赚佣金</p>
                <p><span><?php echo bcadd($tender_log->total_money,0,2);?></span>元</p>
              </div>
                <div class="cb"></div>
            </div>
        </div>
        <div class="cb"></div>
      </div>
      <div class="cb"></div>
    </div>