<? if ($data['isLoggedIn']): ?>

	<p>Hello <?=$data['username'];?></p>

	<ul>
		<li><a href="member/logout">Log out</a></li>
		<!-- <li><a href="member/update">Update details</a></li>
		<li><a href="member/changepassword">Change password</a></li> -->
	</ul>

<? else: ?>

<?=$data['home'];?>

<div>
You need to <a href="member/login">log in</a> or <a href="member/register">register</a>	
</div>

<? endif; ?>