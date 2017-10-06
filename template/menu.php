<?php
    echo '
    <a href="../order/order.php?id='. $user_id .'" name="order_link">
	<div class="menu" id="order_link">
		<h3>ORDER</h3>
	</div>
	</a>
	<a href="../history/transaction_history.php?id='. $user_id .'" name="history_link">
	<div class="menu" id="history_link">
		<h3>HISTORY</h3>
	</div>
	</a>
	<a href="../profile/profile.php?id='. $user_id .'" name="profile_link">
	<div class="menu" id="profile_link">
		<h3>MY PROFILE</h3>
	</div>
	</a>
    ';
?>
