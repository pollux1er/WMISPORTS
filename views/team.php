<?php 
	$t = new equipes();
	$teamName = $t->getTeamName($_GET['idteam']);
	$r = new rencontres();
	$rencontres = $r->getNextGames();
	$nbrc = count($rencontres);
	$j = new joueurs();
	$joueurs = $j->getTeamPlayers($_GET['idteam']);
	///echo "<pre>"; var_dump($rencontres);

?>

<div class="pageheader">
	<h1 class="pagetitle">Team Dashboard</h1>
	<span class="pagedesc">This is the dashboard overview of your <?php echo utf8_encode($teamName); ?>'s team</span>

	<ul class="hornav">
		<li class="current"><a href="#updates">Updates of <?php echo utf8_encode($teamName); ?>'s Teams</a></li>
		<li><a href="#activities">Activities</a></li>
	</ul>
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper">
	<div id="updates" class="subcontent">
		<table cellpadding="0" cellspacing="0" border="0" class="stdtable overviewtable">
			<colgroup>
				<col class="con0" width="16%" />
				<col class="con1" width="16%" />
				<col class="con0" width="16%" />
				<col class="con1" width="16%" />
				<col class="con0" width="16%" />
				<col class="con1" width="16%" />
			</colgroup>
			<thead>
				<tr>
					<th class="head0">Players</th>
					<?php 
					$i = 1;
					foreach($rencontres as $rc) { ?>
					<th class="capitalize" <?php if($i % 2 == 0) { ?>class="head0"<?php } else {?>class="head1"<?php } ?>><?php echo ucfirst($rc->datef); ?><br /><?php echo $rc->status; ?></th>
					
					<?php $i++; } ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($joueurs as $p) { ?>
				<tr>
					<td>
						<span class="jr"><?php echo $p->noms; ?></span>
					</td>
					<?php 
					$i = 1;
					foreach($rencontres as $rc) { 
						
					$status_invite = $r->checkInvitationStatus($rc->id, $p->idplayer);
					?>
					<td class="center">
					<?php if($status_invite->invite_status == 'n') { ?>
						<span class="invite"><a href="dashboard/team/<?php echo $_GET['idteam']; ?>/<?php echo $p->idplayer; ?>/inviteplayer/<?php echo $rc->id; ?>/">invite</a></span>
					<?php } elseif($status_invite->invite_status == 'y') { ?>
						<a class="btn btn4 btn_info" href=""></a>
					<?php } ?>
					</td>
					<?php } ?>
				</tr>
				<?php } ?><!--
				<tr>
					<td>
						<div class="progress progress150">
							<div class="bar"><div style="width: 60%;" class="value bluebar"></div></div>
						</div>
					</td>
					<td><a class="btn btn4 btn_info" href=""></a></td>
					<td>856, 220</td>
					<td class="center">32, 012</td>
					<td class="center">20.5</td>
				</tr>-->
			</tbody>
		</table>
	</div>
	<div id="activities" class="subcontent" style="display: none;">
		<table cellpadding="0" cellspacing="0" border="0" class="stdtable overviewtable">
			<colgroup>
				<col class="con0" width="20%" />
				<col class="con1" width="20%" />
				<col class="con0" width="20%" />
				<col class="con1" width="20%" />
				<col class="con0" width="20%" />
			</colgroup>
			<thead>
				<tr>
					<th class="head0">Metric</th>
					<th class="head1">Rates</th>
					<th class="head0">Impressions</th>
					<th class="head1">Unique Visits</th>
					<th class="head0">Average Time (min)</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div class="progress progress150">
							<div class="bar"><div style="width: 60%;" class="value bluebar"></div></div>
						</div>
					</td>
					<td>67.3%</td>
					<td>856, 220</td>
					<td class="center">32, 012</td>
					<td class="center">20.5</td>
				</tr>
			</tbody>
		</table>
	</div>
	
</div>