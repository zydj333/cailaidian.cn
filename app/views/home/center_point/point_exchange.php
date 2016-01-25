               <!--主栏-->
        <div class="jfdh_mn f-fr bg_ff">
            <div class="jfdh_mn_tt">
                <p class="f-fl" style="border-bottom:3px solid #f1070a;">商品中心</p>
                <div class="cb"></div>
            </div>
            <div class="jfdh_mn_cont">
                <div class="jfdh_mn_list">
                  <ul>
                      <?php if(!empty($list)):?>
                      <?php foreach ($list as $key => $value):?>
                    <li>
                        <div class="jfdh_mn_item">
                            <div class="pr">
                                <div class="jfdh_item_img"><img width="188px"; height="218px"; src="<?php echo base_url().'/'.$value->img?>" alt="商品"/></div><!--商品图片-->
                                <span class="jfdh_item_name"><?php echo $value->name;?></span><!--商品名称-->
                            </div>
                            <p>市场参考价 : <b class="jfdh_item_price"><?php echo $value->price;?></b></p>
                            <p><i style="color:#f1070a;"><?php echo $value->points;?></i>积分</p>
                            <a href="#">兑换</a>
                        </div>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                  </ul>
                  <div class="cb"></div>
                </div>
                <div class="jfdh_mn_pager">
                    <?php echo $pagenation; ?>
                        
                </div>
            </div>
        </div>
        <div class="cb"></div>
      </div>
      <div class="cb"></div>
    </div>