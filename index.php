<html>
<title>YT Collections</title>
<head>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="index.css">
<script type="text/javascript">
	<?php
		include 'config.php';
		$all_array = array();

		$maxResults = 2; // max is 50

		if(isset($_GET['latestonly']) || isset($_GET['latest'])){
			$maxResults = 1;
		}
		$lowercase_params = array_change_key_case($_GET, CASE_LOWER);
		if(isset($lowercase_params['maxresults'])){
			$maxResults = $lowercase_params['maxresults'];
		}
	?>

	var ids = [];
	var debug = false;

	var channels = [
		["LDM", "UUDl6xIISC4tm38lzmcHvDiQ"],
		["PerfectElectroMusic", "UUtCcPJl-cIG-mRiIyg-PKsQ"],
		["xKito", "UUMOgdURr7d8pOVlc-alkfRg"],
		["xKito2", "UUE_4AzEG60_GRBg4im9tKHg"],
		["MrSuicideSheep", "UU5nc_ZtjKW1htCVZVRxlQAQ"],
		["NoCopyrightSounds", "UU_aEa8K-EOJ3D6gOs7HcyNg"],
		["MixHound", "UU_jxnWLGJ2eQK4en3UblKEw"],
		["AirwaveMusicTV", "UUwIgPuUJXuf2nY-nKsEvLOg"],
		["Proximity", "UU3ifTl5zKiCAhHIBQYcaTeg"],
		["WhySoDank", "UUjE1fSNLI_RzC8-ZjkqHH9Q"],
		["Liquicity", "UUSXm6c-n6lsjtyjvdD0bFVw"],
		["Berzox", "UUyePQ8y0eJQ5E-EuiaE29Xg"],
		["Monstafluff", "UUNqFDjYTexJDET3rPDrmJKg"],
		["MajesticCastle", "UUXIyz409s7bNWVcM-vjfdVA"],
		["GalaxyMusic", "UUIKF1msqN7lW9gplsifOPkQ"],
		["Fluidfied", "UUTPjZ7UC8NgcZI8UKzb3rLw"],
		["ArcticEmpire", "PL47GfNryB12uTUdaeDxlbBhGZQLVKJvoT"],
		["eoenetwork", "UUoHJ5m7J27_u96gksCkHnlg"],
		["DiversityPromotions", "UU7tD6Ifrwbiy-BoaAHEinmQ"],
		["MAMusic", "UU0XKvSq8CcMBSQTKXZXnEiQ"],
		["MrRevillz", "UUd3TI79UTgYvVEq5lTnJ4uQ"],
		["VarietyMusic", "UUkFKSmbFIVQ1xY6j9vJlCcA"],
		["Clown", "UUT4e_djPUZOkOLTZzTtnxUQ"],
		["Niiiiiiiiiiii", "UUmsh_oOrl1hby7P1ZUx5Yfw"],
		["MrMoMMusic", "UUJBpeNOjvbn9rRte3w_Kklg"],
		["WaveMusic", "UUbuK8xxu2P_sqoMnDsoBrrg"],
		["NightcoreReality", "UUqX8hO4JWM6IJfEabbZmhUw"],
		["CloudKid", "UUSa8IUd1uEjlREMa21I3ZPQ"],
		["TheLalaTranceGirl", "UUMQBva6MUyidoNmcV8gIV9g"],
		["DubstepGutter", "UUG6QEHCBfWZOnv7UVxappyw"],
		["PenguinMusic", "UU0YSN3ge1paAcKMC_X3ktsw"],
		["UnitedDubstep", "UUVrYrjXtAIgBbVN1i_FiGtw"]
	];

	$(document).ready(function(){
		var deferreds = [];
		for (var i = 0; i < channels.length; i++) {
			deferreds.push(getVideosFromPlaylistV3(channels[i][1]));
		}
		$.when.apply($, deferreds).then(allAjaxCallsDone);
	});
	
	function allAjaxCallsDone(){
		var body = $("body");
		for (var i in ids) {
			body.html(body.html() + "<div class='module' id='" + i + "'><div class='modulehead'><a href='https://www.youtube.com/watch?v=" + ids[i].id + "'>" + ids[i].channelTitle + " ~ " + ids[i].title + "</a></div><div class='modulebody'><img src='https://i.ytimg.com/vi/" + ids[i].id + "/mqdefault.jpg' class='videoimg'></div></div>");
		}
	}

	function getVideosFromPlaylistV3(str){
		var call = $.ajax({
			url: "https://www.googleapis.com/youtube/v3/playlistItems?part=contentDetails,snippet&maxResults=<?php echo($maxResults);?>&playlistId=" + str + "&key=<?php echo($key);?>",
		})
		.done(function(data) {
			for (var key in data.items) {
				var itemobj = data.items[key];
				var videoTitle = itemobj["snippet"]["title"];
				var videoId = itemobj["contentDetails"]["videoId"];
				var channelId = itemobj["snippet"]["channelId"];
				var channel = itemobj["snippet"]["channelTitle"];
				if (debug) {
					console.log(videoTitle + " " + videoId);
				}
				var node = {title: videoTitle, id: videoId, channelTitle: channel, channelId: channelId};
				ids.push(node);
			}
			$("title").html(ids.length);
		});
		return call;
	}

</script>
<base target="_blank">
</head>
<body>
	<!-- >.> -->
</body>
</html>
