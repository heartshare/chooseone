<?php

function cliAction($desciption, $command)
{
    passthru($command);
}

cliAction('Migrate project', 'php yiic migrate');
