<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="assets/stylesheets/style.css">
</head>
<body>
	<div class="nav">
	<a href='/logout'>Logout</a>
	</div>
	<div id="friendcontainer">
		<h1>Hello <?php echo $this->session->userdata('name'); ?></h1>
		<?php 
		// echo $this->session->userdata('friendsmessage');
		?>
		<div id="friends">
		<h3>Friends</h3>
		<table>
			<th>
				<tr>
				<td>Alias</td>
				<td>Action</td>
				</tr>
			</th>
			<tbody>
				<?php 
				$friends = $this->session->userdata('friends');
				foreach ($friends as $value) {
					echo "<tr>";
					echo "<td>" . $value['alias'] . "</td>";
					echo "<td><a href='user/" . $value['id'] . "'>View Profile</a></td>";
					echo "<td><a href='remove/" . $value['id'] . "'>Remove As Friend</a></td></tr>";
				}
				?>
			</tbody>
		</table>
		</div>
		<div id="others">
		<h3>Users Not Added</h3>
		<table>
			<th>
				<tr>
				<td>Alias</td>
				<td>Action</td>
				</tr>
			</th>
			<tbody>
				<?php 
				$others = $this->session->userdata('others');
				foreach ($others as $value) {
					echo "<tr>";
					echo "<td><a href='user/" . $value['id'] . "'>" . $value['alias'] . "</td>";
					echo "<td><a href='add/" . $value['id'] . "'>Add</a></td></tr>";
				}
				?>
			</tbody>
		</table>
		</div>
	</div>
</body>
</html>