<html>
<title>YT Collections</title>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script src="jquery.timeago.js" type="text/javascript"></script>
<script type="text/javascript">
	<?php
		include 'config.php';

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
	var channelsDone = 0;

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
		["UnitedDubstep", "UUVrYrjXtAIgBbVN1i_FiGtw"],
		["OneChilledPanda", "UUkUTBwZKwA9ojYqzj6VRlMQ"],
		["SuicideSheeep", "UULTZddgA_La9H4Ngg99t_QQ"],
		["TrapNation", "UUa10nxShhzNrCE1o2ZOPztg"],
		["TrapGutter", "UUaJdK74vrx8Mk6HlwNk0uEQ"],
		["KoalaKontrol", "UUBYg9_11ErMsFFNR66TRuLA"],
		["JompaMusic", "UU1WKD9pJt5Sa4DCVaoJSAGw"],
		["EpicMusicVN", "PL4adbQCQMmoZNMuDUsddQw4r9XWNdLbbI"],
		["OrionMusicNetwork", "UUdy-3GIGZy2DD65TPg3i1GA"],
		["InverseNetwork", "UUx5rscERi7IpVS9dO_HCl5A"],
		["JED", "UUCCs8U1UsY-KlOePhSrMJdg"],
		["NighTcoreFC", "UU5I3vUh2iNfQ3pCU3sodYRA"],
		["DeadMusicFC", "UUBsKAivSo21NEubmxiLPUWw"],
		["CrazyBass Promotions", "UU8uXrhG0n-i6as8V273Mknw"],
		["BassOneMusic", "UUmyBcA6xsJDuKn_An6wL-EA"],
		["EDMKobart", "UULTqXy_Y5G1nw5cBN21O_zw"],
		["Lustcore", "UUrNlBy9CwV-sHGbRa6mf1GA"],
		["KyraPromotions", "UUqolymr8zonJzC08v2wXNrQ"],
		["RackiePromotions", "UUqPgPXkG6acQomkAewewcNQ"],
		["NightcoreGalaxy", "PLHO3r5TU5dB9xtGsbOcwXVpkiPQiTZiDV"],
		["NexusNetwork", "UUl4UOc8h1ZnO-inFPgAu7gw"],
		["ReinaXmina", "UUwyU7wNCjTmcrRWws7ZTlXw"]
	];

	$(document).ready(function(){
		var deferreds = [];
		for (var i = 0; i < channels.length; i++) {
			deferreds.push(getVideosFromPlaylistV3(channels[i][1], <?php echo($maxResults);?>));
		}
		$.when.apply($, deferreds).then(allAjaxCallsDone);
	});

	var cc = 0;
	function allAjaxCallsDone(){
		var body = $("body");
		for (var i in ids) {
			body.html(body.html() + "<div class='module' id='" + i + "'><div class='modulehead'><div class='videotitle'><a href='https://www.youtube.com/watch?v=" + ids[i].id + "'>" + ids[i].title + "</a></div></div><div class='videoimg'><a href='https://www.youtube.com/watch?v=" + ids[i].id + "'><img src='https://i.ytimg.com/vi/" + ids[i].id + "/mqdefault.jpg' style='width: 100%'></a></div><div class='videodescimg' id='" + ids[i].channelId + cc + "'></div><div class='videodesc' id='" + ids[i].id + cc +"'>" + ids[i].channelTitle + "</div></div>");
			getChannelIcon(ids[i].channelId, ids[i].channelId + cc);
			getVideoInfo(ids[i].id, ids[i].id + cc);
			cc++;
		}
		$(".videodescimg").hover(function(e){
			$(this).fadeOut(50).fadeIn(50).fadeOut(50).fadeIn(50);
		}, function(e){});
		$(".loadingInfo").remove();
	}

	function getChannelIcon(str, resultId){
		$.ajax({
			url: "requests.php?url=" + encodeURIComponent("https://www.googleapis.com/youtube/v3/channels?part=snippet&id=" + str + "&key="),
			dataType: "json"
		})
		.done(function(data) {
			for (var key in data.items) {
				var itemobj = data.items[key];
				var iconUrl = itemobj["snippet"]["thumbnails"]["default"]["url"];
				$("#" + resultId).html("<a href='https://www.youtube.com/channel/" + str + "'><img src='" + iconUrl + "' width='46' style='float: left; margin: 2px'></a>" + $("#"+ resultId).html());
			}
		});
	}

	function getVideoInfo(str, resultId){
		$.ajax({
			url: "requests.php?url=" + encodeURIComponent("https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id=" + str + "&key="),
			dataType: "json"
		})
		.done(function(data) {
			for (var key in data.items) {
				var itemobj = data.items[key];
				var time = itemobj["snippet"]["publishedAt"];
				var views = itemobj["statistics"]["viewCount"];
				$("#" + resultId).html($("#"+ resultId).html() + "<br><abbr id='" + resultId +"timeago' class='timeago' title='" + time + "'>" + time + "</abbr><br>" + views + " views");
				$("#" + resultId + "timeago").timeago();
			}
		});
	}

	function getVideosFromPlaylistV3(str, maxResults){
		var call = $.ajax({
			url: "requests.php?url=" + encodeURIComponent("https://www.googleapis.com/youtube/v3/playlistItems?part=contentDetails,snippet&maxResults=" + maxResults + "&playlistId=" + str + "&key="),
			dataType: "json"
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
			// Circular loading bar
			channelsDone += 1;
			var rotation = 180 * channelsDone / channels.length;
			var rotationFix = rotation * 2;
			$('.circle .fill, .circle .mask.full').css("transform", 'rotate(' + rotation + 'deg)');
			$('.circle .fill, .circle .mask.full').css("-webkit-transform", 'rotate(' + rotation + 'deg)');
			$('.circle .fill, .circle .mask.full').css("-ms-transform", 'rotate(' + rotation + 'deg)');
			$('.circle .fill, .circle .mask.full').css("-moz-transform", 'rotate(' + rotation + 'deg)');
			$('.circle .fill.fix').css("transform", 'rotate(' + rotationFix + 'deg)');
			$('.circle .fill.fix').css("-webkit-transform", 'rotate(' + rotationFix + 'deg)');
			$('.circle .fill.fix').css("-ms-transform", 'rotate(' + rotationFix + 'deg)');
			$('.circle .fill.fix').css("-moz-transform", 'rotate(' + rotationFix + 'deg)');

			$('.progresscount').html(channelsDone + "/" + channels.length);

			$("title").html(ids.length);
		});
		return call;
	}

</script>
<base target="_blank">
</head>
<body>
	<div class="loadingInfo">
		<div class="radial-progress">
			<div class="circle">
				<div class="mask full">
					<div class="fill"></div>
				</div>
				<div class="mask half">
					<div class="fill"></div>
					<div class="fill fix"></div>
				</div>
				<div class="shadow"></div>
			</div>
			<div class="inset">
			<div class="progresscount">0/?</div>
			</div>
		</div>
	</div>
</body>
</html>
