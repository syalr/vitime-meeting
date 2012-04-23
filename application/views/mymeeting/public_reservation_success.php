<?php $this->load->view('/mymeeting/cmp_user_nav.php')?>
<div class="sysTipOk">
    	<span class="icon icon-ok"></span>
        预约成功！
    </div>
    <div class="regSuccess">
    	<div class="regSuccessTip">
        	<span class="icon icon-att"></span>
            <div class="regTxt">
            	会议主题：<?php echo $title?><br>会议密码：<?php echo $password?><br>会议室人数：<?php echo $usercount?>人
            </div>
        </div>
    </div>
    <div class="regBot">
    	<div class="col">
            <h3>您可以通过以下方式通知会议的参会者：</h3>
            <div class="colBox">
                <table border="0">
                  <tr>
                    <td class="td1"><button type="button" class="btn btnBlue">发送邮件</button></td>
                    <td class="td2">使用电脑默认邮件客户端发送会议邀请给会议的参与者。</td>
                  </tr>
                  <tr>
                    <td class="td1"><button type="button" class="btn btnBlue">复制会议信息</button></td>
                    <td class="td2">复制会议的详细信息，使用聊天工具或者网页邮箱发送给与会者。</td>
                  </tr>
                </table>
            </div>
        </div>
    </div>