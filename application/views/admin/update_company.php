<?php $this->load->view('/admin/nav.php')?>
<div class="regBox">
    	<form name="updatecompanyForm" id='updatecompanyForm' class="regForm" action='/admin/update_company' method='post' onsubmit="return validUpdateCmpForm(this)">
    	<input type='hidden' value='<?php echo $id?>' name='user_id' />
    	<input type='hidden' value='<?php echo $company_id?>' name='company_id' />
    	<?php if(!empty($errMsg)):?>
    	<ul>
    		<li>
             	<div class="errorTip">
                 	<span class="icon icon-error"></span><?php echo $errMsg?>
             	</div>
        	</li>
    	</ul>
    	<?php endif;?>
        	<ul>
            	<li>
                	<div class="fname"><span class="redStar">*</span><label>用户名：</label></div>
                    <div class="fvalue"><input type="text" name="username" class="inputStyle" value='<?php echo $username;?>'/></div>
                    <div class="ftip">
                    	<div class="attTip">
                        	请输入您的用户名
                        </div>
                    </div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>密码：</label></div>
                    <div class="fvalue"><input type="password" name="password" class="inputStyle" /></div>
                    <div class="ftip">
                    	<div class="attTip">
                        	如不修改，请留空！！
                        </div>
                    </div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>手机号码：</label></div>
                    <div class="fvalue"><input type="text" name="mobile" class="inputStyle" value='<?php echo $mobile;?>'/></div>
                    <div class="ftip">
                    	<div class="attTip">
                        	请输入您的手机号码
                        </div>
                    </div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>邮箱：</label></div>
                    <div class="fvalue"><input type="text" name="email" class="inputStyle" value='<?php echo $email;?>'/></div>
                    <div class="ftip">
                    	<div class="attTip">
                        	请输入您的常用邮箱,如example@examplae.com
                        </div>
                    </div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>公司名称：</label></div>
                    <div class="fvalue"><input type="text" name="company_name" class="inputStyle" value='<?php echo $company_name;?>'/></div>
                    <div class="ftip"></div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>企业标识：</label></div>
                    <div class="fvalue"><input type="text" name="company_mark" class="inputStyle" value='<?php echo $company_mark;?>'/></div>
                    <div class="ftip"></div>
                </li>
                <li>
                	<div class="fname"></div>
                	<input type="radio" class="mg-r10" name='status' value='1' <?php echo ($status==1?'checked':'');?> />正常状态&nbsp;&nbsp;<input type="radio" class="mg-r10" name='status' value='sys' <?php echo (empty($status)?'checked':'');?>/>已关闭
                </li>
                <li>
                	<div class="fname"></div>
                    <div class="fvalue"><input type="submit" class="btn btnBlue" value='更新'></input></div>
                    <div class="ftip"></div>
                </li>
            </ul>
        </form>
    </div>
    <script src='/js/admin.js'></script>