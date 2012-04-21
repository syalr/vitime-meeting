    <div class="loginBox">
    	<form id="loginForm" name="loginForm" class="loginForm validform " method='post' action='/members/do_login'>
        	<ul>
            	<li>
                	<label>用户名：</label>
                    <input type="text" name="username" class="inputStyle" value='<?php echo $username?>'/>
                </li>
                <li>
                	<label>密码：</label>
                    <input type="password" name="password" class="inputStyle"  value='<?php echo $password?>'/>
                </li>
                <li>
                	<label>公司标识：</label>
                    <input type="text" name="company_mark" class="inputStyle"  value='<?php echo $company_mark?>'/>
                </li>
                <li>
                <?php if(!empty($errMsg)):?>
                	<div class="errorTip">
                     	<span class="icon icon-error"></span><?php echo $errMsg?>
                    </div>
                <?php endif;?>
                </li>
                <li class="loginBtn">
                	<div class="pos1"><input type="checkbox" class="mg-r10" name='keepme' value='1'/>记住我</div>
                    <div class="pos2"><span class="icon icon-fpwd"></span><a href="#">忘记密码 ?</a></div>
                    <a href="javascript:void()" onclick="admin_login();return false;" class="btn btnBlue pos3">登 录</a>
                    <div class="pos4"><span class="icon icon-freg"></span><a href="/members/register">还未注册 ?</a></div>
                </li>
            </ul>
        </form>
    </div>