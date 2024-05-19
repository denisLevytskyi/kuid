<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>[LVZ] Trainz KUIDs slise</title>
</head>
<body>
	<style>
		/*MAIN CSS*/
		/** {
			border: 1px solid red;
		}*/

		div, p, input, button, form, span, a, ul, li, xmp, pre {
			box-sizing: border-box;
			padding: 0;
			margin: 0;
		}

		body {
			font-family: 'Roboto', sans-serif;
			padding: 0;
			margin: 0;
			font-size: 16px;
			background: grey;
		}

		h1, h2, h3, h4, h5, h6 {
			margin: 0;
			font-weight: bold;
			font-size: 20px;
		}

		ul, li {
			list-style: none;
		}

		a { 
			text-decoration: none;
			color: inherit;
			font-size: 16px;
		}

		.container {
			max-width: 90%;
			margin: 0 auto;
		}

		.headerWrap {
			padding: 0 5px;
			display: flex;
			flex-wrap: nowrap;
			align-items: center;
			justify-content: space-between;
			background: black;
			color: white;
		}

		.headerWrapImg {
			height: 50px;
			background: white;
		}

		section {
			margin: 25px auto;
		}

		.initForm {
			display: flex;
			flex-direction: column;
			max-width: 400px;
			margin: auto;
		}

		.initFormInp {
			margin-bottom: 10px;
			padding: 5px;
			border: 1px solid grey;
			border-radius: 5px;
			text-align: center;
			font-size: 14px;
			font-weight: bold;
		}

		.initFormBtn {
		    width: fit-content;
		    display: inline;
		    background: yellow;
		    font-weight: bold;
		    text-align: center;
		    padding: 5px 20px;
		    margin: 0 0 0 auto;
		    border: 1px solid grey;
		    border-radius: 5px;
		    cursor: pointer;
		    transition-duration: 1s;
		}

		.initFormBtn:hover {
			background: palegreen;
			transition-duration: 1s;
		}

		.rezult {
			background: rgba(0, 0, 0, 0.7);
			color: white;
			max-width: 100%;
			font-size: 10px;
		}

		.rezult .container {
			padding: 5px;
		}

		.rezultWrapP {
			text-align: center;
			font-size: 20px;
			font-weight: bold;
			padding: 10px;
		}

		.rezult xmp {
			max-width: 100%;
			white-space: normal;
			overflow-wrap: anywhere;
			margin-top: 10px;
			cursor: pointer;
		}

		.rezult pre {
			font-weight: bold;
			font-size: 16px;
			margin: 5px 0;
			cursor: pointer;
		}

		.copyInp {
			width: 10px;
			height: 10px;
			position: fixed;
			top: -100px;
		}

		.blue {
			color: blue;
		}
	</style>
	<header class="header">
		<div class="container">
			<div class="headerWrap">
				<img src="mainLogo.png" class="headerWrapImg">
				<p class="headerWrapP">[LVZ] Trainz KUIDs slise</p>
			</div>
		</div>
	</header>
	<section class="init">
		<div class="container">
			<form action="" method="POST" id="form" class="initForm">
				<textarea id="kuid" name="kuid" type="text" required="" class="initFormInp"></textarea> 
				<input id="step" name="step" type="number" required="" value="500" class="initFormInp">
				<input id="stop" name="stop" type="text" required="" value="," class="initFormInp">
				<button type="submit" id="btn" class="initFormBtn">ОТПРАВИТЬ</button>
			</form>
		</div>
	</section>
	<section class='rezult'>
		<div class="container">
			<div class="rezultWrap" id="rezultWrap">
				<p class="rezultWrapP">
					РЕЗУЛЬТАТЫ ПОЯВЯТСЯ ТУТ
				</p>
			</div>
		</div>
	</section>
	<section class="copy">
		<input type="text" class="copyInp" id="copyInp">
	</section>
	<script>
		var form = document.getElementById('form');
		var rezult_wrap = document.getElementById('rezultWrap');
		var copy_inp = document.getElementById('copyInp');
		var kuid;
		var step;
		var srop;

		// Функия получения текста запроса из формы
		const get_request_text = () => {
			var kuid = document.getElementById('kuid').value;
			var step = document.getElementById('step').value;
			var stop = document.getElementById('stop').value;
			var request_text = `kuid=${kuid}&step=${step}&stop=${stop}`;
			return request_text;			
		};

		// Функция отправки и выведения запроса
		const send_request = () => {
			var request = new XMLHttpRequest();
			request.open('POST', 'script.php', true);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.send(get_request_text());
			request.addEventListener('readystatechange', () => {
				if (request.readyState == 4 && request.status == 200) {
					rezult_wrap.innerHTML = request.responseText;
					delete (request);
				};
			});
		};

		form.addEventListener ('submit', (event) => {
			event.preventDefault();
			send_request();
		});

		// Копирование текста ответов
		rezult_wrap.addEventListener('click', (event) => {
			var target = event.target;
			var target_text = target.innerHTML;
			copy_inp.value = target_text;
			copy_inp.select();
			document.execCommand('copy');
			copy_inp.value = '';
			target.classList.add('blue');
		});
	</script>
</body>
</html>