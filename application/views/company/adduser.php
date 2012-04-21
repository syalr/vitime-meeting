<?php $this->load->view('/company/cmp_admin_nav.php')?>
<div class="regBox">
    	<form id="adduserForm" name="adduserForm" class="regForm" method='post' action='/company/do_adduser'>
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
                	<div class="fname"><label>姓名：</label></div>
                    <div class="fvalue"><input type="text" name="name" value='<?php echo $name?>' class="inputStyle" /></div>
                    <div class="ftip"></div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>账号：</label></div>
                    <div class="fvalue"><input type="text" name='username' value="<?php echo $username?>" class="inputStyle"/></div>
                    <div class="ftip"></div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>密码：</label></div>
                    <div class="fvalue"><input type="password" name="password" value='<?php echo $password?>' class="inputStyle"/></div>
                    <div class="ftip" style='display:none;'>
                    	<div class="errorTip">
                        	<span class="icon icon-error"></span>请输入验证码
                        </div>
                    </div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>手机号码：</label></div>
                    <div class="fvalue"><input type="text" name="mobile" value='<?php echo $mobile?>' class="inputStyle"/></div>
                    <div class="ftip">
                    	
                    </div>
                </li>
                <li>
                	<div class="fname"><span class="redStar">*</span><label>邮箱：</label></div>
                    <div class="fvalue"><input type="text" name="email" value='<?php echo $email?>' class="inputStyle"/></div>
                    <div class="ftip" style='display:none;'>
                    	<div class="attTip">
                        	请输入您的常用邮箱,如example@examplae.com
                        </div>
                    </div>
                </li>
                <li>
                	<div class="fname"></div>
                    <div class="fvalue">
                    	<button type="submit" class="btn btnBlue">添 加
                        </button><button type="reset" class="btn btnRed" style="margin-left:20px;">取 消</button>
                    </div>
                    <div class="ftip"></div>
                </li>
            </ul>
        </form>
    </div>