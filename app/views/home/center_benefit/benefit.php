        <!--主栏-->
        <div class="hyfl_mn f-fr bg_ff">
            <div class="hyfl_mn_tt bg_ff">
                <p class="f-fl" style="border-bottom:3px solid #f1070a;">会员福利</p>
                <div class="cb"></div>
            </div>
            <div id="cptab" style="margin:0 auto;">
             <h2 class="hyfl_mn_tab">
              <b>
               <ul>
                <li class="lixz">未使用礼券</li>
                <li>已使用礼券</li>
                <li>已过期礼券</li>
               </ul>
              </b>
             </h2>  
       <!--未使用礼券-->
             <object class="divxz">   

             </object>
       <!--已使用礼券-->
             <object class="div">

             </object>
       <!--已过期礼券-->
             <object class="div">   

             </object>
           <script type="text/javascript">
    function chageSelect(nIndex) {
        var oLis = document.getElementById("cptab").getElementsByTagName("li");
        var oDivs = document.getElementById("cptab").getElementsByTagName("object");
        for (var i = 0; i < oLis.length; i++) {
            oLis.item(i).className = null;
            oDivs.item(i).className = null;
        }
        oLis.item(nIndex).className = "lixz";
        oDivs.item(nIndex).className = "divxz";
    }

    var oLis = document.getElementById("cptab").getElementsByTagName("li");
    oLis.item(0).onclick = function() {
        chageSelect(0);
    }
    oLis.item(1).onclick = function() {
        chageSelect(1);
    }
	oLis.item(2).onclick = function() {
        chageSelect(2);
    }
</script>
            </div>
        </div>
        <div class="cb"></div>
      </div>
      <div class="cb"></div>
    </div>