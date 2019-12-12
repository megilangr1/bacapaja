<html>
	<head>
		<title>Color Generator</title>
	</head>

	<body id="color">
		<div>
			<input type="text" id="code" maxlength="6" placeholder="Masukan Kode Warna" placeholder="Ex. fff000">
		</div>


		<script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
		<script>
			$('#code').on('keyup', function () {
				var kode = '#' + $(this).val();
				console.log(kode);
				$('#color').css("background-color", kode);
			});

		</script>
	</body>
</html>
