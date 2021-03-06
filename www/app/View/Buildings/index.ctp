<div class="camp info">

    <div class="divtop curvedtot">
        Bâtiments construit sur votre camp
    </div>

    <div class="space0">

        <?php foreach ($data['Buildings'] as $building):
            $building = current($building);
            $type = $building['databuilding_id'];
            $databuilding = current($data['Databuildings'][$type]);
            ?>
            <div class="space1 curvedtot">
                <div class="space">
                    <div><a href="<?= $this->Html->url('/buildings/display/'.$databuilding['id']);?>">
                        <?=$databuilding['name'];?> </a> (Niveau <?=$building['lvl'];?>)
                        </a>
                    </div>
                    <div>
                        Coût pour le niveau <?=($building['lvl']+1);?> : <?=floor($databuilding['res1']);?> Métal <?=floor($databuilding['res2']);?> Cristal <?=floor($databuilding['res3']);?> Uranium
                    </div>
                    <div>
                        Durée de construction : <?=gmdate("H:i:s", round($databuilding['time']));?>
                    </div>
                    <div><?= $this->Html->link('Upgrade','/buildings/create/'.$type);?></div>
                </div>
            </div>
        <?php endforeach;?>

        <br>

        <div class="space1 curvedtot">
            <div class="space"><?= $this->Html->link('Construire bâtiment', '/buildings/buildable');?></div>
        </div>
    </div>

    <?php if (!empty($data['Dtbuildings'])): ?>

        <br>

        <div class="divtop curvedtot">
            Bâtiments en cours de construction
        </div>

        <div class="space0">
            <?php for ($i=count($data['Dtbuildings'])-1; $i >= 0; $i--):
                $dtbuilding = current($data['Dtbuildings'][$i]);
                $type = $dtbuilding['databuilding_id'];
                $databuilding = current($data['Databuildings'][$type]);
                $timeLeft = $dtbuilding['finish'] - time();
                $datetime = gmdate("H:i:s", $timeLeft);
                ?>
                <div class="space1 curvedtot">
                    <div time="<?=$timeLeft;?>" class="space">
                        <?= $databuilding['name'].' de niveau '.$dtbuilding['lvl'];?>
                        <?php if ($timeLeft <= 0):?>
                            <?= ' terminé.';?>
                        <?php else:?>
                            <?= ' finira dans '.$datetime; ?>
                        <?php endif;?>
                    </div>
                </div>
            <?php endfor;?>
        </div>

    <?php endif;?>

</div>






