<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="site-tasks">
    <div class="row">
    <div class="col-lg-12">
    	<h1 class="text-center">Тестовые задания</h1><br>
			<div class="col-lg-6">	
				<?php /* Запрос 1 */ ?>
				<div class="panel panel-success">
                  <div class="panel-heading ">
                    <h3 class="panel-title">
        <?= 'Запрос 1: Напишите запрос, который выберет имя пользователя (bids.name) с самой высокой ценой заявки (bids.price)' ?>      
                    </h3>
                  </div>
                  <div class="panel-body">
                  <?php foreach($bids1 as $k): ?>
                        <?= 'Имя: '.$k->name ?><br>
						<?= 'Цена: '.$k->price ?><br>
						<?= 'Мероприятие: '.$k->events->caption ?><br>
						<?php endforeach ?>
                  </div>
                </div>
			</div>
			<div class="col-lg-6">	
				<?php /* Запрос 2 */ ?>
				<div class="panel panel-success">
                  <div class="panel-heading ">
                    <h3 class="panel-title">
        <?= 'Запрос 2: Напишите запрос, который выберет название мероприятия (events.caption), по которому нет заявок' ?>                    
                    </h3>
                  </div>
                  <div class="panel-body">
                   <?php foreach($bids2 as $k): ?>
	                  	<?php if ($k->caption != NULL): ?>
							<?= 'По мероприятию '.$k->caption.' нет заявок' ?>
							<br>
						<?php else: ?>
							<?= 'По всем мероприятиям есть заявки'.$xk ?>
						<?php endif ?>	
				   <?php endforeach ?>
                  </div>
                </div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-6">
                <?php /* Запрос 3 */ ?>
				<div class="panel panel-danger">
                  <div class="panel-heading ">
        <?= 'Запрос 3: Напишите запрос, который выберет название мероприятия (events.caption), по которому больше трех заявок' ?>        
                    </h3>
                  </div>
                  <div class="panel-body">
                  <?php foreach($bids4 as $k): ?>
                  	<?php if($k->kol > 3): ?>
						<?= 'Кол-во заявок: '.$k->kol ?><br>
						<?= 'Название: '.$k->caption ?><br>
					<?php endif ?>	
				  <?php endforeach ?>
                  </div>
                </div>
			</div>

			<div class="col-lg-6">
				 <?php /* Запрос 4 */ ?>
				<div class="panel panel-danger">
                  <div class="panel-heading ">
                    <h3 class="panel-title">
        <?= 'Запрос 4: Напишите запрос, который выберет название мероприятия (events.caption), по которому больше всего заявок' ?>         
                    </h3>
                  </div>
                  <div class="panel-body">
                  <?php foreach($bids4 as $k): ?>
                  	<?php $arrx[] = $k->kol ?>
                  <?php endforeach ?>

                  <?php foreach($bids4 as $k): ?>
                  	<?php if(max($arrx) == $k->kol): ?>
						<?= 'Максимальное кол-во заявок: '.$k->kol ?><br>
						<?= 'Название: '.$k->caption ?><br>
					<?php endif ?>	
						
						<?php endforeach ?>
                  </div>
                </div>
			</div>
		</div>

		<div class="col-lg-6">	
				<?php $form = ActiveForm::begin(); ?>	
				    <div class="col-lg-12">
				        <?= $form->field($modelf, 'students')->label('Кол-во учеников') ?>
				    </div>

				    <div class="col-lg-12">    
				        <?= $form->field($modelf, 'sport')->label('Кол-во % из них занимающихся спортом') ?>

				    </div>
				
				    <div class="col-lg-12">
				        <?= Html::submitButton('Расчет', ['class' => 'btn btn-primary']) ?>
				    </div>
				<?php ActiveForm::end(); ?>
		</div>

		<div class="col-lg-6">
			<?php if ($modelf->load(Yii::$app->request->post()) && $modelf->validate()): ?>
			<!-- Задание #1 with form --> <br>
			<div>
				<p>
					<b>
						1) Написать алгоритм решения задачи:
					</b>
				</p>

				<p>
					<i>
						В классе 28 учеников. 75% из них занимаются спортом. 
						Сколько учеников в классе занимаются спортом 
						и сколько всего учеников в классе?
					</i>
				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
						<?php 
							$proc = 100;	
						?>
						<ul>
							<li><?= 'Сколько учеников в классе занимаются спортом? = '.$modelf->students * $modelf->sport / $proc ?></li>
							<li><?= 'Сколько всего учеников в классе? = '.$modelf->students ?></li>
						</ul>			
					</p>	
				</div>
			</div>
			<?php endif ?> 
		</div>	
 		
    	<div class="col-lg-12">
			
			
			<!-- Задание #2 --> <br>
			<div>
				<p>
					<b>
						2) Реализовать алгоритм извлечения числовых значений со строки:
					</b>
				</p>

				<p>
					<i>
						This server has 386 GB RAM and 5000 GB storage
					</i>
				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
						<?php 
							$str = 'This server has 386 GB RAM and 5000 GB storage';
							$count = preg_match_all('/\\d/', $str);
							$newstr = preg_replace("/[^0-9]/", ' ', $str);	
						?>
						<ul>
							<li><?= 'Кол-во чисел в строке = '.$count ?></li>
							<li><?= 'Извлечения числовых значений = '.$newstr ?></li>
						</ul>			
					</p>	
				</div>
			</div>
			<!-- Задание #3 -->
			<div>
				<p>
					<b>
						3) Как получить первый элемент массива ?
					</b>
				</p>

				<p>
					<i>
						[2,3,56,65,56,44,34,45,3,5,35,345,3,5]
					</i>
				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
						<?php 
							$arr = array(2,3,56,65,56,44,34,45,3,5,35,345,3,5);	
						?>
						<ul>
							<li>
								<?= 'Весь массив = ' ?>
								<?php foreach($arr as $k):?>
								<?= $k ?>
								<?php endforeach?>
							</li>
							<li>
								<?= 'Первый элемент массива = '.array_shift($arr) ?>
							</li>
							<li>
								<?= 'Последний элемент массива = '.array_pop($arr) ?>
							</li>							
						</ul>			
					</p>	
				</div>
			</div>
			<!-- Задание #4 -->
			<div>
				<p>
					<b>
						4) Как вычислить остаток от деления? 
					</b>
				</p>

				<p>
					<i>
						10 / 3
					</i>
				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
						<?php 
							$a = 10;
							$b = 3;
						?>
						<ul>
							<li>
								<?= 'Остаток от деления: '.$a.' % '.$b.' = '.$a % $b ?>
							</li>						
						</ul>			
					</p>	
				</div>
			</div>
			<!-- Задание #5 -->
			<div>
				<p>
					<b>
						5) Нужно поменять 2 переменные местами без использования третьей: 
					</b>
				</p>

				<p>
					<i>
						$а = [1,2,3,4,5];<br>
						$b = ‘Hello world’;
					</i>

				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
						<?php 
							$a = array(1,2,3,4,5);
							$b = 'Hello world';
							list($a, $b) = [$b, $a];
						?>
						<ul>
							<li>
								<?= '$a = '.$a ?>
							</li>
							<li>	
								<?= '$b = ' ?>
								<?php for($i=0;$i<count($b);$i++):?>
								<?= $b[$i] ?>
								<?php endfor?>
							</li>						
						</ul>			
					</p>	
				</div>
			</div>
			<!-- Задание #6 -->
			<div>
				<p>
					<b>
						6) Чем отличается оператор:  
					</b>
				</p>

				<p>
					<i>
						== от === ?
					</i>
				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
						<ul>
							<li>
								<?php $a = '57'; $b=57; ?>
								<?= 'Отличие == от === в типах данных'?><br>
								<?= '$a'." = '57' (string)" ?><br>
								<?= '$b'." = 57 (integer)" ?><br>
							</li>

							<li>	
								<?php 
									if($a == $b) {
									echo '$a == $b = True';
									} else {
									echo '$a == $b = False';
									}
								?>
							</li>
							
							<li>	
								<?php 
								$a = '57'; $b=57;
									if($a === $b) {
									echo '$a === $b = True';
									} else {
									echo '$a === $b = False';
									}
								?>
							</li>						
						</ul>			
					</p>	
				</div>
			</div>
			<!-- Задание #7 -->
			<div>
				<p>
					<b>
						7) Чем отличается: 
					</b>
				</p>

				<p>
					<i>
						require от include ?
					</i>
				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
						<ul>
							<li>
								require() возвращает FATAL ERROR, если файл не найден 
							</li>

							<li>	
								include() возвращает только WARNING
							</li>						
						</ul>			
					</p>	
				</div>
			</div>
			<!-- Задание #8 -->
			<div>
				<p>
					<b>
						8) Какие данные пользователя сайта из перечисленных можно считать на 100% достоверными: 
					</b>
				</p>

				<p>
					<i>
						cookie, данные сессии, IP-адрес пользователя , User-Agent? Почему?
					</i>
				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
						<ul>
							<li>
								Данные сессии хранятся на сервере, так что им можно доверять
							</li>						
						</ul>			
					</p>	
				</div>
			</div>
			<!-- Задание #9 -->
			<div>
				<p>
					<b>
						9) Что выведет следующий код на JavaScript и почему: 
					</b>
				</p>

				<p>
					<i>
						for( var i =0; i < 10; i++) {<br>
							setTimeout(function () {<br>
							console.log(i);<br>
							}, 100);<br>
						}
					</i>
				</p>
				<div class="alert alert-success">
					<p>
						<b>
							Решение:
						</b>
					</p>
					<p>
					<script>
						for(var i=0; i<10; i++) {
							setTimeout(function () {
							console.log(i);
							}, 100);
						}
					</script>
						<ul>
							<li>
								В консоле выведет число 10
							</li>
							<li>
								Функция <code>setTimeout</code> принимает ссылку на функцию в качестве первого аргумента
							</li>	
							<li>
								Второй аргумент отвечает за время, через сколько выполнится действие
							</li>	
							<li>
								Метод <code>console.log()</code> выводит отладочную информацию в консоль, т.е. скрывая ее от пользователей.
							</li>				
						</ul>			
					</p>	
				</div>
			</div>
		</div>
    </div>
</div>
<?php $this->endBody() ?>	
</body>
</html>
<?php $this->endPage() ?>
