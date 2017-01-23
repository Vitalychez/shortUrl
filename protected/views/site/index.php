<?php

$this->title = 'Сервис коротких ссылок';

?>
<div class="container">
	<div class="row">
		<div class="col-xs-6 centred">
			<div class="input-group">
				<input id="ShortUrl" type="text" class="form-control" placeholder="Вставьте ссылку">
				<span class="input-group-btn">
					<button id="Short" class="btn btn-success" type="button">Укоротить</button>
				</span>
			</div>
            <div class="form-group hidden">
                <label for="usr">Сокращенная ссылка:</label>
                <input id="ShortValue" type="text" class="form-control">
            </div>
		</div>
	</div>
</div>

