<p><a class="btn btn-large btn-primary" href="<?BASE_URL?>tests/add">Lisa uus test </a>
</p>
<table id="tests-table" class="table table-bordered table-striped">
	<thead>
	<tr>
		<th>Testi nimi</th>
		<th>Koostaja</th>
		<th>Aeg</th>
		<th>Tegevused</th>
	</tr>
	</thead>
	<tbody>
	<?if (! empty($tests)): foreach ($tests as $test): ?>
		<tr id="test<?= $test['test_id'] ?>">
			<td><?=$test['name']?></td>
			<td><?=$test['username']?></td>
			<td><?=$test['date']?></td>
			<td>
				<a href="<?= BASE_URL ?>tests/edit/<?=$test['test_id'] ?>">
					<i class="icon-pencil"></i></a>
	<?if(!empty($status)&&$status=='teacher'):?>
				<a href="#" onclick="if (!confirm('Oled kindel?')) return false;
					remove_test_ajax(<?= $test['test_id'] ?>);return false">
					<i class="icon-trash"></i>Kustuta</a><?endif?>
			</td>

		</tr>
	<? endforeach;endif?>
	</tbody>
</table>