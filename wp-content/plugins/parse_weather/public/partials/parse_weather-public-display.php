<!-- view parse table -->
<table class="table table-striped weather">
    <thead>
    <th colspan="8">
    <div class="btn-group">
        <button id="day1" type="button" class="btn btn-primary btn-md ">1 день</button>
        <button id="day2" type="button" class="btn btn-primary btn-md ">2 день</button>
        <button id="day3" type="button" class="btn btn-primary btn-md ">3 день</button>
    </div>
    </th>
    </thead>
    <thead>
    <th></th>
    <th colspan="2" class="wide">Характеристики&nbsp;погоды, атмосферные&nbsp;явления</th>
    <th class="temp">Tемпература воздуха,°C</th>
    <th class="preassure">Атм.&nbsp;давл., мм рт. ст.</th>
    <th class="speed">Ветер,<br> м/с</td>
    <th class="humm">Влажность  воздуха,&nbsp;%</th>
    <th class="comfort">Ощущается, °C</th>
    </thead>
    <?php if($data): ?>
        <?php foreach ($data as $key=>$val): ?>
            <tr>
                <td><?=$val['th']?></td>
                <td><img src="<?=$val['img']?>"></td>
                <td><?=$val['climate']?></td>
                <td><?=$val['temp']?></td>
                <td><?=$val['atmosphere']?></td>
                <td><?=$val['air']?></td>
                <td><?=$val['humidity']?></td>
                <td><?=$val['feel']?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
